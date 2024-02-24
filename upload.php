<?php
$con = mysqli_connect("localhost", "admin", "admin", "filedb");
mysqli_select_db($con, "filedb");

//Make Sure: "sudo chmod -R 777 uploads/" for folder permissions

if (isset($_POST['uploading'])) {
  $avatar_name = $_FILES['avatar']['name'];
  $avatar_name = preg_replace("/\s+/", "_", $avatar_name); //remove spaces from image name
  $avatar_tmpname = $_FILES['avatar']['tmp_name'];
  $avatar_size = $_FILES['avatar']['size'];
  $avatar_type = $_FILES['avatar']['type'];

  //var_dump($_FILES);

  $avatar_ext = pathinfo($avatar_name, PATHINFO_EXTENSION); //get file extension .jpg
  $avatar_name = pathinfo($avatar_name, PATHINFO_FILENAME); //file name like prince
  $final_name = $avatar_name . "_" . date('mjYHis') . "." . $avatar_ext; //secure name  

  //validation go to google mb to bytes search  
  if (!empty($avatar_name)) { //this is realname
    //  if ($avatar_size <= 2000000) {  //2 mb ki file honi chiye
    if ($avatar_ext == "jpg" || $avatar_ext == "jpeg" || $avatar_ext == "png" || $avatar_ext == "gif") {



      $final_file = "uploads/" . $final_name;
      $upload = move_uploaded_file($avatar_tmpname, $final_file);

      if ($upload) {
        $msg = "File uploaded successfully";
        $query = "INSERT INTO imgtable(name) VALUES('$final_name')";
        $fire = mysqli_query($con, $query) or die("Cannot insert file path into database" . mysqli_error($con));
        $msg .= " and also inserted into database";
      }
    } else {
      $msg = "Only jpg, jpeg, png, gif files are allowed to upload";
    }
    // } else {
    //   echo "file size is too large";
    // }
  } else {
    $msg = "Please select an image to upload";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Image Upload</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center text-dark mb-4">Upload Image</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="imageUpload">Select Image:</label>
            <!-- accept="image/JPEG" -->
            <input type="file" name="avatar" id="imageUpload" class="form-control-file">
          </div>
          <button type="submit" name="uploading" class="btn btn-danger">Upload</button>
          <?php if (isset($msg)) : ?>
            <div class="mt-3 alert alert-info"><?php echo $msg; ?></div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
