<?php require $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/checkSession.php"; ?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <title>My Site</title>
  <?php include $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/head.php" ?>
</head>
<body>
  <?php include $_SERVER["DOCUMENT_ROOT"] .  "/mySite/includes/navbar.php"  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          </br></br></br></br></br>
        </div> <!-- .panel panel-default -->
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          </br></br></br></br></br>
        </div> <!-- .panel panel-default -->
      </div> <!-- .col-md-4 -->
      <div class="col-md-4">
        <div class="panel panel-default">
          </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
        </div> <!-- .panel panel-default -->
      </div>
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
