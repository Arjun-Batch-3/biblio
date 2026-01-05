<?php
    include("includes/header.php");
    include("../includes/connection.php");
    include("functions/process_users_view_data.php");


    $users_list = "SELECT * FROM `register_table`";
    $users_list_result = mysqli_query($connection_database, $users_list);
?>
        <main class="container px-md-4 min-vh-100">
            <h2 class="title mt-5 pt-5">View Users</h2>

            <br>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Contact No</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Block</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        display_data($users_list_result);
                    ?>               
                </tbody>
            </table>
        </main> 


        </div>
<?php
include("includes/footer.php");
?>