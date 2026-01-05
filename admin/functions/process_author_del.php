<?php
	session_start();
	
	include("../../includes/connection.php");

	$author_id = $_GET['id'];

	$query = "DELETE FROM `author_table` WHERE `author_id` = $author_id";

	mysqli_query($connection_database, $query);

	header("location: ../author_view.php");
	exit();
?>