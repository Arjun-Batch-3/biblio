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
if ($_SESSION['client']['isReviewer'] == 0) {
    header("location: quiz.php");
    exit();
}

if (!empty($_GET)) {
    $book_id = $_GET['id'];
    $is_req = $_GET['is_r_r'];
}
display_notification_messages();
display_notification_messages_sucesses();

?>


<div class="container-fluid px-4 mt-4 d-flex flex-row">
    <form class="w-50 m-5 mx-auto" action="functions/process_book_review.php" method="POST"
        enctype="multipart/form-data">
        <div class="shadow rounded-4 p-5 mb-4">
            <h3 class="card-header">Book Review</h3>
            <div class="card-body">

                <div class="mb-3">
                    <label class="small mb-1">main_theme</label>
                    <textarea name="main_theme" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="small mb-1">strength_analysis</label>
                    <textarea name="strength_analysis" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="small mb-1">weakness_analysis</label>
                    <textarea name="weakness_analysis" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="small mb-1">critical_evaluation</label>
                    <textarea name="critical_evaluation" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="customRange2" class="form-label">Rating</label>
                    <input type="range" name="overall_rating" class="form-range" min="0" max="10" id="customRange2">
                </div>
                <input type="number" name="book_id" value="<?php echo $book_id; ?>" hidden>
                <input type="number" name="is_requested_review" value="<?php echo $is_req; ?>" hidden>

                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <button class="btn secondaryBtn" type="submit" value="submit">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
</div>
</form>
</div>

<?php
include("includes/footer.php");
?>