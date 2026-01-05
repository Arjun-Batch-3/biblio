<?php
	session_start();
	
	include("../../includes/connection.php");

	$id = $_GET['id'];

	$query = "DELETE FROM `quiz` WHERE `id` = $id";

	mysqli_query($connection_database, $query);

	header("location: ../quiz_add.php");
	exit();
?>