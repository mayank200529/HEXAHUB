<?php
	session_start();
	if(!$_SESSION['user_id'])
	{
		header('location:/rohit');
	}
	
	include 'config.php';
	if(isset($_POST['upload']))
	{
		$shortdes=mysqli_real_escape_string($conn,$_POST['shortdes']);
		$des=mysqli_real_escape_string($conn,$_POST['des']);
		$site=mysqli_real_escape_string($conn,$_POST['site']);
		$feature=mysqli_real_escape_string($conn,$_POST['feature']);
		$req=mysqli_real_escape_string($conn,$_POST['req']);
		
		$soft=''.implode(', ', $_POST['soft']).'';
		$file_inc=''.implode(', ', $_POST['file_inc']).'';
		$frame_inc=''.implode(', ', $_POST['frame_work']).'';
		
		mysqli_query($conn,"INSERT INTO items (`name`, `user_id`, `logo`, `cover`, `main`, `site`, `short_des`, `des`, `feature`, `req`, `cat`, `price`, `stime`, `date`, `up_date`, `soft`, `file_inc`, `frameworks`, `db`,`status`) VALUES ('".$_POST['name']."','".$_SESSION['user_id']."','".$_FILES['logo']['name']."','".$_FILES['cover']['name']."','".$_FILES['main']['name']."','".$site."','".$shortdes."','".$des."','".$feature."','".$req."','".$_POST['cat']."','".$_POST['price']."','".$_POST['stime']."','".date("Y-m-d")."','".date("Y-m-d")."','".$soft."','".$file_inc."','".$frame_inc."','".$_POST['db']."','pending')");
		$last_id = mysqli_insert_id($conn);
		
		mkdir("projects/$last_id");
		mkdir("projects/$last_id/screenshots");
		
		$main=$_FILES['main']['name'];
		$main='main.zip';
		
		$ss=$_FILES['ss']['name'];
		$ss='ss.zip';
		
		move_uploaded_file($_FILES['logo']['tmp_name'],"projects/".$last_id."/".$_FILES['logo']['name']);
		move_uploaded_file($_FILES['cover']['tmp_name'],"projects/".$last_id."/".$_FILES['cover']['name']);
		move_uploaded_file($_FILES['main']['tmp_name'],"projects/".$last_id."/".$main);
		move_uploaded_file($_FILES['ss']['tmp_name'],"projects/".$last_id."/".$ss);
		
		$zip = new ZipArchive;
		$res = $zip->open("projects/".$last_id."/ss.zip");
		if ($res === TRUE) {
		$zip->extractTo("projects/".$last_id."/screenshots");
		$zip->close();
		}
		
		header('location:my_items');
	}
?>
<html>
	<head>
		<title>Upload Script</title>
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
			<h2>Upload Your Script</h2>
			<br>
			<br>
		</div>
</div>
<div style="background:#efefef;" class="container-fluid">
		<div class="container">
		<br>
