<?php
	include('lib/twitterLib.php');
	include('lib/Job.php');
	$obj = new twitterLib();
	$jobObj = new Job();
	$expert_view = false;

	if(!isset($_REQUEST['limit']))
		$limit = 8;
	else
		$limit = $_REQUEST['limit'];

	if(!isset($_REQUEST['page']))
		$page = 1;
	else
		$page = $_REQUEST['page'];

	$allJobs = $jobObj->getJobs($limit, $page);
	$links = $jobObj->createLinks( 6, '', $allJobs->page, $allJobs->limit, $allJobs->total);

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

<!-- 		<div class="col-md-12 column">
			<div class="media well">
				<div class="media-body"><?php echo $job['job_title'];?>
				</div>
			</div>
		</div> -->

		<div class="col-md-12 column">
			<div class="media well">
				<div class="media-body">
		<?php
			if(isset($allJobs->data) && !empty($allJobs->data))
			{
				foreach ($allJobs->data as $key => $job) {

				?>
					<div class="col-md-12 column" onclick="window.location='job.php?id=<?php echo $job['id'];?>'" style="cursor:pointer;">
						<div class="media well" style="background-color:#FCFCFC;">
							 <a href="#" class="pull-left"><img src="<?php if(isset($job['expert_user']['pic'])) echo $job['expert_user']['pic']; ?>" class="media-object" alt='' /></a>
							<div class="media-body">
								<h4 class="media-heading">
									<?php if(isset($job['job_title'])) echo $job['job_title']; ?>
								</h4>
								<?php if(isset($job['expert_user']['bio'])) echo $job['expert_user']['bio']; ;?>
							</div>
						</div>
					</div>

				<?php
				}
			}
			else
			{
				?>
				<div class="well">No jobs found!</div>	
				<?php
			}
		?>



				</div>

			</div>
					<?php echo $links;?>
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
