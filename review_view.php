<?php
include("includes/connection.php");
include("includes/header.php");
include("functions/notification.php");

if (!isset($_SESSION['client']['status'])) {
    // Store the current page URL in a session variable
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("location: login.php");
    exit();
}

if (!empty($_GET)) {
    $book_id = $_GET['id'];
}

display_notification_messages();
display_notification_messages_sucesses();


$review_query = "SELECT * FROM `book_review` AS `br` 
INNER JOIN `book_table` AS `bt` 
ON `br`.`book_id` = `bt`.`book_id`
INNER JOIN register_table as rt on br.reviewer_id = rt.register_id
WHERE `is_requested_review` = 0 AND is_approved = 1 AND `bt`.`book_id` = $book_id";
$review_result = mysqli_query($connection_database, $review_query);

$book_query = "SELECT * FROM `book_table` WHERE `book_id` = $book_id";
$book_result = mysqli_query($connection_database, $book_query);
$book_data = mysqli_fetch_assoc($book_result);
?>


<div class="container px-4 mt-4 min-vh-100">
    <!-- Book Details Section -->
    <div class="card mb-4 text-center">
        <div class=" mt-5">
            <img class="bd-placeholder-img img-fluid" width="130" height="200"
                src="<?php echo $book_data['book_img']; ?>" alt="Book Image">
        </div>
        <div class=" my-3" style="font-size:1.4rem;">
            <p class="mb-0"><strong>Book Name:</strong> <?php echo $book_data['book_name']; ?></p>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($review_result)) { ?>
            <div class="col-md-12 mb-4">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img class="bd-placeholder-img img-fluid rounded-circle" width="100" height="100"
                                src="<?php echo $row['register_profile_picture']; ?>" alt="Reviewer Profile Picture">
                        </div>
                        <div class="col-md-9">
                            <p style="color: #000;"><strong>Reviewer Name:</strong>
                                <?php echo $row['register_full_name']; ?></p>
                            <p><strong>Main Theme:</strong>
                                <?php echo (strlen($row['main_theme']) > 241) ? substr($row['main_theme'], 0, 241) . '...' : $row['main_theme']; ?>
                            </p>
                            <p><strong>Strength Analysis:</strong>
                                <?php echo (strlen($row['strength_analysis']) > 241) ? substr($row['strength_analysis'], 0, 241) . '...' : $row['strength_analysis']; ?>
                            </p>
                            <p><strong>Weakness Analysis:</strong>
                                <?php echo (strlen($row['weakness_analysis']) > 241) ? substr($row['weakness_analysis'], 0, 241) . '...' : $row['weakness_analysis']; ?>
                            </p>
                            <p><strong>Critical Evaluation:</strong>
                                <?php echo (strlen($row['critical_evaluation']) > 241) ? substr($row['critical_evaluation'], 0, 241) . '...' : $row['critical_evaluation']; ?>
                            </p>
                            <h6>Rating: <?php echo $row['overall_rating']; ?>/10 <i class="fa-solid fa-star"></i></h6>
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