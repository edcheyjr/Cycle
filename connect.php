<?php
// configuration variables
$host = "localhost";
$user = "root";
$password = null;
$db ="ecycle";

// used to run the fist time when the database is created ensure DO NOT delete and it is NULL!
$first_db =null;


// first time run the database
$first_connect =  mysqli_connect($host,$user,$password,$first_db);
// this will the be used once the db is configured
$connect = mysqli_connect($host,$user,$password,$db);

