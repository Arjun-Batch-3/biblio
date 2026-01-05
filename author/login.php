<?php
    include("header.php");
    include("../functions/notification.php");

    display_notification_messages();
    display_notification_messages_sucesses();
?>

        <div class="container mt-4 p-5 min-vh-100" >
            <div class="m-auto w-50" >
                <div class="rounded-4 shadow">
                    <div class="px-5 py-2 border-bottom-0">
                        <a href="../index.php" class="mb-2 btn btn-sm btn-outline-light px-2 rounded-3" ><i class="fa-solid fa-chevron-left"></i></i></a>
                        <h1 class="fw-bold mb-0 fs-2">Author Login</h1>
                    </div>

                    <div class="p-5">
                        <!-- Login Form -->
                        <form class="login" action="functions/login_process.php" method="POST">
                            
                            <div class="form-floating mb-3">
                                <input name="email" type="text" class="form-control rounded-3" placeholder="">
                                <label>Author Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="password" type="password" class="form-control rounded-3" placeholder="">
                                <label>Enter Password</label>
                            </div>

                            <button class="w-100 mb-2 btn btn-outline-light  rounded-3" type="submit" value="Login">Log in</button>

                            <a href="register.php" class="w-100 mb-2 btn btn-outline-light  rounded-3" >Sign up</a>
                            <a href="forget_password.php" class="mb-2 link-underline link-underline-opacity-0 rounded-3" >Forget Password?</a>

                            <!-- Admin Section -->
                            <!-- <h2 class="fs-5 fw-bold mb-3">For Admins</h2>
                            <a href="admin/index.php" class="w-100 mb-2 btn btn-outline-secondary  rounded-3" >Admin Login</a> -->
                           

                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
    include("footer.php");
?>
