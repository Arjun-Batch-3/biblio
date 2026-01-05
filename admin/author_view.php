<?php
include("includes/header.php");
include("../includes/connection.php");

include("../functions/notification.php");

display_notification_messages();


$query = "SELECT * FROM `author_table` WHERE `is_verified` = '1'";
$author_result = mysqli_query($connection_database, $query);



?>

<div class="mt-5 min-vh-100" >
<?php while ($row = mysqli_fetch_assoc($author_result)) { ?>

    <div class="row justify-content-center mb-3 w-75 mx-auto">
        <div class="col-md-12 col-xl-10">
            <div class="card shadow-0 border rounded-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <h5><?php echo $row['author_full_name']; ?></h5>
                            <div class="mt-1 mb-0 small" style="color: #6c757d;">
                                <span>Details</span>
                                <h6>Email: <?php echo $row['author_email'] ?></h6>
                                <h6>Author Description: <?php echo $row['author_description'] ?></h6>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                            <div class="d-flex flex-column mt-4">
                                <a data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger btn-sm mt-1" onclick="return confirm('Are you sure you want to delete?');" href="functions/process_author_del.php?id=<?php echo $row['author_id'] ?>">Delete</a>
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