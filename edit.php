<?php
	session_start();
	if(!$_SESSION['user_id'])
	{
		header('location:/rohit');
	}
	
	$alert=NULL;
	
	include 'config.php';
	
	if(isset($_POST['change_profile']))
	{
		$pic_name="".rand(9999,9999999)."-".$_FILES['profile_img']['name']."";
		$pic_tmpname=$_FILES['profile_img']['tmp_name'];
		$folder="users/profile_img/";
		
		$success=move_uploaded_file($pic_tmpname,$folder.$pic_name);
		
		if($success)
		{
			mysqli_query($conn,"UPDATE users SET pic='".$pic_name."' where user_id='".$_SESSION['user_id']."'");
		} else {
			echo 'image updation failed!';
		}
	}
	
	if(isset($_POST['update_acc']))
	{
		
		$check_email=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE email='".$_POST['email']."' and user_id!='".$_SESSION['user_id']."'"));
		
		if($check_email==1)
		{
			$alert='<div class="alert alert-danger">
						  <strong>'.$_POST['email'].'</strong> Already Used!
						</div>';
		} else {
				mysqli_query($conn,"UPDATE users SET name='".$_POST['name']."', email='".$_POST['email']."', bio='".$_POST['bio']."' WHERE user_id='".$_SESSION['user_id']."'");
	
		$alert='<div class="alert alert-success">
						  <strong>Your Account has been Updated!</strong>
						</div>';
		}
	}
	
if(isset($_POST['change_password'])){
	$pass=mysqli_fetch_array(mysqli_query($conn,"SELECT password FROM users WHERE user_id='".$_SESSION['user_id']."'"));
	if($_POST['c_password']==$pass[0])
	{
		if($_POST['n_password']==$_POST['cn_password'])
		{
			mysqli_query($conn,"UPDATE users SET password='".$_POST['n_password']."' WHERE user_id='".$_SESSION['user_id']."'");
				$alert='<div class="alert alert-success">
						  <strong>Password Changed!</strong>
						</div>';
						
		} else {
			$alert='<div class="alert alert-danger">
						  <strong>Password not Match!</strong>
						</div>';
		}
		
	} else {
		$alert='<div class="alert alert-danger">
						  <strong>Wrong Current Password!</strong>
						</div>';
	}
	}
?>
<html>
	<head>
		<title>Edit Profile</title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Digital Marketing provide service to Buy and Sell your project free online with good quality and price." />
		<meta name="keywords" content="project, freelance, sell, buy, script, online, earn, script, templates" />
		<meta name="author" content="Rohit Chauhan" />
		<!--assets-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">
	</head>
	<body>
		<?php include 'header.php'; ?>
		<div style="" class="container-fluid bg-light">
		<div class="container">
			<h2>Account Settings</h2>
			<br>
			<br>
		</div>
</div>
<div style="background:#efefef;" class="container-fluid">
		<div class="container">
		<br>
		<?php echo $alert;?>
		<br>
			
<div class="card" style="width:100%;">
  <div class="card-header">
    Profile Image Change
  </div>
  <div class="card-body p-3">
			<div class="row">
				<div class="col-2">
				<form action="" method="post" enctype="multipart/form-data">
					<h6>Change Profile Pic</h6>
				</div>
				<div class="col"><input type="file" class="form-control" name="profile_img"></div>
			</div>
			
				<br>
			<div class="row">
				<div class="col-2">
					
				</div>	
				<div class="col"><input type="submit" class="btn btn-success" name="change_profile" value="CHANGE PHOTO"></div>
			</form>
			</div>
			<br>
		</div>
		</div>
		<br>
		<div class="card" style="width:100%;">
  <div class="card-header">
    Personal Details
  </div>
  <div class="card-body p-3">
			<div class="row">
				<div class="col-2">
				<form action="" method="post" enctype="multipart/form-data">
					<h6>Username</h6>
				</div>
				<div class="col"><input type="text" class="form-control" value="<?php echo $users['username'] ;?>" disabled></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
				<form action="" method="post" enctype="multipart/form-data">
					<h6>Account Name</h6>
				</div>
				<div class="col"><input type="text" class="form-control" name="name" value="<?php echo $users['name'] ;?>"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Short Bio</h6>
				</div>
				<div class="col"><input type="text" class="form-control" name="bio" value="<?php echo $users['bio'] ;?>"></div>
			</div>
				<br>
				<div class="row">
				<div class="col-2">
					<h6>Account Email</h6>
				</div>
				<div class="col"><input type="text" class="form-control" name="email" value="<?php echo $users['email'] ;?>"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					
				</div>	
				<div class="col"><input type="submit" class="btn btn-success" name="update_acc" value="UPDATE ACCOUNT"></div>
			</form>
			</div>
			<br>
		</div>
		</div>
		  <br>
		  <div class="card" style="width:100%;">
  <div class="card-header">
    Change Password
  </div>
  <div class="card-body p-3">
			<div class="row">
				<div class="col-2">
				<form action="" method="post" enctype="multipart/form-data">
					<h6>Current Password</h6>
				</div>
				<div class="col"><input type="password" class="form-control" name="c_password" placeholder="Current Password"></div>
			</div>
			
				<br>
			<div class="row">
				<div class="col-2">
					<h6>New Password</h6>
				</div>
				<div class="col"><input type="password" class="form-control" name="n_password" placeholder="New Password"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Confirm New Password</h6>
				</div>
				<div class="col"><input type="password" class="form-control" name="cn_password" placeholder="Confirm New Password"></div>
			</div>
				<div class="row">
				<div class="col-2">
				</div>
				<div class="col"><input type="submit" class="btn btn-danger" name="change_password" value="CHANGE"></div>
			</div>
			</form>
			<br>
		</div>
		</div>
		<br>
	<br>
	<br>
	<br>
	<br>
	<br>
		</div>
		</div>
		</div>
		<!-- javascript and jqurey -->
		</div>
		<!-- modal -->
	<!--sider-->
	</body>
	<!-- javascript and jqurey -->
	<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<?php include 'footer.php'; ?>
			<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});
		</script>
</html>