<?php
    session_start();

    if(isset($_SESSION['admin']['status']))
    {
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon.png">

        <title>Login</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>

        <div class="container mt-5 p-4 py-md-5 min-vh-100">
            <div class="w-50 m-auto">
                <div class="rounded-4 shadow">

                    <div class="p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2">Admin login</h1>
                    </div>

                    <div class="p-5 pt-0">
                        <form class="login" action="functions/login_process.php" method="POST">
                            
                            <div class="form-floating mb-3">
                                <input name="username" type="text" class="form-control rounded-3" id="floatingInput" placeholder="">
                                <label for="floatingInput">Admin name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="password" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="">
                                <label for="floatingPassword">Password</label>
                            </div> 

                            <button class="w-100 mb-2 btn btn-sm rounded-3 btn-outline-light" type="submit">Login</button>
                            <a class="w-100 mb-2 btn btn-sm rounded-3 btn-outline-light" href="../index.php">Exit</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        </div>
<?php
include("includes/footer.php");
?>