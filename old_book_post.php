<?php
include("includes/header.php");
include("includes/connection.php");

if (!isset($_SESSION['client']['status'])) {
  header("location: login.php");
  exit();
}

$user_id = $_SESSION['client']['id'];

$bid_query = "SELECT * FROM `old_book` AS i LEFT JOIN `register_table` AS r on i.bid_id  = r.register_id WHERE `post_id` = $user_id";
$bid_result = mysqli_query($connection_database, $bid_query);

?>

<section class="py-5 min-vh-100">
  <div class="container py-5">
    <?php while ($row = mysqli_fetch_assoc($bid_result)) { ?>

      <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
          <div class="card shadow-0 border rounded-3">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                  <div class="bg-image hover-zoom ripple rounded ripple-surface">
                    <img src="<?php echo $row['book_img']; ?>" class="w-75" />
                    <a href="#!">
                      <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <h5><?php echo $row['book_name']; ?></h5>
                  <div class="mt-1 mb-0 small">
                    <span>Details</span>
                    <h6>Category: <?php echo $row['book_category'] ?></h6>
                    <h6>Price: <?php echo $row['book_price'] ?></h6>
                    <h6>Book Pickup Address: <?php echo $row['pickup_address'] ?></h6>
                    <h6>Exchange Condition: <?php echo $row['exchange_condition'] ?></h6>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                  <div class="d-flex flex-row align-items-center mb-1 justify-content-between">
                    <h4 class="mb-1 me-1">Bid: <?php echo $row['bid_price'] ?></h4>

                    <!-- bidder info modal bidd korle button dekhabe r sob gular id unique deya ase -->
                    <button type="button"
                      class="btn btn-outline-light rounded-circle text-end <?php echo $row['bid_id'] == null ? 'd-none' : ''; ?>"
                      data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row['bid_id']; ?>"><i
                        class="fa-solid fa-circle-user fa-fade"></i></button>
                    <div class="modal fade" id="staticBackdrop<?php echo $row['bid_id']; ?>" data-bs-backdrop="static"
                      data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="color: #af7df5;">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Bidder Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="d-flex">
                              <img src="<?php echo $row['register_profile_picture']; ?>" alt="Avatar"
                                class="rounded-circle" style="width: 100px; height: 100px;">
                              <div class="ms-5">
                                <h6>Name: <?php echo $row['register_full_name'] ?></h6>
                                <h6>Email: <?php echo $row['register_email'] ?></h6>
                                <h6>Phone: <?php echo $row['register_contact_number'] ?></h6>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                  <!-- <h6 class="text-success"><?php echo empty($row['bid_address']) ? 'Will Pickup' : 'Need Delivery'; ?></h6> -->
                  <?php
                  if (!empty($row['bid_address'])) {
                    echo '<h6 class="text-success">Need Delivery</h6>';
                  } else if ($row['bid_price'] > '0') {
                    echo '<h6 class="text-success">Will Pickup</h6>';
                  } else {
                    echo '<h6 class="text-success">Not Bidded</h6>';
                  }


                  if (!empty($row['bid_address'])) {
                    echo '<h4></h4>Bidder Address: ' . $row['bid_address'] . ' </h4>';
                  } else {
                    echo '<br>';
                  }
                  ?>

                  <div class="d-flex flex mt-4 bid-btn">
                    <a href="functions/old_book_confirm.php?id=<?php echo $row['book_id'] ?>" data-mdb-button-init
                      data-mdb-ripple-init
                      class="btn <?php echo ($row['bid_price'] == '0' || $row['is_sold'] == '1') ? 'disabled' : ''; ?>"
                      type="button"> <?php echo ($row['is_sold'] == '0') ? 'Accept' : 'Sold'; ?></a>
                      
                    <a data-title="Delete" href="functions/old_book_post_delete.php?id=<?php echo $row['book_id'] ?>" data-mdb-button-init
                      data-mdb-ripple-init class="btn btn-outline-danger"
                      onclick="return confirm('Are you sure you want to delete?');" type="button"><i
                        class="fa-solid fa-trash"></i></a>
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