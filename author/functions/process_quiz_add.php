<?php
	session_start();

	include("../../includes/connection.php");

	if(!empty($_POST))
	{
		$_SESSION['error'] = array();

		extract($_POST);

        if (empty($question)) 
        {
            $_SESSION['error'][] = "Please enter question";
        }
        if (empty($choiceA)) 
        {
            $_SESSION['error'][] = "Please enter choiceA";
        }
        if (empty($choiceB)) 
        {
            $_SESSION['error'][] = "Please enter choiceB";
        }
        if (empty($choiceC)) 
        {
            $_SESSION['error'][] = "Please enter choiceC";
        }
        if (empty($choiceD)) 
        {
            $_SESSION['error'][] = "Please enter choiceD";
        }
        if (empty($answer)) 
        {
            $_SESSION['error'][] = "Please enter answer";
        }


        // If there are validation errors, redirect back to the registration page
        if (!empty($_SESSION['error'])) 
        {
            header("location: ../quiz_add.php");
            exit();
        } 
        else 
        {
            // Insert data into the database    
            $query = "INSERT INTO `review_request_quiz`(`review_request_id`, `question`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `answer`) VALUES ('$review_request_id' ,'$question', '$choiceA', '$choiceB', '$choiceC', '$choiceD', '$answer')";
            mysqli_query($connection_database, $query);
    
            header("location: ../review_request_questions_add.php");
            exit();
        }

	}
	else
	{
		header("location: ../review_request_questions_add.php");
		exit();
	}

?>