<?php
	session_start();
	
	include("../../includes/connection.php");

	$author_id = $_GET['id'];

    $author_query = "SELECT * FROM author_table WHERE author_id = $author_id";
	$author_result = mysqli_query($connection_database, $author_query);
	$author_row = mysqli_fetch_assoc($author_result);

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
    $mail->addAddress($author_row['author_email']);
    //$mail->addReplyTo('lamkaizhe16@gmail.com');

    // HTML body
    $mail->isHTML(true);
    $mail->Subject="Your Author Account is Verified";
    $mail->Body="<b>Dear {$author_row['author_full_name']}</b>
    <h3>Thank you for Creating an Account!</h3>
    <p>Your account has been verified. You can now login.</p>
    <br><br>
    <p>Best regards,</p>
    <b>Bibliophile's corner</b><br>
    <b>bibliophilescornerr@gmail.com</b>";

    if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
        echo "Message sent!";
    }

    $query = "UPDATE `author_table` SET `is_verified` = '1' WHERE `author_id` = '$author_id'";
    $result = mysqli_query($connection_database, $query);


	header("location: ../author_add.php");
	exit();
?>