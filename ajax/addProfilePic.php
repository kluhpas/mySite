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
  defaultPreviewContent: '<img src="/mySite/images/profilePics/no-profile-pic.jpg" alt="Your Avatar" style="width:160px">',
  layoutTemplates: {main2: '{preview} {remove} {browse}'},
  allowedFileExtensions: ["jpg", "png"],
  uploadUrl: "/mySite/ajax/addProfilePic.php",
  uploadAsync: true
});



<div class="form-group">
  <label class="control-label col-sm-3" for="photo">Foto</label>
  <div class="col-sm-9">
    <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
    <div class="kv-avatar center-block">
      <input id="avatar" name="avatar" type="file" class="file-loading">
    </div>
  </div> <!-- .col-sm-9 -->
</div> <!-- .form-group -->




function saveImage($picTitle)
{
  $target_dir = "/mySite/images/profilePics/";
  $target_file = $target_dir . $picTitle;
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["avatar"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["avatar"]["size"] > 1500) {
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
