<?php
include("includes/header.php");
include("includes/connection.php");
include("functions/notification.php");
// for modal
include("functions/old_book_detail_process.php");

if (!isset($_SESSION['client']['status'])) {
    header("location: login.php");
    exit();
}


if (!empty($_POST['bid_price'])) {
    $bid_price = $_POST['bid_price'];
    $bid_book_id = $_POST['bid_book_id'];
    $bid_address = $_POST['bid_address'];
    $user_id = $_SESSION['client']['id'];

    $bid_query = "SELECT * FROM `old_book` WHERE `book_id` = $bid_book_id";
    $bid_result = mysqli_query($connection_database, $bid_query);
    $bid_row = mysqli_fetch_assoc($bid_result);

    if ($bid_row['bid_price'] < $bid_price) {
        $querys = "UPDATE `old_book` SET `bid_price` = '$bid_price', `bid_id` = '$user_id', `bid_address` = '$bid_address' WHERE `book_id` = $bid_book_id";
        mysqli_query($connection_database, $querys);

        header("location: old_book.php?id=" . $bid_row['book_id']);
        exit();
    }

}


display_notification_messages();

$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

$user_id = $_SESSION['client']['id'];

$selected_category = isset($_POST['bookcategory']) ? $_POST['bookcategory'] : 'All Category';
$selected_author = isset($_POST['book_author']) ? $_POST['book_author'] : 'All Author';

// Fetch books based on the selected category
if ($selected_category == 'All Category' && $selected_author == 'All Author') {
    $query = "SELECT * FROM `old_book` WHERE `book_name` LIKE '%$search%' AND `post_id` != '$user_id' AND `is_sold` = '0' ORDER BY `book_name`";
    $result = mysqli_query($connection_database, $query);
} else if ($selected_category != 'All Category' && $selected_author == 'All Author') {
    $query = "SELECT * FROM `old_book` WHERE `book_category` = '$selected_category' AND `book_name` LIKE '%$search%' AND `post_id` != '$user_id' AND `is_sold` = '0' ORDER BY `book_name`";
    $result = mysqli_query($connection_database, $query);
} else if ($selected_category == 'All Category' && $selected_author != 'All Author') {
    $query = "SELECT * FROM `old_book` WHERE `author_id` = '$selected_author' AND `book_name` LIKE '%$search%' AND `post_id` != '$user_id' AND `is_sold` = '0' ORDER BY `book_name`";
    $result = mysqli_query($connection_database, $query);
} else {
    $query = "SELECT * FROM `old_book` WHERE `book_category` = '$selected_category' AND `author_id` = '$selected_author' AND `book_name` LIKE '%$search%' AND `post_id` != '$user_id' AND `is_sold` = '0' ORDER BY `book_name`";
    $result = mysqli_query($connection_database, $query);
}


#category data
$category_query = "SELECT * FROM `category_table`";
$category_result = mysqli_query($connection_database, $category_query);

// author data
$author_query = "SELECT `author_id`, `author_full_name` FROM `author_table` WHERE `is_verified` = '1'";
$author_result = mysqli_query($connection_database, $author_query);


?>

<header class="d-flex justify-content-center py-3">
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <?php if (isset($_SESSION['oldbook'])) {
                    $oldbook = $_SESSION['oldbook'];
                    ?>

                    <div class="modal-header">

                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel"><?php echo $oldbook['book_name']; ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="d-flex">
                            <img class="" width="200" height="300" src="<?php echo $oldbook['book_img'] ?>">
                            <div class="ms-5">
                                <h6><span class="fw-bold">Category:</span> <?php echo $oldbook['book_category'] ?></h6>
                                <h6><span class="fw-bold">Price:</span> <?php echo $oldbook['book_price'] ?></h6>
                                <h6><span class="fw-bold">Pickup Address:</span> <?php echo $oldbook['pickup_address'] ?></h6>
                                <h6><span class="fw-bold">Exchange Condition:</span> <?php echo $oldbook['exchange_condition'] ?></h6>
                                <h5><span class="fw-bold">Bid:</span> <?php echo $oldbook['bid_price'] ?></h5>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <form class="mx-auto w-75 border-sm-start-none border-end" action="old_book.php" method="POST">
                            <input class="d-none" type="text" name="bid_book_id" value="<?php echo $oldbook['book_id'] ?>">
                            <input class="form-control mb-3" type="number" name="bid_price" placeholder="Bid Price"
                                aria-label="Bid Price">
                            <input class="form-control mb-3" type="text" name="bid_address"
                                placeholder="Address if delivery required" aria-label="Bid address">
                            <div>
                                <button class="btn btn-primary" type="submit">Bidd</button>
                            </div>


                        </form>


                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <a href="functions/old_book_exchange.php?id=<?php echo $oldbook['book_id'] ?>" data-mdb-button-init
                            data-mdb-ripple-init class="btn btn-outline-danger btn-sm mt-2" type="button">Exchange</a>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>

    <!-- mosal -->




    <form action="old_book.php" method="POST" class="mt-5 d-flex flex-row align-items-center">

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
</header>

<div class="py-3">
    <div class="container min-vh-100">
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-3 mb-5">
                    <a class="link-offset-2 link-underline link-underline-opacity-0"
                        href="old_book.php?id=<?php echo $row['book_id']; ?>">
                        <div class="card shadow-sm">
                            <img class="bd-placeholder-img card-img-top" width="75" height="400"
                                src="<?php echo $row['book_img']; ?>">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class=""><?php echo $row['book_name']; ?></small>
                                    <small class=""><?php echo $row['book_price']; ?> TK</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
// Automatically show the modal if the session has book details
if (isset($_SESSION['oldbook'])) {
    echo "<script type='text/javascript'>
        $(document).ready(function(){
            $('#staticBackdrop').modal('show');
        });
      </script>";
    // Clear the session data after showing the moadl
    unset($_SESSION['oldbook']);
}
?>

<?php
include("includes/footer.php");
?>