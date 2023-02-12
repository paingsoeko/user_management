<?php
session_start();
include "core/functions.php";
if(isset($_SESSION['loggedin'])){
    header("location:dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png">
    <title>Login | UMS</title>
    <link class="js-stylesheet" href="css/style.css" rel="stylesheet">
</head>
<body>
<main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Welcome User Management System</h1>
                        <p class="lead">
                            Login in to your account to continue
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <div class="text-center mb-5">
                                    <img src="img/dev_productivity.svg" alt="Charles Hall" class="img-fluid" width="132" height="132">
                                </div>
                                <?php
                                   if(isset($_POST['login_submit'])) {
                                       echo auth();
                                   }
                                ?>
                                <form method="post">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input class="form-control form-control-lg" type="text" name="username" placeholder="Enter your email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password">
                                    </div>
                                    <div class="text-center mt-3">
                                         <button type="submit" name="login_submit" class="btn btn-lg btn-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<script src="js/app.js"></script>
</body>
</html>