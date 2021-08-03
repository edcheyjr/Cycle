<?php
require 'connect.php';
 function validate_data($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
  return $data;    
 }

if($_SERVER['REQUEST_METHOD'] == "POST"){
 
 $json = file_get_contents('php://input');
 $_POST = json_decode($json,true);
 // var_dump($_POST);

 if(isset($_POST['submit_contact'])){
// check for errors and validation and send response
 $name = validate_data( $_POST['name'] );
 $email = validate_data( $_POST['email'] );
 $subject = validate_data( $_POST['subject']);
 $message = validate_data( $_POST['message']);


 $insertQuery="INSERT INTO contacts(name,email,subject,message) VALUES('$name','$email','$subject','$message')";
 mysqli_query($connect, $insertQuery) or die(mysqli_error($connect));
 echo json_encode(array('success'=>'submitted'));
 exit();
}
echo json_encode(array('success'=>'failed'));
exit();
}
?>