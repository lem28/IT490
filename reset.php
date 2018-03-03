<?php
/* The password reset form, the link to this page is included
from the forgot.php email message
 */
require 'db.php';
session_start();
// Make sure email and hash variables aren't empty
if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
    $email = $mysqli->escape_string($_GET['email']);
    $hash  = $mysqli->escape_string($_GET['hash']);
    // Make sure user email with matching hash exist
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash'");
    if ($result->num_rows == 0) {
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        header("location: error.php");
    }
} else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
    header("location: error.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Reset Your Password</title><?php include 'css/css.html';?>
</head>
<body>
	<div class="form">
		<h1>Choose Your New Password</h1>
		<form action="reset_password.php" method="post">
			<div class="field-wrap">
				<label>New Password<span class="req">*</span></label> <input autocomplete="off" name="newpassword" required="" type="password">
			</div>
			<div class="field-wrap">
				<label>Confirm New Password<span class="req">*</span></label> <input autocomplete="off" name="confirmpassword" required="" type="password">
			</div><!-- This input field is needed, to get the email of the user -->
			<input name="email" type="hidden" value="&lt;?=$email?&gt;"> <input name="hash" type="hidden" value="&lt;?=$hash?&gt;"> <button class="button button-block"></button>Apply
		</form>
	</div>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>
	</script>
	<script src="js/index.js">
	</script>
</body>
</html>
