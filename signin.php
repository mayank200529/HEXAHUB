<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	
if(isset($_GET['logout']))
{
	$alert='<div class="alert alert-info">
					 <b>Logout Successful</b>
					</div>';
}	
	
	if(isset($_POST['signin']))
	{
			$username=mysqli_real_escape_string($conn,$_POST['username']);
			$password=mysqli_real_escape_string($conn,$_POST['password']);
			
			$check=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users where username='".$username."' and password='".$password."'"));
			
			if($check==1)
			{
				$status=mysqli_fetch_array(mysqli_query($conn,"SELECT status FROM users where username='".$username."' and password='".$password."'"));
				
				if($status[0]=='disabled')
				{
					$alert='<div class="alert alert-danger">
					 <b>Your account has been block, <u><i>Appeal</i></u></b>
					</div>';
					
				} else {
					$user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users where username='".$username."' and password='".$password."'"));
			
				$_SESSION['user_id']=$user['user_id'];
			
				$alert='<div class="alert alert-warning">
					 Success
					</div>';
					header('location:author?id='.$user['user_id'].'');
				}
					
					
					
			} else {
				$alert='<div class="alert alert-warning">
					 Invalid Username or Password
					</div>';
			}
		
	}
	
?><html>
	<head>
		<title>Signin</title>
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
			<h2>Sign in</h2>
			<br>
		</div>
</div>
<br>
<br>
<div class="container">
	<center>
		<br>
	<div class="card" style="width: 600px;">
  <div class="card-body bg-light">
  <form action="" method="post">
  <?php echo $alert;?>
  <br>
	<div class="row">
		<div class="col-3"><h5 style="float:left;">Username: </h5></div>
		<div class="col"><input type="text" name="username" class="form-control" placeholder="Enter UserName"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"><h5 style="float:left;">Password: </h5></div>
		<div class="col"><input type="password" name="password" class="form-control" placeholder="Enter Password"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col"><input style="float:left;" name="signin" type="submit" class="btn btn-success" value="SIGNIN ME"></div>
	</div>
	<br>
		<a href="signup" class="btn btn-link">Don't Have an Account? Create New Account</a>
	</form>
  </div>
</div><br></center>
</div>	
<BR>
<BR>
<BR>
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