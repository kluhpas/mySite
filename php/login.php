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
    require "connectDB.php";
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
