<?php 
    session_start();
    if(isset($_SESSION['client']['id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['client']['id'];

        // update is_viewed
        $msg_query = "UPDATE `old_book_messages` SET `is_viewed`='1' WHERE `incoming_msg_id` = '$outgoing_id' AND `is_viewed` = '0'";
        mysqli_query($conn, $msg_query);
        //


        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM old_book_messages LEFT JOIN register_table ON register_table.register_id  = old_book_messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="../'.$row['register_profile_picture'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>