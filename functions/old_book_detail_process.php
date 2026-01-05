<?php

    if (isset($_GET['id'])) {
        $book_id = intval($_GET['id']);
        $book_query = "SELECT * FROM `old_book` WHERE `book_id` = $book_id";
        $book_result = mysqli_query($connection_database, $book_query);
        $book_row = mysqli_fetch_assoc($book_result);

        $_SESSION['oldbook'] = $book_row;
    
        // Redirect to the same page to show the modal
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>