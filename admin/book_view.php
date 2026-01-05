<?php
include("includes/header.php");
include("../includes/connection.php");
include("functions/process_book_view.php");

$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}


$selected_category = isset($_POST['bookcategory']) ? $_POST['bookcategory'] : 'All Category';
$selected_author = isset($_POST['book_author']) ? $_POST['book_author'] : 'All Author';

// Fetch books based on the selected category
if ($selected_category == 'All Category' && $selected_author == 'All Author') {
    $query = "SELECT * FROM `book_table` WHERE `book_name` LIKE '%$search%' ORDER BY `book_name`";
    $book_list_result = mysqli_query($connection_database, $query);
} else if ($selected_category != 'All Category' && $selected_author == 'All Author') {
    $query = "SELECT * FROM `book_table` WHERE `book_category` = '$selected_category' AND `book_name` LIKE '%$search%' ORDER BY `book_name`";
    $book_list_result = mysqli_query($connection_database, $query);
} else if ($selected_category == 'All Category' && $selected_author != 'All Author') {
    $query = "SELECT * FROM `book_table` WHERE `author_id` = '$selected_author' AND `book_name` LIKE '%$search%' ORDER BY `book_name`";
    $book_list_result = mysqli_query($connection_database, $query);
} else {
    $query = "SELECT * FROM `book_table` WHERE `book_category` = '$selected_category' AND `author_id` = '$selected_author' AND `book_name` LIKE '%$search%' ORDER BY `book_name`";
    $book_list_result = mysqli_query($connection_database, $query);
}


#category data
$category_query = "SELECT * FROM `category_table`";
$category_result = mysqli_query($connection_database, $category_query);

// author data
$author_query = "SELECT `author_id`, `author_full_name` FROM `author_table` WHERE `is_verified` = '1'";
$author_result = mysqli_query($connection_database, $author_query);
?>

<div class="px-md-4 min-vh-100">
    <div class="d-flex justify-content-center align-items-center">
        <form action="book_view.php" method="POST" class="mt-5 d-flex flex-row align-items-center">
            <div class="form-group me-2">
                <!-- <label class="small mb-1">Category</label> -->
                <select name="bookcategory" class="form-control">
                    echo '<option value="All Category">All Category</option>';
                    <?php
                    while ($category_row = mysqli_fetch_assoc($category_result)) {
                        echo '<option value="' . $category_row['category_name'] . '">' . $category_row['category_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group me-2">
                <!-- <label class="small mb-1">Author</label> -->
                <select name="book_author" class="form-control">
                    echo '<option value="All Author">All author</option>';
                    <?php
                    while ($author_row = mysqli_fetch_assoc($author_result)) {
                        echo '<option value="' . $author_row['author_id'] . '">' . $author_row['author_full_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group me-2 mt-3">
                <input class="form-control mb-3" type="text" name="search" placeholder="Search" aria-label="Search">
            </div>
            <div>
                <button class="btn btn-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>

    </div>
    <br>


    <?php while ($row = mysqli_fetch_assoc($book_list_result)) { ?>

        <div class="row justify-content-center mb-3">
            <div class="col-md-12 col-xl-10">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                    <img src="../<?php echo $row['book_img']; ?>"
                                        class="w-25" />
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <h5><?php echo $row['book_name']; ?></h5>
                                <div class="mt-1 mb-0 small">
                                    <span>Details</span>
                                    <h6>Category: <?php echo $row['book_category'] ?></h6>
                                    <h6>Price: <?php echo $row['book_price'] ?></h6>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                <div class="d-flex flex-column mt-4">
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm mb-1" href="book_edit.php?id=<?php echo $row['book_id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger btn-sm mt-1" onclick="return confirm('Are you sure you want to delete?');" href="functions/process_book_del.php?id=<?php echo $row['book_id'] ?>"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

</div>


</div>
<?php
include("includes/footer.php");
?>