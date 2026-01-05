<?php
    // Include the header of the page
    include("includes/header.php");
    include("functions/notification.php");

    if(!isset($_SESSION['client']['status']))
    {
        // Store the current page URL in a session variable
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("location: login.php");
		exit();
    }

    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) <= 0) {
        header("location: cart.php");
		exit();
    }

    display_notification_messages();
    display_notification_messages_sucesses();
?>

        <div class="bg-body-secondary p-4 py-md-5  min-vh-100">
            <div class="m-auto w-50" role="document">
                <div class="rounded-4 shadow">
                    <div class="p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2">Order - Cash On Delivery</h1>
                    </div>

                    <div class="p-5 pt-0">
                        <form action="functions/order_process.php" method="POST">
                            <div class="form-floating mb-3">
                                <input name="fullname" type="text" class="form-control rounded-3" placeholder="">
                                <label>Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="address" type="text" class="form-control rounded-3" placeholder="">
                                <label>Address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="zipcode" type="text" class="form-control rounded-3" placeholder="">
                                <label>Zip code</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="district" type="text" class="form-control rounded-3" placeholder="">
                                <label>District</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input name="thana" type="text" class="form-control rounded-3" placeholder="">
                                <label>Thana</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="mobile_number" type="text" class="form-control rounded-3" placeholder="">
                                <label>Mobile Number</label>
                            </div>

                            <button type="submit" name="submit" class="w-100 mb-2 btn btn-lg rounded-3 btn-outline-info btn-sm">Confirm & Proceed</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
    include("includes/footer.php");
?>