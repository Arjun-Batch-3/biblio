<?php
include("includes/header.php");
include("includes/connection.php");
include("functions/notification.php");

display_notification_messages();
display_notification_messages_sucesses();

$user_id = 0;
if(isset($_SESSION['client']['status']))
{
    $user_id = $_SESSION['client']['id'];
}

// book select reverse order from database
$query = "SELECT * , AVG(`br`.`overall_rating`) AS `avgRating`
FROM `book_table` AS `bt` INNER JOIN `author_table` AS `at` ON `bt`.`author_id` = `at`.`author_id`  INNER JOIN 
`book_review` AS `br` ON `bt`.`book_id` = `br`.`book_id` 
WHERE `br`.`is_requested_review` = 0 AND `br`.`is_approved` = 1 
GROUP BY `bt`.`book_id` ORDER BY AVG(`br`.`overall_rating`) DESC LIMIT 4";
$result = mysqli_query($connection_database, $query);

// requested review select from database
$requested_review_query = "SELECT * FROM `review_request` as rr 
WHERE rr.id NOT IN (SELECT `book_id` FROM `book_review` WHERE `is_requested_review` = 1 AND `is_approved` = 1 AND `reviewer_id` =  '$user_id')";
$requested_review_result = mysqli_query($connection_database, $requested_review_query);


// review show for req review
$review_query_rr = "SELECT * FROM `book_review` AS `br` 
INNER JOIN `review_request` AS `rr` 
ON `br`.`book_id` = `rr`.`id` INNER JOIN register_table as rt on br.reviewer_id = rt.register_id
WHERE `is_requested_review` = 1 and is_approved = 1";
$review_result_rr = mysqli_query($connection_database, $review_query_rr);

?>
<main>

    <div class="py-3 min-vh-100 mt-5">
        <div class="container">
            <div class="row mx-auto">
                <h3>TOP RATED BOOKS<B></B></h3>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-3 mb-3">
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="book_detail.php?id=<?php echo $row['book_id']; ?>">
                            <div class="card shadow-sm">
                                <img class="bd-placeholder-img card-img-top" width="75" height="400" src="<?php echo $row['book_img']; ?>">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small class=""><?php echo $row['book_name']; ?></small>
                                        <small class=""><?php echo $row['book_price']; ?> TK</small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class=""><?php echo $row['author_full_name']; ?></small>
                                        <small class=""><?php echo round($row['avgRating'], 1); ?><i class="fa-solid fa-star"></i></small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div id="request-slider-parent" class="container border border-primary rounded my-5 p-4">

            <h1 class="text-center">Review Request</h1>
            <div class="request-slider-body">
                <div class="request-slider">

                    <?php while ($row = mysqli_fetch_assoc($requested_review_result)) { ?>
                        <div class="request-slider-item mt-5">
                            <img class="bd-placeholder-img" width="130" height="200" src="<?php echo $row['book_img']; ?>">
                            <div class="">
                                <div class=" mt-4">
                                    <p class="">Book Name: <?php echo $row['book_name']; ?></p>
                                    <p class="">Category: <?php echo $row['book_category']; ?></p>
                                    <p class="">Description: <?php echo (strlen($row['book_description']) > 110)?substr($row['book_description'], 0, 110) . '...':$row['book_description']; ?></p>
                                </div>
                                <a href="review_request_quiz.php?id=<?php echo $row['id']; ?>" class="position-absolute bottom-0 start-0 m-3 btn primaryBtn">Review</a>
                                <?php
                                    if (isset($_SESSION['client']['status'])) {
                                        echo ($_SESSION['client']['isReviewer']==1)?"<a target='_blank' href='{$row['book_link']}' class='position-absolute bottom-0 end-0 m-3 btn secondaryBtn'>Read</a>":""; 
                                    }
                                 ?>
                            </div>
                        </div>
                    <?php } ?>

                    <button id="next">></button>
                    <button id="prev"><</button>
                </div>
            </div>
        </div>
        <div id="review-slider-parent" class="container rounded my-5 p-4">

            <h1 class="text-center mb-5 pb-0">Featured Review</h1>
            <div class="review-slider-body">
                <div class="review-slider">

                    <?php while ($row = mysqli_fetch_assoc($review_result_rr)) { ?>
                        <div class="review-slider-item mt-3 text-start" style="  color: #28104e;">
                            <img class="bd-placeholder-img" width="120" height="155" src="<?php echo $row['book_img']; ?>">
                            <div class="">
                                <div class=" mt-2">
                                    <p class="mb-2"><strong>Book Name:</strong> <?php echo $row['book_name']; ?></p>
                                    <p class="mb-2"><strong>main_theme:</strong> <?php echo (strlen($row['main_theme']) > 241)?substr($row['main_theme'], 0, 241) . '...':$row['main_theme']; ?></p>
                                    <p class="mb-2"><strong>strength_analysis:</strong> <?php echo (strlen($row['strength_analysis']) > 241)?substr($row['strength_analysis'], 0, 241) . '...':$row['strength_analysis']; ?></p>
                                    <p class="mb-2"><strong>weakness_analysis:</strong> <?php echo (strlen($row['weakness_analysis']) > 241)?substr($row['weakness_analysis'], 0, 241) . '...':$row['weakness_analysis']; ?></p>
                                    <p class="mb-2"><strong>critical_evaluation:</strong> <?php echo (strlen($row['critical_evaluation']) > 241)?substr($row['critical_evaluation'], 0, 241) . '...':$row['critical_evaluation']; ?></p>
                                    <h6>Rating: <?php echo $row['overall_rating']; ?>/10<i class="fa-solid fa-star"></i></h6>
                                    <p><img class="rounded-circle" src="<?php echo $row['register_profile_picture']; ?>" height="30" width="30" alt=""><span> <?php echo $row['register_full_name']; ?></span></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <button id="next2">></button>
                    <button id="prev2"><</button>
                    <button id="pause2" class=""><i class="fa-solid fa-pause"></i></button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include("includes/footer.php");
?>