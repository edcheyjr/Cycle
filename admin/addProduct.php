<?php
require '../connect.php';

$imageErrMessage = $uploadMessage = $validateErr = null;

// remove special characters
function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
}  
 

if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['submit'])){
    // extract input from post array
    // print_r($_FILES['file']) && die;
    include 'utils/resize.php';
    // original file dir

    $target_dir_original = '../public/store/original/';
    

    //thumbails dir 
    $target_dir_thumbnail_full = '../public/store/thumbnails/full/';
    $target_dir_thumbnail_large = '../public/store/thumbnails/large/';
    $target_dir_thumbnail_small = '../public/store/thumbnails/small/';

   
    $file = $_FILES["file"];
    $filePath =  basename($_FILES['file']['name']);
    $fileError = $_FILES["file"]["error"];
    $fileName = $_FILES["file"]["name"];
    $tempFile = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    
    extract($_POST);
    // $name = $_POST['name'];
    // $price = $_POST['price'];
    // $company = $_POST['company'];
    $check_string = '/^[a-zA-z_\s]*$/';
    if(empty($name)){
      $validateErr = 'name is required!';
    }
    elseif(!preg_match($check_string,$name)){
      $validateErr = 'only alphabet and whitespaces allowed!';
    }
    else{
     // sanitize $name and continue to check the next input 
      input_data($name);
     $name = filter_var($name,FILTER_SANITIZE_STRING);
      if(empty($price)){
        $validateErr = 'price is required!';
      }
      elseif($price === 0){
        $validateErr = 'price cannot be zero!';
      }
      elseif(!filter_var($price,FILTER_VALIDATE_INT)){
        $validateErr = 'only numbers allowed!';
      }
      else{
        // sanitize price and move to check the next input
        input_data($price);
        $price = filter_var($price,FILTER_SANITIZE_NUMBER_INT);
        if(empty($company)){
          $validateErr = "company name required!";
        }
        elseif(!preg_match("/^[a-zA-Z0-9_\s]*$/",$company)){

          $validateErr = 'only alphabet, numbers and whitespaces allowed!';
        }
        else{

          input_data($company);
          // SANITIZE and move to the next item
          filter_var($company, FILTER_SANITIZE_STRING);
          if(!preg_match("/^[a-zA-Z0-9#]*$/",$color1)){

            $validateErr = 'only alphabet number and # allowed!';

          }else{
        // sanitize price and move to check the next input
            $color1 = filter_var($color1,FILTER_SANITIZE_STRING);
            if(!preg_match("/^[a-zA-Z0-9#]*$/",$color2)){

              $validateErr = 'only alphabet number and # allowed!';
            }
           $color2 = filter_var($color2,FILTER_SANITIZE_STRING);
          }  
        }
      }
    }
    // filter the others
    
    if(!empty($file)){
      // Check if file already exists
      if (!file_exists($fileName)) {   
        // Valid file extensions
        // Select file type
        $imageFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
        // $file_ext = explode('.',$fileName);
        // $imageFileType = strtolower(end($file_ext));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if(in_array($imageFileType, $extensions_arr)){
          
          if ($fileSize <= 5000000) {
            
            if($fileError == 0){

              if($validateErr == null){
              // orginal filename renaming
                $newFileName = uniqid('',true).'_ORGINAL_IMG.'.$imageFileType;
                $targetFile =$target_dir_original.basename($newFileName);
                
                // resize the image for uniformity and also improve request handling interms of size of the image
                
                // rename
                $new_full_thumbnail_name = uniqid('',true).'_FULL_RESIZED_IMG.'.$imageFileType;
                $new_large_thumbnail_name = uniqid('',true).'_LARGE_RESIZED_IMG.'.$imageFileType;
                $new_small_thumbnail_name = uniqid('',true).'_SMALL_RESIZED_IMG.'.$imageFileType;

                // target storage
                $target_resized_full_thumbnail = $target_dir_thumbnail_full.basename($new_full_thumbnail_name);
                $target_resized_large_thumbnail = $target_dir_thumbnail_large.basename($new_large_thumbnail_name);
                $target_resized_small_thumbnail = $target_dir_thumbnail_small.basename($new_small_thumbnail_name);

                // copy temp file to this destination
                copy($tempFile, $target_resized_full_thumbnail);
                copy($tempFile, $target_resized_large_thumbnail);
                copy($tempFile, $target_resized_small_thumbnail);

                // resize that image
                resize_image($target_resized_full_thumbnail,$full_width,$full_height,true);
                resize_image($target_resized_large_thumbnail,$large_width,$large_height,true);
                resize_image($target_resized_small_thumbnail,$small_width,$small_height,true);

                if (move_uploaded_file($tempFile, $targetFile)){

                  $uploadMessage = "The file".  htmlspecialchars(basename($_FILES["file"]["name"])). " has succesfully been uploaded. new bike for sell!!!";
                  $addProductQuery = "INSERT INTO products(bicycle_name, color_1, color_2, price ,company	,image_name,full_thumbnail_path,large_thumbnail_path,small_thumbnail_path) VALUES('$name','$color1','$color2','$price','$company','$newFileName','$new_full_thumbnail_name','$new_large_thumbnail_name','$new_small_thumbnail_name')";
                    mysqli_query($connect,$addProductQuery) or die(mysqli_error($connect));
                  //  header('location:view.php');
                }else{
                  $imageErrMessage = "Sorry, there was an error uploading your file.";
                }      
              }
            }
            else{
              $imageErrMessage = 'Sorry, there was an error uplading image, error number'.$file_Error;
            }
          }
          else{
            $imageErrMessage = "Sorry, your file is too large.";
          }
        }else{
          $imageErrMessage =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
      }else{
        $$imageErrMessage = "Sorry, file already exists.";
      }
    }else{
      $imageErrMessage = 'please upload a photo';
    }
  }
}
// echo "Value: 4; No file was uploaded.";
// if($_FILES["file"]["error"]==UPLOAD_ERR_NO_FILE){
// $imageErrMessage = "there is no image photo";
// $uploadOk = 0;
// }
// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
  // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  // $uploadOk = 0;
  // }
  // Check if $uploadOk is set to 0 by an error

