<?php
/* Database connection settings */
$host   = 'localhost';
$user   = 'root';
$pass   = 'Jonathan723';
$db     = 'accounts';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);
?>
