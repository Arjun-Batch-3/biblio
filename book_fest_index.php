<?php
    session_start();
    include("includes/connection.php");
    include("functions/notification.php");

    display_notification_messages();
    display_notification_messages_sucesses();

    if(!isset($_SESSION['client']['status']))
    {
        // Store the current page URL in a session variable
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("location: login.php");
		exit();
    }
    if(isset($_SESSION['client']['book_fest_id'])){
        $user_id = $_SESSION['client']['id'];
        $book_fest_id = $_SESSION['client']['book_fest_id'];
        echo $book_fest_id;
        echo $user_id;
    }
?>
