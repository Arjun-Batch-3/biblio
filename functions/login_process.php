<?php
    session_start();

    if (!empty($_POST)) 
    {
        extract($_POST);

        $_SESSION['error'] = array();

        // Check if username or password is empty
        if (empty($username)) 
        {
            $_SESSION['error'][] = "Please enter a user ID or Email";
            header("Location: ../login.php");
            exit();
        } 
        else 
        {
            if (empty($password)) 
            {
                $_SESSION['error'][] = "Please enter a password";
                header("Location: ../login.php");
                exit();
            } 
            else 
            {
                include("../includes/connection.php");

                // Query the database to check for valid credentials
                $query_username = "SELECT * FROM `register_table` WHERE `register_user_name` = '$username' OR `register_email` = '$username'";

                $result_username = mysqli_query($connection_database, $query_username);

                $value_of_username = mysqli_fetch_assoc($result_username);

                if (!empty($value_of_username)) 
                {
                    if($password == $value_of_username['register_password']) 
                    {
                        // User information
                        $_SESSION['client']['username'] = $value_of_username['register_user_name'];
                        $_SESSION['client']['id'] = $value_of_username['register_id'];
                        $_SESSION['client']['isReviewer'] = $value_of_username['is_verified_reviewer'];
                        $_SESSION['client']['status'] = true;
                        $_SESSION['message']['success'] = 'Welcome! '.$_SESSION['client']['username'];

                        // set status for active or not in messages
                        $status = "Active now";
                        $sql2 = mysqli_query($connection_database, "UPDATE register_table SET status = '{$status}' WHERE register_id = {$value_of_username['register_id']}");
        

                        // header("Location: ../index.php");
                        // exit();
                        if (isset($_SESSION['redirect_url'])) {
                            // Redirect to the saved URL
                            $redirect_url = $_SESSION['redirect_url'];
                            unset($_SESSION['redirect_url']); // Clear the redirect URL from session
                            header("Location: $redirect_url");
                            exit();
                        } else {
                            // Redirect to a default page if no redirect URL is set
                            header('Location: ../index.php');
                            exit();
                        }
                    } 
                    else 
                    {
                        $_SESSION['error'][] = "Wrong password";
                        header("Location: ../login.php");
                        exit();
                    }
                } 
                else 
                {
                    $_SESSION['error'][] = "Wrong user ID or Email";
                    header("Location: ../login.php");
                    exit();
                }
            }
        }
    } 
    else 
    {
        // No form submission data, redirect to login page
        header("Location: ../login.php");
        exit();
    }
?>
