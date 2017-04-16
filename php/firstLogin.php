<?php
// Start the session
session_start();
if (isset($_GET["ID"]) && isset($_GET["hash"])) {
  $_SESSION["IDutente"] = $_GET["ID"];
  $_SESSION["hashPsw"] = $_GET["hash"];
}
elseif (!isset($_GET["error"])) {
  header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <title>My Site</title>
  <?php include "head.php" ?>
</head>
<body style="padding-top: 5%">
  <div class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <form class="form-horizontal" name="pswForm" id="formPsw" action="validate.php" method="post" onsubmit="return checkFieldForm(this)">
            <h4 class="text-center">Scegli una password</h4>
            <h5 class="text-center">Non può contenere spazi e deve essere composta da almeno 8 caratteri.</h5>
            <?php showError(); ?>
            <div class="form-group" id="formPswGroup">
              <input type="password" name="newPsw" class="form-control" autocomplete="off" placeholder="Inserisci una password" onkeyup="CheckPasswordStrength(this.value)" onblur="checkPsw()"/>
              <p id="password_strength"></p>
            </div>
            <div class="form-group" id="formPswGroup">
              <input type="password" name="validatePsw" class="form-control" autocomplete="off" placeholder="Conferma la password" onblur="checkPsw()"/>
              <p id="password_check"></p>
            </div>
            <button type="submit" name="setPsw" class="btn btn-primary btn-block">Cambia Password</button>
          </form>
        </div> <!-- .panel panel-default -->
      </div> <!-- .col-md-4 -->
      <div class="col-md-4"></div>
    </div> <!-- .row -->
  </div> <!-- .container -->

  <script>
  function CheckPasswordStrength(password) {
    var password_strength = document.getElementById("password_strength");

    //TextBox left blank.
    if (password.length == 0) {
      password_strength.innerHTML = "";
      return;
    }

    //Regular Expressions.
    var regex = new Array();
    regex.push("[A-Z]"); //Uppercase Alphabet.
    regex.push("[a-z]"); //Lowercase Alphabet.
    regex.push("[0-9]"); //Digit.
    regex.push("[$@$!%*#?&]"); //Special Character.

    var passed = 0;

    //Validate for each Regular Expression.
    for (var i = 0; i < regex.length; i++) {
      if (new RegExp(regex[i]).test(password)) {
        passed++;
      }
    }

    //Validate for length of Password.
    if (passed > 2 && password.length > 8) {
      passed++;
    }

    //Display status.
    var color = "";
    var strength = "";
    switch (passed) {
      case 0:
      case 1:
      strength = "Debole";
      color = "red";
      break;
      case 2:
      strength = "Buona";
      color = "darkorange";
      break;
      case 3:
      case 4:
      strength = "Ottima";
      color = "green";
      break;
      case 5:
      strength = "Perfetta";
      color = "darkgreen";
      break;
    }
    password_strength.innerHTML = strength;
    password_strength.style.color = color;
  }

  function checkFieldForm(tmp) {
    var error = true;

    if (tmp.newPsw.value == "") {
      tmp.newPsw.style.borderColor = "#f00";
      error = false;
    }
    else {
      tmp.newPsw.style.borderColor = "#ccc";
    }

    if (tmp.validatePsw.value == "") {
      tmp.validatePsw.style.borderColor = "#f00";
      error = false;
    }
    else {
      tmp.validatePsw.style.borderColor = "#ccc";
    }

    return error;
  }

  function checkPsw() {
    document.getElementById("password_check").innerHTML = "";
    if (document.pswForm.newPsw.value != "")
    {
      if (document.pswForm.newPsw.value.search(" ") != -1 || document.pswForm.newPsw.value.length < 8)
      {
        document.pswForm.newPsw.value = "";
        document.pswForm.validatePsw.value = "";
        document.pswForm.newPsw.focus();
        document.pswForm.newPsw.style.borderColor = "#f00";
        document.pswForm.newPsw.placeholder="Inserisci una password valida";
        document.getElementById("password_strength").innerHTML = "";
      }
      else if (document.pswForm.validatePsw.value != "" && document.pswForm.validatePsw.value.localeCompare(document.pswForm.newPsw.value) != 0)
      {
        document.pswForm.validatePsw.value = "";
        document.pswForm.validatePsw.placeholder="Conferma la password";
        document.getElementById("password_check").style.color = "red";
        document.getElementById("password_check").innerHTML = "Password non corrispondente";
        document.pswForm.validatePsw.focus();
        document.pswForm.validatePsw.style.borderColor = "#f00";
      }
      else
      {
        document.pswForm.validatePsw.style.borderColor = "#ccc";
        document.pswForm.newPsw.style.borderColor = "#ccc";
        document.pswForm.newPsw.style.boxShadow = "none";
        document.pswForm.validatePsw.style.boxShadow = "none";
      }
    }
  }
  </script>
</body>
</html>

<?php
function showError() {
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "true") {
      echo "<p class='text-center text-danger bg-danger'> Password inserite non corrette.</p></br>";
    }
    else {
      echo "<br>";
    }
  }
  else {
    echo "<br>";
  }
}
?>
