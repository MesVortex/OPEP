<?php

$username = 'root';
$host = 'localhost';
$dbname = 'OPEP';

$conn = new mysqli($host,$username,"",$dbname);

if($conn -> connect_error){
  die("connection error: " .$conn -> connect_error);
}