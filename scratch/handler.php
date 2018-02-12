<?php
class error_logger
{
	public function __construct($output_file){$this->fp = fopen($output_file,"a");}
	public function log($message){fwrite($this->fp,$message.PHP_EOL);}
	public function __destruct(){fclose($this->fp);}
}
class user
{
	private $db;private $salt;private $logger;
	public function __construct($iniFile)
	{
		$ini		  = parse_ini_file($iniFile, true);
		$this->logger = new error_logger("logs/users.log");
		$this->db	  = new mysqli(
			$ini['db']["host"],
			$ini['db']["user"],
			$ini['db']["password"],
			$ini['db']["db"]);
		$this->salt   = $ini['db']["salt"];
		if ($this->db->connect_errno > 0)
		{
			$this->logger->log("failed to connect to database re: ".$this->db->connect_error);
			exit(0);
		}
		$this->logger->log("testing");
	}
	public function __destruct(){$this->db->close();}
	private function salt_password($password)
	{
		return $this->db->real_escape_string(sha1($password.$this->salt));
	}
	public function get_user_email($user_email)
	{
		$query   = "select user_email from users where user_email='$user_email';";
		$result = $this->db->query($query);
	        $user = $result->fetch_assoc();
		if (isset($user['user_email']))
		{
		    return $user['user_email'];
		}
		return 0;
	}
	public function login_user($user_email, $password)
	{
		if ($this->get_user_email($user_email) != 0)
		{
			return array(
				"success" => false,
				"message" => "user does not exist"
			);
		}
		$query   = "select * from users where user_email = '$user_email';";
		$result = $this->db->query($query);
		if (!$result)
		{
			return array(
				"success" => false,
				"message" => "db failure"
			);
		}
		$salt_pw = $this->salt_password($password);
		$user = $result->fetch_assoc();
		if (isset($user['user_pw']) && $user['user_pw'] == $salt_pw)
		{
				return array("success" => true);
		}
		return array(
			"success" => false,
			"message" => "failed to match password"
		);
	}
	public function add_new_user($user_email, $password, $first_name, $last_name, $email)
	{
		if ($this->get_user_email($user_email) != 0)
		{
			$this->logger->log("user $user_email already exists!");
			$response = array(
				"message" => "user $user_email already exists!",
				"success" => false
			);
			return $response;
		}
		$now = date("Y-m-d h:i:s", time());
		$user_email = $this->db->real_escape_string($user_email);
		$password = $this->salt_password($password);
		$query = "
			insert into users
			(
				user_email,
				user_pw,
				user_first_name,
				user_last_name,
				user_email,
				first_login,
				last_login
			)
			values
			(
				'$user_email',
				'$password',
				'$first_name',
				'$last_name',
				'$email',
				'$now',
				'$now'
			);";
		$result   = $this->db->query($query);
		if (!$result)
		{
			$this->logger->log("error: ".$this->db->error);
		}
		return array(
			"success" => true
		);
	}
}
switch($request)
{
	case "register":
		$password = $_POST['password'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['user_email'];
		$login = new user("connect.ini");
		$response = $login->login_user($username, $password);
		if ($response['success'])
		{
			$response = "<p>Registration Failed: ".$response['message'];			
		}
		else		
		{
			$login->add_new_user($username,$password,$first_name,$last_name,$email);
			$response = "<p> $username Registered Successfully!";
		}
		break;
	case "login":
		$email = $_POST['user_email'];
		$password = $_POST['password'];
		$login = new user("connect.ini");
		$response = $login->login_user($username, $password);
		if ($response['success'])
		{
			$response = "<p>Login Successful!";
		}
		else		
		{
			$response = "<p>Login Failed: ".$response['message'];
		}
		break;
}
echo $response;
?>