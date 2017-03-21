<?php
$servername = "localhost";
$username = "root";
$dbName = "logindb";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: (" . $mysqli->errno . ") " . $conn->connect_error);
  exit();
}
?>
