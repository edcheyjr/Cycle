<?php
session_start();

if(isset($_SESSION['username'])){
    echo "<h1>Welcome </h1>" . $_SESSION['username'];
}
else {
    echo "Not loggined in";
    header("location:login.php");
}
?>