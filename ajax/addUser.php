<?php
require "../php/checkDB.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["bday"]) && !empty($_POST["bplace"]) && !empty($_POST["codfisc"]) && !empty($_POST["gender"]) && !empty($_POST["address"])  && !empty($_POST["postcode"])  && !empty($_POST["agon"]))
  {
    $firstName = checkName($_POST["firstName"]);
    $lastName = checkName($_POST["lastName"]);
    $bday = $_POST["bday"];
    $bplace = checkName($_POST["bplace"]);
    $codfisc = checkCodFisc($_POST["codfisc"]);
    $gender = checkGender($_POST["gender"]);
    $address = $_POST["address"];
    $postcode = checkCAP($_POST["postcode"]);
    $agon = checkAgon($_POST["agon"]));
    $URLPhoto = $_POST["photo"];
    $codTes = $_POST["codTes"];
    $certMedic =  $_POST["certMedic"];
    if (!empty($_POST["phoneNum"])) {
      $phoneNum = checkPhone($_POST["phoneNum"]);
    }
    else {
      $phoneNum = $_POST["phoneNum"]);
    }
    if (!empty($_POST["email"])) {
      $email = checkEmail($_POST["email"]);
    }
    else {
      $email = $_POST["email"]);
    }

    if (strcmp($_POST["selForm"], "plus") == 0) {
      if (!empty($_POST["firstNameParent"]) && !empty($_POST["lastNameParent"]) && !empty($_POST["emailParent"]) && !empty($_POST["phoneNumParent"])  && !empty($_POST["parentela"])) {
        $firstNameParent = checkName($_POST["firstName"]);
        $lastNameParent = checkName($_POST["lastName"]);
        $phoneNumParent = checkPhone($_POST["phoneNum"]);
        $emailParent = checkEmail($_POST["email"]);
        $parentela = $_POST["parentela"];
      }
    }

    if ()
  }
 ?>
