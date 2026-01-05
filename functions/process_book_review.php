<?php
	session_start();
	
	include("../includes/connection.php");
	
	if (!empty($_POST)) {
		$_SESSION['error'] = array();
	
		extract($_POST);
	
	
		if (empty($main_theme)) {
			$_SESSION['error'][] = "Please enter main_theme";
		}
	
		if (empty($strength_analysis)) {
			$_SESSION['error'][] = "Please enter strength_analysis";
		}
	
		if (empty($weakness_analysis)) {
			$_SESSION['error'][] = "Please enter weakness_analysis";
		}
	
		if (empty($critical_evaluation)) {
			$_SESSION['error'][] = "Please enter critical_evaluation";
		}
		// if (empty($is_requested_review)) {
		// 	$_SESSION['error'][] = "Please enter RR";
		// }
		if (empty($book_id)) {
			$_SESSION['error'][] = "Please enter ID";
		}
	
	
		if (!empty($_SESSION['error'])) {
			header("location: ../book_review.php");
			exit();
		} else {
			$reviewer_id = $_SESSION['client']['id'];
			$query = "INSERT INTO `book_review`(`book_id`, `is_requested_review`, `main_theme`, `strength_analysis`, `weakness_analysis`, `critical_evaluation`, `overall_rating`, `reviewer_id`) VALUES ('$book_id', '$is_requested_review', '$main_theme', '$strength_analysis', '$weakness_analysis', '$critical_evaluation', '$overall_rating', '$reviewer_id')";
		
			mysqli_query($connection_database, $query);
			$_SESSION['message']['success'] = 'Your review has been submitted successfully';
			header("location: ../book_review.php");
			exit();
		}
	} else {
		header("location: ../book_review.php");
		exit();
	}
?>