//  $old = $_FILES['file']['name'];
// $time = time();
// $new = 'file'.$time;
    // $target_file =rename(
    // $target_dir.basename($old),
  // $target_dir.basename($new)
  // );
   
  // require 'uploadImage.php';
  
// product "bicycle"
// contain
// id
// name
// price
// add two color which the bike has
// To add 
// count will add
// company
// featured boolean attached to the featured items queried
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- font-awesome -->
    <!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

 <title>Admin | Add Product</title>
</head>

<!-- css link-->
<link rel="stylesheet" href="../styles.css">
<body>
  <nav class="navbar page">
      <div class="nav-center">
        <!-- links -->
        <div>
          <button class="toggle-nav">
            <i class="fas fa-bars"></i>
          </button>
          <ul class="nav-links">
            <li>
              <a href="view.php" class="nav-link"> admin panel </a>
            </li>
            <li>
              <a href="addProduct.php" class="nav-link"> add product </a>
            </li>
          </ul>
        </div>
        <!-- logo -->
        <p class="nav-logo2 black">eCycle</p>
    </nav>
    <!-- sidebar -->
    <div class="sidebar-overlay">
      <aside class="sidebar">
        <!-- close -->
        <button class="sidebar-close">
          <i class="fas fa-times"></i>
        </button>
        <!-- links -->
        <ul class="sidebar-links">
          <li>
            <a href="view.php" class="sidebar-link">
              <i class="fas fa-home fa-fw"></i>
              admin panel
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-link">
              <i class="fas fa-couch fa-fw"></i>
              addProduct
            </a>
          </li>
        </ul>
      </aside>
    </div>
    <div class="container">
     <div class="mx-auto">

     <!-- <div>
      <p>Add new electric bicycles to sell</p>
     </div> -->
     <div class="card">
      <form class="form" action="addProduct.php" method="post" enctype="multipart/form-data" >
       <h3>Add new electric bicycle</h3>
      <?php if($imageErrMessage != null):?>
       <p class ='error-msg'><?=$imageErrMessage?></p>
       <?php endif?>
       <?php if($uploadMessage != null): ?>
        <p class="success-msg"><?=$uploadMessage?></p>
       <?php endif?>
        <?php if($validateErr != null):?>
        <p class="error-msg"><?=$validateErr?></p>
        <?php endif?>
       <div class="form-group">
         <label for="name" class="label">name</label>
        <input type="text" aria-label="name" id = "name" class="form-control" placeholder="name" name ="name" required>
       </div>
        <div class="form-group">
         <label for="price" class="label">price</label>
        <input type="number" aria-label="price" min='0' class="form-control" placeholder="price eg 2000" id = "price" name ="price" required>
       </div>
        <div class="form-group">
         <label for="company" class="label">company</label>
        <input type="text" aria-label="company" min='0' class="form-control" placeholder="company" id = "company" name ="company" required>
       </div>
        <div class="form-group">
         <label for="name" class="label">select image</label>
        <input type="file" aria-label="image" class="form-control" id ="name"  name ="file" required>
       </div>
        <div class="form-group">
         <label for="color1" class="label">select the dominant colors of the product</label>
        <select aria-label="first color set" class="form-control" id ="color1"  name ="color1">
          <option value="#fff">white</option>
          <option value="#e75757">red</option>
          <option value="#fffb0a">yellow</option>
          <option value="#fda400">orange</option>
          <option value="#008000">green</option>
          <option value="#0077ff">blue</option>
          <option value="#800080">purple</option>
          <option value="#ffc0cb">pink</option>
          <option value="#000">black</option>
        </select>
       </div>
       <div class="form-group">
         <label for="color1" class="label">add a secondary color</label>
          <select aria-label="second color set" class="form-control" id ="color2"  name ="color2">
          <option value="#fff">white</option>
          <option value="#e75757">red</option>
          <option value="#fffb0a">yellow</option>
          <option value="#fda400">orange</option>
          <option value="#008000">green</option>
          <option value="#0077ff">blue</option>
          <option value="#800080">purple</option>
          <option value="#ffc0cb">pink</option>
          <option value="#000">black</option>
        </select>
       </div>
       <button type="submit" class="btn form-control" name ="submit">Add</button>
     </form>
     </div>
     </div>
    </div>
    <script src="../src/validation.js"></script>
  </body>
</html>