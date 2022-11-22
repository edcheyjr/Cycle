<?php
require "connect.php";

// opening div tag with some styles
echo "<div style='width:100%; height:auto; padding:2px 40px; display:flex;flex-direction:column;justify-content: center;  
'>";
// TABLE NAMES
$_NO_OF_TABLES = 5;
$_PRODUCT_TABLE ="products";
$_PRODUCT_ACHRIVE_TABLE ="archive";
$_USER_TABLE ="users";
$_ORDER_TABLE ="orders";
$_CONTACTS_TABLE ="contacts";

// run once and configure your connect.php $db with the right database name;
// check connection
if(!$first_connect){
    echo "<h2 style='color:orange; font-weight:bold'>cannot establish connect with mysql server ❌ ".mysqli_connect_error()."</h2>";
}
else{
    // check if $connect works if it does exit
if($connect){
    $show_tables = "SHOW TABLES IN $db";
    $result_of_tables = $connect->query($show_tables);
    // if the $result_of_tables not False, and contains at least one row
    if($result_of_tables !== false) {
        // if at least one table in result
    if($result_of_tables->num_rows > 0) {
        
        // traverse the $result_of_tables and output the name of the table(s)
        while($row = $result_of_tables->fetch_assoc()) {
            echo "<p style='color:blue; font-weight:medium; font-style:italic;text-transform:capitalize;'>".$row['Tables_in_'.$db]." table ✔</p>";
        }
        if($result_of_tables->num_rows == $_NO_OF_TABLES){
            // ONLY exit with a status ok if db exist and all table exist 
            exit("<p style='color:green; font-weight:bold; font-size:large'>Connected, status OK ✅</p>");
        }
    }else echo  "<h2 style='color:orange; font-weight:bold'>There is no table in $db ❌ </h2>";
    }else echo "<h2 style='color:red; font-weight:bold'>Unable to check the $db ❌, error - ". $connect->error."</h2>";
}
// else
echo("<p style='color:green; font-weight:bold; font-size:medium; text-transform:uppercase'>Let's continue with setup</p>");


$createDB = "CREATE DATABASE IF NOT EXISTS ".$db;

// create database
if (mysqli_query($first_connect , $createDB)){
    if($first_db == null && !$connect){
        echo "<p style='color:green; font-weight:bold; font-size:medium'>db was created ✅</p>";
        mysqli_close($first_connect);

    }
    else{
        echo "<p style='color:green; font-weight:bold; font-size:medium'>connected to $db ✅</p>";
    }
}
else{
    exit
    ("<h2 style='color:red; font-weight:bold; text-decoration:underline; font-size:large;'>failed to created database ❌".mysqli_error($connect)."</h2>");
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

$products_table = "CREATE TABLE IF NOT EXISTS $_PRODUCT_TABLE
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

$products_archive = "CREATE TABLE IF NOT EXISTS $_PRODUCT_ACHRIVE_TABLE
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

$user_table = "CREATE TABLE IF NOT EXISTS $_USER_TABLE
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



$order_table = "CREATE TABLE IF NOT EXISTS $_ORDER_TABLE
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

$contact_us= "CREATE TABLE IF NOT EXISTS $_CONTACTS_TABLE (
id int NOT NULL AUTO_INCREMENT,
email varchar(20) NOT NULL,
subject varchar(20) NOT NULL,
message text NOT NULL,
time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (id)
)";



if(mysqli_query($connect,$contact_us) ){
    echo "<p style='color:blue; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>contacts table created succesfully ✅</p>";
}
else{
    exit("<h2 style='color:red; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>failed to create contact us table ❌".mysqli_error($connect)."</h2>");
}
if(mysqli_query($connect,$user_table) ){
    echo "<p style='color:blue; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>users table created succesfully ✅</p>";
}else{
    exit("<h2 style='color:red; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>failed to create user table ❌".mysqli_error($connect)."</h2>");
}

if(mysqli_query($connect,$products_table) ){
    echo "<p style='color:blue; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>products table created successfully ✅</p>";
}else{
    exit("<h2 style='color:red; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>failed to create product table ❌".mysqli_error($connect)."</h2>");
}

if(mysqli_query($connect,$products_archive) ){
    "<p style='color:blue; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>archives table created successfully ✅</p>";
}
else{
    exit("<h2 style='color:red; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>failed to create product achives table ❌".mysqli_error($connect)."</h2>");

}


// ALL TABLES with FOREIGN KEY CONSTRAINTS should be created LAST
if(mysqli_query($connect,$order_table) ){
    echo "<p style='color:blue; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>orders table created successfully ✅</p>";
}
else{
    exit("<h2 style='color:red; font-weight:medium; font-style:italic; font-size:large; text-transform:capitalize;;padding-bottom:4px;'>failed to create orders table ❌".mysqli_error($connect)."</h2> 
    <p style='color:orange; font-weight:medium; font-style:italic; font-size:normal;text-decoration:underline; text-transform:capitalize;;padding-bottom:4px;'> if error is &#8212; (Errno: 150 `Foreign Key Constraint Is Incorrectly Formed`) check if the order of table create operation is correct as all with foreign key constraint should be created last</p>");
}


// close the connect
mysqli_close($connect);
echo "<p style='color:green; font-weight:bold; font-size:large; text-transform:capitalize;; padding-bottom:4px;'>
All configuration are set closing
connection</p>";
}  

// closing div tag
echo "</div>";
//  UPDATE `products` SET `bicycle_desc` = '\r\nHere are some adjectives for bike: brand-new astral, old american-international, crummy, little, overly chromed, blaringly squeaky, good lousy, reliable electrical, american-international, nice all-terrain, tall, invincible, bloody quiet, worthless, heavy, damn broken-down, al tough, high-ticket, own clunky, dumb blue, ' WHERE `products`.`id` = 21;
