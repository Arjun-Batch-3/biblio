<?php
    // Start a session
    session_start();

    // Check if the form has been submitted
    if (!empty($_POST)) 
    {
        // Extract form data into variables
        extract($_POST);
        
        // Initialize an array to store error messages
        $_SESSION['error'] = array();

        // Validate Full Name
        if (empty($fullname)) 
        {
            $_SESSION['error'][] = "Please enter full name";
        }

        // Validate Password
        if (empty($password) || empty($confirm_password)) 
        {
            $_SESSION['error'][] = "Please enter password";
        } 
        else if ($password != $confirm_password) 
        {
            $_SESSION['error'][] = "Password isn't match";
        } 
        else if (strlen($password) <= 7) 
        {
            $_SESSION['error'][] = "Please enter minimum 8 letters password";
        }

        // Validate E-Mail Address
        if (empty($email)) 
        {
            $_SESSION['error'][] = "Please enter E-Mail address";
        } 

        // Validate verifcation_info
        if (empty($verifcation_info)) 
        {
            $_SESSION['error'][] = "Please enter verifcation_info";
        }

        // Validate Contact Number
        if (empty($contact_number)) 
        {
            $_SESSION['error'][] = "Please contact number";
        } 
        elseif (!is_numeric($contact_number)) 
        {
            $_SESSION['error'][] = "Please enter contact number in digits";
        }

        // If there are validation errors, redirect back to the registration page
        if (!empty($_SESSION['error'])) 
        {
            header("location: ../register.php");
            exit();
        } 
        else 
        {
            // Include a database connection
            include("../../includes/connection.php");

            // Get the current 
            $time = time();

            // Insert user data into the database
            $query = "INSERT INTO `author_table`(`author_full_name`, `author_password`, `author_contact_number`, `author_email`, `verifcation_info`, `author_time`) VALUES ('$fullname', '$password', '$contact_number', '$email', '$verifcation_info', '$time')";

            mysqli_query($connection_database, $query);

            // Redirect to the login page
            $_SESSION['message']['success'] = "Signed up! wait for verification";
            header("location: ../login.php");
            exit();
        }
    } 
    else 
    {
        // If the form was not submitted, redirect to the registration page
        header("location: ../register.php");
        exit();
    }
?>
