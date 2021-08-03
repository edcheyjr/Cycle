<?php
require '../connect.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
 if(isset($_GET['id'])){
  $id = $_GET['id'];
  // archive
    $sql="INSERT INTO products SELECT * FROM archives WHERE id=$id";
    mysqli_query($connect,$sql) or die(mysqli_error($connect));
    // delete from products
    $sql_delete = "DELETE FROM archives WHERE id = $id";
    mysqli_query($connect,$sql_delete) or die(mysqli_error($connect));
    header('location:index.php');
 }
}