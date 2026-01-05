<?php
include("includes/header.php");
include("../includes/connection.php");
include("../functions/notification.php");


// $query = "SELECT * FROM `author_table` WHERE `is_verified` = '0'";
// $author_result = mysqli_query($connection_database, $query);
if ($connection_database->connect_error) {
    die("Connection failed: " . $connection_database->connect_error);
}
if (!empty($_GET)) {
    if (isset($_GET['deleteId'])) {
        $id = $_GET['deleteId'];
        $query = "DELETE FROM `book_fest` WHERE `book_fest_id` = $id";
        mysqli_query($connection_database, $query);
        $_SESSION['message']['success'] = "Bookfest deleted successfully!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_fest_name = $_POST['book_fest_name'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];



    // Check if a book Fest is already active or upcoming
    $sql_check = "SELECT * FROM book_fest WHERE end_time >= NOW()";
    $result = $connection_database->query($sql_check);

    if ($start_time > $end_time) {
        $_SESSION['error'] = array();
        $_SESSION['error'][] = "Start time cannot be greater than end time.";
    } else if ($result->num_rows > 0) {
        $_SESSION['error'] = array();
        $_SESSION['error'][] = "A book Fest is already active or upcoming. Please wait until it ends.";
        display_notification_messages();
    } else {
        // Insert the new book Fest
        $sql_insert = "INSERT INTO book_fest (book_fest_name, start_time, end_time) VALUES ('$book_fest_name', '$start_time', '$end_time')";
        if ($connection_database->query($sql_insert) === TRUE) {
            $_SESSION['message']['success'] = "New book Fest created successfully!";
            display_notification_messages_sucesses();
        } else {
            echo "Error: " . $sql_insert . "<br>" . $connection_database->error;
        }
    }
}

$book_fest_query = "SELECT * FROM `book_fest` order by book_fest_id desc";
$book_fest_result = mysqli_query($connection_database, $book_fest_query);


display_notification_messages_sucesses();
display_notification_messages();

$connection_database->close();
?>

<div class="container min-vh-100">
    <div class="card mt-5 p-5 shadow rounded-4 w-50 mx-auto">
        <form method="POST" action="">

            <div class="form-floating mb-3">
                <input name="book_fest_name" type="text" class="form-control rounded-3" id="book_fest_name" required>
                <label for="book_fest_name">Book Fest Name</label>
            </div>
            <div class="form-floating mb-3">
                <input name="start_time" type="datetime-local" class="form-control rounded-3" id="start_time" required>
                <label for="start_time">Start Time</label>
            </div>
            <div class="form-floating mb-3">
                <input name="end_time" type="datetime-local" class="form-control rounded-3" id="end_time" required>
                <label for="end_time">End Time</label>
            </div>

            <!-- <label for="book_fest_name">Book Fest Name:</label><br>
            <input type="text" id="book_fest_name" name="book_fest_name" required><br> -->

            <!-- <label for="start_time">Start Time:</label><br>
            <input type="datetime-local" id="start_time" name="start_time" required><br> -->

            <!-- <label for="end_time">End Time:</label><br>
            <input type="datetime-local" id="end_time" name="end_time" required><br> -->

            <button class="btn mt-2" type="submit">Create Book Fest</button>
        </form>
    </div>

    <div class="card my-5 p-5 shadow rounded-4 w-75 mx-auto">
        <h3 class="text-center">Book Fest List</h3>
        <?php while ($row = mysqli_fetch_assoc($book_fest_result)) { ?>

            <div class="row justify-content-center mb-3 w-100 mx-auto">
                <div class="col-md-12 col-xl-10">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h5><?php echo $row['book_fest_name']; ?></h5>
                                    <div class="mt-1 mb-0 small">
                                        <span>Details</span>
                                        <h6>Start Date: <?php echo $row['start_time'] ?></h6>
                                        <h6>End Date : <?php echo $row['end_time'] ?></h6>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-column mt-4">
                                        <a data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-outline-primary btn-sm mb-1 disabled"
                                            href=""><?php echo strtotime($row['end_time']) < time() ? "Expired" : "Active" ?></a>
                                        <a data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-outline-danger btn-sm mt-1"
                                            onclick="return confirm('Are you sure you want to delete?');"
                                            href="book_fest_add.php?deleteId=<?php echo $row['book_fest_id'] ?>">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>


    </div>
</div>

<?php
include("includes/footer.php");
?>