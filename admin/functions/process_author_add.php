<?php
	session_start();

	include("../../includes/connection.php");

	if(!empty($_POST))
	{
		$_SESSION['error'] = array();

		extract($_POST);

        // Validate  Name
        if (empty($author_name)) 
        {
            $_SESSION['error'][] = "Please enter full name";
        }

        // Validate  description
        if (empty($author_description)) 
        {
            $_SESSION['error'][] = "Please enter description";
        }

        if (empty($_FILES['author_img']['name']))
        {
            $_SESSION['error'][] = "Please enter Photo";
        }



        // If there are validation errors, redirect back to the registration page
        if (!empty($_SESSION['error'])) 
        {
            header("location: ../author_add.php");
            exit();
        } 
        else 
        {
            // Insert user data into the database
            $time = time();

            $random_number_name = uniqid();
    
            $new_name_file = $random_number_name . $_FILES['author_img']['name'];
    
            move_uploaded_file($_FILES['author_img']['tmp_name'], "../../author_img/" . $new_name_file);
            $author_img = "author_img/" . $new_name_file;
    
            $query = "INSERT INTO `author_table`(`author_full_name`, `author_description`, `author_profile_picture`, `author_time`, `is_verified`) VALUES ('$author_name', '$author_description', '$author_img', '$time', '1')";
            mysqli_query($connection_database, $query);
    
            header("location: ../author_view.php");
            exit();
        }

	}
	else
	{
		header("location: ../author_add.php");
		exit();
	}

?>