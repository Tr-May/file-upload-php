<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "file-upload";

$conn = new mysqli($host, $username, $password, $dbname);

//check connection
if ($conn->connect_error) {
  die("Connection fail :" . $conn->connect_error);
}
