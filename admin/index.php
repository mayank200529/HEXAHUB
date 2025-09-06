<?php
session_start();
include '../config.php';
$alert=NULL;

if(isset($_GET['incorrect']))
{
	$alert='
			<div class="alert alert-danger">
				<strong>Please Login First!</strong>
			</div>
		';
}

if(isset($_GET['logout']))
{
	$alert='
			<div class="alert alert-info">
				<strong>Logout Success!</strong>
			</div>
		';
}

if(isset($_POST['login']))
{
	$ausername=mysqli_real_escape_string($conn,$_POST['username']);
	$apassword=mysqli_real_escape_string($conn,$_POST['password']);
	
	$admin_check=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM admin WHERE username='".$ausername."' and password='".$apassword."'"));
	
	if($admin_check)
	{
		$_SESSION['admin']=true;
		header('location:dashboard.php');
		
	} else {
		$alert='
			<div class="alert alert-danger">
				<strong>Login Faild, Please Check Your Password</strong>
			</div>
		';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" />
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/jquery-1.9.1.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/bootstrap.bundle.min.js"></script>
		<link rel="icon" href="../favicon.png" sizes="16x16" type="image/png">
<!--===============================================================================================-->
</head>
<body style="background:url('bg.jpg');background-size:cover;" >
<div class="container-fluid">
<br>
<br>
<br>
<br>
		<center>
		<div class="card" style="width:400px">
		  <div class="card-body">
			<h3 class="card-title text-danger">Admin Panel</h3>
			<?php echo $alert;?>
			<form action="" method="post">
			<br>
				<input type="text" name="username" class="form-control" placeholder="Admin Username" autocomplete="false" required />
			<br>
				<input type="password" name="password" class="form-control" placeholder="Admin Password" required />
			<br>
			<input type="submit" style="width:100%;" name="login" class="btn btn-danger" value="SECURE LOGIN"/>
			</form>
		  </div>
		</div>
		</center>
</div>
</body>
</html>
