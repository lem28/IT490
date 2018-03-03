<?php
/* Displays user information and some useful messages */
session_start();
// Check if user is logged in using the session variable
/*if ( $_SESSION['logged_in'] != 1 ) {
$_SESSION['message'] = "You must log in before viewing your profile page!";
header("location: error.php");
}
else {
// Makes it easier to read
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
}*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome <? = $first_name.' '.$last_name?>
	</title>
	<meta charset="UTF-8">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</script>
	<link href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'><?php include 'css/css.html';?>
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<div class="form">
		<h1>Search PC games</h1>
		<p></p>
		<h2>  <?php echo $first_name.' '.$last_name;?>
		<p><?=$email?>
		</p>
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<header id="header">
							<div class="slider">
								<div class="carousel slide" data-ride="carousel" id="carousel-example-generic"></div>
								<div class="collapse navbar-collapse" id="mainNav"></div>
							</div>
              <form action="api.php" method="post">
                <label>Limit</label>
                <input name="name" type="text" value=""></input>
                <input type="submit" value="Submit"></input>
                <div class="result"> </div>
              </form>
							<a href="profile.php"><button class="button button-block" name="HOME"></button>HOME</a>
						</header>
					</div>
					<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
					<script src="js/index.js"></script>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
