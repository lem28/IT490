#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function authentication($email,$userpass)
{

  $host = 'localhost';
  $user = 'root';
  $dbpass = 'Jonathan723';
  $db = 'accounts';
  $mysqli = new mysqli($host,$user,$dbpass,$db) or die($mysqli->error);

/* User login process, checks if user exists and password is correct */
// Escape email to protect against SQL injections
$email = $mysqli->escape_string($email);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    echo "User Doesnt Exist\n";
    return false;
}
else { // User exists
    echo "User Exists\n";

    $user = $result->fetch_assoc();

    foreach($user as $key => $value){
      echo "Key: $key; Value: $value\n";
    }

    echo "dbpass = ".$user['password'].PHP_EOL;
    echo "pass = ".$userpass.PHP_EOL;

    if ( $userpass === $user['password'] ){
      echo "Correct Password";
      return true;
    }
    else{
      return false;
    }
}

}


/*function registration($firstname, $lastname, $userpass, $email){
}*/

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Login":
      return authentication($request['email'],$request['password']);
      break;
    case "Register":
      return registration($request['firstname'],$request['lastname'],$request['password'],$request['email']);
      break;
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
