<?php
    session_start();

    if (!empty($_POST)) 
    {
        extract($_POST);

        $_SESSION['error'] = array();

        // Check if email or password is empty
        if (empty($email)) 
        {
            $_SESSION['error'][] = "Please enter a Email";
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
                include("../../includes/connection.php");

                // Query the database to check for valid credentials
                $query_email = "SELECT * FROM `author_table` WHERE `author_email` = '$email'";

                $result_email = mysqli_query($connection_database, $query_email);

                $value_of_email = mysqli_fetch_assoc($result_email);

                if (!empty($value_of_email)) 
                {
                    if($password == $value_of_email['author_password']) 
                    {
                        if($value_of_email['is_verified'] == "1")
                        {
                            // User information
                            $_SESSION['client']['authorName'] = $value_of_email['author_full_name'];
                            $_SESSION['client']['authorId'] = $value_of_email['author_id'];
                            $_SESSION['client']['authorStatus'] = true;
                            $_SESSION['message']['success'] = 'Welcome! '.$_SESSION['client']['authorName'];

                            // set status for active or not in messages
                            $status = "Active now";
                            $sql2 = mysqli_query($connection_database, "UPDATE author_table SET status = '{$status}' WHERE author_id = {$value_of_email['author_id']}");
                            

                            header("Location: ../profile.php");
                            exit();
                        }
                        else
                        {
                            $_SESSION['error'][] = "Wait for verification";
                            header("Location: ../login.php");
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
