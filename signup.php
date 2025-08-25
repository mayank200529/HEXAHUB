<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	
	if(isset($_POST['signup']))
	{
		if($_POST['password']==$_POST['repassword'])
		{
			
			$username_check=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users where username='".$_POST['username']."'"));
			
			if($username_check==1)
			{
				$alert='<div class="alert alert-danger">
					  Username <strong>'.$_POST['username'].' </strong>already used!
					</div>';
			} else {
				
				$email_check=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users where email='".$_POST['email']."'"));
				if($email_check==1)
			{
				$alert='<div class="alert alert-danger">
					  <strong>'.$_POST['email'].' </strong>already Registered, Login Now!
					</div>';
			} else {
			
			function big(){
					$output=rand(1,9);
					for($i=1;$i<16;$i++)
					{
						$output.=rand(1,9);
					}
					return $output;
				}

				function mm() {
					$ran=rand(1,9);
					if($ran<10)
					{
						$ran="0$ran";
						$num=$ran;
					} else {
						$num=$ran;
					}
					return $num;
					}
					
				$yy=rand(18,30);
				$cvv=rand(0000,9999);
				$amount=0;
				
				mysqli_query($conn,"INSERT INTO users (`name`,`username`,`email`,`pic`,`password`,`status`,`date`) VALUES ('".$_POST['name']."','".$_POST['username']."','".$_POST['email']."','avatar.png','".$_POST['password']."','active','".date("Y-m-d")."')");
			
				$user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users where username='".$_POST['username']."' and password='".$_POST['password']."'"));
				
				mysqli_query($conn,"INSERT INTO cc (`user_id`,`cc_number`,`mm`,`yy`,`cvv`,`amount`) VALUE ('".$user['user_id']."','".big()."','".mm()."','".$yy."','".$cvv."','".$amount."')");
	
					$_SESSION['user_id']=$user['user_id'];
						
						header('location:author?id='.$user['user_id'].'');
						
				}
			}
		} else {
			$alert='<div class="alert alert-danger">
					  <strong>Password not Matched!</strong>
					</div>';
		}
	}
?><html>
	<head>
		<title>Signup</title>
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
			<h2>Account Register</h2>
			<br>
		</div>
</div>
<div class="container">
	<center>
		<br>
	<div class="card" style="width: 600px;">
  <div class="card-body bg-light">
  <form action="" method="post">
  <?php echo $alert;?>
  <br>
	<div class="row">
		<div class="col-3"><h5 style="float:left;">Name: </h5></div>
		<div class="col"><input type="text" name="name" class="form-control" placeholder="Enter Your Name"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"><h5 style="float:left;">Username: </h5></div>
		<div class="col"><input type="text" name="username" class="form-control" placeholder="Enter UserName" autofocus="off"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"><h5 style="float:left;">Email: </h5></div>
		<div class="col"><input type="email" name="email" class="form-control" placeholder="Enter Email"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"><h5 style="float:left;">Password: </h5></div>
		<div class="col"><input type="password" name="password" class="form-control" placeholder="Enter Password"></div>
	</div><br>
	<div class="row">
		<div class="col-3"><h5 style="float:left;"></h5></div>
		<div class="col"><input type="password" name="repassword" class="form-control" placeholder="Re Enter Password"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col"><input style="float:left;" name="signup" type="submit" class="btn btn-success" value="SIGNUP ME"></div>
	</div>
	<br>
	<a href="signin" class="btn btn-link">Already Have an Account? Sign in</a>
	<br>
	</form>
  </div>
</div><br></center>
</div>	

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