<?php
/* Displays all error messages */
session_start();
include_once "logger.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <h1>Error</h1>
    <p>
    <?php
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        //echo $_SESSION['message'];
        file_put_contents($errorlog, $_SESSION['message'], FILE_APPEND | LOCK_EX); 
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>
    <a href="index.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
