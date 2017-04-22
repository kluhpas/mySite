<?php
require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/checkSession.php";
require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/checkDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["selUser"] == "allievo" && !empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["bday"]) && !empty($_POST["bplace"]) && !empty($_POST["codfisc"]) && !empty($_POST["gender"]) && !empty($_POST["address"])  && !empty($_POST["postcode"])  && !empty($_POST["agon"]))
{
  $table = checkTable($_POST["selUser"]);
  $firstName = checkName($_POST["firstName"]);
  $lastName = checkName($_POST["lastName"]);
  $bday = strtotime($_POST["bday"]);
  $bday = date("Y-m-d", $bday);
  $bplace = checkName($_POST["bplace"]);
  $codfisc = checkCodFisc($_POST["codfisc"]);
  $gender = checkGender($_POST["gender"]);
  $address = $_POST["address"];
  $postcode = checkCAP($_POST["postcode"]);
  $agon = checkAgon($_POST["agon"]);
  $codTes = $_POST["codTes"];

  if (!empty($_POST["phoneNum"]))
    $phoneNum = checkPhone($_POST["phoneNum"]);
  else
    $phoneNum = "";

  if (!empty($_POST["email"]))
    $email = checkEmail($_POST["email"]);
  else
    $email = "";

  if (!empty($_POST["certMedic"])) {
    $certMedic = strtotime($_POST["certMedic"]);
    $certMedic = date("Y-m-d", $certMedic);
  }
  else
    $certMedic = "";

  $idSocieta = 1; //$_SESSION["idSocieta"];

  if (strcmp($_POST["selForm"], "plus") == 0) {
    if (!empty($_POST["firstNameParent"]) && !empty($_POST["lastNameParent"]) && !empty($_POST["emailParent"]) && !empty($_POST["phoneNumParent"])  && !empty($_POST["parentela"])) {
      $firstNameParent = checkName($_POST["firstName"]);
      $lastNameParent = checkName($_POST["lastName"]);
      $phoneNumParent = checkPhone($_POST["phoneNum"]);
      $emailParent = checkEmail($_POST["email"]);
      $parentela = $_POST["parentela"];
    }
  }

  if ($firstName != -1 && $lastName != -1 && $bday != -1 && $bplace != -1 && $codfisc != -1 && $gender != -1 && $address != -1 && $postcode != -1 && $agon != -1 && $codTes != -1 && $certMedic != -1 && $phoneNum != -1 && $email != -1) {
    if (strcmp($_POST["selForm"], "base") == 0 ) {
      require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/connectDB.php";
      require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/crudDB.php";
      if (insertAllievoBase($conn, $table, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $agon, $codTes, $certMedic, $phoneNum, $email, $idSocieta) == 0) {
        echo "Utente aggiunto correttamente.";
      } else
      echo "Errore (4), inserimento utente errato.";
    }
    elseif (strcmp($_POST["selForm"], "plus") == 0 && $firstNameParent != -1 && $lastNameParent != -1 && $phoneNumParent != -1 && $emailParent != -1 && $parentela != -1) {
      require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/connectDB.php";
      require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/crudDB.php";
      if (insertAllievoBase($conn, $table, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $agon, $codTes, $certMedic, $phoneNum, $email, $idSocieta) == 0) {
        $response = "Utente aggiunto correttamente.";
        if (insertParent($conn, $firstNameParent, $lastNameParent, $phoneNumParent, $emailParent, $parentela) == 0) {
          echo $response . "</br>Parente aggiunto correttamente.";
        }
        else {
          echo $response . "</br>Errore (5), inserimento parente errato.";
        }
      }
      else {
        echo "Errore (4), inserimento utente errato.";
      }
    }
    else {
      echo "Errore (3), selezione form non valida.";
    }
  }
  else
    echo "Errore (2), dato non valido.";
}
else if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["selUser"] == "maestro" && !empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["bday"]) && !empty($_POST["bplace"]) && !empty($_POST["codfisc"]) && !empty($_POST["gender"]) && !empty($_POST["address"])  && !empty($_POST["postcode"]))
{
  $firstName = checkName($_POST["firstName"]);
  $lastName = checkName($_POST["lastName"]);
  $bday = strtotime($_POST["bday"]);
  $bday = date("Y-m-d", $bday);
  $bplace = checkName($_POST["bplace"]);
  $codfisc = checkCodFisc($_POST["codfisc"]);
  $gender = checkGender($_POST["gender"]);
  $address = $_POST["address"];
  $postcode = checkCAP($_POST["postcode"]);
  $agon = checkAgon($_POST["agon"]);
  $codTes = $_POST["codTes"];
  $phoneNum = checkPhone($_POST["phoneNum"]);
  $email = checkEmail($_POST["email"]);
  if (!empty($_POST["certMedic"])) {
    $certMedic = strtotime($_POST["certMedic"]);
    $certMedic = date("Y-m-d", $certMedic);
  }
  else
    $certMedic = "";

  $idSocieta = 1; //$_SESSION["idSocieta"];

  if ($firstName != -1 && $lastName != -1 && $bday != -1 && $bplace != -1 && $codfisc != -1 && $gender != -1 && $address != -1 && $postcode != -1 && $agon != -1 && $codTes != -1 && $certMedic != -1 && $phoneNum != -1 && $email != -1) {
    require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/connectDB.php";
    require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/crudDB.php";
    if (insertMaestroBase($conn, $table, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $agon, $codTes, $certMedic, $phoneNum, $email, $idSocieta) == 0)
      echo "Utente aggiunto correttamente.";
    else
      echo "Errore (4), inserimento utente errato.";
  }
  else
    echo "Errore (2), dato non valido.";
  }
else
echo "Errore (1), campo vuoto.";
  ?>
