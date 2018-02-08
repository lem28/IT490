<?php
require_once("inc/user.php.inc");
require_once("inc/file.php.inc");

$r = $_REQUEST['r'];

function register()
{
	$json = json_decode(file_get_contents("php://input"), true);
	$username = $json['reg_username'];
	$password = $json['reg_password'];
	$first_name = $json['reg_first_name'];
	$last_name = $json['reg_last_name'];
	$email = $json['reg_email'];
	$login = new user("inc/connect.ini");
	$response = $login->login_user($username, $password);
	if ($response['success'])
	{
		$login->add_new_user($username,$password,$first_name,$last_name,$email);
		$response = "<p> $username Registered Successfully!";
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
	$username = $json['log_username'];
	$password = $json['log_password'];
	$login = new user("inc/connect.ini");
	$response = $login->login_user($username, $password);
	if ($response['success'])
	{
		$response = "<p>Login Successful!";
		echo $response;
		$_SESSION["user"] = $username;
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

function upload()
{
	$json = json_decode(file_get_contents("php://input"), true);
	$file = new file("inc/connect.ini");
	$response = $file->file_upload();
	if ($response['success'])
	{
		$response = "<p>File Upload Successful!";
		echo $response;
		header('../user.html');
	}
	else
	{
		$response = "<p>File Upload Failed...";
		echo $response;
	}
}

function browse()
{
	$file = new file("inc/connect.ini");
	$response = $file->file_browse();
}

if($r == "register")
	register();
if($r == "login")
	login();
if($r == "logout")
	logout();
if($r == "upload")
	upload();
if($r == "browse")
	browse();
?>
