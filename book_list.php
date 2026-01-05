<?php
    include("includes/header.php");
    include("includes/connection.php");
    include("functions/notification.php");

    display_notification_messages();

    $search = "";
	if(isset($_POST['search'])){
		$search = $_POST['search'];
	}

    
    $selected_category = isset($_POST['bookcategory']) ? $_POST['bookcategory'] : 'All Category';
    $selected_author = isset($_POST['book_author']) ? $_POST['book_author'] : 'All Author';

    // Fetch books based on the selected category
    if ($selected_category == 'All Category' && $selected_author == 'All Author') 
    {
        $query = "SELECT * FROM `book_table` WHERE `book_name` LIKE '%$search%' ORDER BY `book_name`";
        $result = mysqli_query($connection_database, $query);        
    }
    else if($selected_category != 'All Category' && $selected_author == 'All Author')
    {
        $query = "SELECT * FROM `book_table` WHERE `book_category` = '$selected_category' AND `book_name` LIKE '%$search%' ORDER BY `book_name`";
        $result = mysqli_query($connection_database, $query);        
    }
    else if($selected_category == 'All Category' && $selected_author != 'All Author')
    {
        $query = "SELECT * FROM `book_table` WHERE `author_id` = '$selected_author' AND `book_name` LIKE '%$search%' ORDER BY `book_name`";
        $result = mysqli_query($connection_database, $query);        
    }
    else
    {
        $query = "SELECT * FROM `book_table` WHERE `book_category` = '$selected_category' AND `author_id` = '$selected_author' AND `book_name` LIKE '%$search%' ORDER BY `book_name`";
        $result = mysqli_query($connection_database, $query);        
    }


    #category data
    $category_query = "SELECT * FROM `category_table`";
    $category_result = mysqli_query($connection_database, $category_query);  
    
    // author data
    $author_query = "SELECT `author_id`, `author_full_name` FROM `author_table` WHERE `is_verified` = '1'";
    $author_result = mysqli_query($connection_database, $author_query);


?>

        <header class="d-flex justify-content-center py-3">
            <form action="book_list.php" method="POST" class="mt-5 d-flex flex-row align-items-center">

                <div class="form-group me-2">
                    <!-- <label class="small mb-1">Category</label> -->
                    <select name="bookcategory" class="form-control">
                        <option value="All Category">All Category</option>
                        <?php
                            while($category_row = mysqli_fetch_assoc($category_result))
                            {
                                echo '<option value="' . $category_row['category_name'] . '">' . $category_row['category_name'] . '</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group me-2">
                    <!-- <label class="small mb-1">Author</label> -->
                    <select name="book_author" class="form-control">
                    <option value="All Author">All author</option>
                        <?php
                            while($author_row = mysqli_fetch_assoc($author_result))
                            {
                                echo '<option value="' . $author_row['author_id'] . '">' . $author_row['author_full_name'] . '</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group me-2 mt-3">
                    <input class="form-control mb-3" type="text" name="search" placeholder="Search" aria-label="Search">
                </div>
                <div>
                    <button class="btn btn-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>


            </form>
        </header>

        <div class="py-3">
            <div class="container min-vh-100">
                <div class="row">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-md-3 mb-5">
                            <a class="link-offset-2 link-underline link-underline-opacity-0" href="book_detail.php?id=<?php echo $row['book_id']; ?>">
                                <div class="card shadow-sm">
                                    <img class="bd-placeholder-img card-img-top" width="100" height="400" src="<?php echo $row['book_img']; ?>">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center ">
                                            <small class=""><?php echo $row['book_name']; ?></small>
                                            <small class=""><?php echo $row['book_price']; ?> TK</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

<?php
    include("includes/footer.php");
?>
