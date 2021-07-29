<?php
require "connect.php";

// run once and configure your connect.php $db with the right database name;
// check connection
if(!$connect){
    echo "Cannot connect to db ".mysqli_connect_error();
}
else{
    echo "Connected";
}

// create database
$cat1 = "CREATE DATABASE IF NOT EXISTS ecycle";

if (mysqli_query($connect , $cat1)){
    if($db == null){
        echo "db was created <br>";
    }
    else{
        echo "connected to  db";
    }
}
else{
    echo "Unable to create db <br>";
}

// product "bicycle"
// contain
// id
// name
// price
// color not add will depend with the type of the bike
// To add 
// count will add
// company
// featured boolean attached to the featured items queried

 $products_table = "CREATE TABLE IF NOT EXISTS products
 (id INT AUTO_INCREMENT,
 bicycle_name VARCHAR(50) NOT NULL,
 color_1 VARCHAR(8) NOT NULL,
 color_2 VARCHAR(8) NOT NULL,
 price INT (10) NOT NULL,
 company VARCHAR(50) NOT NULL,
 desc TEXT NOT NULL,
 image_name VARCHAR(100) NOT NULL,
 full_thumbnail_name VARCHAR(100) NOT NULL,
 large_thumbnail_name VARCHAR(100) NOT NULL,
 small_thumbnail_name VARCHAR(100) NOT NULL,
 date_added TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
 PRIMARY KEY(id));";
