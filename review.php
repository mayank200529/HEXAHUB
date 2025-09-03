<?php
session_start();
$item_id=$_GET['id'];
	include 'config.php';
	$item=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM items WHERE item_id='".$item_id."'"));
	$rat=mysqli_fetch_array(mysqli_query($conn,"SELECT AVG(rating) from rating where item_id='".$item_id."'"));
	$count=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(rate_id) from rating where item_id='".$item_id."'"));
	$rating=$rat[0];
	
	$alert=NULL;
	
	if(isset($_POST['buy']))
	{
		$check_already=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE item_id='".$item_id."' AND user_id='".$_SESSION['user_id']."'"));
		
		if($check_already)
		{
				$alert='<div class="alert alert-warning">
						  <strong>Already Purchased!</strong> You have already purchased this item.</a>
						</div>';
		} else {
			
			if($logged_users['wallet']<$item_price)
			{
				$alert='<div class="alert alert-warning">
						  <strong>Not Allow</strong> Please Add Money to your wallet.</a>
						</div>';
			} else {
		
		mysqli_query($conn,"UPDATE users SET wallet = wallet - $item_price where user_id='".$_SESSION['user_id']."'");
		mysqli_query($conn,"INSERT INTO orders (`item_id`,`user_id`,`amount`,`date`) VALUES ('".$item_id."','".$_SESSION['user_id']."','".$item_price."','".date("Y-m-d")."')");
		mysqli_query($conn,"INSERT INTO wlt_transactions (`project_id`,`amount`,`status`,`user_id`,`date`) VALUES ('".$item_id."','".$item_price."','purchased','".$_SESSION['user_id']."','".date("Y-m-d")."')");
		$alert='<div class="alert alert-warning">
						  <strong>Item Purchase Successful!</strong> Thank You for Purchasing, Give Review Now.</a>
						</div>';
		}
		}
	}	
	
	
	if(isset($_POST['rate']))
	{
		$review_already=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM rating WHERE item_id='".$item_id."' AND user_id='".$_SESSION['user_id']."'"));
		
		if($review_already)
		{
				$alert='<div class="alert alert-warning">
						  <strong>Already Rated!</strong> You have already rated this item.</a>
						</div>';
		} else {
			
		$comment=mysqli_real_escape_string($conn,$_POST['comment']);
		mysqli_query($conn,"INSERT INTO rating (`item_id`,`user_id`,`comment`,`rating`,`date`) VALUES ('".$item_id."','".$_SESSION['user_id']."','".$comment."','".$_POST['rating']."','".date("Y-m-d")."')");
	}
	}
?>
<html>
	<head>
		<title>Reviews - <?php echo $item['name']; ?></title>
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
		<?php $i_users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$item['user_id']."'"));?>
		
		<div style="" class="container-fluid bg-light">
		<div style="" class="container">
		<p class="badge badge-dark">PHP / Video Streaming</p>
		<br>
		<div style="padding:10px;" class="row">
			<div class="col-2">
				<img style="height:150px;" src="projects/<?php echo $item_id; echo '/'; echo $item['logo']; ?>" alt="ads">
			</div>
			<div class="col">
				<h3><?php echo $item['name']; ?></h3>
				<p>make your own video streaming site</p>
				<hr>
				<?php
					for($i=1;$i<=$rating;$i++)
						{
							echo '<i class="fa fa-star" style="color:#ffd000;font-size:25px;"></i>&nbsp;';
						}
						$brating=ceil(5-$rating);
						for($i=1;$i<=$brating;$i++)
						{
							echo '<i class="fa fa-star" style="color:#d8d8d8;font-size:25px;"></i>&nbsp;';
						}
				?>
				<p>Average rating of <?php echo round($rat[0],1);?> based on <?php echo $count[0];?> votes</p>
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
		<?php
			if($item['user_id']==$_SESSION['user_id'])
			{
				echo '<div class="alert alert-info">
						  <strong>You are Author of This Script!</strong> Click To Download.</a>
						</div>';
			} else {
				echo '';
			}
		?>
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
  <a class="navbar-brand text-dark" href="item?id=<?php echo $item_id;?>"><b>Overview</b></a>
  &nbsp;
  &nbsp;
  &nbsp;
  <a class="navbar-brand text-dark active" href="review?id=<?php echo $item_id;?>">Reviews</a>
