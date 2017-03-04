<?php
// Start the session
session_start();
include "checkDB.php";
include "crudDB.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Homepage</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="http://rotandrea.altervista.org/project/mySite/css/login.css">
</head>

<body>
  <div id='stars'></div>
  <div id='stars2'></div>
  <div id='stars3'></div>
  <div class="form-wrap">
    <div class="tabs">
      <h3 class="signup-tab"><a class="active" href="#signup-tab-content">Your Profile</a></h3>
      <h3 class="login-tab"><a href="#login-tab-content">Edit your profile</a></h3>
    </div><!--.tabs-->
    <div class="tabs-content">
      <div id="signup-tab-content" class="active">
        <form name="signUp" class="signup-form" action="logout.php" method="post">
          <?php viewData(); ?>
        </form><!--.signUp-form-->
      </div><!--.signup-tab-content-->

      <div id="login-tab-content">
        <form class="signUp" action="login.php" method="post">
          <?php printFormUpdate(); ?>
        </form><!--.login-form-->
      </div><!--.login-tab-content-->
    </div><!--.tabs-content-->
  </div><!--.form-wrap-->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  <script src="http://rotandrea.altervista.org/project/mySite/js/index.js"></script>

</body>


<?php
function viewData(){
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"]) && empty($_POST["email"]) == false && empty($_POST["psw"]) == false)
  {
    $email = checkEmail($_POST["email"]);
    $psw = checkPsw($_POST["psw"]);

    if ($email != -1 && $psw != -1)
    {
      require "connectDB.php";
      $row = read_compare($conn, $email, $psw);
      if ($row != -1) {
        $_SESSION["email"] = $row['email'];

        echo "Welcome " . $row['name'] . "<br>";
        printTable($row);
      }
    }
    else
    echo "Sorry, your login has been unsuccessful. Please try to register again.";

    $conn->close();
  }
  else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"]) && empty($_POST["FirstName"]) == false && empty($_POST["LastName"]) == false && empty($_POST["email"]) == false && empty($_POST["bday"]) == false && empty($_POST["Gender"]) == false && empty($_POST["psw"]) == false)
  {
    $name = checkName($_POST["FirstName"]);
    $surname = checkName($_POST["LastName"]);
    $email = checkEmail($_POST["email"]);
    $birthDate = strtotime($_POST["bday"]); //checkDate($_POST["birthDate"]);
    $birthDate = date("Y-m-d", $birthDate);
    $gender = checkGender($_POST["Gender"]);
    $psw = checkPsw_hash($_POST["psw"]);

    if ($name !=  -1 && $surname != -1 && $email != -1 && $Gender != -1 && $birthDate != -1 && $psw != -1)
    {
      require "connectDB.php";
      if (insert ($conn, $name, $surname, $email, $birthDate, $gender, $psw) == 0) {
        $_SESSION["email"] = $email;
        echo "Welcome " . $_POST['name'] . $_POST['surname'] . "<br>Your registration was successful!<br>";
        $row = array("name"=>$name, "surname"=>$surname, "birthday"=>$birthDate, "gender"=>$gender, "email"=>$email);
        printTable($row);

      }
      else {
      echo "Sorry, your registration has been unsuccessful. Please try to register again.";
      }

      $conn->close();
    }
    else {
      echo "Sorry, your registration has been unsuccessful. Please try to register again.";
    }
  }
  else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $name = checkName($_POST["FirstName"]);
    $surname = checkName($_POST["LastName"]);
    $email = checkEmail($_POST["email"]);
    $birthDate = strtotime($_POST["bday"]); //checkDate($_POST["birthDate"]);
    $birthDate = date("Y-m-d", $birthDate);
    $gender = checkGender($_POST["Gender"]);
    $psw = checkPsw_hash($_POST["psw"]);
    if ($name !=  -1 && $surname != -1 && $email != -1 && $Gender != -1 && $birthDate != -1) {
      require "connectDB.php";
      if (update($conn, $_SESSION["email"], $name, $surname, $email, $birthDate, $gender) == 0) {
        echo "Record updated successfully";
        $_SESSION["email"] = $email;
        $row = read($conn, $_SESSION["email"]);
        if ($row != -1) {
            printTable($row);
        }
      }
      $conn->close();
    }

  }
  else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    require "connectDB.php";
    delete($conn, $_SESSION["email"]);
    $conn->close();
    require "php/crudDB.php";
  }
  else if (isset($_SESSION["email"])) {
    require "connectDB.php";
    $row = read($conn, $_SESSION["email"]);
    if ($row != -1) {
      echo "Welcome " . $row['name'] . "<br>";
      printTable($row);
    }
    $conn->close();
  }
  else {
    header("Location: http://rotandrea.altervista.org/project/mySite/");
  }
}

function printTable($row)
{
  echo '<div class="wrap">

      <table class="table-responsive card-list-table">
        <tbody>
          <tr>
            <td data-title="First Name">'. $row["name"] . '</td>
            <td data-title="Last Name">'. $row["surname"] . '</td>
            <td data-title="Email">'. $row["email"] . '</td>
            <td data-title="Birthday">'. $row["birthday"] . '</td>
            <td data-title="Gender">'. $row["gender"] . '</td>
          </tr>
        </tbody>
      </table>
    </div>
  	<input type="submit" class="button" value="Logout">';
}

function printFormUpdate()
{
  require "connectDB.php";
  $row = read($conn, $_SESSION["email"]);
  if ($row != -1) {
    echo '<input type="text"  name="FirstName" class="input" value="' . $row["name"] . '" onblur="checkName(this)">
    <input type="text" name="LastName" class="input" value="' . $row["surname"] . '" onblur="checkSurname(this)">
    <input type="email" name="email" class="input" value="' . $row["email"] . '" id="user_email" onblur="checkEmail(this)">
    <input type="date" name="bday" class="input" value="' . $row["birthday"] . '" onblur="checkbirthDate(this)" required>
    <select name="Gender"  value="Female" class="input" required>
      <option value="Male"y>Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select>
    <input type="submit" class="button" name="update" value="Update">
    <input type="submit" class="button" name="delete" value="Delete">';
  }
  $conn->close();
}
?>

</html>
