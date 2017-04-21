<?php
// Start the session
session_start();
include "checkDB.php";
include "crudDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]) == true && empty($_POST["username"]) == false && empty($_POST["psw"]) == false)
{
  $username = checkPsw($_POST["username"]); /* Creare funzione ad hoc*/
  $psw = checkPsw($_POST["psw"]);

  if ($username != -1 && $psw != -1) {
    $servername = "localhost";
    $username = "root";
    $dbName = "logindb";
    $password = "admin";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: (" . $mysqli->errno . ") " . $conn->connect_error);
      exit();
    }

    $row = read_compare($conn, $username, $psw);

    if ($row != -1) {
      $_SESSION["IDutente"] = $row["IDutente"];
      header("Location: ./index.php")
      $conn->close();
    }
    elseif ($row == -1) {
      $conn->close();
      header("Location: ../index.php?error=true");
    }
  }
  else {
    header("Location: ../index.php?error=true");
  }
}
else {
  header("Location: ../index.php");
}
?>
