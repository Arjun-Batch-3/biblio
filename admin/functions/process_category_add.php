<?php

	session_start();

	if(!empty($_POST))
	{
		$_SESSION['error'] = array();

		extract($_POST);

        // Validate  category
        if (empty($category)) 
        {
            $_SESSION['error'][] = "Please enter Category name";
        }



		if(!empty($_SESSION['error']))
		{
			header("location: ../category_add.php");
			exit();
		}
		else
		{
			include("../../includes/connection.php");

			$query = "INSERT INTO `category_table`(`category_name`) VALUES ('$category')";

			mysqli_query($connection_database, $query);

			header("location: ../category_view.php");
			exit();
		}
	}
	else
	{
		header("location: category.php");
		exit();
	}

?>