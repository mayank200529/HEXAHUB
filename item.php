<?php
session_start();
$item_id=$_GET['id'];
	include 'config.php';
	$item=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM items WHERE item_id='".$item_id."'"));
	$rat=mysqli_fetch_array(mysqli_query($conn,"SELECT AVG(rating) from rating where item_id='".$item_id."'"));
	$count=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(rate_id) from rating where item_id='".$item_id."'"));
	
	$logged_users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
	$rating=$rat[0];
	
	$alert=NULL;
	$item_price=$item['price'];
	
	$future_price=$logged_users['wallet']-$item['price'];
	
	if($future_price<=0)
	{
		$sts='<span class="text-danger"><b>Not possible to buy this script, Please Earn More</b></span>';
	} else {
		$sts='<h6>Future Wallet: '.$currency.''.$future_price.' (If you buying this item)</h6>';
	}
	
	if(isset($_POST['buy']))
	{
	
		   if($_POST['method']=='wallet')
			  {
							  
						if($logged_users['wallet']<$item_price)
						{
							$alert='<div class="alert alert-warning">
									  <strong>Not Allow</strong> Please Add Money to your wallet.</a>
									</div>';
						} else {
							$our_comm=20;
					
					$com_amount=($item_price*$our_comm)/100;
					
					$final=$item_price-$com_amount;
					
					mysqli_query($conn,"UPDATE users SET wallet = wallet - $item_price where user_id='".$_SESSION['user_id']."'");
					mysqli_query($conn,"UPDATE users SET wallet = wallet + $final where user_id='".$item['user_id']."'");
					mysqli_query($conn,"INSERT INTO orders (`item_id`,`user_id`,`amount`,`method`,`date`) VALUES ('".$item_id."','".$_SESSION['user_id']."','".$item_price."','".$_POST['method']."','".date("Y-m-d h:i:s")."')");
					mysqli_query($conn,"INSERT INTO wlt_transactions (`project_id`,`amount`,`status`,`user_id`,`date`) VALUES ('".$item_id."','".$final."','received','".$item['user_id']."','".date("Y-m-d h:i:s")."')");
					mysqli_query($conn,"INSERT INTO wlt_transactions (`project_id`,`amount`,`status`,`user_id`,`date`) VALUES ('".$item_id."','".$item_price."','purchased','".$_SESSION['user_id']."','".date("Y-m-d h:i:s")."')");
					mysqli_query($conn,"INSERT INTO earnings (`project_id`,`seller_id`,`buyer_id`,`amount`,`com`,`final`,`date`) VALUES ('".$item_id."','".$item['user_id']."','".$_SESSION['user_id']."','".$item_price."','".$com_amount."','".$final."','".date("Y-m-d h:i:s")."')");
					$alert='<div class="alert alert-warning">
									  <strong>Item Purchase Successful!</strong> Thank You for Purchasing, Give Review Now.</a>
									</div>';	

						$popup="$(window).on('load',function(){
										$('#myPay').modal('show');
									});";		
									
			  }
			  }
			  else if($_POST['method']=='paypal') {
				  $alert= '
					<div class="alert alert-info">
						<strong>Please Pay First From PayPal, After Buy</strong>
					</div>
				  ';
			  } else if($_POST['method']=='cc') {
				 
				 $cc_amount=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM cc WHERE cc_number='".$_POST['cc_number']."' and mm='".$_POST['cc_mm']."' and yy='".$_POST['cc_yy']."' and cvv='".$_POST['cc_cvv']."'"));
				 $cc=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM cc WHERE cc_number='".$_POST['cc_number']."' and mm='".$_POST['cc_mm']."' and yy='".$_POST['cc_yy']."' and cvv='".$_POST['cc_cvv']."'"));
				 
				 if($cc_amount==1)
				 {  
			 
					if($cc['amount']<$item_price)
						{
							$alert= '
						<div class="alert alert-info">
							<strong>No Money in Your Virthual Card, Please Add!</strong>
						</div>
					  ';
					} else {
						
						$our_comm=20;
					
					$com_amount=($item_price*$our_comm)/100;
					
					$final=$item_price-$com_amount;
					
					mysqli_query($conn,"UPDATE cc SET amount = amount - $item_price WHERE cc_number='".$_POST['cc_number']."' and mm='".$_POST['cc_mm']."' and yy='".$_POST['cc_yy']."' and cvv='".$_POST['cc_cvv']."'");
					mysqli_query($conn,"UPDATE users SET wallet = wallet + $final where user_id='".$item['user_id']."'");
					mysqli_query($conn,"INSERT INTO orders (`item_id`,`user_id`,`amount`,`method`,`date`) VALUES ('".$item_id."','".$_SESSION['user_id']."','".$item_price."','".$_POST['method']."','".date("Y-m-d h:i:s")."')");
					mysqli_query($conn,"INSERT INTO wlt_transactions (`project_id`,`amount`,`status`,`user_id`,`date`) VALUES ('".$item_id."','".$final."','received','".$item['user_id']."','".date("Y-m-d h:i:s")."')");
					mysqli_query($conn,"INSERT INTO vc_transactions (`pro_name`,`amount`,`status`,`user_id`,`date`) VALUES ('".$item_id."','".$item_price."','purchased','".$_SESSION['user_id']."','".date("Y-m-d h:i:s")."')");
					mysqli_query($conn,"INSERT INTO earnings (`project_id`,`seller_id`,`buyer_id`,`amount`,`com`,`final`,`date`) VALUES ('".$item_id."','".$item['user_id']."','".$_SESSION['user_id']."','".$item_price."','".$com_amount."','".$final."','".date("Y-m-d h:i:s")."')");
					$alert='<div class="alert alert-warning">
									  <strong>Item Purchase Successful!</strong> Thank You for Purchasing, Give Review Now.</a>
									</div>';
							$popup="$(window).on('load',function(){
										$('#myPay').modal('show');
									});";		
					}
				
				
				 } else {
					 $alert= '
					<div class="alert alert-danger">
						<strong>Credit Card Details in Not Valid</strong>
					</div>
				  ';
				  $popup="$(window).on('load',function(){
										$('#myError').modal('show');
									});";	
				 }
				 
			//  }
			}
	}	
