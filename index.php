<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign-Up/Login Form</title><?php include 'css/css.html';?>
	<link href="css/style.css" rel="stylesheet">
</head><?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        //user logging in
        require 'login.php';
    } elseif (isset($_POST['register'])) {
        //user registering
        require 'register.php';
    }
}
?>
<body>
	<div class="form">
		<ul class="tab-group">
			<li class="tab">
				<a href="#signup">Create Account</a>
			</li>
			<li class="tab active">
				<a href="#login">Log In</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="login">
				<h1>Log in to continue</h1>
				<form action="index.php" autocomplete="off" method="post">
					<div class="field-wrap">
						<label>Email Address<span class="req">*</span></label> <input autocomplete="off" name="email" required="" type="email">
					</div>
					<div class="field-wrap">
						<label>Password<span class="req">*</span></label> <input autocomplete="off" name="password" required="" type="password">
					</div>
					<p class="forgot"><a href="forgot.php">Forgot Password?</a></p><button class="button button-block" name="login"></button>Log In
				</form>
			</div>
			<div id="signup">
				<h1>Create an Account</h1>
				<form action="index.php" autocomplete="off" method="post">
					<div class="top-row">
						<div class="field-wrap">
							<label>First Name<span class="req">*</span></label> <input autocomplete="off" name='firstname' required="" type="text">
						</div>
						<div class="field-wrap">
							<label>Last Name<span class="req">*</span></label> <input autocomplete="off" name='lastname' required="" type="text">
						</div>
					</div>
					<div class="field-wrap">
						<label>Email Address<span class="req">*</span></label> <input autocomplete="off" name='email' required="" type="email">
					</div>
					<div class="field-wrap">
						<label>Password<span class="req">*</span></label> <input autocomplete="off" name='password' required="" type="password">
					</div><button class="button button-block" name="register" type="submit"></button>Register
				</form>
			</div>
		</div><!-- tab-content -->
	</div><!-- /form -->
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>
	</script>
	<script src="js/index.js">
	</script>
</body>
</html>
