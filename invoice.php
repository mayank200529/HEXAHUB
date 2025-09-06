<?php
	include 'config.php';
	
	$id_order=$_GET['q'];
	
	$invoice=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders WHERE order_id='".$id_order."'"));
	
	$item=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM items WHERE item_id='".$invoice['item_id']."'"));
	
	$buyer=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$invoice['user_id']."'"));
	
	$seller=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$item['user_id']."'"));
	
	function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}

?>
<html>
	<head>
		<title>Invoice </title>
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
		<div class="container">
		<br>
		<center><h5>Invoice</h5></center>
		<br>
		<div class="card p-3">
			<div class="row">
				<div class="col">
					<small>Order ID</small>
					<h3># <?php echo $invoice['order_id'];?></h3>
				</div>
				<div class="col"><div style="float:right;" ><h3><img style="height:80px;" src="logo_1.png"/></h3></div></div>
			</div>
			<hr>
			<div class="row">
				<div class="col">
					<h6><b>Item:</b> <?php echo $item['name'];?></h6>
					<h6><b>Category:</b> <?php echo $item['cat'];?></h6>
					<h6><b>Purchased On:</b> <?php echo $invoice['date'];?></h6>
					
					<h6><b>Seller:</b> <?php echo $seller['name'];?></h5>
					<h6><b>Seller Email:</b> <?php echo $seller['email'];?></h6>
				</div>
				<div class="col">
				<div style="float:right;" >
						<h6><b>Payment by:</b> <span class="badge badge-dark"><?php echo strtoupper($invoice['method']);?></span></h5>
						<h6><b>Payment Charge: </b><?php echo $currency;?><?php echo round($invoice['amount'],2);?></h5>
						<h6><b>Price in Word: </b><?php echo strtoupper(convertNumberToWord($invoice['amount'])) ?> RUPEES </h5>
						<h6><b>Purchased by:</b> <?php echo $buyer['name'];?></h5>
						<h6><b>User Id:</b> <?php echo round($invoice['user_id'],2);?></h5>
						<h6><b>Email:</b> <?php echo $buyer['email'];?></h5>
				</div></div>
			</div>
			<br>
			<div class="row">
				<table class="table">
				<th>Item ID</th>
				<th>Item Name</th>
				<th>Price</th>
				<th>Commision</th>
				<th>Grand Total</th>
				<tr>
					<td>#<?php echo $invoice['item_id'];?></td>
					<td><?php echo $item['name'];?></td>
					<td><?php echo $currency;?><?php echo round($invoice['amount'],2);?></td>
					<td>Free</td>
					<td><?php echo $currency;?><?php echo round($invoice['amount'],2);?></td>
				</tr>
				</table>
			</div>
			<br>
			<div class="row p-3">
				<small><u>Privacy and Policy: </u>No refundable money, codemall can't refund money after purchasing any item or project.</small>
			</div>
		</div>
		</div>
	</body>
	<!-- javascript and jqurey -->
	<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
			<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});
		</script>
</html>