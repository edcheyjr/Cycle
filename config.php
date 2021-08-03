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
 (id INT NOT NULL AUTO_INCREMENT,
 bicycle_name VARCHAR(50) NOT NULL,
 color_1 VARCHAR(8) NOT NULL,
 color_2 VARCHAR(8) NOT NULL,
 price INT (10) NOT NULL,
 company VARCHAR(50) NOT NULL,
 bicycle_desc TEXT NOT NULL,
 image_name VARCHAR(100) NOT NULL,
 full_thumbnail_name VARCHAR(100) NOT NULL,
 large_thumbnail_name VARCHAR(100) NOT NULL,
 small_thumbnail_name VARCHAR(100) NOT NULL,
 date_added TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(id));";

  $products_archive = "CREATE TABLE IF NOT EXISTS archives
 (id INT NOT NULL AUTO_INCREMENT,
 bicycle_name VARCHAR(50) NOT NULL,
 color_1 VARCHAR(8) NOT NULL,
 color_2 VARCHAR(8) NOT NULL,
 price INT (10) NOT NULL,
 company VARCHAR(50) NOT NULL,
 bicycle_desc TEXT NOT NULL,
 image_name VARCHAR(100) NOT NULL,
 full_thumbnail_name VARCHAR(100) NOT NULL,
 large_thumbnail_name VARCHAR(100) NOT NULL,
 small_thumbnail_name VARCHAR(100) NOT NULL,
 date_added TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(id));";

 $user_table = "CREATE TABLE IF NOT EXISTS users
 (id INT NOT NULL AUTO_INCREMENT,
 full_name VARCHAR(50) NOT NULL,
 username VARCHAR(20) NOT NULL,
 email VARCHAR(8) NOT NULL,
 phone int(10) NOT NULL,
 dob DATE NOT NULL,
 postal_address VARCHAR(20) NOT NULL,
 postal_code VARCHAR(10) NOT NULL,
 user_password VARCHAR(50) NOT NULL,
 date_created TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 UNIQUE (username),
 PRIMARY KEY(id))ENGINE=InnoDB DEFAULT CHARSET=latin1;" ;



$order_table = "CREATE TABLE IF NOT EXISTS orders
 (id INT NOT NULL AUTO_INCREMENT,
 order_number VARCHAR(50) NOT NULL, 
 quantity INT NOT NULL, 
 price VARCHAR(10) NOT NULL, 
 total_price VARCHAR(10) NOT NULL, 
 user_id INT NOT NULL, 
 product_id INT NOT NULL, 
 date_ordered TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(id),
 FOREIGN KEY (user_id) REFERENCES users(id),
 FOREIGN KEY (product_id) REFERENCES products(id)
 );";

 $contact_us= "CREATE TABLE contacts (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(20) NOT NULL,
    subject varchar(20) NOT NULL,
    message text NOT NULL,
    time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
     )";

if(mysqli_query($connect,$contact_us) or die(mysqli_error($connect))){
    echo 'contacts table created succesfully v';
}
if(mysqli_query($connect,$user_table) or die(mysqli_error($connect))){
    echo 'users table created succesfully <br>';
}
if(mysqli_query($connect,$order_table) or die(mysqli_error($connect))){
    echo 'orders table created successfully <br>';
};
if(mysqli_query($connect,$products_archive) or die(mysqli_error($connect))){
    echo 'archives table created successfully <br>';
};
    
//  UPDATE `products` SET `bicycle_desc` = '\r\nHere are some adjectives for bike: brand-new astral, old american-international, crummy, little, overly chromed, blaringly squeaky, good lousy, reliable electrical, american-international, nice all-terrain, tall, invincible, bloody quiet, worthless, heavy, damn broken-down, al tough, high-ticket, own clunky, dumb blue, ' WHERE `products`.`id` = 21;
