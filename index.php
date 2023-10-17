<?php
session_start();
include_once('extention/securityLogin.php');
include_once('database/db.php');
$error = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT user.id, username, password, fullname, id_jabatan, jabatan, level, bidang, turunan FROM user JOIN jabatan ON user.id_jabatan = jabatan.id WHERE username = '$username' AND password = '$password'");
    $check = mysqli_num_rows($query);
    if ($check == 1) {
        $data = mysqli_fetch_array($query);
        if ($data['status'] == "Block") {
            $error = "Account has Blocked, Please Contact Admin!";
        } else {
            $_SESSION['user'] = $data;
            header("Location: home.php");
        }
    } else {
        $error = "Username or Password Maybe Wrong!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bg/bg.css">
    <title>Login - SUMA</title>
    <style>
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center mt-5 mb-5 text-white">LOGIN PAGE - SUMA</h1>
            </div>
        </div>
        <div class="center-form">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center m-2">
                            <img src="bg/logo_sulawesitengah.png" alt="logo" width="90px" class="">
                        </div>
                        <div class="col-lg-12">
                            <form method="POST">
                                <div class="form-floating mb-2">
                                    <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                                    <label for="username" class="form-label">Username</label>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="form-floating">
                                        <input type="password" name="password" id="password" placeholder="****" class="form-control">
                                        <label for="password" class="form-label">Password</label>
                                    </div>
                                    <span class="input-group-text" style="cursor: pointer;" id="show-pass" onclick="togglePassword()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg></span>
                                </div>
                                <div class="d-grid gap-2 mb-2">
                                    <button name="login" class="btn btn-outline-success">LOGIN</button>
                                </div>
                            </form>
                        </div>
                        <?php
                        if ($error != "") {
                        ?>
                            <div class="alert alert-danger">
                                <strong><?= $error ?></strong>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="extention/password.js"></script>

</html>