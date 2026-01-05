<?php
	session_start();
	
	include("../../includes/connection.php");

	$request_id = $_GET['id'];

	$query = "DELETE FROM `review_request` WHERE `id` = $request_id";

	mysqli_query($connection_database, $query);

	header("location: ../review_request.php");
	exit();
?>