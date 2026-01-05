<?php
    session_start();
    include("../../includes/connection.php");
    if (isset($_GET['id'])) {
        $book_id = intval($_GET['id']);
        $review_query_rr = "SELECT * FROM `book_review` AS `br` 
        INNER JOIN `review_request` AS `rr` 
        ON `br`.`book_id` = `rr`.`id` INNER JOIN register_table as rt on br.reviewer_id = rt.register_id
        WHERE `is_requested_review` = 1 and is_approved = 1 and `rr`.`id` = '$book_id'";
        $review_result_rr = mysqli_query($connection_database, $review_query_rr);
        $review_result_rr_data = mysqli_fetch_assoc($review_result_rr);

        $_SESSION['requestedReview'] = $review_result_rr_data;
        $num = mysqli_num_rows($review_result_rr);
        if($num == 0){
            $_SESSION['error'] = array();
            $_SESSION['error'][] = "Not Yet Reviewed";

        }
    
        header("Location: ../review_request.php");
        exit();
    }
?>