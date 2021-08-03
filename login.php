<?php
session_start();
require 'connect.php';
// check if the user is already logged in
if(isset($_SESSION['username'])){
    header('location:shop.html');
}
// Define variables and initialize with empty values
$_SESSION['loginErr'] = $_SESSION['wrong credentials'] = null;
//  validate
  function validate_data($connect, $data){
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = filter_var($data,FILTER_SANITIZE_SPECIAL_CHARS);
    $data = mysqli_real_escape_string($connect, $data);  
    return $data;
  }
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(isset($_POST['login_email'])){
           extract($_POST);
    
    // email validation
    if(empty($login_email)){
      $_SESSION['loginErr'] = 'enter email!';
      header('location: index.php');
     }
     elseif(!filter_var($login_email,FILTER_VALIDATE_EMAIL)){
       $_SESSION['loginErr'] = 'only emails allowed!';
      header('location: index.php');

      }else{
       $login_email = validate_data( $connect, $login_email);
      
      // password validation
      
      if(empty($login_password)){
        $_SESSION['loginErr'] = 'enter password';
      header('location: index.php');
      }
      elseif(strlen(trim($login_password)) < 6){
        $_SESSION['loginErr'] = 'password should be atleast 6 character long';
      header('location: index.php');
      }
      else{
        
           if($_SESSION['loginErr'] == null){
               $mysql_query = "SELECT * FROM users WHERE email = '$login_email' LIMIT 1";
               $result = mysqli_query($connect,$mysql_query) or die(mysqli_error($connect));
                   $row = mysqli_fetch_assoc($result);
                   
                   if(mysqli_num_rows($result) == 0){
                     $_SESSION['wrongCredentials'] = 'wrong credential, check your email';
                     
                    }
                    else{
                      extract($row);  
                      #found the user
                      if(!password_verify(trim($login_password) ,$user_password)){
                        #session
                        $_SESSION['username'] =$username;
                        $_SESSION['admin'] = $admin;
                        $_SESSION['user_id'] = $id;

                        header("location:index.php");
                    }
                    else{
                          $_SESSION['wrongCredentials'] = 'wrong credential, check your email or password';                     
                    }
                }

               
           }
      }
    echo json_encode($_SESSION);
    }
   }
}