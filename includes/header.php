<?php
ob_start();
session_start();
$con2 = new mysqli("localhost", "root", "", "biblio");

if (isset($_SESSION['client']['status'])) {
	// for notification
	$user_id = $_SESSION['client']['id'];
	$notify_query = "SELECT * FROM `notifications` WHERE `is_viewed`= '0' AND `user_id` = '$user_id'";
	$notify_result = mysqli_query($con2, $notify_query);
	$notify_count = mysqli_num_rows($notify_result);
	// for message
	$message_query = "SELECT COUNT(DISTINCT `outgoing_msg_id`) as count 
FROM `old_book_messages` 
WHERE `incoming_msg_id` = '$user_id' 
AND `is_viewed` = '0';";
	$message_result = mysqli_query($con2, $message_query);
	$message_row = mysqli_fetch_assoc($message_result);
	$message_count = $message_row['count'];
}
?>

<!DOCTYPE html>

<html>

<head>

	<title>Bibliophile's Corner</title>
	<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon.png">


	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width" , initial-scale=1.0>


	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
		rel="stylesheet">
	<!-- font awesome cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
		integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css" integrity="sha384-NvKbDTEnL+A8F/AA5Tc5kmMLSJHUO868P+lDtTpJIeQdGYaUIuLr4lVGOEA1OcMy" crossorigin="anonymous"> -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
	<!-- this thing is for old book modal -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<style>
		#cart-button {
			position: relative;
		}

		#notify-button {
			position: relative;
		}

		#message-button {
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
	</style>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<header class="header pt-2">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-between nav-main">

				<ul class="nav mb-2 justify-content-center mb-md-0">
					<li><a href="index.php" data-title="Home" class="navlink px-3 m-2 btn btn-outline-light"><i
								class="fa-solid fa-house "></i></a>
					</li>
					<?php
					if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
						$cart_size = count($_SESSION['cart']);
						echo '<li><a id="cart-button" href="cart.php" data-title="Cart" class="navlink px-3 m-2 btn btn-outline-light"><i class="fa-solid fa-cart-shopping fa-bounce"></i><span id="item-count" class="shadow">' . $cart_size . '</span></a></li>';
					} else {
						echo '<li><a href="cart.php" data-title="Cart" class="navlink px-3 m-2 btn btn-outline-light"><i class="fa-solid fa-cart-shopping"></i></a></li>';
					}

					if (isset($_SESSION['client']['status'])) { ?>
						<div class="btn-group">
							<button type="button" class="navlink px-3 m-2 btn btn-outline-light dropdown-toggle"
								data-bs-toggle="dropdown" aria-expanded="false">
								Old Book
							</button>

							<!-- newly changed -->
							<ul class="dropdown-menu px-1">
								<li><a class="dropdown-item navlink mb-1" href="old_book.php">Old Book Buy</a></li>
								<li><a class="dropdown-item navlink mb-1" href="add_old_book.php">Old Book
										Sell</a></li>
								<li><a class="dropdown-item navlink" href="old_book_post.php">My Sell
										Post</a></li>
							</ul>

						<?php } ?>

						<?php if (isset($_SESSION['client']['status'])) { ?>

								<li><a class="navlink px-3 m-2 btn btn-outline-light" data-title="contest" href="book_fest.php"><img src="assets/bookFest.png" style="width: 25px" alt=""></a></li>

						<?php }?>

						<li><a href="book_list.php" data-title="Book List" class="navlink px-3 m-2 btn btn-outline-light"><i
									class="fa-solid fa-book"></i></a></li>
				</ul>

				<h1 id="logo">Bibliophile's corner</h1>

				<div class="text-end">
					<?php
					if (isset($_SESSION['client']['status'])) {
						echo '<a href="profile.php" data-title="Profile" class="navlink px-3 m-2 btn btn-outline-light"><i class="fa-solid fa-user"></i></a>';

						if ($notify_count > 0) {
							echo '<a id="notify-button" data-title="Notification" class="navlink px-3 m-2 btn btn-outline-light" href="user_notifications.php"><i class="fa-solid fa-bell fa-shake"></i><span id="item-count" class="shadow">' . $notify_count . '</span></a>';
						} else {
							echo '<a class="navlink px-3 m-2 btn btn-outline-light" data-title="Notification" href="user_notifications.php"><i class="fa-solid fa-bell"></i></a>';
						}
						if ($message_count > 0) {
							echo '<a data-title="Message" id="message-button" class="navlink px-3 m-2 btn btn-outline-light" href="chat/users.php"><i class="fa-solid fa-message fa-beat"></i><span id="item-count" class="shadow">' . $message_count . '</span></a>';
						} else {
							echo '<a data-title="Message" class="navlink px-3 m-2 btn btn-outline-light" href="chat/users.php"><i class="fa-solid fa-message"></i></a>';
						}
						echo '<a data-title="Logout" href="logout.php" class=" btn btn-outline-warning px-3 m-2 me-2 "><i class="fa-solid fa-right-from-bracket"></i></a>';
					} else {
						echo '<a href="login.php" data-title="Login" class="navlink btn btn-outline-light px-3 m-2 me-2"><i class="fa-solid fa-right-to-bracket"></i></a>';
						echo '<a href="register.php" data-title="Sign up" class="navlink btn btn-outline-light px-3 m-2"><i class="fa-solid fa-user-plus"></i></a>';
					}
					?>
				</div>
			</div>
		</div>
	</header>