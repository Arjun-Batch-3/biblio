<?php
    include("includes/header.php");
    include("../includes/connection.php");
    include("../functions/notification.php");

    display_notification_messages();

    #category data
    $category_query = "SELECT * FROM `category_table`";
    $category_result = mysqli_query($connection_database, $category_query);

    $author_query = "SELECT `author_id`, `author_full_name` FROM `author_table` WHERE `is_verified` = '1'";
    $author_result = mysqli_query($connection_database, $author_query);

?>

        <div class="container-fluid px-4 w-50 mx-auto my-5 min-vh-100">
            <form class="shadow p-5 rounded-4" action="functions/process_book_add.php" method="POST" enctype="multipart/form-data">
                <div class=" mb-4">
                    <h3 class="card-header title text-center mb-3">New book</h3>
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
                                <label class="small mb-1">Image</label>
                                <input name="book_img" class="form-control" type="file">
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <button class="btn btn-outline-info" type="submit" value="submit">Save changes</button>
                                    <a class="btn btn-outline-info" href="book_view.php">Exit</a>
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