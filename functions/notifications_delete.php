<?php

	session_start();
	
	include("../includes/connection.php");

	$query = "DELETE FROM `notifications` WHERE `id` = " . $_GET['id'];

	$result = mysqli_query($connection_database, $query);

	header("location: ../user_notifications.php");
	exit();
?>