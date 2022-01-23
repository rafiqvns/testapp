<?php
include('config.php');
$usid = $_GET['id'];

if($_GET['id']!=''){
		$query = "delete FROM tbluserimage where Id=".$_GET['id'];
		$sql = mysql_query($query);

		header('Location: imagesupload.php');
	}
?>