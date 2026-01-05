<?php
    include("includes/header.php");
    include("functions/notification.php");

    display_notification_messages();
    display_notification_messages_sucesses();
?>

        <div class="container p-5 min-vh-100" >
            <div class="m-auto w-50" >
                <div class="rounded-4 shadow">
                    <div class="p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2">Please Login</h1>
                    </div>

                    <div class="p-5 pt-5">
                        <!-- Login Form -->
                        <form class="login" action="functions/login_process.php" method="POST">
                            
                            <div class="form-floating mb-3">
                                <input name="username" type="text" class="form-control rounded-3" placeholder="">
                                <label>User ID or Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="password" type="password" class="form-control rounded-3" placeholder="">
                                <label>Enter Password</label>
                            </div>

                            <button class="w-100 mb-2 btn btn-outline-light  rounded-3" type="submit" value="Login">Log in</button>

                            <a href="register.php" class="w-100 mb-2 btn btn-outline-light  rounded-3" >Sign up</a>
                            <a href="forget_password.php" class="mb-2 link-underline link-underline-opacity-0 rounded-3" >Forget Password?</a>

                            <!-- Admin Section -->
                            <br>
                            <br>
                            <br>
                            <a data-title="Admin" href="admin/index.php" class="mb-2 btn btn-outline-light  rounded-3" ><i class="fa-solid fa-user-gear"></i></a>
                            <a data-title="Author" href="author/login.php" class="mb-2 btn btn-outline-light  rounded-3" ><i class="fa-solid fa-feather-pointed"></i></a>
                           

                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
    include("includes/footer.php");
?>
