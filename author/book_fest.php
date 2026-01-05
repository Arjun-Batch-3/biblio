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

if (!empty($_GET)) {
    if (isset($_GET['deleteId'])) {
        $id = $_GET['deleteId'];
        $query = "DELETE FROM `cover_design_req` WHERE `cover_design_req_id` = $id";
        mysqli_query($connection_database, $query);
        $_SESSION['message']['success'] = "Design Request deleted successfully!";
    }
}


$author_id = $_SESSION['client']['authorId'];

#coverv design request
$cover_design_request_query = "SELECT * FROM `cover_design_req` WHERE `author_id` = '$author_id'";
$cover_design_request_result = mysqli_query($connection_database, $cover_design_request_query);


//ongoing fest query -- eta holo fest assigned hoise kintu suru hoini
$ongoing_fest_sql = "SELECT * FROM book_fest WHERE start_time > NOW() LIMIT 1";
$ongoing_fest_result = $connection_database->query($ongoing_fest_sql);


?>

<div class="container-fluid px-4 mt-5 mb-5 min-vh-100">

    <form class="w-50 mx-auto mb-5" action="functions/process_book_fest.php" method="POST" enctype="multipart/form-data">
        <div class="rounded-4 shadow p-5">
            <h3 class="card-header mb-3">Book Fest</h3>
            <div class="card-body">
                <?php if ($ongoing_fest_result->num_rows == 0) { ?>
                    <h4 class="mt-4">No upcoming Book Fest</h4>
                <?php } ?>

                <?php while ($ongoing_fest_row = $ongoing_fest_result->fetch_assoc()) { ?>
                    <h6 style="color: white;">Book Fest Name: <?php echo $ongoing_fest_row['book_fest_name'] ?></h6>
                    <h6 style="color: white;">Start Time: <?php echo $ongoing_fest_row['start_time'] ?></h6>
                    <h6 style="color: white;">End Time: <?php echo $ongoing_fest_row['end_time'] ?></h6>

                    <h4 class="mt-4">Submit Book for Cover Design in Book Fest</h4>
                    <input name="book_fest_id" class="form-control d-none" type="text" value="<?php echo $ongoing_fest_row['book_fest_id'] ?>" required>
                    <div class="mb-3">
                        <label class="small mb-1">Name of the Book</label>
                        <input name="book_name" class="form-control" type="text" placeholder="Name of the Book">
                    </div>


                    <div class="mb-3">
                        <label class="small mb-1">Description</label>
                        <textarea name="book_description" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <button class="btn btn-outline-info" type="submit" value="submit">Submit</button>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </form>




    <?php while ($row = mysqli_fetch_assoc($cover_design_request_result)) { ?>

        <div class="row justify-content-center mb-5 mt-5 w-75 mx-auto">
            <div class="col-md-12 col-xl-10">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <h5><?php echo "Book Name: " . $row['book_name']; ?></h5>
                                <div class="mt-1 mb-0 small">
                                    <span>Details</span>
                                    <h6>Book Description: <?php echo $row['cover_design_description'] ?></h6>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                <div class="d-flex flex-column mt-4">
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger btn-sm mt-1" onclick="return confirm('Are you sure you want to delete?');" href="book_fest.php?deleteId=<?php echo $row['cover_design_req_id'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm mt-1" href="view_cover_design.php?coverDesignReqId=<?php echo $row['cover_design_req_id'] ?>"><i class="fa-solid fa-eye"></i></a>
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