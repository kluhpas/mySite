<!DOCTYPE html>
<html lang="it-IT">
<head>
  <title>My Site</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="../favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
  <link rel="manifest" href="../favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="padding-top: 100px">
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
