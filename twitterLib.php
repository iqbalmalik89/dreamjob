<?php
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class twitterLib
{
    public $cred = array();
    public $connection;
    function __construct() {
		$this->cred = array('consumer_key' => 'atbTj86LsM5RL4hIWmvvJmAuL',
              'consumer_secret' => 'L0LG0Tj6wbkyVnFWMtQopvRCwgqjBbOfqJkPxyJPBfvGFNAOuu',
              'app_access_token' => '1487596926-RRBub8VVtcxAaFqSyfHFXKMv2YPM5AKru1lY3Xy',
              'app_access_secret' => 'GAj1kmIflKB2dVQaAGhwWao1KRF3NVw9Ra2uQaSSt1k6q',
        );
    }

    public function connect()
    {
		$this->connection = new TwitterOAuth($this->cred['consumer_key'], $this->cred['consumer_secret'], $this->cred['app_access_token'], $this->cred['app_access_secret']);		
    }

    public function getUser($user)
    {
		$userArr = array('twitter_id' => '',
						 'name' => '',
						 'screen_name' => '',
						 'profile_image_url' => '',
						);

		if(isset($user->id))	
			$userArr['twitter_id'] = $user->id;

		if(isset($user->name))	
			$userArr['name'] = $user->name;		

		if(isset($user->screen_name))	
			$userArr['screen_name'] = $user->screen_name;

		if(isset($user->profile_image_url))	
			$userArr['profile_image_url'] = $user->profile_image_url;

		return $userArr;
    }

    public function search($query)
    {
    	$this->connect();
    	$results = array();
		$statuses = $this->connection->get("search/tweets", array("q" => $query));   	
		if(isset($statuses->statuses))
		{
			if(!empty($statuses->statuses))
			{
				foreach($statuses->statuses as $status)
				{
					$results[] = array('msg' => $status->text, 'user' => $this->getUser($status->user));
				}
			}
		}

		return $results;
    }
}



?>