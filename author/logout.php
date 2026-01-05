<?php
    // Start or resume the PHP session
    session_start();
    include("../includes/connection.php");
    $status = "Offline now";
    $sql = mysqli_query($connection_database, "UPDATE author_table SET status = '{$status}' WHERE author_id = {$_SESSION['client']['authorId']}");

    // Destroy the current session
    session_destroy();

    // Redirect the user to the "index.php" page
    header("location: login.php");

    exit();
?>