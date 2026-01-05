<?php
include("includes/header.php");
include("../includes/connection.php");

include("../functions/notification.php");

display_notification_messages();


$query = "SELECT * FROM `author_table` WHERE `is_verified` = '0'";
$author_result = mysqli_query($connection_database, $query);



?>

<div class="container px-4 mt-5 w-50 mx-auto min-vh-100">
    <form action="functions/process_author_add.php" method="POST" enctype="multipart/form-data">
        <div class="mt5 mb-4">
            <h2 class="card-header ">New Author Add</h2>
            <div class="card-body">

                <div class="mb-3">
                    <label class="small mb-1">Author Name</label>
                    <input name="author_name" class="form-control" type="text" placeholder="Name">
                </div>

                <div class="mb-3">
                    <label class="small mb-1">Author Details</label>
                    <textarea name="author_description" rows="3" class="form-control"></textarea>
                </div>


                <div class="mb-3">
                    <label class="small mb-1">Author Photo</label>
                    <input name="author_img" class="form-control" type="file">
                </div>

                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <button class="btn" type="submit" value="submit">Save changes</button>
                        <a class="btn" href="author_view.php">Exit</a>
                    </div>
                </div>

            </div>
        </div>
    </form>


    <?php while ($row = mysqli_fetch_assoc($author_result)) { ?>

        <div class="row justify-content-center mb-3 w-75 mx-auto">
            <div class="col-md-12 col-xl-10">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <h5><?php echo $row['author_full_name']; ?></h5>
                                <div class="mt-1 mb-0 small">
                                    <span>Details</span>
                                    <h6>Email: <?php echo $row['author_email'] ?></h6>
                                    <h6>Verification Info: <?php echo $row['verifcation_info'] ?></h6>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                <div class="d-flex flex-column mt-4">
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm mb-1"
                                        href="functions/process_author_verify.php?id=<?php echo $row['author_id'] ?>">Verify</a>
                                    <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger btn-sm mt-1"
                                        onclick="return confirm('Are you sure you want to delete?');"
                                        href="functions/process_author_del.php?id=<?php echo $row['author_id'] ?>">Delate</a>
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
include("includes/footer.php");
?>