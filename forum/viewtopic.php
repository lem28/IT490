<?php
  $app_id = $_GET["gameid"];

  $options = array('http' => array('user_agent' => 'custom user agent string'));
  $context = stream_context_create($options);
  $apiResult = file_get_contents("https://www.giantbomb.com/api/game/3030-".$app_id."/?api_key=1eb68d69b5b8c3a4d37f93116ba4968ccf789a33&format=json&resources=game", false, $context);
  $json = json_decode($apiResult);
?>

<?php
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in first!";
  header("location: error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


  <title>General Discussion for <?php echo $json->results->name; ?></title>

  <?php include '../css/css.html'; ?>

  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="form">

	<h1><?php echo $json->results->name; ?></h1>
  <h2>
  <?php

  $forum = new mysqli('localhost', 'root', 'Jonathan723', 'forum');

  $topic_id = $_GET["topic"];
  $_SESSION["topic"] = $topic_id;

  $sql = "SELECT topic FROM `$app_id"."_topics` WHERE `topic_id` = $topic_id";
  $result = $forum->query($sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  echo $row["topic"];


  ?>
  </h2><br>

  <?php

  require '../back/user_functions.php';

  $board_id = $_GET["board"];

  display_messages($app_id, $board_id, $topic_id);



  ?>

  <form action="postmessage.php" method="post" autocomplete="off">

  <br><h1>Post Response<h1>

  <textarea rows="3" cols="50" name="message"></textarea>

  <br><button type="submit" class="button button-block" name="post">Post</button>

  <?php

  //echo "<br><a href='boards.php?gameid=".$app_id."'><button type='button' class='button button-block' name='forum'/>Back to boards</button></a>";

   ?>
   <script>
     function goBack() {
       window.history.back()
     }
   </script>
   <br><button type="button" class="button button-block" onclick="goBack()">Back</button>

   <br><a href="../profile.php"><button type="button" class="button button-block" name="profile"/>Back to profile</button></a>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
