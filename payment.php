<?php
include("includes/header.php");

if (!isset($_SESSION['client']['status'])) {
    header("location: login.php");
    exit();
}

?>

<div class="container min-vh-100">
    <br>
    <h2 class="text-center mt-5">Cash On Delivery</h2>
    <br>

    <div style='text-align: center;'>
        <div class='product_wrapper'>

            <h2 class='price'>Total price: <?php echo $_SESSION['client']['order_total_price']; ?>TK</h2>
            <br>
            <h6>Please Wait for email for order confirmation</h6>
            <h6>Pay after the book is delivered</h6>

        </div>
    </div>

</div>
<?php
include("includes/footer.php");
?>