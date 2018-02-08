<?php
require_once("inc/user.php.inc");
require_once("inc/file.php.inc");

$r = $_REQUEST['r'];

function register()
{
	$json = json_decode(file_get_contents("php://input"), true);
	$password = $json['reg_password'];
	$first_name = $json['reg_first_name'];
	$last_name = $json['reg_last_name'];
	$email = $json['reg_email'];
	$login = new user("inc/connect.ini");
	$response = $login->login_user($email, $password);
	if ($response['success'])
	{
		$login->add_new_user($password,$first_name,$last_name,$email);
		$response = "<p> $email Registered Successfully!";
		echo $response;
	}
	else
	{
		$response = "<p>Registration Failed: ".$response['message'];
		echo $response;
	}
}

function login()
{
	$json = json_decode(file_get_contents("php://input"), true);
	$email = $json['log_email'];
	$password = $json['log_password'];
	$login = new user("inc/connect.ini");
	$response = $login->login_user($email, $password);
	if ($response['success'])
	{
		$response = "<p>Login Successful!";
		echo $response;
		$_SESSION["email"] = $email;
		header('Location: ../user.html');
	}
	else
	{
		$response = "<p>Login Failed: ".$response['message'];
		echo $response;
	}
}

function logout()
{
	session_unset();
	session_destroy();
	header('Location: ../index.html');
}

if($r == "register")
	register();
if($r == "login")
	login();
if($r == "logout")
	logout();
?>
