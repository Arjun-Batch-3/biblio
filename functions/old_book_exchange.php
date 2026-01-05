<?php

	session_start();
	
	include("../includes/connection.php");

    $old_book_id = $_GET['id'];
    $buyer_id = $_SESSION['client']['id'];

	$order_query = "SELECT * FROM old_book AS o WHERE o.book_id = $old_book_id";
	$order_result = mysqli_query($connection_database, $order_query);
	$order_row = mysqli_fetch_assoc($order_result);

	$message_seller ="
	I want to exchange with<br>
	Book Name: {$order_row['book_name']}<br>
	Book Price: {$order_row['book_price']}<br>
	Exchange Condition: {$order_row['exchange_condition']}<br>
	";

	$query1 = "INSERT INTO `old_book_messages`(`incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES ('{$order_row['post_id']}', '$buyer_id', '$message_seller')";
	mysqli_query($connection_database, $query1);

	header("location: ../chat/chat.php?user_id=".$order_row['post_id']);
	exit();
?>