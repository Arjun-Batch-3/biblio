<?php
include("header.php");


display_notification_messages();
display_notification_messages_sucesses();

$user_id = $_SESSION['client']['id'];
$book_fest_id = $_SESSION['client']['book_fest_id'];
//echo $book_fest_id;
//echo $user_id;


#coverv design request
$cover_design_request_query = "SELECT * FROM `cover_design_req` WHERE `book_fest_id` = '$book_fest_id'";
$cover_design_request_result = mysqli_query($connection_database, $cover_design_request_query);

#paintings
$paintings_query = "SELECT * FROM `paintings` AS `p` 
INNER JOIN register_table as rt on p.user_id = rt.register_id  
WHERE `book_fest_id` = '$book_fest_id'";
$paintings_result = mysqli_query($connection_database, $paintings_query);


#best paintings
$best_paintings_query = "SELECT * FROM `paintings` AS `p` 
INNER JOIN `register_table` as `rt` on `p`.`user_id` = `rt`.`register_id`
INNER JOIN `best_paintings` as `bp` on `p`.`id` = `bp`.`paintings_id`
WHERE `bp`.`book_fest_id` = '$book_fest_id'";
$best_paintings_result = mysqli_query($connection_database, $best_paintings_query);


?>

<body>
    <div class="container min-vh-100">
        <div class="mt-5 d-block">
            <a class="btn secondaryBtn" href="../">Back</a>
            <h1 class="text-center mb-2">Book Fest</h1>
        </div>

        <div class="d-flex flex-row justify-content-between">
            <section class="mt-5 w-50 rounded-4 shadow">
                <div class="scrollable-area p-3 overflow-auto" style="height: 600px; background-color: transparent">
                    <h3 class="text-center">Painting Request</h3>
                    <?php while ($row = mysqli_fetch_assoc($paintings_result)) { ?>
                        <div class="card w-75 row justify-content-center mb-5 mt-5 mx-auto">
                            <div class="col-md-3 text-center d-flex flex-column align-items-center">
                                <p style="color: #fff; display:block"><span>Designer Name: </span><?php echo $row['register_full_name']; ?></p>
                                <img class="bd-placeholder-img img-fluid rounded-circle" width="50" height="50" src="../<?php echo $row['register_profile_picture']; ?>" alt="Reviewer Profile Picture">
                            </div>
                            <img class="bd-placeholder-img img-fluid rounded m-1" width="200" height="100" src="../paint/<?php echo $row['image_path']; ?>" alt="">
                        </div>

                    <?php } ?>
                </div>


            </section>
            <section class="mt-5 w-50 rounded-4 shadow d-flex flex-column">
                <div class="scrollable-area p-3 overflow-auto" style="height: 600px; background-color: transparent">

                    <h3 class="text-center">Cover Design Request</h3>
                    <?php while ($row = mysqli_fetch_assoc($cover_design_request_result)) { ?>
                        <a class="text-decoration-none" href="process_paint.php?coverDesignReqId=<?php echo $row['cover_design_req_id'] ?>">
                        <div class="row justify-content-center mb-5 mt-5 w-100 mx-auto">
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

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    <?php } ?>

                </div>
            </section>

        </div>

        <div class="d-block w-50 mx-auto" style="margin: 200px 0px">
            <h3 class="text-center mt-5 ">Best Paintings</h3>
            <?php while ($row = mysqli_fetch_assoc($best_paintings_result)) { ?>
                <div class="card w-75 row justify-content-center mb-5 mt-5 mx-auto">
                    <div class="col-md-3 text-center d-flex flex-column align-items-center">
                        <p style="color: #fff; display:block"><span>Designer Name: </span><?php echo $row['register_full_name']; ?></p>
                        <img class="bd-placeholder-img img-fluid rounded-circle" width="50" height="50" src="../<?php echo $row['register_profile_picture']; ?>" alt="Reviewer Profile Picture">
                    </div>
                    <img class="bd-placeholder-img img-fluid rounded m-1" width="200" height="100" src="../paint/<?php echo $row['image_path']; ?>" alt="">
                </div>
            <?php } ?>
        </div>

    </div>
</body>

</html>