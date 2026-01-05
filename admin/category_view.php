<?php
include("includes/header.php");
include("../includes/connection.php");
include("functions/process_category_view_data.php");

$category_query = "SELECT * FROM `category_table`";
$category_result = mysqli_query($connection_database, $category_query);
$count = 1;
?>
<div class="mt-5 container min-vh-100">
    <h2>View Category</h2>

    <br>

    <table class="table" cellspacing="0" border="0" width="100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Category Name</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            display_data($count, $category_result);
            ?>
        </tbody>
    </table>
</div>


<?php
include("includes/footer.php");
?>