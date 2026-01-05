<?php
    // Start a session
    session_start();
    // Include a database connection
    include("../includes/connection.php");


    // Check if the form has been submitted
    if (!empty($_POST)) 
    {

        // Extract form data into variables
        extract($_POST);
        
        // Initialize an array to store error messages
        $_SESSION['error'] = array();



        // Validate E-Mail Address
        $emailCheck= "SELECT * FROM register_table  WHERE register_email='$email'";
        $result = mysqli_query($connection_database,$emailCheck);
        $num = mysqli_num_rows($result);
        if($num == 1){
            echo "Email already exists";
            $_SESSION['error'][] = "E-Mail address already exists";
            header("location: ../register.php");
            exit();
        }
        // Validate User Name
        $usernameCheck= "SELECT * FROM register_table  WHERE register_user_name='$username'";
        $result = mysqli_query($connection_database,$usernameCheck);
        $num = mysqli_num_rows($result);
        if($num == 1){
            echo "Email already exists";
            $_SESSION['error'][] = "User name already exists";
            header("location: ../register.php");
            exit();
        }






        // Validate Full Name
        if (empty($fullname)) 
        {
            $_SESSION['error'][] = "Please enter full name";
        }

        // Validate User Name
        if (empty($username)) 
        {
            $_SESSION['error'][] = "Please enter user name";
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

        // Validate Security Answer
        if (empty($answer)) 
        {
            $_SESSION['error'][] = "Please enter security answer";
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
            // Get the current 
            $time = time();

            // Insert user data into the database
            $query = "INSERT INTO `register_table`(`register_full_name`, `register_user_name`, `register_password`, `register_contact_number`, `register_email`, `register_question`, `register_answer`, `register_time`) VALUES ('$fullname', '$username', '$password', '$contact_number', '$email', '$question', '$answer', '$time')";

            mysqli_query($connection_database, $query);

            // Redirect to the login page
            $_SESSION['message']['success'] = "You are signed up";
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
