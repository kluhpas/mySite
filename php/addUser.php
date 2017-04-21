<?php require "checkSession.php"; ?>
<!DOCTYPE html>
<html lang="it-IT">
<head>
  <title>Aggiungi utente</title>
  <?php include "head.php" ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
  <link href="../css/content/Content/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="../css/content/Scripts/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
  <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
  This must be loaded before fileinput.min.js -->
  <script src="../css/content/Scripts/plugins/sortable.min.js" type="text/javascript"></script>
  <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
  This must be loaded before fileinput.min.js -->
  <script src="../css/content/Scripts/plugins/purify.min.js" type="text/javascript"></script>
  <!-- the main fileinput plugin file -->
  <script src="../css/content/Scripts/fileinput.min.js"></script>
  <!-- bootstrap.js below is needed if you wish to zoom and view file content
  in a larger detailed modal dialog -->
  <script src="../css/content/Content/bootstrap-fileinput/themes/fa/theme.js"></script>
  <!-- optionally if you need translation for your language then include
  locale file as mentioned below -->
  <script src="../css/content/Scripts/locales/it.js"></script>
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
            <form class="form-horizontal" id="newUser" method="post" autocomplete="on" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label col-sm-3" for="selUser" >Tipo di utente *</label>
                <div class="col-sm-9">
                  <select name="selUser" id="selUser" class="form-control" onchange="selectUser(this)">
                    <option value="allievo" selected>Allievo</option>
                    <option value="maestro">Maestro</option>
                  </select>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group" id="selFormHTML">
                <label class="control-label col-sm-3" for="selForm">Scegli i dati da inserire *</label>
                <div class="col-sm-9">
                  <select name="selForm" id="selForm" class="form-control" onchange="selectForm(this)">
                    <option value="base" selected>Allievo</option>
                    <option value="plus">Allievo + Genitore/Parente</option>
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
                  <label id="agon" class="radio-inline"><input type="radio" name="agon" value="yes">Sì</label>
                  <label id="agon" class="radio-inline"><input type="radio" name="agon" value="no">No</label>
                </div> <!-- .col-sm-9 -->
              </div> <!-- .form-group -->
              <div class="form-group">
                <label class="control-label col-sm-3" for="photo">Foto</label>
                <div class="col-sm-9">
                  <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                  <div class="kv-avatar center-block">
                    <input id="avatar" name="avatar" type="file" class="file-loading">
                  </div>
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

  /* Funzione per selezione del form da visualizzare tramite utente*/
  function selectUser(tmp) {
    if (tmp.value == "allievo") {
      document.getElementById("selFormHTML").style.display = "inherit";
    }
    else {
      document.getElementById("selFormHTML").style.display = "none";
      selectForm("base");
    }
  }

  /* Funzione per selezione del form da visualizzare*/
  function selectForm(tmp) {
    if (tmp.value == "plus") {
      document.getElementById("parent").innerHTML = '<div class="form-group"><label class="control-label col-sm-3" for="firstNameParent">Nome parente *</label><div class="col-sm-9"><input type="text" name="firstNameParent" id="firstNameParent" class="form-control" placeholder="Inserisci il nome" onblur="checkName(this)"></div></div><div class="form-group"><label class="control-label col-sm-3" for="lastNameParent">Cognome parente *</label><div class="col-sm-9"><input type="text" name="lastNameParent" id="lastNameParent" class="form-control" placeholder="Inserisci il cognome" onblur="checkSurname(this)"></div></div></div><div class="form-group"><label class="control-label col-sm-3" for="phoneNumParent">Telefono parente *</label><div class="col-sm-9"><input type="tel" name="phoneNumParent" id="phoneNumParent" class="form-control" placeholder="Inserisci il telefono" onblur="checkPhoneNum(this)"></div></div><div class="form-group"><label class="control-label col-sm-3" for="emailParent">Email parente *</label><div class="col-sm-9"><input type="email" name="emailParent" id="emailParent" class="form-control" placeholder="Inserisci la email" onblur="checkEmail(this)"></div></div><div class="form-group"><label class="control-label col-sm-3" for="parentela">Grado di parentela *</label><div class="col-sm-9"><input type="text" name="parentela" id="parentela" class="form-control" placeholder="Inserisci il grado di parentela" onblur="checkName(this)"></div></div>';
      document.getElementById("lblPhone").innerHTML = "Telefono";
      document.getElementById("lblEmail").innerHTML = "email";
    }
    else {
      document.getElementById("parent").innerHTML = "";
      document.getElementById("lblPhone").innerHTML = "Telefono *";
      document.getElementById("lblEmail").innerHTML = "Email *";

    }
  }

  /*Funzione per upload foto*/
  $("#avatar").fileinput({
    resizeImage: true,
    maxImageWidth: 500,
    maxImageHeight: 500,
    resizePreference: 'width',
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    browseOnZoneClick: true,
    maxFileCount: 1,
    browseLabel: '',
    removeLabel: '',
    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors-1',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="../image/profile/no-profile-pic.jpg" alt="Your Avatar" style="width:160px">',
    layoutTemplates: {main2: '{preview} {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png"]
  });

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
      BootstrapDialog.alert({
        title: 'Esito operazione',
        message: response,
        buttonLabel: 'Chiudi', // <-- Default value is 'OK',
      });
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
