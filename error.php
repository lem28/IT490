<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Error</title><?php include 'css/css.html';?>
</head>
<body>
	<div class="form">
		<h1>Error</h1>
		<p>
      <?php
		if (isset($_SESSION['message']) and !empty($_SESSION['message'])):
		    echo $_SESSION['message'];
		    $date = date_create();
		    file_put_contents('error.log', "[" . date_format($date, 'm-d-Y H:i:s') . "] " . $_SESSION['message'] . PHP_EOL, FILE_APPEND);
		else:
		    header("location: index.php");
		endif;
		?>
    </p>
    <a href="index.php"><button class="button button-block"></button>Home</a>
	</div>
</body>
</html>
