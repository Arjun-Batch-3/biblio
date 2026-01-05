<?php
include("includes/header.php");
include("../includes/connection.php");
include("../functions/notification.php");


if ($connection_database->connect_error) {
    die("Connection failed: " . $connection_database->connect_error);
}
if (!empty($_GET)) {
    if (isset($_GET['deleteId'])) {
        $id = $_GET['deleteId'];
        $query = "DELETE FROM `paintings` WHERE `id` = $id";
        mysqli_query($connection_database, $query);
        $_SESSION['message']['success'] = "Design deleted successfully!";
    }
    if (isset($_GET['selectID'])) {
        $id = $_GET['selectID'];
        $book_fest_id = $_SESSION['admin']['book_fest_id'];
        // first delete previous
        $query = "DELETE FROM `best_paintings` WHERE `book_fest_id` = '$book_fest_id'";
        mysqli_query($connection_database, $query);
        // then insert
        $query = "INSERT INTO `best_paintings`(`paintings_id`, `book_fest_id`) VALUES ('$id','$book_fest_id')";
        mysqli_query($connection_database, $query);
        $_SESSION['message']['success'] = "Selected successfully!";
    }
}

// check running fest -- eta fest running ase
$running_fest_sql = "SELECT * FROM book_fest WHERE start_time < NOW() AND end_time > NOW() LIMIT 1";
$running_fest_result = $connection_database->query($running_fest_sql);

$running_fest_id = 0;
$row_running_fest = array();
if ($running_fest_result->num_rows > 0) {
    $row_running_fest = $running_fest_result->fetch_assoc();
    $running_fest_id = $row_running_fest['book_fest_id'];
    $_SESSION['admin']['book_fest_id'] = $running_fest_id;
}

#paintings
$paintings_query = "SELECT * FROM `paintings` AS `p` 
INNER JOIN register_table as rt on p.user_id = rt.register_id  
WHERE `book_fest_id` = '$running_fest_id'";
$paintings_result = mysqli_query($connection_database, $paintings_query);



display_notification_messages_sucesses();
display_notification_messages();

$connection_database->close();
?>

<div class="container min-vh-100">
    <section class="mt-5 rounded-4 shadow">
        <div class=" p-3 mb-5" style="background-color: transparent">
            <h3 class="text-center">Running Fest Cover Design</h3>
            <?php while ($row = mysqli_fetch_assoc($paintings_result)) { ?>
                <div class="card py-2 w-50 row justify-content-center mb-5 mt-5 mx-auto">
                    <div class=" mb-3 col-md-6 text-center d-flex flex-column align-items-start">
                        <p class="m-0 mb-2"><span class="fw-bold">Designer Name:</span> <?php echo $row['register_full_name']; ?> </p>

                        <img class="bd-placeholder-img img-fluid rounded-circle" width="50" height="50" src="../<?php echo $row['register_profile_picture']; ?>" alt="Reviewer Profile Picture">
                    </div>
                    <img class="bd-placeholder-img img-fluid rounded m-1" width="200" height="100" src="../paint/<?php echo $row['image_path']; ?>" alt="">

                    <div class="d-flex flex-row justify-content-center">
                        <a class="btn secondaryBtn w-25 m-1" onclick="return confirm('Are you sure you want to delete?');" href="book_fest_contest.php?deleteId=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                        <a class="btn optionalBtn w-25 m-1" onclick="return confirm('Select This Design to be Best?');" href="book_fest_contest.php?selectID=<?php echo $row['id'] ?>"><i class="fa-solid fa-check"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

<?php
include("includes/footer.php");
?>