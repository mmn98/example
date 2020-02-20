<?php
include_once 'common.class.php';
//require_once ('MysqliDb.php');
/**
 *
 */
class Auth extends Common
{
	public function __construct()
    {
        parent::__construct();
    }

	public function login($email, $password, $remember)
	{
		$return_array = array();
				
		$this->db->where ("email",$email);
		$result = $this->db->getOne('usres');
		
		if ($result!==NULL)
		{
			
				if ($result['password'] === $password)
				{
					if ($result['admin'] != 1)
					{ 
						//for user session

						if ($remember)
						{
							$cookie_name  = 'rememberlogin';
							$cookie_value = $result['id'];
							setcookie($cookie_name, $cookie_value, time() + (86400 * 7), '/'); // 86400 = 1 day
						}

						$_SESSION['user_id']     = 	$result['id'];
						$_SESSION['email']       = $result['email'];
						$_SESSION['username']    = $result['username'];
						$_SESSION['role']		 = "user";
						$_SESSION['is_loggedin'] = true;

						$return_array['response'] = 'user_role';
					}
					if($result['admin'] == 1)
					{
						//for admin session					
						if ($remember)
						{
							$cookie_name  = 'rememberlogin';
							$cookie_value = $result['id'];
							setcookie($cookie_name, $cookie_value, time() + (86400 * 7), '/'); // 86400 = 1 day
						}

						$_SESSION['user_id']     = 	$result['id'];
						$_SESSION['email']       = $result['email'];
						$_SESSION['username']    = $result['username'];
						$_SESSION['role']		 = "admin";
						$_SESSION['is_loggedin'] = true;

						$return_array['response'] = 'success';
					}
				}
				else
				{
					$return_array['response'] = 'incorrect_password';
				}
			
		}
		else
		{
			$return_array['response'] = 'wrong_email';
		}

		return $return_array;
	}

	public function autologin()
	{
	}

	public function is_loggedin()
	{
		if (isset($_SESSION['is_loggedin']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function logout()
	{
		session_destroy();
		setcookie('rememberlogin', '', time() - (86400 * 7), '/');
		echo 'here';
	}

	public function update_password($password,$id)
	{


		$data = Array (
						'password' =>$password,
					 );

		$this->db->where ('id',$id);
		if ($this->db->update ('usres', $data))
		{
			//echo $db->count . ' records were updated';
			return true;
		}
		else
		{
			return 'update failed: ' . $db->getLastError();
		}
	}

	public function match_key($id,$key)
	{
			$this->db->where("id", $id);
			$result = $this->db->getOne("usres");
			echo $result['reset_password_key'];
			echo "hii";
			echo $key;
            //return $result;
            if($result)
            {
                if($key == $result['reset_password_key'])
                {
                    return true;
                } 
                    return false;
            }
	}
}

?>