<?php
require_once 'connect.php';
session_start();
$err = array();
$success = array();
if(isset($_SESSION['username'])){
 $username = $_SESSION['username'];
 $user_id = $_SESSION['user_id'];
}
$order_number = uniqid('').time();

  function validate_data($connect, $data){
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
    $data = mysqli_real_escape_string($connect, $data);  
    return $data;
  }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
 // get json and store it in post
  $json = file_get_contents('php://input');
 $_POST = json_decode($json,true);
 if(isset($_POST['product_id'])){
  extract($_POST);
  if(!filter_var($product_id,FILTER_VALIDATE_INT)){
   $err['wrong_input'] = 'invalid input product';
  }
  else{
   validate_data($connect, $product_id);

  }
  if(!filter_var($user_id,FILTER_VALIDATE_INT)){
   $err['wrong_input'] = 'invalid input user';
  }else{
   validate_data($connect, $user_id);
  }
  if(!filter_var($quantity,FILTER_VALIDATE_INT)){
   $err['wrong_input'] = 'invalid input quantity';
  }else{
   validate_data($connect, $quantity);
  }
  if(!filter_var($price,FILTER_VALIDATE_INT)){
   $err['wrong_input'] = 'invalid input price';
  }
  else{
   validate_data($connect, $price);
  }
  if(!filter_var($total_amount, FILTER_VALIDATE_INT)){
   $err['wrong_input'] = 'invalid input total amount';
  }
  else{
   validate_data($connect, $total_amount);
  }
  if($err== null){
   $mysql_query = "INSERT INTO orders(order_number,quantity,price, total_price, user_id, product_id) VALUES ('$order_number','$quantity','$price','$total_amount', $user_id, $product_id);";
   mysqli_query($connect,$mysql_query);
   $success['order'] = 'order was delivered successfully';
   $success['success'] = 'success';
   echo json_encode($success);
  }else{
   echo json_encode($err);
  }
 }
}