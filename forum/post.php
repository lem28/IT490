<?php

session_start();

include '../back/user_functions.php';

$app_id = $_SESSION['app_id'];
$board_id = $_SESSION['board_id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$topic = $_POST['topic'];
$message = $_POST['message'];
$fullname = $first_name." ".$last_name;

post_topic($app_id, $board_id, $topic, $fullname, $message);
header('Location: general.php?gameid='.$app_id.'');




 ?>
