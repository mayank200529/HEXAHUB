<?php
session_start();
	include 'config.php';
	
$cat=$_GET['q'];	
?>
<html>
	<head>
		<title>Digital Marketing</title>
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
		<style>
		@media screen and (max-width:600px)
		{
			.card {
				width:100%;
			}
		}
		</style>
	</head>
	<body>
		<?php include 'header.php'; ?>
	
			<div class="col text-center">
				<br>
				<h2>Category: <?php echo $cat;?></h2>
		</div>
		<div class="container-fluid">
		<div class="container">
		<div class="row">
		<?php
		$result=mysqli_query($conn,"SELECT * FROM items WHERE cat='$cat'");
					while($rows=mysqli_fetch_assoc($result))
					{
						$rat=mysqli_fetch_array(mysqli_query($conn,"SELECT AVG(rating) from rating where item_id='".$rows['item_id']."'"));
						$rating=$rat[0];
						echo '
				   <a style="text-decoration:none;" href="item?id='.$rows['item_id'].'"><div style="padding:10px;" class="col">
				<div class="card" style="width: 360px;">
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
				 <br>
				 </div></div>
		<br>
		<br>
		<!-- javascript and jqurey --><script src="assets/js/popper.min.js"></script>
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<?php include 'footer.php'; ?>
	</body>
</html>