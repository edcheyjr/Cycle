<?php
require 'connect.php';
// define variables
$error = null;
$fields = array();
$image_array = array();
$image_info =array();
$status = ['server error' =>'505','ok'=>200];
$thumbnails = array();
$response = [];
$aplhabets = 'abcdefghijklmnopqrstuvwxyz';
$strings = $aplhabets.strtoupper($aplhabets);
// original file dir
$target_url_original = 'http://localhost/ecycle/public/store/original/';
$target_dir = './public/store/original/';
//thumbails dir 
$target_url_thumbnail_full = 'http://localhost/ecycle/public/store/thumbnails/full/';
$target_url_thumbnail_large = 'http://localhost/ecycle/public/store/thumbnails/large/';
$target_url_thumbnail_small = 'http://localhost/ecycle/public/store/thumbnails/small/';


// generate image id
$image_id = md5($strings);

// get size and other info from the image
/**
 * parameter
 * @param string $target_file
 * @return array $imagedetails assocative
 */
function getImageFileInfo($target_file){
 // init imagedetails assoc
 $imagedetails = array();
 $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 $imagedetails['type']= 'image/'.$ext;
 $size = filesize($target_file);
 $imagedetails['size'] = $size;
 return $imagedetails;
}

// returns a json obj of everythumbnails
/**
 * @param int $thumbnail_width
 * @param int $thumbnail_height
 * @param string $url
 * @return object $details 
 */
function getThumbnails($thumbnail_width,$thumbnail_height,$url){
 // init variable
 $details = array();
 
 //input details to array 
 $details['url'] =$url;

 $details['width'] = $thumbnail_width;
 $details['height'] = $thumbnail_height; 

 return $details;
}
/**
 * query database for the 3 latest product to feature and add to them a field called featured which returns boolean
 * @param object mysqli object
 * @param int
 * @return boolean
 */

function featuredProducts($connect,$product_id){
 // init featured 
$featured = false;

 $queryTheLatestProducts = 'SELECT * FROM products ORDER BY date_added DESC LIMIT 3';
 $result = mysqli_query($connect, $queryTheLatestProducts);
 while($row = mysqli_fetch_assoc($result)){
   extract($row);
   if($product_id === $id){
    $featured = true;
   }
 }
 return $featured;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

 $queryAllProducts = "SELECT * FROM products ORDER BY date_added DESC;";
 $result = mysqli_query($connect,$queryAllProducts) or die(mysqli_error($connect));
 
 if(!$result){
  $error = 'their was error while getting the result';
  echo $error;
 }
 while( $row = mysqli_fetch_assoc($result)){
  extract($row);
  // fields in associative array
  $fields['id'] = $id;
  $fields['name'] = $bicycle_name;
  $fields['colors'] = array($color_1, $color_2);
  $fields['company'] = $company;
  $fields['featured'] = featuredProducts($connect,$id);
  $fields['price'] = $price;
 
  // image info as an associative array; 
  $image_info['id']=$image_id; 
  $image_info['url']=$target_url_original.$image_name;
  $image_info['filename']=$image_name;
 
  //extract details for image info
  extract(getImageFileInfo($target_dir.$image_name));
  $image_info['size']= $size;
  $image_info['type'] =$type;
 
  //extract thumbnails details
  $thumbnails['full'] = getThumbnails($full_width, $full_height,$target_url_thumbnail_full.$full_thumbnail_name);
  $thumbnails['large'] = getThumbnails($large_width, $large_height, $target_url_thumbnail_large.$large_thumbnail_name);
  $thumbnails['small'] = getThumbnails($small_width, $small_height, $target_url_thumbnail_small.$large_thumbnail_name);
 
 
  // insert thumbnails details to thumbnails
  $image_info['thumbnails'] = $thumbnails; 
  $fields['image'] = array($image_info);
   // send the json data

  $response['id']= $id;
  $response['fields'] = $fields;
 
  $responses[] = $response;
 // echo fields 
 }
 if($responses){

  //remove any header information
  header_remove(); 
  //limit which route can make this request
  //http://localost/ecycle/test/test.html
  //http://localost/ecycle/index.html
  header('Access-Control-Allow-Origin:*');
  //specify data
  header('Content-Type: application/json');
  http_response_code(200);
  array('status'=> $status['ok']);
// why not seen the json_responses
 
echo json_encode($responses);
 } 
  else{

    echo json_encode(array('error'=>$status['server error'].' their was an internal server problem'));
    http_response_code($status['server errror']);
 }
 exit();
}
