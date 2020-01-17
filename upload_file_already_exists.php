<?php 
//ye file already exists di coding hai agr ye functionality chiye toh esko use kro:)  
$con =mysqli_connect("localhost","root","","filedb") or die(mysql_error());
mysqli_select_db($con,"imgupload");
if(isset($_POST['uploading'])){
$f =$_FILES['imageUpload'];
// echo "<pre>";
// print_r($f);
// echo "</pre>";

echo "file name :".$f['name']."<br>";
echo "file type :".$f['type']."<br>";
echo "file name :".$f['size']."<br>";
echo "file name :".$f['tmp_name']."<br>";

if (file_exists("uploads/".$f['name'])) {
	echo $f['name']." is already exists";
}
elseif($f['type']=="image/jpeg") {
move_uploaded_file($f['tmp_name'],"uploads/".$f['name']);
}else {
	echo "file format is not supported";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MyTable</title>
	<link rel="stylesheet" href="style.css">
</head>
<body> 
	<h2>Check if image already exists in database folder</h2>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

UPLOAD IMAGE: <input type="file" name="imageUpload" id="imageUpload" accept="image/JPEG" required="required"><br>
		<input type="submit" name="uploading" value="upload">
	</form>	
</body>
</html>