<?php
	include('lib/twitterLib.php');
	include('lib/Job.php');

	$q = $_GET['q'];
	$obj = new twitterLib();
	$jobObj = new Job();
	$jobData = $jobObj->jobExists($q);

	if(!empty($jobData))
	{
	 	header("location:job.php?id=".$jobData['id']);
		die();
	}
	
	if(!isset($_SESSION['current_job']))
		$_SESSION['current_job'] = array();

	if(isset($_POST['expert_id']))
	{
		$_SESSION['expert_id'] = $_POST['expert_id'];
	 	$getAuthUrl = $obj->getAuthUrl($_SESSION['expert_id']);
	 	header('location:'. $getAuthUrl);
	 	die();		
	}

	

	$_SESSION['current_job_title'] = $q;

	$users = $obj->search($q);
//	$users = $_SESSION['users'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dream Job</title>
  <?php 
  	require('inc/js.php');
  ?>
  	<style>
	.user_div
	{
		background-color: #eee;
		border-radius: 14px;
		margin-bottom: 10px;
		padding: 10px;
		cursor: pointer;
		width: 30%;
		margin-right: .5%;
	}  	
  	</style>  
</head>

<body>
<div class="container">
	<div class="row clearfix" style="margin-top:20px;">



		<div class="col-md-11 column">
			<div class="media well">
				<div class="media-body"><?php echo $q;?>
				</div>
			</div>
		</div>

		<div class="col-md-12 column" id="userlisting">
			<div class="row">

	<?php
		foreach($users as $key => $user)
		{
			// if($key > 6)
			// 	continue;
	?>

				<div class="col-md-3 column user_div" onclick="selectExpert('<?php echo $user['twitter_id'];?>', this);">
				<div class="media">
					 <a href="javascript:void(0);" class="pull-left"><img src="<?php echo $user['profile_image_url'];?>" class="media-object" alt='' /></a>
					<div class="media-body">
						<?php
							$left = '';
							if($user['verified']) {
								$left = 'margin-left:6%;';
							}
						?>
						<h4 class="media-heading" style="<?php echo $left;?>">
						<?php if($user['verified']) { ?>
						<span class="glyphicon glyphicon-ok-circle verified" aria-hidden="true"></span>
						<?php
					}
					?>
							<?php echo $user['name'];?>
						</h4>
						 <h6><?php echo substr($user['description'], 0, 30).' ...';?></h6>
					</div>
				</div>

				</div>



<!--
 		<div class="row clearfix user_div" style="width:26%;">
			<div class="col-md-12 column">
				<div class="media">
					 <a href="newjob.php?id=<?php echo $user['twitter_id'];?>" class="pull-left"><img src="<?php echo $user['profile_image_url'];?>" class="media-object" alt='' /></a>
					<div class="media-body">
						<h4 class="media-heading">
							<?php echo $user['name'];?>
						</h4>
						 <?php // echo $user['description'];?>
					</div>
				</div>
			</div>
		</div> -->
	<?php			
		}
	?>			
		</div>
	</div>



	<form action="" method="post" onsubmit="return checkJob();">
	<input type="hidden" id="expert_id" name="expert_id" value="">
		<div class="col-md-12 column" style="margin-bottom:25px;">
				<div style="width:500px;padding:5px; float:right; margin-right:25%; display:none;" id="error_msg" class="alert alert-danger" role="alert">
				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				  <span class="sr-only">Error:</span>
				  	Please select a job expert to continue.
				</div>
				<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Login With Twitter</button>
		</div>
    </form>


			<?php
				include('inc/featured_jobs.php');
			?>
		</div>
	</div>
</div>

</body>
</html>
