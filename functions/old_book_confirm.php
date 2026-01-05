<?php

	session_start();
	
	include("../includes/connection.php");

    $old_book_id = $_GET['id'];

	$query = "UPDATE `old_book` SET `is_sold` = '1' WHERE `book_id` = '$old_book_id'";
	$result = mysqli_query($connection_database, $query);



	$order_query = "SELECT * FROM register_table AS r INNER JOIN old_book AS o ON r.register_id = o.bid_id WHERE o.book_id = $old_book_id";
	$order_result = mysqli_query($connection_database, $order_query);
	$order_row = mysqli_fetch_assoc($order_result);


	$notification_buyer ="
	Order Details: - Plese wait for pickup <br><br>
	Buyer Name: {$order_row['register_full_name']} <br>
	Buyer Nuimber: {$order_row['register_contact_number']}<br>
	Buyer Email: {$order_row['register_email']}<br>
	Book Name: {$order_row['book_name']}<br>
	Book Price: {$order_row['bid_price']}<br>
	Pickup Address: {$order_row['pickup_address']}<br>
	Delivery Address: {$order_row['bid_address']}
	";

	$notification_seller ="
	Your order Confirmed: - Thank you for your order<br><br>
	Buyer Name: {$order_row['register_full_name']}<br>
	Buyer Nuimber: {$order_row['register_contact_number']}<br>
	Buyer Email: {$order_row['register_email']}<br>
	Book Name: {$order_row['book_name']}<br>
	Book Price: {$order_row['bid_price']}<br>
	Pickup Address: {$order_row['pickup_address']}<br>
	Delivery Address: {$order_row['bid_address']}
	";

	$time = time();

	$query1 = "INSERT INTO `notifications`(`user_id`, `messege`, `notify_time`) VALUES ('{$order_row['post_id']}', '$notification_buyer', '$time')";
	mysqli_query($connection_database, $query1);

	$query2 = "INSERT INTO `notifications`(`user_id`, `messege`, `notify_time`) VALUES ('{$order_row['bid_id']}', '$notification_seller', '$time')";
	mysqli_query($connection_database, $query2);


	header("location: ../user_notifications.php");
	exit();
?>