<?php
    include("includes/connection.php");
    include("includes/header.php");
    include("functions/notification.php");

    if(!isset($_SESSION['client']['status']))
    {
        // Store the current page URL in a session variable
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("location: login.php");
		exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $book_fest_id = $_POST['book_fest_id'];
        $user_id = $_SESSION['client']['id'];
        $sql_fest_register = "INSERT INTO book_fest_reg (user_id, book_fest_id) VALUES ('$user_id', '$book_fest_id')";
        $connection_database->query($sql_fest_register);
        $_SESSION['message']['success'] = "Registered Successfully";
    }

    //ongoing fest query -- eta holo fest assigned hoise kintu suru hoini
    $ongoing_fest_sql = "SELECT * FROM book_fest WHERE start_time > NOW() LIMIT 1";
    $ongoing_fest_result = $connection_database->query($ongoing_fest_sql);

    $ongoing_fest_id = 0;
    $row_fest = array();
    //ongoing fest id
    if ($ongoing_fest_result->num_rows > 0) {
        $row_fest = $ongoing_fest_result->fetch_assoc();
        $ongoing_fest_id = $row_fest['book_fest_id'];
    }

    //check if already registered
    $user_id = $_SESSION['client']['id'];
    $book_fest_reg_sql = "SELECT * FROM book_fest_reg WHERE user_id = '$user_id' and book_fest_id = '$ongoing_fest_id'";
    $book_fest_reg_result = $connection_database->query($book_fest_reg_sql);

    // check running fest -- eta fest running ase
    $running_fest_sql = "SELECT * FROM book_fest WHERE start_time < NOW() AND end_time > NOW() LIMIT 1";
    $running_fest_result = $connection_database->query($running_fest_sql);

    $running_fest_id = 0;
    $row_running_fest = array();
    if ($running_fest_result->num_rows > 0) {
        $row_running_fest = $running_fest_result->fetch_assoc();
        $running_fest_id = $row_running_fest['book_fest_id'];
    }

    $running_fest_user_sql = "SELECT * FROM book_fest_reg WHERE book_fest_id = '$running_fest_id' and user_id = '$user_id'";
    $running_fest_user_result = $connection_database->query($running_fest_user_sql);
    //  end


    display_notification_messages();
    display_notification_messages_sucesses();

?>


<div class="container px-4 mt-4 d-flex flex-row min-vh-100">
            <form class="w-50 m-5 mx-auto" action="" method="POST" enctype="multipart/form-data">
                <div class="shadow rounded-4 p-5 mb-4">
                    <h3 class="card-header mb-2">Book Fest Portal</h3>
                        <div class="card-body">


                            <?php
                                if ($running_fest_result->num_rows > 0 && $running_fest_user_result->num_rows > 0) {
                                    // $row_fest = $running_fest_result->fetch_assoc();
                                    $_SESSION['client']['book_fest_id'] = $row_running_fest['book_fest_id'];
                                    $book_fest_name = $row_running_fest['book_fest_name'];
                                    echo "<div class='row gx-3 mb-3'>
                                                <label class='form-label'>Running Book Fest</label>
                                                <input type='text' class='form-control' name='book_fest_name' value='$book_fest_name' readonly>
                                            </div>
                                            <div class='row gx-3 mb-3'>
                                                <a href='book_fest' class='btn secondaryBtn'>Join Fest</a>
                                            </div>";
                                }
                                else if ($ongoing_fest_result->num_rows > 0 && $book_fest_reg_result->num_rows == 0) {
                                    // $row_fest = $ongoing_fest_result->fetch_assoc();
                                    $start_time = $row_fest['start_time'];
                                    $end_time = $row_fest['end_time'];
                                    $book_fest_id = $row_fest['book_fest_id'];
                                    $book_fest_name = $row_fest['book_fest_name'];

                                    echo "<div class='row gx-3 mb-3'>
                                                <label class='form-label'>Book Fest Name</label>
                                                <input type='text' class='form-control' name='book_fest_name' value='$book_fest_name' readonly>
                                            </div>
                                            <div class='row gx-3 mb-3'>
                                                <label class='form-label'>Start Time</label>
                                                <input type='text' class='form-control' name='start_time' value='$start_time' readonly>
                                            </div>
                                            <div class='row gx-3 mb-3'>
                                                <label class='form-label'>End Time</label>
                                                <input type='text' class='form-control' name='end_time' value='$end_time' readonly>
                                            </div>
                                            <input type='number' name='book_fest_id' value='$book_fest_id' hidden>
                                            <div class='row gx-3 mb-3'>
                                                <div class='col-md-6'>
                                                    <button class='btn secondaryBtn' type='submit' value='submit'>REGISTER</button>
                                                </div>
                                            </div>";
                                }
                                else if ($ongoing_fest_result->num_rows > 0 && $book_fest_reg_result->num_rows > 0) {
                                    // $row_fest = $ongoing_fest_result->fetch_assoc();
                                    $start_time = $row_fest['start_time'];
                                    $end_time = $row_fest['end_time'];
                                    $book_fest_id = $row_fest['book_fest_id'];
                                    $book_fest_name = $row_fest['book_fest_name'];
                                    echo "<div class='row gx-3 mb-3'>
                                                <label class='form-label'>Book Fest Name</label>
                                                <input type='text' class='form-control' name='book_fest_name' value='$book_fest_name' readonly>
                                            </div>
                                            <div class='row gx-3 mb-3'>
                                                <label class='form-label'>Start Time</label>
                                                <input type='text' class='form-control' name='start_time' value='$start_time' readonly>
                                            </div>
                                            <div class='row gx-3 mb-3'>
                                                <label class='form-label'>End Time</label>
                                                <input type='text' class='form-control' name='end_time' value='$end_time' readonly>
                                            </div>
                                            <div class='row gx-3 m-5'>
                                                <label class='form-label'>Already Registered</label>
                                            </div>";
                                }
                                else {
                                    echo "<div class='row gx-3 m-5'>
                                                <label class='form-label'>No ongoing fest</label>
                                            </div>";
                                }                       
                            ?>

                        </div>
                    </div>
                </div>
            </form>   
        </div> 

        <?php
    include("includes/footer.php");
?>