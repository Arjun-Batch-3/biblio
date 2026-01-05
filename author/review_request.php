<?php
include("header.php");
include("../includes/connection.php");
include("../functions/notification.php");

display_notification_messages();
display_notification_messages_sucesses();

if (!isset($_SESSION['client']['authorStatus'])) {
    header("location: login.php");
    exit();
}

$author_id = $_SESSION['client']['authorId'];

#review request
$request_query = "SELECT * FROM `review_request` WHERE `author_id` = '$author_id'";
$request_result = mysqli_query($connection_database, $request_query);


#category data
$category_query = "SELECT * FROM `category_table`";
$category_result = mysqli_query($connection_database, $category_query);
?>

<div class="container-fluid px-4 mt-5 mb-5 min-vh-100">


    <!-- Modal -->
    <div class="modal fade" id="staticBackdropReview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <?php if (isset($_SESSION['requestedReview'])) {
                    $row = $_SESSION['requestedReview'];
                ?>

                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="min-height: 700px;">

                        <div class="review-slider-item mt-3 text-center" style="  color: #28104e;">
                            <img class="bd-placeholder-img" width="120" height="155" src="../<?php echo $row['book_img']; ?>">
                            <div class="">
                                <div class=" mt-1">
                                    <p class="mb-2"><strong>Book Name:</strong> <?php echo $row['book_name']; ?></p>
                                    <p class="mb-2"><strong>main_theme:</strong> <?php echo (strlen($row['main_theme']) > 241) ? substr($row['main_theme'], 0, 241) . '...' : $row['main_theme']; ?></p>
                                    <p class="mb-2"><strong>strength_analysis:</strong> <?php echo (strlen($row['strength_analysis']) > 241) ? substr($row['strength_analysis'], 0, 241) . '...' : $row['strength_analysis']; ?></p>
                                    <p class="mb-2"><strong>weakness_analysis:</strong> <?php echo (strlen($row['weakness_analysis']) > 241) ? substr($row['weakness_analysis'], 0, 241) . '...' : $row['weakness_analysis']; ?></p>
                                    <p class="mb-2"><strong>critical_evaluation:</strong> <?php echo (strlen($row['critical_evaluation']) > 241) ? substr($row['critical_evaluation'], 0, 241) . '...' : $row['critical_evaluation']; ?></p>
                                    <h6>Rating: <?php echo $row['overall_rating']; ?>/10<i class="fa-solid fa-star"></i></h6>
                                    <p><img class="rounded-circle" src="../<?php echo $row['register_profile_picture']; ?>" height="30" width="30" alt=""><span> <?php echo $row['register_full_name']; ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- mosal -->





    <form class="w-50 mx-auto mb-5" action="functions/process_review_request.php" method="POST" enctype="multipart/form-data">
        <div class="rounded-4 shadow p-5">
            <h3 class="card-header mb-3">Book Review Request</h3>
            <div class="card-body">

                <div class="mb-3">
                    <label class="small mb-1">Name of the Book</label>
                    <input name="book_name" class="form-control" type="text" placeholder="Name of the Book">
                </div>

                <div class="form-group mb-3">
                    <label class="small mb-1">Book Category</label>
                    <select name="book_category" class="form-control">
                        <?php
                        while ($category_row = mysqli_fetch_assoc($category_result)) {
                            echo '<option value="' . $category_row['category_name'] . '">' . $category_row['category_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Description</label>
                    <textarea name="book_description" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Cover Photo</label>
                    <input name="book_img" class="form-control" type="file">
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Drive Link</label>
                    <input name="book_link" class="form-control" type="text" placeholder="Drive Link">
                </div>

                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary" type="submit" value="submit">Add</button>
                    </div>
                </div>

            </div>
        </div>
    </form>



    <?php while ($row = mysqli_fetch_assoc($request_result)) { ?>

        <div class="row justify-content-center mb-5 mt-5 w-75 mx-auto">
            <div class="col-md-12 col-xl-10">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <h5><?php echo "Book Name: " . $row['book_name']; ?></h5>
                                <div class="mt-1 mb-0 small">
                                    <span>Details</span>
                                    <h6>Category: <?php echo $row['book_category'] ?></h6>
                                    <h6>Book Description: <?php echo $row['book_description'] ?></h6>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                <div class="d-flex flex-column mt-4">
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger btn-sm mt-1" href="functions/process_request_del.php?id=<?php echo $row['id'] ?>">Delate</a>
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-secondary btn-sm mt-1" href="functions/requested_Review_view_process.php?id=<?php echo $row['id'] ?>">View</a>
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-secondary btn-sm mt-1" href="review_request_questions_add.php?id=<?php echo $row['id'] ?>">Add Questions</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

</div>

<?php
// Automatically show the modal if the session has book details
if (isset($_SESSION['requestedReview'])) {
    echo "<script type='text/javascript'>
        $(document).ready(function(){
            $('#staticBackdropReview').modal('show');
        });
      </script>";
    // Clear the session data after showing the moadl
    unset($_SESSION['requestedReview']);
}
?>



<?php
include("footer.php");
?>