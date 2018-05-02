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

$_SESSION['app_id'] = $app_id;
$_SESSION['board_id'] = $_GET['board'];
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


  <title>New Topic</title>

  <?php include '../css/css.html'; ?>

  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="form">

	<h1>General Discussion</h1>

  <h2>New Topic</h2><br>

  <form action="post.php" method="post" autocomplete="off">

  <input type="text" required autocomplete="off" name="topic"/><br>

  <textarea rows="5" cols="50" name="message"></textarea>

   <script>
     function goBack() {
       window.history.back()
     }
   </script>

   <br><button type="submit" class="button button-block" name="post">Post</button>
   <br><button type="button" class="button button-block" onclick="goBack()">Back</button>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
