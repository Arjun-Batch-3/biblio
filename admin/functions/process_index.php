<?php

	$query_length_of_users = "SELECT * FROM `register_table`";
	$result_users_table = mysqli_query($connection_database, $query_length_of_users);
	$users_result = mysqli_num_rows($result_users_table);

	$query_length_of_books = "SELECT * FROM `book_table`";
	$result_books_table = mysqli_query($connection_database, $query_length_of_books);
	$books_result = mysqli_num_rows($result_books_table);


	$query_length_of_author = "SELECT * FROM `author_table`";
	$result_order_author = mysqli_query($connection_database, $query_length_of_author);
	$author_result = mysqli_num_rows($result_order_author);

	$query_length_of_old_book = "SELECT * FROM `old_book`";
	$result_old_book = mysqli_query($connection_database, $query_length_of_old_book);
	$old_book_result = mysqli_num_rows($result_old_book);

	$query_length_of_book_fest = "SELECT * FROM `book_fest`";
	$result_book_fest = mysqli_query($connection_database, $query_length_of_book_fest);
	$book_fest_result = mysqli_num_rows($result_book_fest);

	$query_length_of_book_review = "SELECT * FROM `book_review`";
	$result_book_review = mysqli_query($connection_database, $query_length_of_book_review);
	$book_review_result = mysqli_num_rows($result_book_review);

	$query_length_of_paintings = "SELECT * FROM `paintings`";
	$result_paintings = mysqli_query($connection_database, $query_length_of_paintings);
	$paintings_result = mysqli_num_rows($result_paintings);

	$dataPoints = array(
		array("label"=> "Users", "y"=> $users_result),
        array("label"=> "Authors", "y"=> $author_result),
		array("label"=> "Books", "y"=> $books_result),
		array("label"=> "Old Book", "y"=> $old_book_result),
		array("label"=> "Book Reviews", "y"=> $book_review_result),
		array("label"=> "Book Fests", "y"=> $book_fest_result),
		array("label"=> "Paintings", "y"=> $paintings_result),
	);