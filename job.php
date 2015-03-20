<?php
	include('lib/twitterLib.php');
	include('lib/Job.php');
	$obj = new twitterLib();
	$jobObj = new Job();
	$expert_view = false;

	if(isset($_REQUEST['login']))
	{
		$id = $_REQUEST['id'];
		$url = $obj->getAuthUrl($id, 'job.php');
		header("location:".$url);
		die();
	}

	if(isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];
		$job = $jobObj->getJob($id);
		if($job['status'] == 'expired')
		{
			header('location: index.php');
			die();
		}

		if(isset($_REQUEST['oauth_verifier']))
		{
		 	$access_token = $obj->authorize();
		 	if($access_token['user_id'] == $job['expert_id'])
		 	{
		 		$expert_view = 'job_approve';
		 	}
		}

		if(isset($_REQUEST['expert_view']) && $_REQUEST['expert_view'] == 'yes')
			$expert_view = true;

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

  <script type="text/javascript">
	$( document ).ready(function() {

    $(".grid").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'span2 well placeholder tile',
        forceHelperSize: true,
        stop: function( event, ui ) { reOrder(); }
    });
    <?php
    	if($job['status'] == 'pending' )
    	{
    	?>
		  var newYear = new Date("<?php echo $job['expired_time'];?>");
	   	  $('#defaultCountdown').countdown({until:newYear}); 
    	<?php
    	}
    ?>

	});
  </script>
</head>

<body>
<div class="container">
	<div class="row clearfix" style="margin-top:1%;">
     <form role="form" method="post" action="?id=<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id'];?>">

		<div class="col-md-12 column">
			<div class="media well">
				<div class="media-body"><?php echo $job['job_title'];?>
				</div>
			</div>
		</div>

		<div class="col-md-12 column">
			<div class="media well">
				<div class="media-body">
				<?php

				if($expert_view === 'job_approve' && $job['status'] == 'pending')
				{
					?>
					<div class="row grid span8" id="steps_div">
					    <div class="well span2 tile"> <span class="badge badge-info" style="margin-left:1.6%;">1</span> <input style="width:95%; float:right; margin-top:-5px;" type="text" class="form-control" name="steps[]" id="steps[]"></div>
					</div>
					<?php
				}
				else if($job['status'] == 'approved')
				{
					if(!empty($job['steps']))
					{
						foreach ($job['steps'] as $key => $step) {
						?>
							<div class="well"><span class="badge badge-info" style="margin-left:1.6%; margin-right:10px;"><?php echo ++$key;?></span> <?php echo $step;?></div>
						<?php
						}
					}
					?>
					<?php
				}
				else if($expert_view && $job['status'] == 'pending')
				{
					?>
						User defined message
					<?php
				}				
				else
				{
					?>
					<div id="defaultCountdown" style="width:35%; height:60px; margin-left:30%;"></div>
					<p style="margin-top:2%;">
					This job is pending by expert. This job is pending by expert. This job is pending by expert. This job is pending by expert. 
					</p>
					<?php
				}

				?>

				</div>
			</div>
		</div>

	      </form>

		<div class="col-md-12 column" style="margin-bottom:25px;">
		<?php
			if($expert_view === 'job_approve' && $job['status'] == 'pending')
			{
			?>
				<div style="clear:both;">
					<button type="button" style="width:45%; float:left; margin-right:9%;" class="btn btn-info  btn-lg btn-block" onclick="addMoreSteps();"> Add more steps </button>

					<button  style="width:45%; margin-top:0px;" name="submit" type="button" onclick="submitJob(<?php echo $id;?>);" class="btn btn-success btn-lg btn-block"> <span style="display:none;" id="submit_spinner" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> </span>Submit</button>
				</div>
			<?php
			}
			else if($expert_view && $job['status'] == 'pending')
			{
				?>
					<button onclick="window.location='job.php?id=<?php echo $id;?>&login=yes'" class="btn btn-primary btn-lg btn-block"> <span style="display:none;" id="spinner" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Login With Twitter</button>
				<?php
			}
			else if($job['status'] == 'approved')
			{

			}
			else
			{
				?>

					<button name="submit" type="button" onclick="watch(<?php echo $id;?>);" class="btn btn-success btn-lg btn-block"> <span style="display:none;" id="spinner" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> <span class="glyphicon glyphicon-eye-open" style="margin-right:1%;" aria-hidden="true"></span>Watch</button>

				<?php
			}
		?>


		</div>



			<?php
				include('inc/featured_jobs.php');
			?>
		</div>
	</div>
</div>
</body>
</html>
