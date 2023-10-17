<?php 
session_start();
include_once('extention/securityNotLogin.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bg/bg.css">
    <title>Admin Menu - SUMA</title>
</head>

<body>
    <?php include_once('extention/navbar.php'); ?>
    <div class="container mt-2">
        <h2 class="mb-4 text-white">Admin Menu</h2>

        <div class="row">
            <div class="col-lg-4">
                <a href="akun.php" style="text-decoration:none;">
                    <div class="card bg-primary text-white p-3" style="min-height:22vh; cursor:pointer">
                        <div class="d-flex flex" style="justify-content: center; align-items: center;">
                            <div class="p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                </svg>
                            </div>
                            <div class="p-3">
                                <h3>Kelola Akun</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="pengaturanAkun.php" style="text-decoration:none;">
                    <div class="card bg-success text-white p-3" style="min-height:22vh; cursor:pointer">
                        <div class="d-flex flex" style="justify-content: center; align-items: center;">
                            <div class="p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                            </div>
                            <div class="p-3">
                                <h3>Pengaturan Akun Admin</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="daftarSurat.php" style="text-decoration:none;">
                    <div class="card bg-danger text-white p-3" style="min-height:22vh; cursor:pointer">
                        <div class="d-flex flex" style="justify-content: center; align-items: center;">
                            <div class="p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                                </svg>
                            </div>
                            <div class="p-3">
                                <h3>Daftar Surat</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php include_once("extention/logoutModal.php"); ?>
</body>

</html>