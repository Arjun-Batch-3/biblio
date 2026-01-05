<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['client']['id'];

// update is_viewed
$msg_query = "UPDATE `old_book_messages` SET `is_viewed`='1' WHERE `incoming_msg_id` = '$outgoing_id' AND `is_viewed` = '0'";
mysqli_query($conn, $msg_query);
//

$sql = "SELECT DISTINCT r.*
FROM register_table r
WHERE r.register_id IN (
    SELECT incoming_msg_id FROM old_book_messages WHERE outgoing_msg_id = {$outgoing_id}
    UNION
    SELECT outgoing_msg_id FROM old_book_messages WHERE incoming_msg_id = {$outgoing_id}
) AND r.register_id != {$outgoing_id};
";
$query = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "data.php";
}
echo $output;
