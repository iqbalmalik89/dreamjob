<?php session_start();
require __DIR__."/../vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class twitterLib
{
    public $cred = array();
    public $connection;
    public $url;
    function __construct() {
		$this->cred = array('consumer_key' => '7A2AZvILvfd7LeQptf24Foxxp',
              'consumer_secret' => 'LWtgg1Y0Ws6dIavM07ymHsSlrIinJmHIYlW6xoLT6N1EoeO2j6',
              'app_access_token' => '1487596926-h4ShsNXHmY24ho9AuZDqj2Y8YcvmBRlFTXdWh90',
              'app_access_secret' => 'GnARH7WekzNNK4ZHpbCBZLJcFYuBhltYObUQDpPco4gzk',
        );

    	if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1')
    	{
			$this->url = 'http://127.0.0.1/dreamjob/';
		}
		else
		{
			$this->url = 'http://www.thinkcloud.com.sg/makeawish/';
		}

    }

    public function connect($oauth = false)
    {
    	if($oauth)
			$this->connection = new TwitterOAuth($this->cred['consumer_key'], $this->cred['consumer_secret']);		
    	else
			$this->connection = new TwitterOAuth($this->cred['consumer_key'], $this->cred['consumer_secret'], $this->cred['app_access_token'], $this->cred['app_access_secret']);		

    }

    public function getUser($user)
    {
		$userArr = array('twitter_id' => '',
						 'name' => '',
						 'screen_name' => '',
						 'profile_image_url' => '',
						 'description' => '',
						 'verified' => false,
						);

		if(isset($user->id))	
			$userArr['twitter_id'] = $user->id;

		if(isset($user->name))	
			$userArr['name'] = $user->name;		

		if(isset($user->screen_name))	
			$userArr['screen_name'] = $user->screen_name;

		if(isset($user->profile_image_url))	
			$userArr['profile_image_url'] = $user->profile_image_url;

		if(isset($user->description))	
			$userArr['description'] = $user->description;

		if(!empty($user->verified))
			$userArr['verified'] = true;

		return $userArr;
    }

    public function search($query)
    {
    	$this->connect();
    	$results = array();
		$result = $this->connection->get("users/search", array("q" => $query));

		$_SESSION['users'] = array();
		if(!empty($result))
		{
			foreach($result as $user)
			{
				
				$userData = $this->getUser($user);
				$status = '';
				
				if(isset($user->status))
				{
					if(isset($user->status->text))
						$status = $user->status->text;
				}
				
				$created_at = '';

				if(isset($user->created_at))
				{
					$created_at = date('d M Y', strtotime($user->created_at));
				}

				$userData['created_at'] = $created_at;
				$userData['status'] = $status;
				$_SESSION['users'][$userData['twitter_id']] = $userData;
				$results[] = $userData;
			}
		}

		return $results;
    }

    public function getAuthUrl($id, $file = 'newjob.php')
    {
    	$this->connect(true);
		$request_token = $this->connection->oauth('oauth/request_token', array('oauth_callback' => $this->url.$file.'?id='.$id));
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

		$url = $this->connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		return $url;
    }

    public function postStatus($userMsg)
    {
    	$this->cred['app_access_token'] = $_SESSION['access_token']['oauth_token'];
    	$this->cred['app_access_secret'] = $_SESSION['access_token']['oauth_token_secret'];
    	$this->connect(false);
		$response = $this->connection->post('statuses/update', array('status' => $userMsg));
    }

    public function authorize()
    {
    	$access_token = '';
		$request_token = [];
		$request_token['oauth_token'] = $_SESSION['oauth_token'];
		$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

		if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
		    // Abort! Something is wrong.
		    echo 'Token Mismatch<br>';
		    echo $request_token['oauth_token'].'<br>';
		    echo $_REQUEST['oauth_token'].'<br>';
		    die();
		}
		else
		{
	    	$this->cred['app_access_token'] = $request_token['oauth_token'];
	    	$this->cred['app_access_secret'] = $request_token['oauth_token_secret'];
	    	$this->connect();
			$access_token = $this->connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));	    	

	    	$this->cred['app_access_token'] = $access_token['oauth_token'];
	    	$this->cred['app_access_secret'] = $access_token['oauth_token_secret'];
	    	$this->connect(false);
			$userData = $this->connection->get("account/verify_credentials");
			$_SESSION['current_user'] = array();

			if(isset($userData->id))
				$_SESSION['current_user']['twitter_id'] = $userData->id;

			if(isset($userData->name))
				$_SESSION['current_user']['name'] = $userData->name;

			if(isset($userData->screen_name))
				$_SESSION['current_user']['screen_name'] = $userData->screen_name;			

			if(isset($userData->description))
				$_SESSION['current_user']['description'] = $userData->description;

			if(isset($userData->profile_image_url))
				$_SESSION['current_user']['profile_image_url'] = $userData->profile_image_url;

			$_SESSION['access_token'] = $access_token;
		}
		return $access_token;
    }
}



?>