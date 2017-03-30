<?php
// Start the session
session_start();
include "checkDB.php";
include "crudDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["setPsw"]) == true && empty($_POST["newPsw"]) == false && empty($_POST["validatePsw"]) == false && empty($_SESSION["IDutente"]) == false && empty($_SESSION["hashPsw"]) == false) {
  if (strcmp ($_POST["newPsw"], $_POST["validatePsw"]) == 0 ) {
    $psw = checkPsw_hash($_POST["newPsw"]);

    if ($psw != 1) {
      require "connectDB.php";
      $row = read($conn, $_SESSION["IDutente"]);

      if ($row != -1 && strcmp($row, $_SESSION["hashPsw"]) == 0) {
        if (setPsw($conn, $psw, $_SESSION["IDutente"]) == 0) {
          echo "PAGINA INIZIALE";
          $conn->close();
        }
        $conn->close();
      }
      $conn->close();
    }
    else {
      header("Location: ../firstLogin.php?error=true");
    }
  }
  else {
    header("Location: ../firstLogin.php?error=true");
  }
}
else {
  header("Location: ../index.php");
}
?>
