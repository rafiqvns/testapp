<?php
//include('config.php');
$user_check=$_SESSION['UserId'];

if(!isset($user_check))
{
	header("Location: index.php");
}
?>