?>
<html>
	<head>
		<title><?php echo $item['name']; ?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Digital Marketing provide service to Buy and Sell your project free online with good quality and price." />
		<meta name="keywords" content="project, freelance, sell, buy, script, online, earn, script, templates" />
		<meta name="author" content="Mayank Singh Rawat" />
		<!--assets-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
		<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">
	</head>
	<body>
		<?php include 'header.php'; ?>
		<?php $users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$item['user_id']."'"));?>
		<div style="" class="container-fluid bg-light">
			<?php echo $alert;?>
		<div style="" class="container">
		<?php
					$pro_query=mysqli_query($conn,"select item_id, count(item_id) c from orders group by item_id order by c desc LIMIT 5");
						$sn=0;
						while($list=mysqli_fetch_assoc($pro_query))
						{
							$sn++;
							if($list['item_id']==$item_id)
							{
								echo '<span style="height:28px;font-size:18px;" class="badge badge-danger">#'.$sn.' <i class="fa fa-line-chart" aria-hidden="true"></i> Trending</span>';
							}
					}?>
		<br>
		<div style="padding:10px;" class="row">
			<div class="col-2">
				<img style="height:150px;" src="projects/<?php echo $item_id; echo '/'; echo $item['logo']; ?>" alt="ads">
			</div>
			<div class="col">
				<h3><?php echo $item['name']; ?></h3>
				<p><?php echo $item['short_des']; ?></p>
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
  <a class="navbar-brand text-dark" href="item?id=<?php echo $item_id;?>">Overview</a>
  &nbsp;
  &nbsp;
  &nbsp;
  <a class="navbar-brand text-dark" href="review?id=<?php echo $item_id;?>"><b>Reviews</b></a>
