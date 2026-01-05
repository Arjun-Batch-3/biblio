<?php
    session_start();
    include("../../includes/connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        extract($_POST);
        $author_id = $_SESSION['client']['authorId'];
        $sql_cover_design_req = "INSERT INTO cover_design_req (author_id, book_name, cover_design_description, book_fest_id) VALUES ('$author_id', '$book_name', '$book_description', '$book_fest_id')";
        $connection_database->query($sql_cover_design_req);
        $_SESSION['message']['success'] = "Inserted Successfully";
    }
    header("Location: ../book_fest.php");
    exit();
    
?>