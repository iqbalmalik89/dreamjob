<?php
	include('lib/twitterLib.php');
	include('lib/Job.php');

	$obj = new twitterLib();
	$jobObj = new Job();

	if(!isset($_SESSION['current_job']))
		$_SESSION['current_job'] = array('id' => '', 'job_title' => '', 'message' => '');

	if(isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];

		if(isset($_POST['submit']))
		{

			if(isset($_REQUEST['id']))
				$_SESSION['current_job']['id'] = $_REQUEST['id'];

			if(isset($_SESSION['current_job_title']))
				$_SESSION['current_job']['job_title'] = $_SESSION['current_job_title'];

			if(isset($_REQUEST['message']))
				$_SESSION['current_job']['message'] = $_REQUEST['message'];

		 	//$getAuthUrl = $obj->getAuthUrl($id);

		 	$jobId = $jobObj->addDreamJob($_SESSION['current_job']['job_title'], $_SESSION['access_token']['user_id'], $id, $_SESSION['current_job']['message']);

		 	header("location:job.php?id=".$jobId);
		  	die();
		}

		if(isset($_REQUEST['oauth_verifier']))
		{
		 	$access_token = $obj->authorize();
			// $_SESSION['current_job'] = array();
		}

		$userData = $_SESSION['users'][$id];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dream Job</title>
  <?php 
  	require('inc/js.php');
  ?>
</head>

<body>
<div class="container">
	<div class="row clearfix" style="margin-top:1%;">
     <form role="form" method="post" onsubmit="return validateJobSubmission();" action="?id=<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id'];?>">

        <div class="input-group" style="margin-bottom:20px; width:100%;">
			<div class="media well">
				<div class="media-body"><?php echo $_SESSION['current_job_title'];?>
				</div>
			</div>
            </div><!-- /input-group -->


		<div class="col-md-12 column">
			<div class="media well">
				 <a href="#" class="pull-left"><img src="<?php if(isset($userData['profile_image_url'])) echo $userData['profile_image_url']; ?>" class="media-object" alt='' /></a>
				<div class="media-body">
					<h4 class="media-heading">
						<?php if(isset($userData['name'])) echo $userData['name']; ?>
					</h4>
					<?php if(isset($userData['description'])) echo $userData['description']; ;?>					
				</div>
			</div>
		</div>


		<div class="col-md-12 column" style="margin-bottom:25px;">
	        <div class="input-group" style="margin-bottom:20px;">
	        <textarea id="message" name="message" class="form-control" placeholder="Enter Personal message to job expert" style="width:1140px;height:103px;"><?php if(isset($_SESSION['current_job']['message'])) echo $_SESSION['current_job']['message'] ;?></textarea>
	            </div><!-- /input-group -->


				<div class="checkbox">
					 <label><input type="checkbox" value="yes" id="terms" /> Are you agree with the term and conditions?</label>
<div style="width:500px;padding:5px; float:right; margin-right:25%; display:none;" id="error_msg" class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
You must have to select one expert to proceed.
</div>
				</div>
				<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit Dream Job</button>


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
