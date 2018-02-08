<?php
require_once("inc/user.php.inc");

$request = $_POST['request'];
$response = "didn't work :^)";

switch($request)
{
	case "register":
		$username = $_POST['username'];
		$password = $_POST['password'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['user_email'];
		$login = new user("inc/connect.ini");
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
		$username = $_POST['username'];
		$password = $_POST['password'];
		$login = new user("inc/connect.ini");
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
