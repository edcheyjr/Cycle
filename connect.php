<?php
$host = "localhost";
$user = "root";
$password = "123hadi9alafu0";
$db ="ecycle";


 //thumbails width and heights
    //recommended 1280 × 720 
    //expirement with sizes recommended ratio 16:9 or 4:3
    //$full_width= 3000; 
    //$full_height =3000;
    $full_width= 2560; 
    $full_height =1440;
    

    // $large_width = 512;
    // $large_height = 768;
    $large_width = 1200;
    $large_height = 720;

    // $small_width = 24;
    // $small_height= 36;
    $small_width = 379.33;
    $small_height= 208;


$connect = mysqli_connect($host,$user,$password,$db);


