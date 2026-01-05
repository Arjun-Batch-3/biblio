<?php
include("includes/header.php");
include("../functions/notification.php");

display_notification_messages();
display_notification_messages_sucesses();

?>

<div class="container px-4 mt-5 min-vh-100">
    <form class="w-50 mx-auto mt-5" action="functions/process_category_add.php" method="POST" enctype="multipart/form-data">
        <div class=" mb-4">
            <h4 class="card-header mb-3">Add New category</h4>
            <div class="card-body">

                <div class="form-floating mb-3">
                    <input name="category" type="text" class="form-control rounded-3" placeholder="Category Name">
                    <label>Category Name</label>
                </div>

                <button type="submit" class="btn btn-sm">Add Category</button>
                <a href="category_view.php" class="btn btn-sm">Exit</a>

            </div>
        </div>
    </form>
</div>


<?php
include("includes/footer.php");
?>