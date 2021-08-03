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
                     $_SESSION['wrongCredentials'] = 'wrong credential, check your email or password';
                     
                    }
                    else{
                      extract($row);  

                      #found the user
                      if(password_verify($login_password ,$row['user_password'])){
                        #session
                        $_SESSION['username'] =$username;
                        $_SESSION['admin'] = $admin;
                        $_SESSION['user_id'] = $id;

                        // var_dump($_SESSION);
                        // return;
                        header("location:index.php");
                    }
                    else{
                          $_SESSION['wrongCredentials'] = 'wrong credential, check your email or password';                     
                    }
                }

               
           }
      }
    }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login |eCycle</title>
  <link rel="stylesheet" href="styles.css" />
  
</head>
<body>
  <div class="container">
    <div class="title">
    <h2>Log in</h2>
  </div>
  <div class="card">   
    <form
    class="form"
    action="login.php"
                  method="post"
                  enctype="multipart/form-data"
                  >
                  <?php if(isset($_SESSION['loginErr'])):?>
                    <p class="error-msg"><?= $_SESSION['loginErr']?></p>
                    <?php unset($_SESSION['loginErr'])?>
                    <?php endif?>
                    <?php if(isset($_SESSION['wrongCredentials'])):?>
                      <p class="error-msg"><?= $_SESSION['wrongCredentials']?></p>
                  <?php unset($_SESSION['wrongCredentials'])?>
                  <?php endif?>
                  
                  <div class="form-group">
                    <label for="email" class="label">email</label>
                    <input
                    type="email"
                    aria-label="email"
                    class="form-control"
                    placeholder="example@gmail.com"
                    id="login_email"
                    name="login_email"
                    required
                    />
                  </div>
                    <div class="form-group">
                      <label for="password" class="label">password</label>
                      <input
                      type="password"
                      aria-label="password"
                      class="form-control"
                      id="login_password"
                      name="login_password"
                      required
                      />
                  </div>                
                  <button
                  type="submit"
                  id="#button"
                  class="btn form-control"
                  name="submit"
                  >
                    Login
                  </button>
                  
                  
                </form>  
                <p>Don't have an account ?<a href="signup" class="secondary-btn">signup</a></p>
              </div>
              

              </div>
            </body>
            </html>