
		<link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
		
 <div class="container-fluid ">
  <style>
 
	/* Wrapper */.icon-button {
	background-color: white;
	border-radius: 3.6rem;
	cursor: pointer;
	display: inline-block;
	font-size: 20px;
	height: 30px;
	line-height: 30px;
	margin: 0 5px;
	position: relative;
	text-align: center;
	-webkit-user-select: none;
	-moz-user-select: none;
		-ms-user-select: none;
			user-select: none;
	width: 30px;
	}

	.icon-button span {
	border-radius: 0;
	display: block;
	height: 0;
	left: 50%;
	margin: 0;
	position: absolute;
	top: 50%;
	transition: all 0.3s;
	width: 0;
	}
	.icon-button:hover span {
	width: 30px;
	height: 30px;
	border-radius: 50%;
	margin: -15px 0px 0px -15px;
	}
	.linkedin span {
	background-color: #0c315cff;
	}
	.github span {
	background-color: #000000ff;
	}
	.facebook span {
	background-color: #3B5998;
	}
	.whatsapp span {
	background-color: #64b265ff;
	}
	.instagram span{
	background-color: #e4405f;
	}
	.phone span{
	background-color: #45764dff;
	}
	.mail span{
	background-color: #330000ff;
	}

	.icon-button i {
	background: none;
	color: white;
	height: 30px;
	left: 0;
	line-height: 30px;
	position: absolute;
	top: 0;
	transition: all 0.3s;
	width: 30px;
	z-index: 10;
	}
	.icon-button .fa-linkedin {
	color: #0a73ebff;
	}
	.icon-button .fa-github {
	color: #000000ff;
	}
	.icon-button .fa-facebook {
	color: #3B5998;
	}
	.icon-button .fa-whatsapp {
	color: #065e0aff;
	}
	.icon-button .fa-instagram {
	color: #e4405f;
	}
	.icon-button .fa-phone {
	color: #02270bff;
	}
	.icon-button .fa-envelope {
	color: #BB001B;
	}
	.icon-button:hover .fa-linkedin,
	.icon-button:hover .fa-github,
	.icon-button:hover .fa-facebook,
	.icon-button:hover .fa-phone,
	.icon-button:hover .fa-instagram,
	.icon-button:hover .fa-envelope,
	.icon-button:hover .fa-whatsapp {
	color: #fff;
	}
 </style>
<div style="height:50px;background:#063c6f" class="row">
	<div class="col">
		 <nav style="height:50px;" class="navbar navbar-expand-lg nav-light">
<br>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <center>
    <ul class="navbar-nav">
	 <li class="nav-item active">
        <a style="color:#fff;" class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a style="color:#fff;" class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a style="color:#fff;" class="nav-link" href="#">Contact Us</a>
      </li>
	   <li class="nav-item">
        <a style="color:#fff;" class="nav-link" href="#">Policy</a>
      </li>
    </ul>
	</center>
  </div>
</nav>
	</div>
	<div class="col p-2">
	<div style="float:right;">
		<a class=" icon-button phone" target="_blank" href="tel:+918209785485"><i class="fa fa-phone" style="font-size: 25px;"></i><span></span></a>
		<a class=" icon-button whatsapp" target="_blank" href="https://wa.me/8209785485?text=Hello%20I'm%20Mayank"><i class="fa fa-whatsapp" style="font-size: 25px;"></i><span></span></a>
		<a class=" icon-button mail" target="_blank" href="mailto:rawatmayank685@gmail.com"><i class="fa fa-envelope" style="font-size: 25px;"></i><span></span></a>
		<a class=" icon-button github" target="_blank" href="https://github.com/mayank200529"><i class="fa fa-github" style="font-size: 25px;"></i><span></span></a>
		<a class=" icon-button linkedin" target="_blank" href="https://www.linkedin.com/in/mayank-rawat-372675200/"><i class="fa fa-linkedin" style="font-size: 25px;"></i><span></span></a>
		<a class=" icon-button instagram" target="_blank" href="https://www.instagram.com/mayank_r29?igsh=eTRyaGpjcGNoeWcx"><i class="fa fa-instagram" style="font-size: 25px;"></i><span></span></a>
	</div>
	</div>
