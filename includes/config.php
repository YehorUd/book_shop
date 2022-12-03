<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "shop_db";

$db = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if(mysqli_connect_errno()) {  
    die("Failed to connect with MySQL: ". mysqli_connect_error());  
}
?>