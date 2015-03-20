<?php 
class GateKeeper
{
	public $jobobj;
    function __construct() {

		$this->jobobj = new Job();

    }

    public function loginAdmin($email, $password)
    {
    	$resp = array('status' => 'error');
		if(!empty($email) && !empty($password))
		{
			$rec = $this->jobobj->con->from('admin')->where('username',$email)->where('password',md5($password));
			$exists = count($rec);

			if($exists)
			{
				$_SESSION['user'] = $rec->fetch();
				$resp['status'] = 'success';
			}
		}
		return $resp;
    }

    public function logoutAdmin()
    {
    	session_destroy();
    }
}	