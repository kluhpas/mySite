<?php
/* Read and compare the email and password */
function read_compare($conn, $username, $psw) {
  $row = ["username"=>"","psw"=>"","firstLogin"=>"","IDutente"=>""];
  if ($stmt = $conn->prepare("SELECT * FROM User WHERE username=?;")) { /* Check that there aren't errors */
    if ($stmt->bind_param("s", $username))
      if ($stmt->execute())
        if ($stmt->bind_result($row['username'], $row['psw'], $row['firstLogin'], $row['IDutente'])) /* Bind result query into an associative array*/
          if ($stmt->fetch())
            if (password_verify($psw, $row['password'])) { /* Verifies that a password matches a hash */
              $stmt->close();
              return $row; /* Return an associative array */
            }
  }
  
  $stmt->close();
  return -1;
}

/* read row with email */
function read($conn, $email) {
  if ($stmt = $conn->prepare("SELECT * FROM User WHERE email=?;")) { /* Check that there aren't errors */
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($row['IDuser'], $row['name'], $row['surname'], $row['email'], $row['birthday'], $row['gender'], $row['password']); /* Bind result query into an associative array*/
    $stmt->fetch();

    if ($stmt->num_rows === 1) { /* Check that there's a row */
      $stmt->close();
      return $row; /* Return an associative array */
    }
  }
  $stmt->close();
  echo "Error: " . $sql . "<br> (" . $mysqli->errno . ") " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
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
function insert($conn, $name, $surname, $email, $birthDate, $gender, $psw) {
  if ($stmt = $mysqli->prepare("INSERT INTO User (name, surname, email, birthday, gender, password) VALUES (?,?,?,?,?,?)")) { /* Check that there aren't errors */
    $stmt->bind_param("ssssis", $name, $surname, $newEmail, $birthDate, $gender, $email); /* bind parameters for markers */
    if ($stmt->execute()) {
      $stmt->close();
      echo "New records created successfully";
      return 0;
    }
  }
  $stmt->close();
  echo "Error: " . $sql . "<br> (" . $mysqli->errno . ") " . $conn->error; /* Show a message of error with SQL statement, error number and error text */
  return -1;
}
?>
