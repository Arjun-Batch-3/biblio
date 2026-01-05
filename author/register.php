<?php
    // Include the header
    include("header.php");
    
    include("../functions/notification.php");

    display_notification_messages();
    display_notification_messages_sucesses();
?>

        <div class="container p-5  min-vh-100" >
            <div class="m-auto w-50" >
                <div class="rounded-4 shadow">
                    
                    <div class="p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2">Sign up for free</h1>
                    </div>

                    <div class="p-5 pt-0">
                        <form action="functions/register_process.php" method="POST">

                            <div class="form-floating mb-3">
                                <input name="fullname" type="text" class="form-control rounded-3" placeholder="">
                                <label>Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="email" type="email" class="form-control rounded-3" placeholder="">
                                <label>E-Mail:</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="password" type="password" class="form-control rounded-3" placeholder="">
                                <label>Password</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="confirm_password" type="password" class="form-control rounded-3" placeholder="">
                                <label>Confirm Password</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="contact_number" type="text" class="form-control rounded-3" placeholder="">
                                <label>Contact Number</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="verifcation_info" type="text" class="form-control rounded-3" placeholder="Verifcation Info">
                                <label>Verifcation Info</label>
                            </div>

                            <button class="w-100 mb-2 btn rounded-3 btn-outline-light " type="submit" value="Register">Sign up</button>
                            <a href="login.php" class="w-100 mb-2 btn rounded-3 btn-outline-light ">Log in</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
    include("footer.php");
?>