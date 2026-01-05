<?php
	session_start();
	
	include("../../includes/connection.php");

	$order_id = $_GET['id'];

    // $order_query = "SELECT * FROM `order_table` WHERE `order_id` = " . $_GET['id'] . ";";
	// $order_result = mysqli_query($connection_database, $order_query);
	// $order_row = mysqli_fetch_assoc($order_result);

    $order_query = "SELECT * FROM register_table AS r INNER JOIN order_table AS o ON r.register_id = o.order_register_id WHERE o.order_id = $order_id";
	$order_result = mysqli_query($connection_database, $order_query);
	$order_row = mysqli_fetch_assoc($order_result);

    require "../../phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->FromName='Bibliophile\'s corner';

    // h-hotel account
    $mail->Username='bibliophilescornerr@gmail.com';
    $mail->Password='plqythmxddftuivt';

    // send by h-hotel email
    //$mail->setFrom('email', 'Password Reset');
    // get email from input
    $mail->addAddress($order_row['register_email']);
    //$mail->addReplyTo('lamkaizhe16@gmail.com');

    // HTML body
    $mail->isHTML(true);
    $mail->Subject="Your Order is Confirmed";
    $mail->Body="<b>Dear {$order_row['register_full_name']}</b>
    <h3>Thank you for your order!</h3>
    <p>We are pleased to confirm your order with the following details:.</p>
    <p>Books:  {$order_row['order_list_books']}</p>
    <p>Price:  {$order_row['order_total_price']}</p>

    <br><br>
    <p>Best regards,</p>
    <b>Bibliophile's corner</b><br>
    <b>bibliophilescornerr@gmail.com</b>";

    if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
        echo "Message sent!";
    }

    $query = "UPDATE `order_table` SET `is_confirmed` = '1' WHERE `order_id` = '$order_id'";
    $result = mysqli_query($connection_database, $query);


	header("location: ../order_view.php");
	exit();
?>