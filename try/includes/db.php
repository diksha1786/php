<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$servername ="localhost";
$dBUsername="root";
$dBPassword=1234;
$dBName="loginsystem";

$conn=mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);
if(!$conn){
    die("Connection failed:".mysqli_connect_error());
}



?>