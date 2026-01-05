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
	
		// Validate  category
		if (empty($book_category)) {
			$_SESSION['error'][] = "Please enter category";
		}
	
		// Validate  book_description
		if (empty($book_description)) {
			$_SESSION['error'][] = "Please enter book_description";
		}
	
		// Validate  book_link
		if (empty($book_link)) {
			$_SESSION['error'][] = "Please enter book_link";
		}

		//img
		if (empty($_FILES['book_img']['name'])) {
			$_SESSION['error'][] = "Please insert book Cover Photo";
		}
		
		if (!empty($_SESSION['error'])) {
			header("location: ../review_request.php");
			exit();
		} else {
		
			$time = time();
            $book_author = $_SESSION['client']['authorId'];

			//for immage
			$random_number_name = uniqid();
			$new_name_file = $random_number_name . $_FILES['book_img']['name'];
			move_uploaded_file($_FILES['book_img']['tmp_name'], "../../request_img/" . $new_name_file);
			$book_img = "request_img/" . $new_name_file;

			$query = "INSERT INTO `review_request`(`book_name`, `book_category`, `book_description`, `book_link`, `book_time`, `author_id`, `book_img`) VALUES ('$book_name', '$book_category', '$book_description', '$book_link', '$time', '$book_author', '$book_img')";
		
			mysqli_query($connection_database, $query);
		
			header("location: ../review_request.php");
			exit();
		}
	} else {
		header("location: ../review_request.php");
		exit();
	}
?>