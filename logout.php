<?php
    // Start or resume the PHP session
    session_start();
    include("includes/connection.php");
    $status = "Offline now";
    $sql = mysqli_query($connection_database, "UPDATE register_table SET status = '{$status}' WHERE register_id = {$_SESSION['client']['id']}");

    // Destroy the current session
    session_destroy();

    // Redirect the user to the "index.php" page
    header("location: index.php");

    exit();
?>