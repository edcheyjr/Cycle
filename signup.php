<?php 
  require 'connect.php';
  session_start();
  //check if the user is already logged in
  if(isset($_SESSION['username'])){

    header('location:index.php');
  }
  
  // variables
  $admin = false;
  $_SESSION['signupErr'] = null;
  $check_string = '/^[a-zA-z_\s]*$/';
  $check_username = '/^[a-zA-z0-9_\s]*$/';
  $check_number = '/^[0-9_\s]*$/';
  $check_postal = '/^[0-9_\s-]*$/';
  // check if the use is already loggedin
  
  function validate_data($connect,$data){
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);  
    $data = mysqli_real_escape_string($connect, $data);  

    return $data;
  }
  
if($_SERVER['REQUEST_METHOD'] == "POST"){
  
  
  if(isset($_POST['name'])){
    
    extract($_POST);
    
    // name validation
    if(empty($name)){
      $_SESSION['signupErr'] = 'name is required!';
    }
    elseif(!preg_match($check_string,$name)){
      $_SESSION['signupErr'] = 'only alphabet and whitespaces allowed!';
    }
    else{
     $name = validate_data( $connect,$name);
    }
    // username validation
    if(empty($username)){
     $_SESSION['signupErr'] = 'usernme cannot be empty';
    }
    elseif(!preg_match($check_username,$username)){
      $_SESSION['signupErr'] = 'only alphabet, numbers and whitespaces allowed!';
      
    }
    else{
     $username_exist = "SELECT * FROM users WHERE username = '$username' LIMIT 1" ;
     $result = mysqli_query($connect, $username_exist) or die(mysqli_error($connect));
     if(mysqli_num_rows($result) == 1){
       $_SESSION['signupErr'] = 'username already exist';
       header('location:index.php');
     }
     $username =  validate_data( $connect, $username);
     }
    // email validation
    if(empty($email)){
      $_SESSION['signupErr'] = 'emails required!';
     }
     elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $_SESSION['signupErr'] = 'only emails allowed!';
      }else{
       $email = validate_data($connect ,$email);
       
      }
      // phone validation
      if(empty($phone)){
    $_SESSION['signupErr'] = 'phone required!';    
  }elseif(!preg_match($check_number,$phone)){
    $_SESSION['signupErr'] = 'only valid telephone numbers allowed';
  }
  elseif(strlen(trim($phone)) > 10){
    $_SESSION['signupErr'] = 'phone number is too long';
  }
  else{
    $phone = validate_data($connect, $phone);
     }
     // date of birth
     if(empty($dob)){
       $_SESSION['signupErr'] = 'date of birth is required';
     }
     else{
       $dob = validate_data($connect , $dob);
     }
     // postal address validation
     if(empty($postalAddress)){
       $_SESSION['signupErr'] = 'postal address is required!';
      } 
      elseif(!preg_match($check_username, $username)){
        $_SESSION['signupErr'] = 'only alphabet, numbers and whitespaces allowed!';
      }
     else{
       $postalAddress = validate_data($connect, $postalAddress);
      }
      
      // postal code validation
      if(empty($postalCode)){
        $_SESSION['signupErr'] = 'postal code is required!';
      }
      elseif(!preg_match($check_postal,$postalCode)){
        $_SESSION['signupErr'] = 'not a valid postal code!';
      }
      else{
        $postalCode = validate_data($connect, $postalCode);
      }
      
      // password validation
      
      if(empty($password)){
        $_SESSION['signupErr'] = 'password is required!';
      }
      elseif(strlen(trim($password)) < 6){
        $_SESSION['signupErr'] = 'password should be atleast 6 character long';
      }
      elseif($password !== $confirmPassword){
        $_SESSION['signupErr'] = 'password did not match confirm password';
      }
      else{
        $hashpassword = password_hash($password,PASSWORD_DEFAULT);
      }
      
      if($_SESSION['signupErr'] == null){
        $signup_query = "INSERT INTO users(full_name,username,email,phone,dob,postal_address,postal_code,user_password,admin) VALUES ('$name','$username','$email','$phone','$dob','$postalAddress','$postalCode','$hashpassword','$admin');";
       mysqli_query($connect,$signup_query) or die(mysqli_error($connect));
       
       $query_id = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
       $id_result = mysqli_query($connect, $query_id) or die(mysqli_error($connect));
       $row = mysqli_fetch_assoc($id_result);
       extract($row);
       $_SESSION['username'] = $username;
       $_SESSION['admin'] = $admin;
       $_SESSION['user_id'] = $id;
       echo json_encode($_SESSION);
       header('location: index.php');
      }
      else{
        header('location: index.php');
      }
  }
  $_SESSION['signupErr'] = '500, internal server error';
  exit();
}
