<?php
	include('lib/twitterLib.php');
	include('lib/Job.php');
	$obj = new twitterLib();
	$jobObj = new Job();
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
	<div class="row clearfix">
		<div class="col-md-12 column" style="margin-top:40px;">

			<div class="modal fade" id="modal-container-171994" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">
								Modal title
							</h4>
						</div>
						<div class="modal-body">
							...
						</div>
						<div class="modal-footer">
							 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
					
				</div>
				
			</div>
			
			<div class="jumbotron">
<div role="alert" class="alert alert-info">
      <strong>Heads up!</strong> This <a class="alert-link" href="#">alert needs your attention</a>, but it's not super important.
    </div>

<div role="alert" class="alert alert-info">
      <strong>Heads up!</strong> This <a class="alert-link" href="#">alert needs your attention</a>, but it's not super important.
    </div> 
       
<div role="alert" class="alert alert-info">
      <strong>Heads up!</strong> This <a class="alert-link" href="#">alert needs your attention</a>, but it's not super important.
    </div>
<!-- 				<h1>
					Hello, world!
				</h1>
				<p>
					This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Learn more</a>
				</p> -->
			</div>

			<?php
				include('inc/featured_jobs.php');
			?>
		</div>
	</div>
</div>
</body>
</html>
