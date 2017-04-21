<?php
require "../php/checkDB.php";
print_r(array_values($_POST));
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["bday"]) && !empty($_POST["bplace"]) && !empty($_POST["codfisc"]) && !empty($_POST["gender"]) && !empty($_POST["address"])  && !empty($_POST["postcode"])  && !empty($_POST["agon"]))
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
    $email = checkPhone($_POST["email"]);
  else
    $email = "";

  if (!empty($_POST["certMedic"])) {
    $certMedic = strtotime($_POST["certMedic"]);
    $certMedic = date("Y-m-d", $certMedic);
  }
  else
    $certMedic = "";


  if (strcmp($_POST["selForm"], "plus") == 0) {
    if (!empty($_POST["firstNameParent"]) && !empty($_POST["lastNameParent"]) && !empty($_POST["emailParent"]) && !empty($_POST["phoneNumParent"])  && !empty($_POST["parentela"])) {
      $firstNameParent = checkName($_POST["firstName"]);
      $lastNameParent = checkName($_POST["lastName"]);
      $phoneNumParent = checkPhone($_POST["phoneNum"]);
      $emailParent = checkEmail($_POST["email"]);
      $parentela = $_POST["parentela"];
    }
  }

  if ($firstName != -1 && $lastName != -1 && $bday != -1 && $bplace != -1 && $codfisc != -1 && $gender != -1 && $address != -1 && $postcode != -1 && $agon != -1 && $photo != -1 && $codTes != -1 && $certMedic != -1 && $phoneNum != -1 && $email != -1) {
    if (strcmp($_POST["selForm"], "base") == 0) {
      require "../php/connectDB.php";
      $id = insertUserBase($conn, $table, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $agon, $codTes, $certMedic, $phoneNum, $email);
      if ($id > 0) {
        saveImage($id);
        echo "Utente aggiunto correttamente.";
      } else
      echo "Errore (4), inserimento utente errato.";
    }
    elseif (strcmp($_POST["selForm"], "plus") == 0 && $firstNameParent != -1 && $lastNameParent != -1 && $phoneNumParent != -1 && $emailParent != -1 && $parentela != -1) {
      require "../php/connectDB.php";
      $id = insertUserBase($conn, $table, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $agon, $codTes, $certMedic, $phoneNum, $email);
      if ($id > 0) {
        saveImage($id);
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
      echo "Errore (3), dato non valido.";
    }
  }
  echo "Errore (2), dato non valido.";
}
else
echo "Errore (1), campo vuoto.";

function saveImage($id)
{
  $target_dir = "../image/profile/";
  $target_file = $target_dir . $id;
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["avatar"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["avatar"]["size"] > 1500) {
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
?>
