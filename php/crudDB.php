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
  }

  $stmt->close();
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
  }

  $stmt->close();
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
  }
  $stmt->close();
  echo "Error updating record: (" . $mysqli->errno . ") " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

/* delete row with email */
function delete($conn, $email) {
  if ($stmt = $mysqli->prepare("DELETE FROM User WHERE email=?")) { /* Check that there aren't errors */
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
      $stmt->close();
      echo "Record deleted successfully";
      return 0;
    }
  }
  $stmt->close();
  echo "Error deleting record: (" . $mysqli->errno . ") " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

/* insert row */
function insertUserBase($conn, $table, $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $agon, $codTes, $certMedic, $phoneNum, $email) {
  if ($stmt = $mysqli->prepare("INSERT INTO $table (nome, cognome, email, birthday, gender, password) VALUES (?,?,?,?,?,?)")) { /* Check that there aren't errors */
    if ($stmt->bind_param("sssssississss", $firstName, $lastName, $bday, $bplace, $codfisc, $gender, $address, $postcode, $agon, $codTes, $certMedic, $phoneNum, $email)) /* bind parameters for markers */
      if ($stmt->execute()) {
        $id = $mysqli->insert_id;
        $username = $lastName . "." . $id;
        $stmt->close();
        if (addUserLogin($username, $table) == 0)
          return $id;
      }
  }
  $stmt->close();
  echo "Error: " . $sql . "<br> (" . $mysqli->errno . ") " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}

function insertParent($conn, $firstNameParent, $lastNameParent, $phoneNumParent, $emailParent, $parentela)
{
  if ($stmt = $mysqli->prepare("INSERT INTO parente (nome, cognome, email, parentela) VALUES (?,?,?,?)")) { /* Check that there aren't errors */
    if ($stmt->bind_param("ssss", $firstNameParent, $lastNameParent, $phoneNumParent, $emailParent, $parentela)) /* bind parameters for markers */
      if ($stmt->execute()) {
        $stmt->close();
        return 0;
      }
  }
  $stmt->close();
  echo "Error: " . $sql . "<br> (" . $mysqli->errno . ") " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
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
  }
  $stmt->close();
  return -1;
}

function addUserLogin($username, $privileges)
{
  if (strcmp($privileges, "allievo") == 0)
		$privileges = 0;
	else if (strcmp($privileges, "maestro") == 0)
		$privileges = 1;
  else
    $privileges = 0;

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

  if ($stmt = $mysqli->prepare("INSERT INTO user (username, privileges) VALUES (?,?)")) { /* Check that there aren't errors */
    if ($stmt->bind_param("si", $username, $privileges)) /* bind parameters for markers */
      if ($stmt->execute()) {
        $stmt->close();
        return 0;
      }
  }
  $stmt->close();
  echo "Error: " . $sql . "<br> (" . $mysqli->errno . ") " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}
?>
