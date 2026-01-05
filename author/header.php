<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Dhaka");

?>

<!DOCTYPE html>

<html>

<head>

	<title>Bibliophile's Corner</title>
	<link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon.png">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width" , initial-scale=1.0>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

	<!-- font awesome cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<!-- this thing is for old book modal -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- <style>
		#cart-button {
			position: relative;
		}

		#item-count {
			position: absolute;
			top: -10px;
			right: -10px;
			background-color: red;
			color: white;
			border-radius: 50%;
			padding: 5px 10px;
			font-size: 10px;
		}
	</style> -->
	<link rel="stylesheet" href="../css/style.css">
</head>

<body>

	<header class="header pt-2">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<li><a href="#" class="navlink px-3 m-2 btn btn-outline-light"><i class="fa-solid fa-feather-pointed fa-beat-fade fa-2xl"></i></a></li>
					<?php

					if (isset($_SESSION['client']['authorStatus'])) {
						echo '<li><a href="profile.php" class="navlink px-3 m-2 btn btn-outline-light"><i class="fa-solid fa-user"></i></a></li>';
						echo '<li><a href="review_request.php" class="navlink px-3 m-2 btn btn-outline-light"><i class="fa-solid fa-pen-to-square"></i></a></li>';
						echo '<li><a class="navlink px-3 m-2 btn btn-outline-light" href="book_fest.php"><img src="../assets/bookFest.png" style="width: 25px" alt=""></a></li>';
						// echo '<div class="btn-group">
  						// 		<button type="button" class="navlink px-3 m-2 btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    					// 			Action
  						// 		</button>
						// 		<ul class="dropdown-menu">
						// 		  <li><a class="btn-outline-light dropdown-item navlink px-3 m-2 " href="old_book.php">Old Books</a></li>
						// 		  <li><a class="dropdown-item navlink px-3 m-2 btn btn-outline-light" href="add_old_book.php">Add Old Books</a></li>                				
						// 		  <li><a class="dropdown-item navlink px-3 m-2 btn btn-outline-light" href="old_book_post.php">Post</a></li>               				
						// 		  <li><a class="dropdown-item navlink px-3 m-2 btn btn-outline-light" href="user_notifications.php">Notifications</a></li>              				
						// 		  <li><a class="dropdown-item navlink px-3 m-2 btn btn-outline-light" href="chat/users.php">MESSAGES</a></li>              				
						// 		</ul>
						// 	    </li>';
					}
					?>
				</ul>


				<div class="text-end">
					<?php
					if (isset($_SESSION['client']['authorStatus'])) {
						echo '<a href="logout.php" ><button type="button" class=" btn btn-outline-light px-3 m-2 me-2 "><i class="fa-solid fa-right-from-bracket"></i></button></a>';
					} else {
						echo '<a href="login.php" class="navlink btn btn-outline-light px-3 m-2 me-2"><i class="fa-solid fa-right-to-bracket"></i></a>';
						echo '<a href="register.php" class="navlink btn btn-outline-light px-3 m-2"><i class="fa-solid fa-user-plus"></i></a>';
					}
					?>
				</div>

			</div>
		</div>
	</header>