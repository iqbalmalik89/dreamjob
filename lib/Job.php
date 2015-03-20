<?php 
class Job
{
	public $con;
	public $minutes;
    function __construct() {

    	if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1')
    	{
	    	$username = 'root';
	    	$password = '';
	    	$database = 'dreamjob';    		
    	}
    	else
    	{
	    	$database = 'thinkclo_dreamjob';    		    		
	    	$username = 'thinkclo_dreamjo';
	    	$password = 'vw8BJBPz0@0I';
    	}

    	$this->minutes = 10080;

		$pdo = new PDO("mysql:dbname=".$database, $username, $password);
		$this->con = new FluentPDO($pdo);
		//$this->con->debug = true;
    }

    public function getShortUrl($longUrl)
    {
    	if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1')
    	{
    		return $longUrl;	
    	}

		$data = array("longUrl" => $longUrl);
		$data_string = json_encode($data);                                                                                   
		 
		$ch = curl_init('https://www.googleapis.com/urlshortener/v1/url');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json',                                                                                
		    'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
		 
		$result = json_decode(curl_exec($ch), TRUE);

		if(isset($result['id']))
		{
			return $result['id'];
		}
		else
		{
			return '';
		}
    }

	public function createLinks( $links, $list_class, $page, $limit, $total) {
	    if ( $limit == 'all' ) {
	        return '';
	    }
	 
	    $last       = ceil( $total / $limit );
	 
	    $start      = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
	    $end        = ( ( $page + $links ) < $last ) ? $page + $links : $last;

	 
	    $html       = '<nav style="margin:0px auto;"><ul class="pagination">';
	 
	    $class      = ( $page == 1 ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="?limit=' . $limit . '&page=' . ( $page - 1 ) . '">&laquo;</a></li>';
	 
	    if ( $start > 1 ) {
	        $html   .= '<li><a href="?limit=' . $limit . '&page=1">1</a></li>';
	        $html   .= '<li class="disabled"><span>...</span></li>';
	    }
	 
	    for ( $i = $start ; $i <= $end; $i++ ) {
	        $class  = ( $page == $i ) ? "active" : "";
	        $html   .= '<li class="' . $class . '"><a href="?limit=' . $limit . '&page=' . $i . '">' . $i . '</a></li>';
	    }
	 
	    if ( $end < $last ) {
	        $html   .= '<li class="disabled"><span>...</span></li>';
	        $html   .= '<li><a href="?limit=' . $limit . '&page=' . $last . '">' . $last . '</a></li>';
	    }
	 
	    $class      = ( $page == $last ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="?limit=' . $limit . '&page=' . ( $page + 1 ) . '">&raquo;</a></li>';
	 
	    $html       .= '</ul></nav>';
	 
	    return $html;
	}

    public function getPendingJobs($request)
    {
    	$resp = array('data' => array(), "total_pages" => 0);
		$limit = 15;
		$total_pages = 0;
		if(!isset($request['page']))
			$page = 0;
		else
			$page = $request['page'];

		$offset = $page * $limit;

		$count = $this->con->from('jobs')->where("status", $request['status'])->count();
		$total_pages = ceil($count / $limit);
		$jobs = $this->con->from('jobs')->where("status", $request['status'])->limit($limit)->offset($offset);


		if(!empty($jobs))
		{
			foreach ($jobs as $key => $job) {
				$resp['data'][] = $this->getJob($job['id']);
			}
		}

		$resp['total_pages'] = $total_pages;
		return $resp;
    }



    public function getJobs( $limit = 10, $page = 1 )
    {
        $countQuery      = $this->con->from('jobs')->where('status != ?', 'expired');

        $total = count($countQuery);

	    if ( $limit == 'all' ) {
	    	$query = $countQuery;
	    } else {
	        $query      = $this->con->from('jobs')->where('status != ?', 'expired')->orderBy('id DESC')->limit($limit)->offset(( ( $page - 1 ) * $limit ));
	    }

		//$query =  $this->con->from('jobs')->where('status != ?', 'expired');
		$jobs = array();
		if(!empty($query))
		{
			foreach ($query as $key => $job) {
				$jobs[] = $this->getJob($job['id']);
			}
		}

	    $result         = new stdClass();
	    $result->page   = $page;
	    $result->limit  = $limit;
	    $result->total  = $total;
	    $result->data   = $jobs;
	 
	    return $result;

    }

	public function addDreamJob($jobTitle, $userId, $expertId, $userMsg)
	{
		$twitterObj = new twitterLib();

		$dateCreated = date("Y-m-d H:i:s");

		// Add expert
		$expertData = $_SESSION['users'][$expertId];
		$this->addUser($expertData);

		// Add User
		$userData = $_SESSION['current_user'];
		$this->addUser($userData);

		$values = array('job_title' => $jobTitle,
					    'created_date' => $dateCreated, 
					    'status' => 'pending', 
					    'expert_id' => $expertId, 
					    'user_id' => $userId, 
					    'user_msg' => $userMsg,
				  );


		$job_id = $this->con->insertInto('jobs', $values)->execute();

		// send message to expert
		$url = $twitterObj->url.'job.php?id='.$job_id.'&expert_view=yes';
		$shortUrl = $this->getShortUrl($url);
		$builtinTemplate = '@'.$expertData['screen_name'].' '.$shortUrl."\r\n";
		$len = 138 - strlen($builtinTemplate);
		$userShortMsg = substr($userMsg, 0, $len);
		$finalMsg = $builtinTemplate.$userShortMsg;

		$twitterObj->postStatus($finalMsg);
		return $job_id;
	}

	public function addUser($expertData)
	{
		$expertData['profile_image_url'] = str_replace('normal', 'bigger', $expertData['profile_image_url']);
		$query = $this->con->from('users')->where('twitter_id = ?', $expertData['twitter_id'])->limit(1);
		$user_id = 0;		
		if(count($query) == 0)
		{
			$values = array('twitter_id' => $expertData['twitter_id'],
						    'name' => $expertData['name'], 
						    'username' => $expertData['screen_name'], 
						    'pic' => $expertData['profile_image_url'], 
						    'bio' => $expertData['description'], 
					  );

			$user_id = $this->con->insertInto('users', $values)->execute();			
		}
		// else
		// 	$user_id = $query['id'];

		return $user_id;

	}

	public function getFeaturedExperts()
	{
		$query =  $this->con->from('jobs')->limit(2);
		$experts = array();
		if(!empty($query))
		{
			foreach ($query as $key => $job) {

				$getExpertData = $this->getUserData($job['expert_id'], 'twitter_id');
				if(!empty($getExpertData))
				{
					$getExpertData['created_date'] = $job['created_date'];
					$getExpertData['job_title'] = ucfirst($job['job_title']);
					$experts[] = $getExpertData;
				}
			}
		}

		return $experts;
	}

	public function jobExists($q)
	{
		$query =  $this->con->from('jobs')->where('job_title = ?', $q)->where('status != ?', 'expired');
		$query = $query->fetch();
		return $query;
	}

	public function getJob($id)
	{
		$query =  $this->con->from('jobs')->where('id = ?', $id);
		$query = $query->fetch();
		$currentTime = time();
		if(!empty($query))
		{
			if($query['status'] == 'pending')
			{
				$timeDiff =  round((time() - strtotime($query['created_date'])) / 60);
				$exptime =  round(strtotime($query['created_date']) / 60) + $this->minutes;
				if($exptime <= $timeDiff)
				{
					// job expire
				}
				else
				{
//					Fri Jan 01 2016 00:00:00 GMT+0500 (PKT)
					$sec = $exptime * 60;
					$query['expired_time'] = date('M j, Y H:i:s O', $sec);
				}
			}

			// Get steps
			$steps = $this->getSteps($id);
			$query['steps'] = $steps;

			// get User data
			$query['expert_user'] = $this->getUserData($query['expert_id'], 'twitter_id');
			$query['user'] = $this->getUserData($query['user_id'], 'twitter_id');
		}

		return $query;
	}

	public function getUserData($id, $type = 'id')
	{
		$userData = array();
		$rs =  $this->con->from('users')->where($type.' = ?', $id)->fetch();
		if(!empty($rs))
			return $rs;
		else
			return array();
	}

	public function getSteps($id)
	{
		$steps = array();
		$rs =  $this->con->from('steps')->where('job_id = ?', $id);
		if(!empty($rs))
		{
			foreach ($rs as $key => $item) {
				$steps[] = $item['step'];
			}
		}
		return $steps;
	}

	public function watch($job_id, $twitter_id)
	{
		$resp = array('status' => 'error', 'msg' => 'Some arguments are missing');

		if(!empty($job_id) && !empty($twitter_id))
		{
			$query =  $this->con->from('watch')->where('twitter_id = ?', $twitter_id)->where('job_id = ?', $job_id);
			$query = $query->fetch();

			if(empty($query))
			{
				$values = array('twitter_id' => $twitter_id,
							    'job_id' => $job_id, 
						  );

				$this->con->insertInto('watch', $values)->execute();
				$resp = array('status' => 'success', 'msg' => 'We will notify you.');
			}
			else
			{
				$resp = array('status' => 'error', 'msg' => 'You are already watched this job');
			}
		}
		return $resp;
	}

	public function changeJobStatus($job_id, $status)
	{
		$values = array('status' => $status);
		$query = $this->con->update('jobs', $values, $job_id)->execute();
		return array('status' => 'success');
	}

	public function deleteJob($job_id)
	{
		$query =  $this->con->from('jobs')->where('id = ?', $job_id)->count();
		if($query > 0)
		{
			$query = $this->con->deleteFrom('jobs')->where('id', $job_id)->execute();		
			$query = $this->con->deleteFrom('steps')->where('job_id', $job_id)->execute();				
			$query = $this->con->deleteFrom('watch')->where('job_id', $job_id)->execute();			
			session_destroy();
			return array('status' => true, "msg" => "Job deleted");
		}
		else
		{
			return array('status' => false, "msg" => "Job doesnt exsits");			
		}
	}

	public function submitJob($job_id, $expert_id, $steps)
	{
		foreach ($steps as $key => $step) {
			if(!empty($step))
			{
				$values = array('step' => $step, 'job_id' => $job_id);
				$query = $this->con->insertInto('steps', $values)->execute();
			}
		}

		// Change job status
		$this->changeJobStatus($job_id, 'approved');
		return true;
	}

}



?>