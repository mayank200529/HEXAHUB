<?php
session_start();
$a_user_id=$_GET['id'];
	include 'config.php';
	$a_users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$a_user_id."'"));
?>
<html>
	<head>
		<title><?php echo $a_users['name']?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Digital Marketing provide service to Buy and Sell your project free online with good quality and price." />
		<meta name="keywords" content="project, freelance, sell, buy, script, online, earn, script, templates" />
		<meta name="author" content="Rohit Chauhan" />
		<!--assets-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
		<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">
	</head>
	<body>
		<?php include 'header.php'; ?>
		<div style="" class="container-fluid bg-light">
		<div style="" class="container">
		<p class="badge badge-dark">@<?php echo $a_users['username'];?></p>
		<br>
		<div style="padding:10px;" class="row">
			<div class="col-2">
				<img style="height:180px;width:180px;" class="rounded-circle" src="users/profile_img/<?php echo $a_users['pic']; ?>" alt="User Profile">
			</div>
			<div class="col">
				<h3><?php echo $a_users['name']; ?>
						</h3>
						
				<hr>
				<p>&nbsp;&nbsp;<span class="badge badge-dark">BIO:</span> <?php echo $a_users['bio'];?></p>
				<p>&nbsp;&nbsp;<span class="badge badge-dark">CONTACT:</span> <?php echo $a_users['email'];?></p>
				<!--<div class="row">
						&nbsp;
						&nbsp;
						&nbsp;
						<i data-toggle="tooltip" data-placement="right" title="Author Verified" style="color:#3ad130;font-size:40;" class="fa fa-check-circle"></i>
						&nbsp;
						&nbsp;
						&nbsp;
						<i data-toggle="tooltip" data-placement="right" title="1 Year Membership" style="color:#ed7512;font-size:40;" class="fa fa-coffee"></i>
					 &nbsp;
						&nbsp;
						&nbsp;
						<i data-toggle="tooltip" data-placement="right" title="Level 1" style="color:#1a88ef;font-size:40;" class="fa fa-flash"></i>
					 </div>-->
			</div>
			<!-- AddToAny BEGIN -->
				<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
				<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
				<a class="a2a_button_facebook"></a>
				<a class="a2a_button_twitter"></a>
				<a class="a2a_button_google_plus"></a>
				<a class="a2a_button_whatsapp"></a>
				<a class="a2a_button_pinterest"></a>
				<a class="a2a_button_email"></a>
				</div>
<!-- AddToAny END -->
		</div>
<!--<nav style="height:40px;" class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
	 <li class="nav-item active">
        <a class="nav-link" href="#">Script</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Reviews</a>
      </li>
    </ul>
  </div>
</nav>-->
<br>
<nav class="navbar navbar-expand-sm bg-light navbar-dark">
  <a class="navbar-brand text-dark" href="item?id=<?php echo $item_id;?>"><?php echo $a_users['name']?>'s Projects</a>
  &nbsp;
  &nbsp;
</nav>
</div>
</div>
<div style="background:#efefef;" class="container-fluid">
		<div class="container">
		<br>
			<div class="row">
			<?php
		$result=mysqli_query($conn,"SELECT * FROM items where user_id='".$a_user_id."' ORDER BY item_id DESC LIMIT 6");
					while($rows=mysqli_fetch_assoc($result))
					{
						$rat=mysqli_fetch_array(mysqli_query($conn,"SELECT AVG(rating) from rating where item_id='".$rows['item_id']."'"));
						$rating=$rat[0];
						echo '
				   <a style="text-decoration:none;" href="item?id='.$rows['item_id'].'"><div style="padding:10px;" class="col">
				<div class="card" style="width: 350px;">
				  <img style="height:180px;" class="card-img-top" src="projects/'.$rows['item_id'].'/'.$rows['cover'].'" alt="ads">
				  <div style="margin-left:1px;margin-top:-25px;" class="row">
						<div class="col">
							  <h6><span class="badge badge-danger">'.strtoupper($rows['cat']).'</span></h6>
						</div>
					</div>
				  <div class="card-body">
					<h5 style="color:#000;" class="card-text"><b>'.$rows['name'].'</b></h5>
					<div class="row">
						<div class="col">';
							 for($i=1;$i<=$rating;$i++)
						{
							echo '<i class="fa fa-star" style="color:#ffd000;font-size:20px;"></i>&nbsp;';
						}
						$brating=ceil(5-$rating);
						for($i=1;$i<=$brating;$i++)
						{
							echo '<i class="fa fa-star" style="color:#d8d8d8;font-size:20px;"></i>&nbsp;';
						}
						echo'</div>
						<div class="col-3">
							 <h5><span class="badge badge-success">'.$currency.''.$rows['price'].'</span></h5>
						</div>
					</div>
				  </div>
				 </div>
					</div></a>';
					}?>
			</div>
			</div>
			<br>
			<br>
			<br>
			<br>
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