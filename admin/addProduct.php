<?php
$host = "localhost";
$user = "root";
$password = "123hadi9alafu0";
$db ="ecycle";

$connect = mysqli_connect($host,$user,$password,$db);

$imageErrMessage = null;
$uploadMessage = null;
$namePriceCompanyImageEmpty = $nameValidateErr = $priceValidateErr = $companyValidateErr = $imageValidateErr = null;


if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['submit'])){
    // extract input from post array
    // print_r($_FILES['file']) && die;
    $target_dir = '../public/store/';
    $file = $_FILES["file"];
    $fileError = $_FILES["file"]["error"];
    $fileName = $_FILES["file"]["name"];
    $tempFile = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    extract($_POST);
    // $name = $_POST['name'];
    // $price = $_POST['price'];
    // $company = $_POST['company'];
        
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
              $newFileName = uniqid('',true).'.'.$imageFileType;
              $targetFile =$target_dir.basename($newFileName);

              if (move_uploaded_file($tempFile, $targetFile)){
                $uploadMessage = "The file".  htmlspecialchars(basename($_FILES["file"]["name"])). " has succesfully been uploaded.";
                $addProductQuery = "INSERT INTO products(bicycle_name, price ,company	,image_name) VALUES('$name','$price','$company','$newFileName')";
                 mysqli_query($connect,$addProductQuery) or die(mysqli_error($connect));
                //  header('location:view.php');
                }else{
                $imageErrMessage = "Sorry, there was an error uploading your file.";
              }      
            }else{
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
// color not add will depend with the type of the bike
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
       <?php elseif($uploadMessage != null): ?>
        <p class="success-msg"><?=$uploadMessage?></p>
        <?php elseif($nameValidateErr != null): ?>
        <p class="error-msg"><?=$nameValidateErr?></p>
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
        <input type="file" aria-label="name" class="form-control" id ="name"  name ="file">
       </div>
       <button type="submit" class="btn form-control" name ="submit">Add</button>
     </form>
     </div>
     </div>
    </div>
    <script src="../src/validation.js"></script>
</body>
</html>