</nav>
</div>
</div>
<div style="background:#efefef;" class="container-fluid">
		<div class="container">
		<br>
			<div class="row">
				<div class="col">
			<?php echo $alert;?>
				<?php
					$check_review=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM orders WHERE item_id='".$item_id."' AND user_id='".$_SESSION['user_id']."'"));
					
					if($check_review)
					{
						echo '
							<div class="row">
								<div class="col-2">
									<img style="height:120px;" class="rounded-circle" src="users/profile_img/'.$users['pic'].'">
								</div>
								<div class="col">
								<form action="" method="post">
									<select name="rating" class="form-control">
										<option value="1">1 Star</option>
										<option value="2">2 Star</option>
										<option value="3">3 Star</option>
										<option value="4">4 Star</option>
										<option value="5">5 Star</option>
									</select>
									<br>
									<textarea class="form-control" name="comment"></textarea>
									<br>
									<input name="rate" type="submit" class="btn btn-warning" value="RATE THIS"/>
									</form>
								</div>
							</div>
				<hr>
						';
					} else {
					}
				?>
				<?php
					$result=mysqli_query($conn,"SELECT * FROM rating where item_id='".$item_id."'");
					while($rows=mysqli_fetch_assoc($result))
					{
						$users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$rows['user_id']."'"));
						echo '
							<div class="media border p-3 bg-white">
				  <img src="users/profile_img/'.$users['pic'].'" alt="'.$users['name'].'" class="mr-3 mt-3 rounded-circle" style="width:80px;">
				  <div class="media-body">
					<h4>'.$users['name'].' <small>on '.date('j F Y',strtotime($rows['date'])).'</small></h4>
					<p>'.$rows['comment'].'</p>
					';
					for($i=1;$i<=$rows['rating'];$i++)
						{
							echo '<i class="fa fa-star" style="color:#ffd000;font-size:25px;"></i>&nbsp;';
						}
						$brating=ceil(5-$rating);
						for($i=1;$i<=$brating;$i++)
						{
							echo '<i class="fa fa-star" style="color:#d8d8d8;font-size:25px;"></i>&nbsp;';
						}
					echo'
				  </div>
				</div><br>
						';
					}
				?>
				</div>
				<div class="col-4">
				 <div class="card" style="">
					  <div class="card-body">
						<div class="row">
							<div class="col">
								<select class="form-control">
									<option value="regular" selected>Regular License</option>
									<option value="extendard">Extendard License</option>
								</select>
							</div>
							<div class="col-4">
								<h3 class="text-success"><b><?php echo $currency;?><?php echo $item['price']; ?></b></h3>
							</div>
						</div>
						<br>
						<ul style="list-style-type:none;">
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Free support</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Free Future product updates</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Quality checked by Our Team</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;No transaction fees</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Lowest price guarantee</li>
						</u>
						<br>
						<a href="item?id=<?php echo $item_id; ?>"><button style="width:100%;" class="btn btn-success"><b>BUY NOW</b></button></a>
					  </div>
						<div class="card-footer"><center><img style="width:200px;"src="assets/img/payment.png"></center></div>
					</div>
					<br>
					
				<div class="card">
					 <div class="card-header bg-white"><b>Published by</b></div>
					  <div class="card-body">
					  <div class="row">
						<div class="col-4">
						<img style="height:100px;" class="rounded-circle" src="users/profile_img/<?php echo $i_users['pic'];?>" alt="<?php echo $users['name'];?>">
						</div>
						<div class="col">
							<h5><?php echo $i_users['name'];?>&nbsp;<i data-toggle="tooltip" data-placement="right" title="Author Verified" style="color:#3ad130;font-size:18px;" class="fa fa-check-circle"></i></h5>
							<p>@<?php echo $i_users['username'];?></p>
						</div>
					  </div>
					  </div>
					</div>
					<br>
					 <div class="card" style="">
					  <div class="card-body">
						<h5>Project Information</h5>
						<br>
						<table class="table table-hover">
							<tr>
								<td><b>Category</b></td>
								<td><?php echo strtoupper($item['cat']);?></td>
							</tr>
							<tr>
								<td><b>First Release</b></td>
								<td><?php echo date('j F Y',strtotime($item['date']));?></td>
							</tr>
							<tr>
								<td><b>Last Update</b></td>
								<td><?php echo date('j F Y',strtotime($item['up_date']));?></td>
							</tr>
							<tr>
								<td><b>Software Versions</b></td>
								<td><?php echo strtoupper($item['soft']);?></td>
							</tr>
							<tr>
								<td><b>Files Included</b></td>
								<td><?php echo strtoupper($item['file_inc']);?></td>
							</tr>
							<tr>
								<td><b>Database</b></td>
								<td><?php echo strtoupper($item['db']);?></td>
							</tr>
						</table>
					  </div>
					</div>
				</div>
			</div>
			</div>
			<br>
			<br>
			<br>
			<br>
		<!-- javascript and jqurey -->
		</div>
		<!-- modal -->
		<div class="modal fade" id="payment">
		  <div class="modal-dialog">
			<?php
				if($_SESSION['user_id'])
				{
					echo '
						<div class="modal-content">

			  <!-- Modal Header -->
			  <div class="modal-header">
				<h4 class="modal-title">Complete Your Payment</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>

			  <!-- Modal body -->
			  <div class="modal-body">
				<br>
				<div class="input-group mb-4">
					  <div class="input-group-prepend">
						<input type="radio" name="method">
						&nbsp;
						&nbsp;
						&nbsp;
					  </div>
					 <img style="height:25px;" src="assets/img/paypal.png">
					</div>
					<div class="input-group mb-4">
					  <div class="input-group-prepend">
						<input type="radio" name="method">
						&nbsp;
						&nbsp;
						&nbsp;
					  </div>
					 <img style="height:25px;" src="assets/img/payment.png">
					</div>
					<div class="input-group mb-4">
					  <div class="input-group-prepend">
						<input type="radio" name="method">
						&nbsp;
						&nbsp;
						&nbsp;
					  </div>
					 <h4>Use Wallet</h4>
					</div>
			  </div>

			  <!-- Modal footer -->
			  <div class="modal-footer">
			  <form action="" method="post">
				<input type="submit" name="buy" class="btn btn-success" value="Pay $'.$item['price'].' Now">
				</form>	
			 </div>

			</div>
					';
					
				} else {
					echo '
						<div class="modal-content">
			  <!-- Modal body -->
			  <div class="modal-body">
				<center><h5><span class="text-success">SignUp/Signin to Buy</span></h5></center>
							  <form action="signin" method="post"> 
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
									<div class="col"><input style="float:left;" name="signin" type="submit" class="btn btn-success" value="SIGNIN ME">
												
								<br>
								<br>
								<a href="signup">Signup Account</a>
									</div>
								</div>
								</form>
			  </div>

			</div>
					';
				}
			?>
		  </div>
</div>
<!--sider-->
<div class="modal fade" id="ss">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
  
  <?php
$directory = "projects/".$item_id."/screenshots";
$images = glob($directory . "/*.jpg");
$i=1;
foreach($images as $image)
{
  echo '
	<li data-target="#demo" data-slide-to="'.$i.'"></li>
  ';
  
  $i++;
}
?>

  </ul>
  <!-- The slideshow -->
  <div class="carousel-inner">
	<?php
$directory = "projects/".$item_id."/screenshots";
$images = glob($directory . "/*.jpg");
$i=1;
foreach($images as $image)
{
  //echo $image;
  //echo '<br>';
  if($i==1)
  {
	  $st="active";
  } else {
	  $st="";
  }
  echo '
	<div class="carousel-item '.$st.'">
      <img src="'.$image.'" alt="New York" style="width:100%;">
    </div>
  ';
  $i++;
}
?>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</div>

    </div>
  </div>
</div>

	</body>
	<!-- javascript and jqurey -->
	<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script async src="https://static.addtoany.com/menu/page.js"></script>
		<?php include 'footer.php'; ?>
			<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});
		</script>
</html>