<?php
/* Read and compare the email and password */
function read_compare($conn, $username, $psw) {
  $row = ["username"=>"","psw"=>"","IDutente"=>""];
  if ($stmt = $conn->prepare("SELECT * FROM User WHERE username=?;")) { /* Check that there aren't errors */
    if ($stmt->bind_param("s", $username))
      if ($stmt->execute())
        if ($stmt->bind_result($row['username'], $row['psw'], $row['IDutente'])) /* Bind result query into an associative array*/
          if ($stmt->fetch())
            if (password_verify($psw, $row['password'])) { /* Verifies that a password matches a hash */
              $stmt->close();
              return $row; /* Return an associative array */
            }
    $stmt->close();
  }

  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

/* read psw with IDutente */
function read($conn, $IDutente) {
  if ($stmt = $conn->prepare("SELECT psw FROM User WHERE IDutente=?;")) { /* Check that there aren't errors */
    if ($stmt->bind_param("i", $IDutente))
      if ($stmt->execute())
        if ($stmt->bind_result($row)) /* Bind result query into a var*/
          if ($stmt->fetch())
            if ($stmt->num_rows === 1) { /* Check that there's a row */
              $stmt->close();
              return $row; /* Return an associative array */
            }
    $stmt->close();
  }
  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

/* update row with email */
function update($conn, $email, $name, $surname, $newEmail, $birthDate, $gender) {
  if ($stmt = $conn->prepare("UPDATE User SET name=?, surname=?, email=?, birthday=?, gender=? WHERE email=?")) { /* Check that there aren't errors */
    $stmt->bind_param("ssssis", $name, $surname, $newEmail, $birthDate, $gender, $email);
    if ($stmt->execute()) {
      $stmt->close();
      return 0;
    }
    $stmt->close();
  }

  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

/* delete row with email */
function delete($conn, $email) {
  if ($stmt = $conn->prepare("DELETE FROM User WHERE email=?")) { /* Check that there aren't errors */
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
      $stmt->close();
      echo "Record deleted successfully";
      return 0;
    }
    $stmt->close();
  }

  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

/* insert row */
function insertAllievoBase($conn, $table, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $agon, $codTes, $certMedic, $phoneNum, $email, $idSocieta) {
  if ($stmt = $conn->prepare("INSERT INTO allievo (codiceTesseramento, nome, cognome, dataNascita, luogoNascita, codiceFiscale, sesso, via, cap, telefono, email, agonista, scadenzaCertMedico, idSocieta) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) { /* Check that there aren't errors */
    if ($stmt->bind_param("isssssissssisi", $codTes, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $phoneNum, $email, $agon, $certMedic, $idSocieta)) /* bind parameters for markers */
      if ($stmt->execute()) {
        $username = $lastName . "." . $conn->insert_id;
        $stmt->close();
        $conn->close();
        if (addUserLogin($username, $table) == 0)
          return 0;
      }
    $stmt->close();
  }

  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

/* insert row */
function insertMaestro($conn, $table, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $codTes, $certMedic, $phoneNum, $email, $idSocieta) {
  if ($stmt = $conn->prepare("INSERT INTO maestro (codiceTesseramento, nome, cognome, dataNascita, luogoNascita, codiceFiscale, sesso, via, cap, telefono, email, scadenzaCertMedico, idSocieta) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)")) { /* Check that there aren't errors */
    if ($stmt->bind_param("isssssisssssi", $codTes, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $phoneNum, $email, $certMedic, $idSocieta)) /* bind parameters for markers */
      if ($stmt->execute()) {
        $username = $lastName . "." . $conn->insert_id;
        $stmt->close();
        if (addUserLogin($username, $table) == 0)
          return 0;
      }
    $stmt->close();
  }

  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

function insertParent($conn, $firstNameParent, $lastNameParent, $phoneNumParent, $emailParent, $parentela)
{
  if ($stmt = $conn->prepare("INSERT INTO parente (nome, cognome, email, parentela) VALUES (?,?,?,?)")) { /* Check that there aren't errors */
    if ($stmt->bind_param("ssss", $firstNameParent, $lastNameParent, $phoneNumParent, $emailParent, $parentela)) /* bind parameters for markers */
      if ($stmt->execute()) {
        $stmt->close();
        return 0;
      }
    $stmt->close();
  }

  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

/*Set psw*/
function setPsw($conn, $psw, $IDutente) {
  if ($stmt = $conn->prepare("UPDATE User SET psw=? WHERE IDutente=?")) { /* Check that there aren't errors */
    if ($stmt->bind_param("si", $psw, $IDutente))
      if ($stmt->execute()) {
        $stmt->close();
        return 0;
      }
    $stmt->close();
  }
  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

function addUserLogin($usernameUser, $privileges)
{
  if (strcmp($privileges, "allievo") == 0)
		$privileges = 3;
	else if (strcmp($privileges, "maestro") == 0)
		$privileges = 2;
  else
    $privileges = 3;

  $servername = "localhost";
  $username = "admin";
  $dbName = "dblogin";
  $password = "FabRuwek3zas";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbName);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: (" . $conn->errno . ") " . $conn->connect_error);
    exit();
  }

  if ($stmt = $conn->prepare("INSERT INTO user (username, privileges) VALUES (?,?)")) { /* Check that there aren't errors */
    if ($stmt->bind_param("si", $usernameUser, $privileges)) /* bind parameters for markers */
      if ($stmt->execute()) {
        $stmt->close();
        return 0;
      }
    $stmt->close();
  }

  echo "Error(" . $conn->errno . "): " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}
?>
