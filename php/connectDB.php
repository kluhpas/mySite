<?php
$servername = "localhost";
$dbName = "logindb";

switch ($_SESSION["Privileges"]) {
  case '0':
  $username = "admin";
  $password = "FabRuwek3zas";
  break;
  case '1':
  $username = "editor";
  $password = "stUwa88zegen";
  break;
  case '2':
  $username = "master";
  $password = "nuswaq5Pafre";
  break;
  case '3':
  $username = "user";
  $password = "W6uPhaqAthus";
  break;

  default:
  $username = "user";
  $password = "W6uPhaqAthus";
  break;
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: (" . $mysqli->errno . ") " . $conn->connect_error);
  exit();
}
?>
