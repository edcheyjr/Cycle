<?php
require_once '../connect.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

if(isset($_GET['id']))
{
    $id= $_GET['id'];
    //delete
    $sql="DELETE FROM archives WHERE id = $id";
    mysqli_query($connect,$sql) or die(mysqli_error($connect));
    header('location:index.php');
}
}