<?php
include('twitterLib.php');
include('Job.php');
include('GateKeeper.php');
$twitterObj = new twitterLib();
$jobObj = new Job();
$getekeeper = new GateKeeper();
if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	    case 'watch':
	    	
	    	if(!isset($_SESSION['access_token']))
	    	{
				$url = $twitterObj->getAuthUrl($_REQUEST['job_id'], 'job.php');
				echo json_encode(array('status' => 'invalid_access_token', 'url' => $url));
				return false;
	    	}

	    	$resp = $jobObj->watch($_REQUEST['job_id'], $_SESSION['access_token']['user_id']);
	    	echo json_encode($resp);
	        break;
	    case 'submit':
	    	if(isset($_REQUEST['steps']))
	    		$steps = $_REQUEST['steps'];
	    	else
	    		$steps = array();

	    	$resp = $jobObj->submitJob($_REQUEST['job_id'], $_SESSION['access_token']['user_id'], $steps);
	    	echo json_encode($resp);
	        break;

	    case 'delete':
	    	if(isset($_REQUEST['job_id']))
	    		$id = $_REQUEST['job_id'];
	    	if(!empty($id))
	    	$resp = $jobObj->deleteJob($id);
	    	echo json_encode($resp);
	        break;
	    case 'login':
	    	if(isset($_REQUEST['email']) && isset($_REQUEST['password']))
	    	{
		    	$resp = $getekeeper->loginAdmin($_REQUEST['email'], $_REQUEST['password']);
	    	}
	    	echo json_encode($resp);
	        break;	        
	    case 'logout':
	    	$resp = $getekeeper->logoutAdmin();
	    	echo json_encode(array('status' => 'success'));
	        break;
	    case 'get_all_jobs':
	    	$request = array();
	    	$request['page'] = $_REQUEST['page'];
	    	$request['status'] = $_REQUEST['status'];	    	
	    	$resp = $jobObj->getPendingJobs($request);
	    	echo json_encode($resp);
	        break;
	    case 'job_status':
	    	$request = array();
	    	$job_id = $_REQUEST['job_id'];
	    	$status = $_REQUEST['status'];
	    	$resp = $jobObj->changeJobStatus($job_id, $status);
	    	echo json_encode($resp);
	        break;
	    default:

	}	
}


?>