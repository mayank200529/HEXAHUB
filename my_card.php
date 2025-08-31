<?php
	session_start();
	if(!$_SESSION['user_id'])
	{
		header('location:/rohit');
	}
	
	$alert=NULL;
	include 'config.php';
	
	$cc_data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM cc WHERE user_id='".$_SESSION['user_id']."'"));
	
	$cc_num = $cc_data['cc_number'];
	$cc_num = substr_replace($cc_num, str_repeat("X", 8), 4, 8);

?>
<html>
	<head>
		<title>My Cards</title>
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
		<style>
		 #cvv_code{
       background-color:rgba(0,0,0,0) !important;
       border:none !important;
	   margin:170px 0px 0px 150px;
	   font-size:50px;
	   width:350px;
	   height:60px;
	   color:#fff;
	   outline:none;
    }
	
	::placeholder {
    color: white;
    opacity: 1; /* Firefox */
		</style>
	</head>
	<body>
		<?php include 'header.php'; ?>
		<div style="" class="container-fluid bg-light">
		<div class="container">
			<h2>My Virtual Card</h2>
			<br>
			<br>
		</div>
</div>
<div style="background:#efefef;" class="container-fluid">
		<div class="container">
		<br>
		<div style="display:none;" id="alert" class="alert alert-danger"><strong>Wrong Password</strong></div>
		<br>
		
<div class="row">
	<div class="col">
				<div class="card">
				<div style="height:324px;" id="card_click">
				<div class="front"> 
					
  <div style="position:absolute;">
	<h2 style="color:#fff;margin:160px 0px 0px 280px;"><?php echo strtoupper($users['name']);?></h2>
	<h1 id="cc_number" style="color:#fff;margin:0px 0px 0px 50px;font-size:48px;"><?php echo wordwrap($cc_num,4,' ',true);?></h1>
	<h2 style="color:#fff;margin:0px 0px 0px 70px;"><?php echo $cc_data['mm'];?>/<?php echo $cc_data['yy'];?></h2>
	<h2 id="cvv" style="color:#fff;margin:-37px 0px 0px 370px;"><span style="letter-spacing:2px;">CVV</span>: <span id="show_cvv">XXXX</span></h2>
  </div><img src="blank_cc.jpg">
				  </div> 
				  <div class="back">
					
  <div style="position:absolute;">
  	<input type="password" id="cvv_code" placeholder="* * * * * * * *" name="password" maxlength="16"/>
  </div>
    <img src="back_cc.jpg">
				  </div> 
</div>
</div>
	</div>
	<div class="col">
				<div class="card">
  <div class="card-body">
    <h4 class="card-title">Available Amount</h4>
    <p class="card-text text-info" style="font-size:60px;"><?php echo $currency;?><?php if($cc_data['amount']==0){echo '0';}else{echo round($cc_data['amount'],2);}?> /-</p>
  
 <!-- <button onclick="pass()" class="btn btn-danger">SHOW <span style="letter-spacing:2px;">CVV</span> CODE</button>-->
  <button id="flip-btn" class="btn btn-danger">SHOW DETAILS</button>
  <button id="unflip-btn" style="display:none;" class="btn btn-danger">CHECK</button>
  </div>
</div>
	</div>
</div>
<br>
	<div class="card" style="width:100%;">
  <div class="card-header bg-white">
    <b>All Transactions</b>
  </div>
  <div class="card-body p-3">
		<table class="table">
			<th>S.no</th>
			<th>Project Name</th>
			<th>Amount</th>
			<th>Status</th>
			<th>Date on</th>
			<?php
	$vc_sql=mysqli_query($conn,"SELECT * FROM vc_transactions WHERE user_id='".$_SESSION['user_id']."'");
	$sn=1;
	while($vc=mysqli_fetch_assoc($vc_sql))
	{
		
	$my_items=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM items WHERE item_id='".$vc['pro_name']."'"));
	
	if($vc['status']=='purchased')
	{
		$vc_amount='<span class="text-danger"><b>-'.$currency.''.$vc['amount'].'</b></span>';
		$vc_status='<span class="badge badge-success">Purchased</span>';
	} else {
		$vc_amount='<span class="text-success"><b>+'.$currency.''.$vc['amount'].'</b></span>';
		$vc_status='<span class="badge badge-success">Received</span>';
	}
	
		echo '
				<tr>
					<td>'.$sn.'</td>
					<td>'.$my_items['name'].'</td>
					<td>'.$vc_amount.'</td>
					<td>'.$vc_status.'</td>
					<td>'.date('j F Y h:i:s',strtotime($vc['date'])).'</td>
				</tr>
		';
		$sn++;
	}
?>
		</table>

		</div>
		</div>
<br>
		
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
		<script src="assets/js/flip.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<?php include 'footer.php'; ?>
			<script>
$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});
		
$("#card_click").flip({
  trigger: 'manual'
});

$(function(){
	   $("#flip-btn").click(function(){
		   document.getElementById("flip-btn").style.display="none";
		   document.getElementById("unflip-btn").style.display="block";
	$("#card_click").flip(true);
});
});

$(function(){
	   $("#unflip-btn").click(function(){
		   var password=document.getElementById("cvv_code").value;
			var password1="<?php echo $users['password'];?>";
			var cvvcode="<?php echo $cc_data['cvv'];?>";
				
			var xyz = "<?php echo $cc_data['cc_number'];?>".replace(/(\d{4})/g, '$1 ').replace(/(^\s+|\s+$)/,'');	
				if(password==password1)
				{	
							document.getElementById("show_cvv").innerHTML=cvvcode;
							document.getElementById("cc_number").innerHTML=xyz;
							$("#card_click").flip(false);
							 document.getElementById("unflip-btn").style.display="none";
							 document.getElementById("alert").style.display="none";
				} else {
					document.getElementById("alert").style.display="block";
				}
});
});
		
		
		</script>
		<script>
			function pass(){
				var password=prompt("Enter Password");
				var password1="<?php echo $users['password'];?>";
				
				if(password==password1)
				{
						//$(window).on('load',function(){
									$(document).ready(function(){
								  $('#card_click').click();
								});
								
				//	});
				} else {
					alert("Wrong Password");
				}
			}
		</script>
</html>