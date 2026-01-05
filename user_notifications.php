<?php
    include("includes/header.php");
    include("includes/connection.php");

    if (!isset($_SESSION['client']['status'])) {
        header("location: login.php");
        exit();
    }

    $user_id = $_SESSION['client']['id'];

    $notif_query1 = "UPDATE `notifications` SET `is_viewed`='1' WHERE `is_viewed`= '0' AND `user_id` = '$user_id'";
    mysqli_query($connection_database, $notif_query1);

    $notif_query = "SELECT * FROM `notifications` WHERE `user_id` = $user_id ORDER BY `id` DESC";
    $notif_result = mysqli_query($connection_database, $notif_query);
    //header("location: user_notifications.php");

    date_default_timezone_set("Asia/Dhaka");


?>

<section >
  <div class="container py-5 min-vh-100">
  <?php while ($row = mysqli_fetch_assoc($notif_result)) { ?>

    <div class="row justify-content-center mb-3">
      <div class="col-md-12 col-xl-10">
        <div class="card shadow-0 border rounded-3">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-6">
                <h6><?php echo $row['messege']; ?></h6>
              </div>
              <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                <div class="d-flex flex-column mt-4 ">
                  <a href="functions/notifications_delete.php?id=<?php echo $row['id']?>" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger btn-sm mt-2" type="button" >Delete</a>
                  <button class="btn btn-outline-primary btn-sm mt-3 "><?php echo date("Y-m-d h:i:sa", $row['notify_time']); ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php } ?>

  </div>
</section>

<?php
    include("includes/footer.php");
?>
