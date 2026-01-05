<?php
include("includes/header.php");
include("../includes/connection.php");
include("../functions/notification.php");

if (!empty($_GET)) {
    if (isset($_GET['approveId'])){
        $id = $_GET['approveId'];
        $query = "UPDATE `book_review` SET `is_approved` = 1 WHERE `id` = $id";
        mysqli_query($connection_database, $query);
        $_SESSION['message']['success'] = "Review approved successfully!";
    }
    elseif (isset($_GET['deleteId'])){
        $id = $_GET['deleteId'];
        $query = "DELETE FROM `book_review` WHERE `id` = $id";
        mysqli_query($connection_database, $query);
        $_SESSION['message']['success'] = "Review deleted successfully!";
    }
}
display_notification_messages();
display_notification_messages();
display_notification_messages_sucesses();

$review_query = "SELECT * FROM `book_review` AS `br`
INNER JOIN register_table as rt on br.reviewer_id = rt.register_id
INNER JOIN book_table as bt on br.book_id = bt.book_id
WHERE br.is_approved = 0 AND br.is_requested_review = 0";
$review_result = mysqli_query($connection_database, $review_query);

$review_query2 = "SELECT br.id as brid, rt.register_full_name,
rr.book_name, rr.book_category, rr.book_img, rt.register_profile_picture,
br.main_theme,br.strength_analysis, br.weakness_analysis, br.critical_evaluation, br.overall_rating
FROM `book_review` AS `br`
INNER JOIN register_table as rt on br.reviewer_id = rt.register_id
INNER JOIN review_request as rr on br.book_id = rr.id
WHERE br.is_approved = 0 AND br.is_requested_review = 1";
$review_result2 = mysqli_query($connection_database, $review_query2);

?>


<div class="container px-4 mt-4 min-vh-100">
    
    <!-- Reviews Section -->
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($review_result)) { ?>
            <div class="col-md-12 mb-4">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-3 text-center d-flex flex-column align-items-center">
                            <img class="bd-placeholder-img img-fluid rounded-circle" width="100" height="100" src="../<?php echo $row['register_profile_picture']; ?>" alt="Reviewer Profile Picture">
                            <a class="btn optionalBtn mt-3" href="book_review.php?approveId=<?php echo $row['id'] ?>">Approve</a>
                            <a class="btn secondaryBtn mt-2" onclick="return confirm('Are you sure you want to delete?');" href="book_review.php?deleteId=<?php echo $row['id'] ?>">Delete</a>
                        </div>
                        <div class="col-md-9" style="color: rgb(173 104 247);">
                            <p><strong>For: </strong> Regular Book</p>
                            <p><strong>Book Name:</strong> <?php echo $row['book_name']; ?></p>
                            <p><strong>Book Category:</strong> <?php echo $row['book_category']; ?></p>
                            <img class="bd-placeholder-img img-fluid" width="100" height="100" src="../<?php echo $row['book_img']; ?>" alt="Book Image">
                            <p><strong>Reviewer Name:</strong> <?php echo $row['register_full_name']; ?></p>
                            <p><strong>Main Theme:</strong> <?php echo (strlen($row['main_theme']) > 241) ? substr($row['main_theme'], 0, 241) . '...' : $row['main_theme']; ?></p>
                            <p><strong>Strength Analysis:</strong> <?php echo (strlen($row['strength_analysis']) > 241) ? substr($row['strength_analysis'], 0, 241) . '...' : $row['strength_analysis']; ?></p>
                            <p><strong>Weakness Analysis:</strong> <?php echo (strlen($row['weakness_analysis']) > 241) ? substr($row['weakness_analysis'], 0, 241) . '...' : $row['weakness_analysis']; ?></p>
                            <p><strong>Critical Evaluation:</strong> <?php echo (strlen($row['critical_evaluation']) > 241) ? substr($row['critical_evaluation'], 0, 241) . '...' : $row['critical_evaluation']; ?></p>
                            <h6>Rating: <?php echo $row['overall_rating']; ?>/10 <i class="fa-solid fa-star"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php while ($row = mysqli_fetch_assoc($review_result2)) { ?>
            <div class="col-md-12 mb-4">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-3 text-center d-flex flex-column align-items-center">
                            <img class="bd-placeholder-img img-fluid rounded-circle" width="100" height="100" src="../<?php echo $row['register_profile_picture']; ?>" alt="Reviewer Profile Picture">
                            <a class="btn optionalBtn mt-3" href="book_review.php?approveId=<?php echo $row['brid'] ?>">Approve</a>
                            <a class="btn secondaryBtn mt-2" onclick="return confirm('Are you sure you want to delete?');" href="book_review.php?deleteId=<?php echo $row['brid'] ?>">Delete</a>
                        </div>
                        <div class="col-md-9" style="color: rgb(173 104 247);">
                            <p><strong>For: </strong>Review Request</p>
                            <p><strong>Book Name:</strong> <?php echo $row['book_name']; ?></p>
                            <p><strong>Book Category:</strong> <?php echo $row['book_category']; ?></p>
                            <img class="bd-placeholder-img img-fluid" width="100" height="100" src="../<?php echo $row['book_img']; ?>" alt="Book Image">
                            <p><strong>Reviewer Name:</strong> <?php echo $row['register_full_name']; ?></p>
                            <p><strong>Main Theme:</strong> <?php echo (strlen($row['main_theme']) > 241) ? substr($row['main_theme'], 0, 241) . '...' : $row['main_theme']; ?></p>
                            <p><strong>Strength Analysis:</strong> <?php echo (strlen($row['strength_analysis']) > 241) ? substr($row['strength_analysis'], 0, 241) . '...' : $row['strength_analysis']; ?></p>
                            <p><strong>Weakness Analysis:</strong> <?php echo (strlen($row['weakness_analysis']) > 241) ? substr($row['weakness_analysis'], 0, 241) . '...' : $row['weakness_analysis']; ?></p>
                            <p><strong>Critical Evaluation:</strong> <?php echo (strlen($row['critical_evaluation']) > 241) ? substr($row['critical_evaluation'], 0, 241) . '...' : $row['critical_evaluation']; ?></p>
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