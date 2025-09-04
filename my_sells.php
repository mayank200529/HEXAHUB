<?php
	session_start();
	if(!$_SESSION['user_id'])
	{
		header('location:/rohit');
	}
	
	$alert=NULL;
	
	include 'config.php';
?>
<html>
	<head>
		<title>My Sells</title>
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
			<h2>My Sells</h2>
			<br>
			<br>
		</div>
</div>
<div style="background:#efefef;" class="container-fluid">
		<div class="container">
		<br>
<br>
			<div class="card" style="width:100%;">
  <div class="card-body p-3">
		<table class="table">
			<th>S.no</th>
			<th>Project Name</th>
			<th>Item Price</th>
			<th>Commission(20%)</th>
			<th>Earn Amount</th>
			<th>Date</th>
			<?php
				$earn_query=mysqli_query($conn,"SELECT * FROM earnings WHERE seller_id='".$_SESSION['user_id']."'");
				$snn=0;
				while($earn=mysqli_fetch_assoc($earn_query))
				{
					$snn++;
					$item_nm=mysqli_fetch_array(mysqli_query($conn,"SELECT name FROM items WHERE item_id='".$earn['project_id']."'"));
					echo '
						<tr>
						<td>'.$snn.'</td>
						<td>'.$item_nm[0].'</td>
						<td>'.$currency.''.$earn['amount'].'</td>
						<td><span class="text-danger">-'.$currency.''.$earn['com'].'</span></td>
						<td>'.$currency.''.$earn['final'].'</td>
						<td>'.date('j F Y',strtotime($earn['date'])).'</td>
						</tr>
					';
				}
			?>
		</table>

		</div>
		</div>
<br>
<br>
<br>
		</div>
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