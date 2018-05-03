<?php

session_start();

include '../back/user_functions.php';

$app_id = $_SESSION['app_id'];
$board_id = $_SESSION['board_id'];
$topic_id = $_SESSION['topic'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$message = $_POST['message'];
$fullname = $first_name." ".$last_name;

post_message($app_id, $board_id, $topic_id, $fullname, $message);
header('Location: viewtopic.php?gameid='.$app_id.'&board='.$board_id.'&topic='.$topic_id.'');




 ?>
