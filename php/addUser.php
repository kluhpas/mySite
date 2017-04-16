<?php require "checkSession.php"; ?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <title>Aggiungi utente</title>
  <?php include "head.php" ?>
</head>
<body>
  <?php include "navbar.php" ?>
  <div class="container">
    <div class="row">
      <div class="col-md-2"></div> <!-- .col-md-2 -->
      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><h4>Nuovo Utente</h4></div> <!-- .panel-heading -->
          <div class="panel-body">
            <form class="form-horizontal" id="newUser" method="post">
              <div class="form-group">
                <label class="control-label col-sm-3" for="selForm">Scegli i dati da inserire</label>
                <div class="col-sm-9">
                  <select name="selForm" id="selForm" class="form-control" onclick="selectForm(this)">
                    <option value="base" selected>Allievo</option>
                    <option value="plus">Allievo + Genitore</option>
                  </select>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="selUser">Tipo di utente *</label>
                <div class="col-sm-9">
                  <select name="selUser" id="selUser" class="form-control">
                    <option value="allievo" selected>Allievo</option>
                    <option value="maestro">Maestro</option>
                  </select>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="firstName">Nome *</label>
                <div class="col-sm-9">
                  <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Inserisci il nome" onblur="checkName(this)">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="lastName">Cognome *</label>
                <div class="col-sm-9">
                  <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Inserisci il cognome" onblur="checkSurname(this)">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="bday">Data di nascita *</label>
                <div class="col-sm-9">
                  <div class="input-group date" id="bday">
                    <input type="text" name="bday" id="bday" class="form-control" placeholder="yyyy/mm/dd" onblur="checkBDay(this)"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="bplace">Luogo di nascita *</label>
                <div class="col-sm-9">
                  <input type="text" name="bplace" id="bplace" class="form-control" placeholder="Inserisci il luogo di nascita" onblur="checkBDay(this)">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="codfisc">Codice fiscale *</label>
                <div class="col-sm-9">
                  <input type="text" name="codfisc" id="codfisc" class="form-control" placeholder="Inserisci il codice fiscale" onblur="checkCodFiscale(this)">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="gender">Sesso *</label>
                <div class="col-sm-9">
                  <label id="gender" class="radio-inline"><input type="radio" name="gender" value="male">Maschio</label>
                  <label id="gender" class="radio-inline"><input type="radio" name="gender" value="female">Femmina</label>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="address">Via *</label>
                <div class="col-sm-9">
                  <input type="text" name="address" id="address" class="form-control" placeholder="Inserisci la via" onblur="checkBDay(this)">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="postcode">CAP *</label>
                <div class="col-sm-9">
                  <input type="text" name="postcode" id="postcode" class="form-control" placeholder="Inserisci il CAP" onblur="checkCAP(this)">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="phoneNum" id="lblPhone">Telefono *</label>
                <div class="col-sm-9">
                  <input type="tel" name="phoneNum" id="phoneNum" class="form-control" placeholder="Inserisci il telefono" onblur="checkPhoneNum(this)">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="email" id="lblEmail">Email *</label>
                <div class="col-sm-9">
                  <input type="email" name="email"  id="email" class="form-control" placeholder="Inserisci la email" onblur="checkEmail(this)">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="agon">Agonista *</label>
                <div class="col-sm-9">
                  <label class="radio-inline" id="agon"><input type="radio" name="agon" value="0">Sì</label>
                  <label class="radio-inline" id="agon"><input type="radio" name="agon" value="1">No</label>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="photo">Foto</label>
                <div class="col-sm-9">
                  <button type="button" id="photo" class="btn btn-block">Scegli Foto</button>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="codTes">Codice Tesseramento</label>
                <div class="col-sm-9">
                  <input type="text" name="codTes" id="codTes" class="form-control" placeholder="Inserisci il codice di tesseramento">
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="certMedic">Data scadenza certificato medico</label>
                <div class="col-sm-9">
                  <div class="input-group date" id="certMedic">
                    <input type="text" name="certMedic" id="certMedic" class="form-control" placeholder="yyyy/mm/dd" onblur="checkBDay(this)"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  </div>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div id="parent">
              </div>
              <input type="submit" id="submitButton"  name="submitButton" value="Aggiungi utente" class="btn btn-primary btn-block">
            </form> <!-- .form-horizontal -->
          </div> <!-- .panel-body -->
        </div> <!-- .panel panel-default -->
      </div> <!-- .col-md-4 -->
      <div class="col-md-2"></div> <!-- .col-md-2 -->
    </div> <!-- .row -->
  </div> <!-- .container -->
  <script type="text/javascript">
  /* Funzione per widget calendario Data di Nascita*/
  $(function () {
    $("#bday").datepicker({
      format: "yyyy/mm/dd",
      endDate: "0d",
      startView: 3,
      maxViewMode: 3,
      clearBtn: true,
      language: "it",
      autoclose: true,
      allowInputToggle : true,
      orientation: "bottom left",
    });
  });

  /* Funzione per widget calendario Scadenza Certificato*/
  $(function () {
    $("#certMedic").datepicker({
      format: "yyyy/mm/dd",
      startView: 2,
      maxViewMode: 2,
      clearBtn: true,
      language: "it",
      autoclose: true,
      allowInputToggle : true,
      orientation: "bottom left",
    });
  });

  /* Funzione per selezione del form da visualizzare*/
  function selectForm(tmp) {
    if (tmp.value == "plus") {
      document.getElementById("parent").innerHTML = '<div class="form-group"><label class="control-label col-sm-3" for="firstNameParent">Nome parente *</label><div class="col-sm-9"><input type="text" name="firstNameParent" id="firstNameParent" class="form-control" placeholder="Inserisci il nome" onblur="checkName(this)"></div></div><div class="form-group"><label class="control-label col-sm-3" for="lastNameParent">Cognome parente *</label><div class="col-sm-9"><input type="text" name="lastNameParent" id="lastNameParent" class="form-control" placeholder="Inserisci il cognome" onblur="checkSurname(this)"></div></div></div><div class="form-group"><label class="control-label col-sm-3" for="phoneNumParent">Telefono parente *</label><div class="col-sm-9"><input type="tel" name="phoneNumParent" id="phoneNumParent" class="form-control" placeholder="Inserisci il telefono" onblur="checkPhoneNum(this)"></div></div><div class="form-group"><label class="control-label col-sm-3" for="emailParent">Email parente *</label><div class="col-sm-9"><input type="email" name="emailParent" id="emailParent" class="form-control" placeholder="Inserisci la email" onblur="checkEmail(this)"></div></div><div class="form-group"><label class="control-label col-sm-3" for="parentela">Grado di parentela *</label><div class="col-sm-9"><input type="text" name="parentela" id="parentela" class="form-control" placeholder="Inserisci il grado di parentela" onblur="checkName(this)"></div></div>';
      document.getElementById("lblPhone").innerHTML = 'Telefono';
      document.getElementById("lblEmail").innerHTML = 'Email';
    }
    else {
      document.getElementById("parent").innerHTML = '';
      document.getElementById("lblPhone").innerHTML = 'Telefono *';
      document.getElementById("lblEmail").innerHTML = 'Email *';

    }
  }

  /* Funzione per invio dati al server*/
  var request;
  /* attach a submit handler to the form */
  $("#newUser").submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault();

    /*  if (!selectForm(document.newUser))
    return false;*/

    // Abort any pending request
    if (request) {
      request.abort();
    }

    // setup some local variables
    var $form = $(this);
    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");
    // Serialize the data in the form
    var serializedData = $form.serialize();
    alert(serializedData);
    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);
    // Fire off the request to /form.php
    request = $.ajax({
      url: "../ajax/addUser.php",
      type: "post",
      data: serializedData
    });
    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
      // Log a message to the console
      console.log("Hooray, it worked!");
      alert(response);
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
      // Log the error to the console
      console.error(
        "The following error occurred: "+
        textStatus, errorThrown
      );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
      // Reenable the inputs
      $inputs.prop("disabled", false);
    });
  });
</script>
</body>
</html>
