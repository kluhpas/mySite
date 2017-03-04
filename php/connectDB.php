<?php
$servername = "localhost";
$username = "rotandrea";
$dbName = "my_rotandrea";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $PSW, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: (" . $mysqli->errno . ") " . $conn->connect_error);
  exit();
}
?>
