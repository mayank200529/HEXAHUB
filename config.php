<?php
error_reporting(0);
$server="localhost"; //Server
$username="root"; //cPanel Username
$password=""; //cPanel Password
$database="codemall"; //Database Name

$conn=mysqli_connect($server,$username,$password,$database); // Connecting Database

if (mysqli_connect_errno()) // Check Database connection
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//contact me on itsrohitofficial@gmail.com  

$currency='<i class="fa fa-inr"></i>';

date_default_timezone_set('Asia/Kolkata');
?>