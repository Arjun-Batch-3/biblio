<?php
    session_start();

    if (!empty($_POST)) 
    {
        extract($_POST);

        $_SESSION['error'] = array();

        // Check if Full Name empty
        if (empty($fullname)) 
        {
            $_SESSION['error'][] = "Enter full name";
        }

        // Check if Full Address empty
        if (empty($address)) 
        {
            $_SESSION['error'][] = "Enter full address";
        }

        // Check if  Zipcode is empty
        if (empty($zipcode)) 
        {
            $_SESSION['error'][] = "Enter zipcode";
        }

        // Check if district is empty
        if (empty($district)) 
        {
            $_SESSION['error'][] = "Enter district";
        }

        // Check if thana is empty
        if (empty($thana)) 
        {
            $_SESSION['error'][] = "Enter thana";
        }

        // Check if Mobile Number is empty
        if (empty($mobile_number)) 
        {
            $_SESSION['error'][] = "Enter mobile number";
        } 

        // Check if Total price is empty
        if($_SESSION['client']['order_total_price'] <= 0)
        {
            $_SESSION['error'][] = "Cart is empty";
            header("location: ../book_list.php");
            exit();
        }

        if (!empty($_SESSION['error'])) 
        {
            // Redirect to 'order.php' with an error message
            header("location: ../order.php");
            exit();
        } 
        else 
        {
            include("../includes/connection.php");

            // Get the user ID from the session
            $register = $_SESSION['client']['id'];
            $total_price = $_SESSION['client']['order_total_price'];
            $book_name = $_SESSION['client']['order_books_name'];

            // Prepare and execute the SQL query to insert the order data into the database
            $query = "INSERT INTO `order_table`(`order_name`, `order_address`, `order_zipcode`, `order_district`, `order_thana`, `order_mobile`, `order_register_id`, `order_total_price`, `order_list_books`) VALUES ('$fullname', '$address', '$zipcode', '$district', '$thana', '$mobile_number', '$register', '$total_price', '$book_name')";
            mysqli_query($connection_database, $query);


            //empty cart
            unset($_SESSION['cart']);
            // Redirect to 'payment.php' with the total price as a parameter
            header("location: ../payment.php");
            exit();
        }
    } 
    else 
    {
        // Redirect to 'order.php' with an empty error message
        header("location: ../order.php");
        exit();
    }
?>
