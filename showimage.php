<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>show image</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
</head>
<body>
<?php 
$con =mysqli_connect("localhost","root","","filedb") or die(mysql_error());
mysqli_select_db($con,"filedb");
$q = "SELECT name from imgtable";
$result=mysqli_query($con,$q);
while($row=mysqli_fetch_array($result))
{
//echo $row['name']; //get image name
?>
<!--  <div class="container">
    <img src="uploads/<?php //echo $row['name'];?>" alt="not found">
  </div>  -->
<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3 col-sm-12">
			<img src="uploads/<?php echo $row['name'];?>" alt="" class="img-fluid rounded">
			<h4><?php echo $row['name'] ; ?></h4>
	   </div>
	</div>
</div><hr>
  <?php } ?>
</body>
</html>