</div>
 <!---->
  <div class="row" style="background-color:rgb(16, 34, 62);">
		<div class="col-8">
		<nav class="navbar navbar-expand-lg ">
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
    	<ul class="row" >
	 	<a class="w-100" href=""><img style="height:100px; padding-left:40px;" class="img-fluid" src="logo.png" alt="LOGO"></a>
    	</ul>
    <!---->
  </div>
</nav>

	</div>
	<div class="col-3">
	<div class="row">
		<?php
			if($_SESSION['user_id'])
			{
				$users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users where user_id='".$_SESSION['user_id']."'"));
			
			if($users['wallet']==0){
				$my_wallet=0;
				}else{
					$my_wallet=$users['wallet'];
					}
					
				echo '
						<div class="row" style="margin:10px;">
							<div class="col-4">
								<img style="height: 100px;" class="rounded-circle img-fluid border border-white" src="users/profile_img/'.$users['pic'].'">
							</div>
							<div class="col-8">
								<div style="margin-top:28px;" class="btn-group">
								<button type="button" class="btn btn-light">Hey, '.$users['name'].'</button>
								<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
								</button>
								<div class="dropdown-menu dropleft">
									<a class="dropdown-item bg-success text-white" href="my_wallet">My Wallet: '.$currency.''.round($my_wallet,2).'</a>
									<hr>
									<a class="dropdown-item" href="author?id='.$users['user_id'].'">My Profile</a>
									<a class="dropdown-item" href="my_items">My Items</a>
									<a class="dropdown-item" href="orders">My Orders</a>
									<a class="dropdown-item" href="my_sells">My Sells</a>
									<a class="dropdown-item" href="withdraw">Withdraw Money</a>
									<a class="dropdown-item" href="my_card">Virthual Card</a>
									<a class="dropdown-item" href="upload">Upload</a>
									<a class="dropdown-item" href="edit">Settings</a>
									<a class="dropdown-item" href="logout">Logout</a>
								</div>
								</div>
							</div>
						</div>
						
				';
			} else
				
				{
					echo '
						<div class="p-3" >
							<div style="margin-top:0px; margin-right:0px;" class="btn-group dropend">
							  <button type="button" style="color:#012a4a;background-color:#a9d6e5; font-size:20px;" class="btn dropdown-toggle" data-bs-toggle="dropdown">Hello User</button>
							  <div class="dropdown-menu p-2 dropleft" style="color:#fff;background-color:#e9f5db; font-size:20px;">
							  <a class="dropdown-item" href="signin">Login</a>
							  <a class="dropdown-item" href="signup">Signup</a>
							  <ul>
							  </ul>
							  </div>
							</div>
						</div>';

					
				}
		?>
	</div>
	</div>
  </div>
  </div>
<nav style="background-color:#e6f2ff;" class="navbar navbar-expand-lg nav-light opaque-navbar">
  <div class="collapse navbar-collapse"  id="navbarNavDropdown">
    <ul class="navbar-nav" >
	 <li class="nav-item active">
        <a class="nav-link" style="color:#003049;" href="search?q=">All <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:#003049;" href="category?q=PHP Script">PHP Projects</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:#003049;" href="category?q=HTML Templates">HTML Tamplates</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:#003049;" href="category?q=Graphics">Graphic Projects</a>
      </li>
	   <li class="nav-item">
        <a class="nav-link" style="color:#003049;" href="category?q=Android">Android Projects</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" style="color:#003049;" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          More Projects
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="category?q=C Language">C, C++, C#</a>
          <a class="dropdown-item" href="category?q=Python">Python</a>
          <a class="dropdown-item" href="category?q=MS Office">MS Office</a>
          <a class="dropdown-item" href="category?q=Java">Java</a>
          <a class="dropdown-item" href="category?q=Wordpress">Wordpress</a>
          <a class="dropdown-item" href="category?q=Others">Others</a>
        </div>
      </li>
	  <li class="nav-item">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </li>
	  <form class="form-inline" action="search" method="get">
		<input class="form-control mr-sm-2" name="q" type="search" placeholder="Search" aria-label="Search">
		<button class="btn my-2 my-sm-0" style="color:#fff; background-color:rgba(1, 19, 47, 1);" type="submit">Search</button>
	</form>
    </ul>
  </div>
</nav>