</nav>
</div>
</div>
<div style="background:#efefef;" class="container-fluid">
		<div class="container">
		<br>
			<div class="row">
				<div class="col">
					<div class="card" style="width:700px">
					  <img style="height:350px;" class="card-img-top" src="projects/<?php echo $item_id; echo '/'; echo $item['cover']; ?>" alt="Card image">
					  <div class="card-body">
						<center>
						<form action="preview" method="get">
						<input type="hidden" name="id" value="<?php echo $item_id;?>">
						<input type="submit" class="btn btn-primary" value="LIVE PREVIEW">
						<a href="#" class="btn btn-info">VIDEO PREVIEW</a>
						</form>
						</center>
					  </div>
					</div>
					<br>
					<div class="card" style="width:700px">
					 <div class="card-header bg-white"><b>Screenshorts</b></div>
					  <div class="card-body">
						<center>
						<?php
						$directory = "projects/".$item_id."/screenshots";
						$images = glob($directory . "/*.*");
						foreach($images as $image)
						{
						 // echo $image;
						  echo '<img style="cursor:pointer;height:100px;width:110px;margin-right:10px;" data-toggle="modal" data-target="#ss" class="card-img-top" src="'.$image.'" alt="Card image">';
						  //echo '<br>';
						}
						?>
						</center>
					  </div>
					</div>
					<br>
					<div class="card" style="width:700px">
					 <div class="card-header bg-white"><b>Overview/Interoduction</b></div>
					  <div class="card-body">
							<p>
								<?php echo nl2br($item['des']); ?>
							</p>
					  </div>
					</div>
					<br>
					<div class="card" style="width:700px">
					 <div class="card-header bg-white"><b>Features</b></div>
					  <div class="card-body">
						<!--<ul style="list-style-type:none;">
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-square-o"></i>&nbsp;&nbsp;Free support</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-square-o"></i>&nbsp;&nbsp;Free Future product updates</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-square-o"></i>&nbsp;&nbsp;Quality checked by Our Team</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-square-o"></i>&nbsp;&nbsp;No transaction fees</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-check-square-o"></i>&nbsp;&nbsp;Lowest price guarantee</li>
						</u>-->
						<?php echo nl2br($item['feature']); ?>
					  </div>
					</div>
					<br>
					<div class="card" style="width:700px">
					 <div class="card-header bg-white"><b>Requirement</b></div>
					  <div class="card-body">
						<!--<ul style="list-style-type:none;">
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;Free support</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;Free Future product updates</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;Quality checked by Our Team</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;No transaction fees</li>
							<li><i style="color:#3ad130;font-size:18px;" class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;Lowest price guarantee</li>
						</u>-->
						<?php echo nl2br($item['req']); ?>
					  </div>
					</div>
				</div>
				
				<div class="col">
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
						</ul>
						<br>
						<button data-toggle="modal" data-target="#payment" style="width:100%;" class="btn btn-success"><b>BUY NOW</b></button>
					  </div>
						<div class="card-footer"><center><img style="width:200px;"src="assets/img/payment.png"></center></div>
					</div>
					<br>
					
				<div class="card">
					 <div class="card-header bg-white"><b>Published by</b></div>
					  <div class="card-body">
					  <div class="row">
						<div class="col-4">
						<a href="author?id=<?php echo $users['user_id'];?>"><img style="height:100px;width:100px;" class="rounded-circle" src="users/profile_img/<?php echo $users['pic'];?>" alt="<?php echo $users['name'];?>"></a>
						</div>
						<div class="col">
							<h5><?php echo $users['name'];?></h5>
							<p>@<?php echo $users['username'];?></p>
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
				
			  <form action="" method="post">
				<div class="input-group mb-4">
					  <div class="input-group-prepend">
						<input type="radio" value="wallet" onclick="wlt()" name="method" checked>
						&nbsp;
						&nbsp;
						&nbsp;
					  </div>
				 <img style="height:80px;" src="assets/img/wallet.png">
				 <h4>('.$currency.''.$logged_users['wallet'].' Left)</h4>
					</div>
					'.$sts.'
					<hr>
					<br>
				<div class="input-group mb-4">
					  <div class="input-group-prepend">
						<input type="radio" onclick="pp()" value="paypal" name="method">
						&nbsp;
						&nbsp;
						&nbsp;
					  </div>
					 <img style="height:25px;" src="assets/img/paypal.png">
					</div>
					
					 <div id="ppdiv" class="p-1">
					<button class="btn btn-info">Goto PayPal</button>
					<br>
					<br>
					</div>
					<div class="input-group mb-4">
					  <div class="input-group-prepend">
						<input type="radio" onclick="cc()" value="cc" name="method">
						&nbsp;
						&nbsp;
						&nbsp;
					  </div>
					 <img style="height:25px;" src="assets/img/payment.png">
					</div>
					<div id="ccdiv" class="p-2">
				<div style="width:100%;height:160px;" class="card">
											<div class="card-body">
												<div id="ccdiv" class="p-2">
													<div class="row p-1">
														<div class="input-group mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text">
																	<i style="color:#000;" class="fa fa-credit-card"></i>
																</span>
															</div>
															<input type="number" name="cc_number" class="form-control" placeholder="Enter Card Number" maxlength="16">
															</div>
														</div>
														<div style="margin:0px 0px 0px -30px"  class="row p-1">
															<div class="col-4">
																<select name="cc_mm" class="form-control">
																	<option value="01">01</option>
																	<option value="02">02</option>
																	<option value="03">03</option>
																	<option value="04">04</option>
																	<option value="05">05</option>
																	<option value="06">06</option>
																	<option value="07">07</option>
																	<option value="08">08</option>
																	<option value="09">09</option>
																	<option value="10">10</option>
																	<option value="11">11</option>
																	<option value="12">12</option>
																	<option value="13">13</option>
																	<option value="14">14</option>
																	<option value="15">15</option>
																	<option value="16">16</option>
																	<option value="17">17</option>
																	<option value="18">18</option>
																	<option value="19">19</option>
																	<option value="20">20</option>
																	<option value="21">21</option>
																	<option value="22">22</option>
																	<option value="23">23</option>
																	<option value="24">24</option>
																	<option value="25">25</option>
																	<option value="26">26</option>
																	<option value="27">27</option>
																	<option value="28">28</option>
																	<option value="29">29</option>
																	<option value="30">30</option>
																	<option value="31">31</option>
																</select>
															</div>
															<div class="col-4">
																<select name="cc_yy" class="form-control">
																	<option value="18">18</option>
																	<option value="19">19</option>
																	<option value="20">20</option>
																	<option value="21">21</option>
																	<option value="22">22</option>
																	<option value="23">23</option>
																	<option value="24">24</option>
																	<option value="25">25</option>
																	<option value="26">26</option>
																	<option value="27">27</option>
																	<option value="28">28</option>
																	<option value="29">29</option>
																	<option value="30">30</option>
																	<option value="31">31</option>
																	<option value="32">32</option>
																	<option value="33">33</option>
																	<option value="34">34</option>
																	<option value="35">35</option>
																	<option value="36">36</option>
																	<option value="37">37</option>
																	<option value="38">38</option>
																	<option value="39">39</option>
																	<option value="40">40</option>
																</select>
															</div>
															<div class="col-4">
																<div class="input-group mb-4">
																	<div class="input-group-prepend">
																		<span class="input-group-text"><i style="color:#000;" class="fa fa-lock"></i></span>
																	</div>
																	<input style="width:50px;" type="text" name="cc_cvv" class="form-control" placeholder="CVV" maxlength="4">
																	</div>
																</div>
															</div>
														</div>
													</div>
													</div>
					
					</div>
			  </div>

			  <!-- Modal footer -->
			  <div class="modal-footer">
				<input type="submit" name="buy" class="btn btn-success" value="Buy Now">
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
  <!-- Payment Successful -->
  <div class="modal hide fade" id="myPay">
  <br>
  <br>
  <br>
  <br>
  <center>
    <div class="modal-dialog modal-lg">
	
      <div style="width:290px;" class="modal-content">
       <div class="modal-header">
          <button type="button" style="outline:none;" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <img src="assets/checkmark.gif">
		  <br>
		  <br>
		  <h3 style="">Payment Successful</h3>
		  <br>
		  <?php
		  $order_sql=mysqli_query($conn,"SELECT * FROM orders WHERE user_id='".$_SESSION['user_id']."' ORDER BY order_id DESC LIMIT 1");
	$sn=1;
	while($orders=mysqli_fetch_assoc($order_sql))
	{
		echo ' <a class="btn btn-danger" href="invoice?q='.$orders['order_id'].'">VIEW INVOICE</a>
		';
	}
		  ?>
		 
        </div>
        
        <!-- Modal footer -->
   
      </div>
    </div></center>
  </div>
    <!-- Already -->
  <div class="modal hide fade" id="myPur">
  <br>
  <br>
  <br>
  <br>
  <center>
    <div class="modal-dialog">
	
      <div style="width:290px;" class="modal-content">
       <div class="modal-header">
          <button type="button" style="outline:none;" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <img src="assets/warning.gif">
		  <br>
		  <br>
		  <h3 style="">Already Purchased</h3>
        </div>
        
        <!-- Modal footer -->
   
      </div>
    </div></center>
  </div>
  <!--error-->
  <div class="modal hide fade" id="myError">
  <br>
  <br>
  <br>
  <br>
  <center>
    <div class="modal-dialog">
	
      <div style="width:290px;" class="modal-content">
       <div class="modal-header">
          <button type="button" style="outline:none;" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <img style="width:260px;" src="assets/error.png">
		  <br>
		  <br>
		  <h3 style="">Payment Unsuccessful</h3>
        </div>
        
        <!-- Modal footer -->
   
      </div>
    </div></center>
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
			jQuery(document).trigger("enhance");
			
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});
		<?php echo $popup;?>
		</script>
		<script>
		document.getElementById("ccdiv").style.display="none";
		document.getElementById("ppdiv").style.display="none";
		
			function wlt(){
						document.getElementById("ccdiv").style.display="none";
						document.getElementById("ppdiv").style.display="none";
			}
		
			function cc(){
						document.getElementById("ccdiv").style.display="block";
						document.getElementById("ppdiv").style.display="none";
			}
			
			function pp(){
						document.getElementById("ccdiv").style.display="none";
						document.getElementById("ppdiv").style.display="block";
			}
		</script>
</html>