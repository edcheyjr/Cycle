<?php
// credential..

$error = null;
// create a connection variable
$connect = require'connect.php';
// check if connection was successfully
if(!$conn){
    echo "Cannot connect to db ".mysqli_connect_error();
}
else{
    echo "Connected well";
}


// create database
$cat1 = "CREATE DATABASE IF NOT EXISTS CAT1";

if (mysqli_query($connect , $cat1)){
    echo "Created db well<br>";
}
else{
    echo "Unable to create db <br>";
}


$tbl1 = "CREATE TABLE IF NOT EXISTS Users(id int auto_increment, username varchar(14) UNIQUE, fname varchar(14),lname varchar(14) , email varchar(25) UNIQUE , password varchar(150),primary key(id))";

if (mysqli_query($conn , $tbl1)){
    echo "Created table successfully well<br>";
}
else{
    echo "Unable to create table <br>";
}


// get form data
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = mysqli_real_escape_string($conn , $_POST['username']);
    $fname = mysqli_real_escape_string($conn , $_POST['fname']);
    $lname = mysqli_real_escape_string($conn , $_POST['lname']);
    $email = mysqli_real_escape_string($conn , $_POST['email']);
    $pass = mysqli_real_escape_string($conn , $_POST['pass']);
    $cpass = mysqli_real_escape_string($conn , $_POST['cpass']);

    if($pass != $cpass){
        $error = "password doesnot march";
    }
    else{
        $password = password_hash($pass ,PASSWORD_DEFAULT);
        $insertUser = "Insert into Users(username , fname , lname , email , password) 
            VALUES('$username' , '$fname' , '$lname' , '$email' , '$password')";

        if(mysqli_query($conn , $insertUser)){

            // echo "echo user created well<br>";
            header("location:login.php");
        }
        else{
            $error= "Unable to create user<br>";
        }

    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title>PHP SIGNUP PAGE</title>
</head>
<body>
<!-- <center>
<h1>SIGNUP</h1>
</center> -->
<h3 style="color:red;">
<?php
if($error){
echo "$error";
}
?>
</h3>
    <form class="" action="signup.php" method="post">
        <div class="">
            <label for="username">Username</label>
            <input type="text" name="username" value="">
        </div>

        <div class="">
            <label for="fname">Fname</label>
            <input type="text" name="fname" value="">
        </div>

        <div class="">
            <label for="lname">Lname</label>
            <input type="text" name="lname" value="">
        </div>

        <div class="">
            <label for="email">Email</label>
            <input type="text" name="email" value="">
        </div>

        <div class="">
            <label for="pass">Password</label>
            <input type="password" name="pass" value="">
        </div>
        <div class="">
            <label for="cpass">Confirm Password</label>
            <input type="password" name="cpass" value="">
        </div>


        <div class="btn">
            <input type="submit" name="btn" value="Submit">
        </div>

    </form>
</body>
</html>