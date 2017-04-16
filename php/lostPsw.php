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
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sendEmail"]) && empty($_POST["email"]) == false) {
            /* SCRIVERE FUNZIONE PER INVIO MAIL!
            $to = "andrea.rota.98@gmail.com";
            $subject = "Password dimenticata";
            $txt = "Un link a caso";
            $headers = "From: andrea.rota.98@gmail.com";

            mail($to,$subject,$txt,$headers);*/
            echo '<h4 class="text-center">Email Inviata</h4>';
          }
          else {
            echo '<form class="form-horizontal" name="lostPsw" action="lostPsw.php" method="post" onsubmit="return checkFieldForm(this)">
              <h4 class="text-center">Password dimenticata?</h4>
              <h5 class="text-center">Inserisci la tua email e riceverai un link di recupero.</h5>
              <?php showError(); ?>
              <input type="email" name="email" id="lostEmail" class="form-control" placeholder="Inserisci email" onblur="checkEmail(this)"/>
              <button type="submit" name="sendEmail" class="btn btn-primary btn-block">Invia email</button>
            </form>';
          }
           ?>
        </div> <!-- .panel panel-default -->
      </div> <!-- .col-md-4 -->
      <div class="col-md-4"></div>
    </div> <!-- .row -->
  </div> <!-- .container -->
  <script src="../js/index.js"></script>
  <script>
  function checkFieldForm(tmp) {
    if (tmp.email.value == "") {
      tmp.email.style.borderColor = "#f00";
      return false;
    }
    else {
      tmp.email.style.borderColor = "#ccc";
      return true;
    }
}
  </script>
</body>
</html>

<?php
function showError() {
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "true") {
      echo "<p class='text-center text-danger bg-danger'> Email inesistente o non corretta.</p></br>";
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
