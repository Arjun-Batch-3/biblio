<?php
    include("includes/connection.php");
    include("includes/header.php");
    include("functions/notification.php");

    if (!isset($_SESSION['client']['status'])) {
        header("location: login.php");
        exit();
    }
    

    display_notification_messages();
    display_notification_messages_sucesses();

    #category data
    $category_query = "SELECT * FROM `category_table`";
    $category_result = mysqli_query($connection_database, $category_query);

    // author data
    $author_query = "SELECT `author_id`, `author_full_name` FROM `author_table` WHERE `is_verified` = '1'";
    $author_result = mysqli_query($connection_database, $author_query);

?>


<div class="container-fluid px-4 mt-4 d-flex flex-row">
            <form class="w-50 m-5 mx-auto" action="functions/process_old_book_add.php" method="POST" enctype="multipart/form-data">
                <div class=" mb-4 rounded-4 shadow p-5">
                    <div class="card-header"><h2 class="text-center">Used book Sell</h2></div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="small mb-1">Name of the Book</label>
                                <input name="book_name" class="form-control" type="text" placeholder="Name of the Book">
                            </div>

                            <div class="form-group mb-3">
                                <label class="small mb-1">Book Category</label>
                                <select name="book_category" class="form-control">
                                    <?php
                                        while($category_row = mysqli_fetch_assoc($category_result))
                                        {
                                            echo '<option value="' . $category_row['category_name'] . '">' . $category_row['category_name'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                           

                            <div class="form-group mb-3">
                                <label class="small mb-1">Book Author</label>
                                <select name="book_author" class="form-control">
                                    <?php
                                        while($author_row = mysqli_fetch_assoc($author_result))
                                        {
                                            echo '<option value="' . $author_row['author_id'] . '">' . $author_row['author_full_name'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                           
                            <div class="mb-3">
                                <label class="small mb-1">Description</label>
                                <textarea name="book_description" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1">Price</label>
                                <input name="book_price" class="form-control" type="text" placeholder="Price">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1">Pickup Address</label>
                                <input name="pickup_address" class="form-control" type="text" placeholder="Pickup Address">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1">Exchange Condition</label>
                                <input name="exchange_condition" class="form-control" type="text" placeholder="Exchange Condition">
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1">Image</label>
                                <input name="book_img" class="form-control" type="file">
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <button class="btn btn-outline-info" type="submit" value="submit">Save changes</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>   
        </div> 

        <?php
    include("includes/footer.php");
?>