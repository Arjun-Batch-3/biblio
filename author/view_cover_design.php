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

$coverDesignReqId = $_GET['coverDesignReqId'];

#paintings
$paintings_query = "SELECT * FROM `paintings` AS `p` 
INNER JOIN register_table as rt on p.user_id = rt.register_id  
WHERE `cover_design_req_id` = '$coverDesignReqId'";
$paintings_result = mysqli_query($connection_database, $paintings_query);


?>

<div class="container min-vh-100">
    <a class="btn secondaryBtn text-decoration-none m-2" href="book_fest.php">Back</a>
    <section class="mt-5 w-75 mx-auto rounded-4 shadow mb-5">
        <div class="p-3">
            <h3 class="text-center">Desined Cover</h3>
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


</div>

<?php
include("footer.php");
?>