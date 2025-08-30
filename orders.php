<?php
	session_start();
	if(!$_SESSION['user_id'])
	{
		header('location:/rohit');
	}
	
	include 'config.php';
	
	
?>
<html>
	<head>
		<title>My Orders</title>
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
			<h2>All Orders</h2>
			<br>
			<br>
		</div>
</div>
<div style="background:#efefef;" class="container-fluid">
		<div class="container">
		<br>
<form action="" method="post" enctype="multipart/form-data">		
<div class="card" style="width:100%;">
  <div class="card-body p-3">
  <table class="table">
	<th>S.no</th>
	<th>Name</th>
	<th>Price</th>
	<th>Method</th>
	<th>Purchased On</th>
	<th>Invoice</th>
<?php
	$order_sql=mysqli_query($conn,"SELECT * FROM orders WHERE user_id='".$_SESSION['user_id']."'");
	$sn=1;
	while($orders=mysqli_fetch_assoc($order_sql))
	{
		$o_items=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM items WHERE item_id='".$orders['item_id']."'"));
	
		echo '
				<tr>
					<td>'.$sn.'</td>
					<td>'.$o_items['name'].'</td>
					<td>'.$currency.''.$orders['amount'].'</td>
					<td><span class="badge badge-info">'.strtoupper($orders['method']).'</span></td>
					<td>'.date('j F Y',strtotime($orders['date'])).'</td>
					<td><a target="_blank" href="invoice?q='.$orders['order_id'].'" class="btn btn-danger btn-sm">VIEW/DOWNLOAD</a></td>
				</tr>
		';
		$sn++;
	}
?>
</table>
		</div>
		</div>
			
		</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
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