<?php
session_start();
	include 'config.php';
?>
<html>
	<head>
		<title>HEXAHUB - Hub of Codes</title>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
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
		<div style="margin-top:-64px; height: 800px;background:url('assets/img/bg/<?php echo rand(1,4);?>.png') fixed;background-size:cover;" class="jumbotron  jumbotron-fluid">
		  
		<?php include 'menu.php';?>
		  <div style="margin-top:-180px;height:515px;background:rgba(1,1,1,0.2);">
		  <div style="margin-top:4cm;" class="container text-center">
		  <br>
		  <br>
		  <div class="box" style="background-color:rgba(0, 0, 0, 0.1);">
		  <p class="display-1 text-white"><img class="" style="height:140px; padding-bottom:0px;" src="logo.png" alt="LOGO"></p>
			<p class="lead text-white fw-bolder" style="font-size:24px;">Digital Marketing provide service to Buy and Sell your project free online with good quality and price.</p>
			<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm" action="search" method="get">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input name="q" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search Projects and Templates">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                       &nbsp; &nbsp; <button class="btn btn-lg btn-success" type="submit">Search</button>
									
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
			 <br>
			 <p class="lead p-2">
				<a class="btn btn-warning btn-lg " href="v_signup" role="button">SIGNUP AND GET <?php echo $currency;?>100 IN VIRTUAL CARD</a> 
				<!--<a class="btn btn-warning btn-lg" href="signup" role="button">BUY NOW</a>-->
			  </p>
		  </div>
		</div>
		</div>
	</div>
		<div style="margin-top:-100px;" class="container">
		<div class="row">
			<div class="col text-center">
				<img style="height:130px;" src="assets/img/upload.png" alt="uplaod">
				<h2>UPLOAD</h2>
				<p>Upload your script in just one click</p>
			</div>
			<div class="col text-center">
				<img style="height:130px;" src="assets/img/sell.png" alt="uplaod">
				<h2>SELL</h2>
				<p>Sell your script</p>
			</div>
			<div class="col text-center">
				<img style="height:130px;" src="assets/img/earn.png" alt="uplaod">
				<h2>EARN</h2>
				<p>Earn from your own projects</p>
			</div>
		</div>
		<br>
		<br>
		<div class="row">
				<div class="col text-left">
					<h1 class="fw-bold" style="color:rgba(1, 19, 47, 1); font-weight:700;">What is HEXAHUB?</h1>
					<p style="letter-spacing:1px;"><b style="color:rgba(1, 19, 47, 1);">HEXAHUB</b> , It is a Freelancing Website or Digital Marketing Web Application it allow to User can earn money from Upload and Selling their own Project Like C/C++ Programs, JAVA Programs, Database Software, Websites, Mobile Application Projects, Excel Projects, Photoshop Designs, PHP Scripts, HTML Templates, PPT and more. their user can buy project with its own <b style="color:rgba(1, 19, 47, 1);">HEXAHUB</b> Wallet, Credit Card and Also PayPal and Paytm. and also when someone buy their project so money will be <b style="color:rgba(1, 19, 47, 1);">Automatically Credit</b> to developer's wallet. and developer can withdraw money to his <b style="color:rgba(1, 19, 47, 1);">PayPal</b> or <b style="color:rgba(1, 19, 47, 1);">Paytm</b> Account any time. </p>
				</div>
				<div class="col">
					<div class="card">
						<video width="100%" height="300px" poster="assets/poster.png" controls >
							<source src="assets/hexahubvideo.mp4" type="video/mp4">
						</video>
					</div>
				</div>
		</div>
		<br>
		<br>
		<!--<center><h2><span class="badge badge-success">OUR FEATURES</span></h2></center>
		<hr>
		<div class="row">
			<div class="col-6">
						
						<ul style="list-style-type:none;">
							<li style="font-size:22px;"><i style="color:#3ad130;font-size:25px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Earn 80% Commission</li>
							<li style="font-size:22px;"><i style="color:#3ad130;font-size:25px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;No minimum number of sales required</li>
							<li style="font-size:22px;"><i style="color:#3ad130;font-size:25px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Free 24x7 support</li>
							</ul>                     
		</div>
			<div class="col-6">
				<ul style="list-style-type:none;">
					<li style="font-size:22px;">
						<i style="color:#3ad130;font-size:25px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Free Future Product Updates</li>
							<li style="font-size:22px;"><i style="color:#3ad130;font-size:25px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Quality checked by Our Team</li>
							<li style="font-size:22px;"><i style="color:#3ad130;font-size:25px;" class="fa fa-check-circle"></i>&nbsp;&nbsp;Lowest price guarantee</li>
						</ul>
			</div>
		</div>-->
			</div>
		<div class="container-fluid" style="background-color:rgba(1, 19, 47, 1);">
		<br>
		<center><h2><span class="badge badge-light">TOP POPULAR ITEMS <i class="fa fa-line-chart" aria-hidden="true"></i></span></h2></center>
		<br>
	<div class="container">
		<div class="row">
		<?php
		$pro_query=mysqli_query($conn,"select item_id, count(item_id) c from orders group by item_id order by c desc LIMIT 9");
						$sn=0;
						while($list=mysqli_fetch_assoc($pro_query))
						{
							$items=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM items WHERE item_id='".$list['item_id']."'"));
						
							$title = implode(" ", array_splice($items['name'], 0, 10));
							
							$sn++;
						echo '<a style="text-decoration:none;color:#000;" href="item?id='.$items['item_id'].'"><div class="p-1">
						<div style="margin-left:30px;width:330px;" class="card">
						<div class="row">
							<div class="col-4">
								<img style="width:105px;" src="projects/'.$items['item_id'].'/'.$items['logo'].'">
							</div>
							<div class="col p-2">
								<h5 style="margin-left:0px;">'.$items['name'].'</h5>
								<div style="float:left;">
								<span style="height:33px;" class="badge badge-success"><h5>'.$currency.''.$items['price'].'</h5></span>
								</div>
							</div>
						</div>
						</div>
					 </div></a>';
					}?>
				 </div>
				 <br>
				 <hr>
				 </div></div>
		<br>
		<div class="container-fluid">
		<div class="container">
		<div class="row">
		<?php
		$result=mysqli_query($conn,"SELECT * FROM items ORDER BY item_id DESC");
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
			<script>
		$(document).ready(function(){
				$("#logo").fadeIn();
		});
		</script>
		<?php include 'footer.php'; ?>
	</body>
</html>