<form action="" method="post" enctype="multipart/form-data">		
		<div class="card" style="width:100%;">
  <div class="card-header">
    Project Details
  </div>
  <div class="card-body p-3">
 <div class="row">
				<div class="col-2">
					<h6>Project Name</h6>
				</div>
				<div class="col"><input type="text" class="form-control" name="name" placeholder="Enter Your Project Name"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Category</h6>
				</div>
				<div class="col">
					<select class="form-control" name="cat">
						<?php
							$result=mysqli_query($conn,"SELECT * FROM cat");
							while($rows=mysqli_fetch_assoc($result))
							{
								echo '<option value="'.$rows['cat'].'">'.strtoupper($rows['cat']).'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Short Description</h6>
				</div>
				<div class="col"><input type="text" class="form-control" name="shortdes" placeholder="Short Description"></div>
			</div>
		</div>
		</div>
			<hr>
<div class="card" style="width:100%;">
  <div class="card-header">
    Project Files
  </div>
  <div class="card-body p-3">
<div class="row">
				<div class="col-2">
					<h6>Project Logo</h6>
				</div>
				<div class="col">
				<p class="text-danger"><b>*</b>(Size must be Square, jpg/png)</p>
				<input type="file" class="form-control" name="logo"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Project Cover</h6>
				</div>
				<div class="col">
				<p class="text-danger"><b>*</b>(Size must be 1600x800, jpg/png)</p>
				<input type="file" class="form-control" name="cover"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Project Main ZIP</h6>
				</div>
				<div class="col">
				<p class="text-danger"><b>*</b>(include all project files with documantation in zip file)</p>
				<input type="file" class="form-control" name="main"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Screenshot ZIP</h6>
				</div>
				<div class="col">
				<p class="text-danger"><b>*</b>(include all screenshots images in zip file)</p><input type="file" class="form-control" name="ss"></div>
			</div>
		</div>
		</div>
			<hr>
			<div class="card" style="width:100%;">
  <div class="card-header">
    Details
  </div>
  <div class="card-body p-3">
			<div class="row">
				<div class="col-2">
					<h6>Overview</h6>
				</div>
				<div class="col">
					<textarea style="height:150px;" name="des" class="form-control"></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Features</h6>
				</div>
				<div class="col">
					<textarea style="height:150px;" name="feature" class="form-control"></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Requirement</h6>
				</div>
				<div class="col">
					<textarea style="height:150px;" name="req" class="form-control"></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Software Versions</h6>
				</div>
				<div class="col">
					<?php
							$soft_sql=mysqli_query($conn,"SELECT * FROM soft");
							$sn=1;
							while($softs=mysqli_fetch_assoc($soft_sql))
						{
							echo '<div class="form-check-inline">
							  <label class="form-check-label">
								<input type="checkbox" name="soft[]" class="form-check-input" value="'.$softs['soft_name'].'">'.$softs['soft_name'].'
								</label>
							</div>
							&nbsp;
							&nbsp;
							';
						}
					?>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>File Included</h6>
				</div>
				<div class="col">
					<?php
							$files_sql=mysqli_query($conn,"SELECT * FROM lang");
							$sn=1;
							while($lang=mysqli_fetch_assoc($files_sql))
						{
							echo '<div class="form-check-inline">
							  <label class="form-check-label">
								<input type="checkbox" name="file_inc[]" class="form-check-input" value="'.$lang['lang_name'].'">'.$lang['lang_name'].'
								</label>
							</div>
							&nbsp;
							&nbsp;
							';
						}
					?>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Framework</h6>
				</div>
				<div class="col">
					<?php
							$frame_sql=mysqli_query($conn,"SELECT * FROM framework");
							$sn=1;
							while($frame=mysqli_fetch_assoc($frame_sql))
						{
							echo '<div class="form-check-inline">
							  <label class="form-check-label">
								<input type="checkbox" name="frame_work[]" class="form-check-input" value="'.$frame['frame_name'].'">'.$frame['frame_name'].'
								</label>
							</div>
							&nbsp;
							&nbsp;
							';
						}
					?>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Database (yes/no)</h6>
				</div>
				<div class="col">
					<div class="form-check-inline">
					  <label class="form-check-label">
						<input type="radio" class="form-check-input" name="db" value="yes">YES
					  </label>
					</div>
					<div class="form-check-inline">
					  <label class="form-check-label">
						<input type="radio" class="form-check-input" name="db" value="no">NO
					  </label>
					</div>
				</div>
			</div>
		</div>
		</div>
		<hr>
			<div class="card" style="width:100%;">
  <div class="card-header">
   Preview
  </div>
  <div class="card-body p-3">
 <div class="row">
				<div class="col-2">
					<h6>Preview Link</h6>
				</div>
				<div class="col"><input type="text" class="form-control" name="site" placeholder="http://example.com/"></div>
			</div>
			<br>
		</div>
		</div>
		<hr>
			<div class="card" style="width:100%;">
  <div class="card-header">
    Final Step
  </div>
  <div class="card-body p-3">
 <div class="row">
				<div class="col-2">
					<h6>Spend Time (Hour)</h6>
				</div>
				<div class="col"><input type="text" class="form-control" name="stime" placeholder="How many time you spended in this project"></div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<h6>Price ( <?php echo $currency;?> )</h6>
				</div>
				<div class="col"><input type="text" class="form-control" name="price" placeholder="Your Price"></div>
			</div>
		</div>
		</div>
		<br>
		<div class="card" style="width:100%;">
  <div class="card-body p-3">
	<input type="submit" name="upload" class="btn btn-success" value="UPLOAD"/>
		</div>
		</div>
		</div><br>
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