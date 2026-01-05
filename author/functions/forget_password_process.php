<?php
session_start();

if (!empty($_POST)) {
    // Extract form data into variables
    extract($_POST);
    $_SESSION['error'] = array();
    if (empty($email)) {
        $_SESSION['error'][] = "Please enter Email";
    }


    include("../../includes/connection.php");

    if (!empty($_SESSION['error'])) {
        header("location: ../forget_password.php");
        exit();
    } else {
        $password = rand(10000000, 99999999);
        // Insert user data into the database
        $query = "UPDATE author_table SET author_password='$password' WHERE author_email='$email'";
        $result = mysqli_query($connection_database, $query);


        if ($result) {
            require "../../phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->FromName = 'Bibliophile\'s corner';

            // h-hotel account
            $mail->Username = 'bibliophilescornerr@gmail.com';
            $mail->Password = 'plqythmxddftuivt';

            // send by h-hotel email
            //$mail->setFrom('email', 'Password Reset');
            // get email from input
            $mail->addAddress($email);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject = "Your Password is Reset";
            $mail->Body = "<b>Dear Author</b>
            <h3>Your Password is Reset successfully!</h3>
            <p>Your temporary Password is: {$password}</p>
            <p>Please change your password after login</p>
            <br>
            <p>Best regards,</p>
            <b>Bibliophile's corner</b><br>
            <b>bibliophilescornerr@gmail.com</b>";

            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message sent!";
                $_SESSION['message']['success'] = "Password Reset Successfully. Please check your email.";
            }
        }
        header("location: ../login.php");
        exit();
    }
} else {
    header("location: ../forget_password.php");
    exit();
}
