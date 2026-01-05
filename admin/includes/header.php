<?php
ob_start();
session_start();

if (!isset($_SESSION['admin']['status'])) {
  header("location: login.php");
  exit();
}
date_default_timezone_set("Asia/Dhaka");

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon.png">
  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <header class="header pt-2">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a class="navlink px-3 m-2 btn btn-outline-light" href="index.php"><i class="fa-solid fa-user-gear"></i></a></li>
          <li><a class="navlink px-3 m-2 btn btn-outline-light" href="../admin/order_view.php"><i class="fa-solid fa-cart-plus"></i></a></li>
          <li><a class="navlink px-3 m-2 btn btn-outline-light" href="../admin/users_view.php"><i class="fa-solid fa-users"></i></a></li>
          <li class="btn-group">
            <button class="navlink px-3 m-2 btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-book"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item navlink btn btn-outline-light" href="../admin/book_add.php">Add books</a></li>
              <li><a class="dropdown-item navlink btn btn-outline-light" href="../admin/book_view.php">View books</a></li>
              <li><a class="dropdown-item navlink btn btn-outline-light" href="../admin/book_review.php">Book Review</a></li>
            </ul>
          </li>
          <li class="btn-group">
            <button class="navlink px-3 m-2 btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-layer-group"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../admin/category_add.php">Add categorys</a></li>
              <li><a class="dropdown-item" href="../admin/category_view.php">View categorys</a></li>
            </ul>
          </li>
          <li class="btn-group">
            <button class="navlink px-3 m-2 btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-feather-pointed"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item navlink btn btn-outline-light" href="../admin/author_add.php">Add Author</a></li>
              <li><a class="dropdown-item navlink btn btn-outline-light" href="../admin/author_view.php">View Author</a></li>
            </ul>
          </li>
          <li><a class="navlink px-3 m-2 btn btn-outline-light" href="../admin/quiz_add.php"><i class="fa-solid fa-clipboard-question"></i></a></li>
        

          <li class="btn-group">
            <button class="navlink px-3 m-2 btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/bookFest.png" style="width: 25px" alt="">
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item navlink btn btn-outline-light" href="../admin/book_fest_add.php">Add Book Fest</a></li>
              <li><a class="dropdown-item navlink btn btn-outline-light" href="../admin/book_fest_contest.php">Book Fest Contest</a></li>
            </ul>
          </li>
        
        </ul>

        <div class="text-end">
          <a class="navlink px-3 mt-0 btn btn-outline-light" href="../admin/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
      </div>
    </div>
  </header>