<?php

	session_start();
	
	include("../includes/connection.php");

	$query = "DELETE FROM `old_book` WHERE `book_id` = " . $_GET['id'];

	$result = mysqli_query($connection_database, $query);

	header("location: ../old_book_post.php");
	exit();
?>