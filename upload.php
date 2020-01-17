<?php 
$con =mysqli_connect("localhost","root","","filedb") or die(mysql_error());
mysqli_select_db($con,"filedb");

if(isset($_POST['uploading'])){
  $avatar_name =$_FILES['avatar']['name'];
  $avatar_name =preg_replace("/\s+/","_",$avatar_name); //remove spaces from image name
  $avatar_tmpname=$_FILES['avatar']['tmp_name'];
  $avatar_size=$_FILES['avatar']['size'];
  $avatar_type=$_FILES['avatar']['type'];

  $avatar_ext=pathinfo($avatar_name,PATHINFO_EXTENSION);  //get file extenstion .jpg
  $avatar_name =pathinfo($avatar_name,PATHINFO_FILENAME);      //file name like prince
  $final_name=$avatar_name."_".date('mjYHis').".".$avatar_ext; //secure name  
 
  //validation go to google mb to bytes search  
  if (!empty($avatar_name)){   //this is realname
  	 if($avatar_size <= 2000000){  //2 mb ki file honi chiye
  	 	if($avatar_ext=="jpg" || $avatar_ext=="jpeg" || $avatar_ext=="png" || $avatar_ext=="gif"){
  	 	  //echo "great!!! everything is fine";
          $final_file="uploads/".$final_name;
          $upload =move_uploaded_file($avatar_tmpname,$final_file);
          if($upload){
          	$msg= "file upload sucessfully";
          	$query="INSERT INTO imgtable(name) VALUES('$final_name')";
          	$fire=mysqli_query($con,$query) or die("cannot insert file path into database".mysqli_error($con));
          	echo $msg.="and also inserted into database";
          }    
  	 	}else{echo "only jpg, jpeg, png, gif files are allowed to upload";}
  	 }else{echo "file size is too large";}
   }else{echo "please select an image to upload";}
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>mytable</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body> 
<!-- 	accept="image/JPEG"  -->
	<h2 class="text-dark">Please Upload Image......</h2><br>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
UPLOAD IMAGE: <input type="file" name="avatar" id="imageUpload" ><br>
		<input type="submit" name="uploading" value="UPLOAD" class="btn btn-danger">
	</form>	
</body>
</html>