<?php
include("header.php");
include("../includes/connection.php");
include("../functions/notification.php");

if (!empty($_GET)) {
    if (isset($_GET['deleteId'])) {
        $id = $_GET['deleteId'];
        $query = "DELETE FROM `review_request_quiz` WHERE `id` = $id";
        mysqli_query($connection_database, $query);
        $_SESSION['message']['success'] = "Questions deleted successfully!";
    }
    if (isset($_GET['id'])) {
        $rr_id = $_GET['id'];
        $_SESSION['client']['review_request_id'] = $rr_id;
    }
}


$rr_id = $_SESSION['client']['review_request_id'];


$query = "SELECT * FROM `review_request_quiz` where `review_request_id` = '$rr_id'";
$quiz_result = mysqli_query($connection_database, $query);


display_notification_messages();
display_notification_messages_sucesses();

?>

<div class="container-fluid px-4 mt-4 w-50 mx-auto">
    <form class="shadow-lg rounded-4 p-5 mb-5" action="functions/process_quiz_add.php" method="POST" enctype="multipart/form-data">
        <div class=" mb-4">
            <h2 class="card-header ">Quiz Question Add</h2>
            <div class="card-body">

                <div class="mb-3">
                    <label class="small mb-1">Question</label>
                    <textarea name="question" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Choice A</label>
                    <input name="choiceA" class="form-control" type="text" placeholder="choiceA">
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Choice B</label>
                    <input name="choiceB" class="form-control" type="text" placeholder="choiceB">
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Choice C</label>
                    <input name="choiceC" class="form-control" type="text" placeholder="choiceC">
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Choice D</label>
                    <input name="choiceD" class="form-control" type="text" placeholder="choiceD">
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Correct Answer</label><br>
                    <input type="radio" id="ans1" name="answer" value="1">
                    <label for="ans1">A</label>&nbsp&nbsp&nbsp
                    <input type="radio" id="ans2" name="answer" value="2">
                    <label for="ans2">B</label>&nbsp&nbsp&nbsp
                    <input type="radio" id="ans3" name="answer" value="3">
                    <label for="ans3">C</label>&nbsp&nbsp&nbsp
                    <input type="radio" id="ans4" name="answer" value="4">
                    <label for="ans4">D</label><br>
                </div>

                <input type="text" name="review_request_id" value="<?php echo $rr_id; ?>" hidden>

                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <button class="btn" type="submit" value="submit">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
</div>
</form>


<?php while ($row = mysqli_fetch_assoc($quiz_result)) { ?>

    <div class="row justify-content-center mb-3 w-75 mx-auto">
        <div class="col-md-12 col-xl-10">
            <div class="card shadow-0 border rounded-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <h5><?php echo $row['question']; ?></h5>
                            <div class="mt-1 mb-0 small">
                                <h6>1: <?php echo $row['choiceA'] ?></h6>
                                <h6>2: <?php echo $row['choiceB'] ?></h6>
                                <h6>3: <?php echo $row['choiceC'] ?></h6>
                                <h6>4: <?php echo $row['choiceD'] ?></h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                            <div class="d-flex flex-column mt-4">
                                <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger btn-sm mt-1" onclick="return confirm('Are you sure you want to delete?');" href="review_request_questions_add.php?deleteId=<?php echo $row['id'] ?>">Delete</a>
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
include("footer.php");
?>