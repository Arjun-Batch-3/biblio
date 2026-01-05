<?php
	session_start();
	
	include("../../includes/connection.php");
	
	if (!empty($_POST)) {
		$_SESSION['error'] = array();
	
		extract($_POST);
	
	
		// Validate  Name
		if (empty($book_name)) {
			$_SESSION['error'][] = "Please enter book name";
		}
	
		// Validate  description
		if (empty($book_category)) {
			$_SESSION['error'][] = "Please enter category";
		}
	
		// Validate  Name
		if (empty($book_price)) {
			$_SESSION['error'][] = "Please enter Price";
		}
	
		// Validate  description
		if (empty($book_author)) {
			$_SESSION['error'][] = "Please enter author";
		}
	
		if (empty($_FILES['book_img']['name'])) {
			$_SESSION['error'][] = "Please book Photo";
		}
	
		if (!empty($_SESSION['error'])) {
			header("location: ../book_add.php");
			exit();
		} else {
		
			$time = time();
		
			$random_number_name = uniqid();
		
			$new_name_file = $random_number_name . $_FILES['book_img']['name'];
		
			move_uploaded_file($_FILES['book_img']['tmp_name'], "../../book_img/" . $new_name_file);
			$book_img = "book_img/" . $new_name_file;
		
			$query = "INSERT INTO `book_table`(`book_name`, `book_category`, `book_description`, `book_price`, `book_img`, `book_time`, `author_id`) VALUES ('$book_name', '$book_category', '$book_description', '$book_price', '$book_img', '$time', '$book_author')";
		
			mysqli_query($connection_database, $query);
		
			header("location: ../book_view.php");
			exit();
		}
	} else {
		header("location: ../book_add.php");
		exit();
	}
?>