<?php
    session_start();

    include("../../includes/connection.php");

    // Check if the form has been submitted
    if (!empty($_POST)) 
    {
        // Extract form data into variables
        extract($_POST);

        $id = $_SESSION['client']['authorId'];
        $query = "SELECT * FROM `author_table` WHERE `author_id` = $id";
        $result_user_name = mysqli_query($connection_database, $query);
        $rows = mysqli_fetch_assoc($result_user_name);

        // Initialize an array to store error messages
        $_SESSION['error'] = array();

        // Validate Full Name
        if (empty($fullname)) 
        {
            $_SESSION['error'][] = "Please enter full name";
        }


        // Validate Password
        if (empty($password)) 
        {
            $_SESSION['error'][] = "Please enter password";
        } 
        else if (strlen($password) <= 7) 
        {
            $_SESSION['error'][] = "Please enter minimum 8 digit password";
        }

        // Validate E-Mail Address
        if (empty($email)) 
        {
            $_SESSION['error'][] = "Please enter E-Mail address";
        } 

        // Validate Contact Number
        if (empty($contact)) 
        {
            $_SESSION['error'][] = "Please enter contact number";
        } 
        else if (!is_numeric($contact)) 
        {
            $_SESSION['error'][] = "Please enter contact number in digits";
        }

        if (!empty($rows['author_profile_picture']))
		{	
	 		$img = $rows['author_profile_picture'];
		}

		if (!empty($_FILES['file']['name'])) 
		{
            $allowedExtensions = ['png', 'jpg', 'jpeg'];
            $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($fileExtension), $allowedExtensions)) 
            {
			    $_SESSION['error'][] = "Please upload a PNG or JPG image";
            } 
            else 
            {
                $random_new_name = uniqid();

                $new_name_for_file = $random_new_name . $_FILES['file']['name'];

                move_uploaded_file($_FILES['file']['tmp_name'], "../../author_img/" . $new_name_for_file);
			    $img = "author_img/" . $new_name_for_file;
            }
		}

        // If there are validation errors, redirect back to the registration page
        if (!empty($_SESSION['error'])) 
        {
            header("location: ../profile.php");
            exit();
        } 
        else 
        {
            // Insert user data into the database
            $query = "UPDATE author_table SET author_full_name='$fullname', author_description='$author_description', author_password='$password', author_contact_number='$contact', author_email='$email', author_profile_picture='$img' WHERE author_id=$id";
        
            mysqli_query($connection_database, $query);

            header("location: ../profile.php");
            exit();
        }
    } 
    else 
    {
        header("location: ../profile.php");
        exit();
    }
?>