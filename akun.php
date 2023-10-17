<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php');

$query = mysqli_query($conn, "SELECT user.id, username, fullname, jabatan, level, status FROM user JOIN jabatan ON user.id_jabatan = jabatan.id ORDER BY level ASC");
$AkunTotal = mysqli_num_rows($query);

if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rePassword = $_POST['re-password'];
    $fullname = $_POST['name'];
    $bagian = $_POST['bagian'];
    $level = $_POST['level'];
    if ($password != $rePassword) {
        setcookie('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Akun gagal ditambahkan</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');
        header("Location: akun.php");
    } else {
        mysqli_query($conn, "INSERT INTO user VALUES(NULL, '$username', '$password', '$fullname', '$bagian', '$level', 'Active')");
        setcookie('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Akun berhasil ditambahkan</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');
        header("Location: akun.php");
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
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bg/bg.css">
    <script src="node_modules/bootstrap-icons/font/bootstrap-icons.json"></script>

    <title>Akun - SUMA</title>
</head>

<body>
    <?php include_once('extention/navbar.php') ?>
    <div class="container mt-2">
        <h2 class="mb-4 text-white">Akun</h2>
        <div class="alert alert-warning">
            <div class="d-flex flex-column">
                <div>
                    <strong>Informasi Warna Akun</strong>
                </div>
                <div class="d-flex flex-row">
                    <div class="d-flex flex-column me-2">
                        <div>
                            <span><i class="bi bi-square-fill text-white"></i> Admin</span>
                        </div>
                        <div>
                            <span><i class="bi bi-square-fill text-dark"></i> Kepala Utama</span>
                        </div>
                        <div>
                            <span><i class="bi bi-square-fill text-primary"></i> Kepala Bagian</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <span><i class="bi bi-square-fill text-warning"></i> Kepala Sub Bagian</span>
                        </div>
                        <div>
                            <span><i class="bi bi-square-fill text-danger"></i> Staff</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span><strong>Total Akun: <?= $AkunTotal ?></strong></span>
        <?php if (isset($_COOKIE['pesan'])) {
            echo $_COOKIE['pesan'];
        } ?>
        <div class="row">
            <?php
            while ($data = mysqli_fetch_array($query)) :
            ?>
                <div class="col-lg-4">
                    <?php
                    if ($data['level'] == "Admin") {
                    ?>
                        <div class="card bg-default p-3 mb-3" style="min-height: 48vh;">
                        <?php
                    } else if ($data['level'] == "Kepala Utama" && $data['status'] == "Active") {
                        ?>
                            <div class="card bg-dark text-white p-3 mb-3" style="min-height: 48vh;">
                            <?php
                        } else if ($data['level'] == "Kepala Bagian" && $data['status'] == "Active") {
                            ?>
                                <div class="card bg-primary text-white p-3 mb-3" style="min-height: 48vh;">
                                <?php
                            } else if ($data['level'] == "Kepala Sub Bagian" && $data['status'] == "Active") {
                                ?>
                                    <div class="card bg-warning text-white p-3 mb-3" style="min-height: 48vh;">
                                    <?php
                                } else if ($data['level'] == "Staff" && $data['status'] == "Active") {
                                    ?>
                                        <div class="card bg-danger text-white p-3 mb-3" style="min-height: 48vh;">
                                        <?php
                                    } else if ($data['level'] == "Kepala Utama" && $data['status'] == "Block") {
                                        ?>
                                            <div class="card bg-secondary text-white p-3 mb-3" style="min-height: 48vh;">
                                            <?php
                                        } else if ($data['level'] == "Kepala Bagian" && $data['status'] == "Block") {
                                            ?>
                                                <div class="card bg-secondary text-white p-3 mb-3" style="min-height: 48vh;">
                                                <?php
                                            } else if ($data['level'] == "Kepala Sub Bagian" && $data['status'] == "Block") {
                                                ?>
                                                    <div class="card bg-secondary text-white p-3 mb-3" style="min-height: 48vh;">
                                                    <?php
                                                } else if ($data['level'] == "Staff" && $data['status'] == "Block") {
                                                    ?>
                                                        <div class="card bg-secondary text-white p-3 mb-3" style="min-height: 48vh;">
                                                        <?php
                                                    }
                                                        ?>
                                                        <div class="card-body d-flex flex-row">

                                                            <div class="row">
                                                                <div class="col-lg-4" style="align-items: center; justify-content:center; display:flex;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                                    </svg>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="d-flex flex-column">
                                                                        <div>
                                                                            <strong>Username</strong>
                                                                        </div>
                                                                        <div>
                                                                            <?= $data['username'] ?>
                                                                        </div>
                                                                        <div>
                                                                            <strong>Nama Lengkap</strong>
                                                                        </div>
                                                                        <div>
                                                                            <?= $data['fullname'] ?>
                                                                        </div>
                                                                        <div>
                                                                            <strong>Jabatan</strong>
                                                                        </div>
                                                                        <div>
                                                                            <?= $data['jabatan'] ?>
                                                                        </div>
                                                                        <div>
                                                                            <strong>Status Akun</strong>
                                                                        </div>
                                                                        <div>

                                                                            <?php
                                                                            if ($data['status'] == "Active") {
                                                                                echo '<strong><span class="text-success">' . $data['status'] . '</span></strong>';
                                                                            } else {
                                                                                echo '<strong><span class="text-danger">' . $data['status'] . '</span></strong>';
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php if ($data['level'] != "Admin") {
                                                                ?>
                                                                    <div class="col-lg-12 text-center mt-3">
                                                                        <a href="editakun.php?id=<?= $data['id'] ?>" class="btn btn-light text-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                            </svg></a>
                                                                        <a onclick="return confirm('Yakin ingin menghapus akun?')" href="deleteakun.php?id=<?= $data['id'] ?>" class="btn btn-light text-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                                            </svg></a>
                                                                        <?php
                                                                        if ($data['status'] == "Active") {
                                                                        ?>
                                                                            <a href="blokakun.php?id=<?= $data['id'] ?>" onclick="return confirm('Yakin ingin blokir akun?')" class="btn btn-light text-secondary btn-sm"><i class="bi bi-person-fill-slash"></i></a>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <a href="activeakun.php?id=<?= $data['id'] ?>" onclick="return confirm('Yakin ingin aktivasi akun?')" class="btn btn-light text-success btn-sm"><i class="bi bi-person-fill-check"></i></a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>
                                                <div class="col-lg-2">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#addUser">
                                                        <div class="card bg-success text-white p-3 mb-3" style=" cursor:pointer; height:48vh; width:54vh;">
                                                            <div class="card-body text-center d-flex flex-row" style="justify-content: center; align-items: center;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                    <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                </div>
                                            </div>
                                            <!-- Tambah Modal -->
                                            <div class="modal fade" id="addUser" data-bs-backdrop="static">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Akun</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="alert alert-warning"><span class="text-danger">*</span> Wajib diisi!</div>
                                                            <form method="POST">
                                                                <div class="form-floating mt-2">
                                                                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                                                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="form-floating mt-2">
                                                                    <input type="text" name="username" class="form-control" placeholder="Username">
                                                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="input-group mt-2">
                                                                    <div class="form-floating">
                                                                        <input type="password" name="password" id="password" placeholder="****" class="form-control">
                                                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <span class="input-group-text" style="cursor: pointer;" id="show-pass" onclick="togglePassword()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                        </svg></span>
                                                                </div>
                                                                <div class="input-group mt-2">
                                                                    <div class="form-floating">
                                                                        <input type="password" name="re-password" id="re-password" placeholder="****" class="form-control">
                                                                        <label for="re-password" class="form-label">Re Password <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <span class="input-group-text" style="cursor: pointer;" id="show-re-pass" onclick="toggleRePassword()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                        </svg></span>
                                                                </div>
                                                                <div class="form-floating mt-2">
                                                                    <input type="text" name="bagian" class="form-control" placeholder="bagian" list="bidang">
                                                                    <label for="bagian" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                                                    <datalist id="bidang">
                                                                        <?php
                                                                        $q = mysqli_query($conn, "SELECT * FROM jabatan WHERE jabatan != 'Admin Aplikasi'");
                                                                        while ($d = mysqli_fetch_array($q)) {
                                                                        ?>
                                                                            <option value="<?= $d['id'] ?>"><?= $d['jabatan'] ?>
                                                                            <?php
                                                                        }
                                                                            ?>
                                                                    </datalist>
                                                                </div>
                                                                <div class="form-floating mt-2">
                                                                    <input type="text" name="level" class="form-control" placeholder="level" list="levels">
                                                                    <label for="level" class="form-label">Level Akses <span class="text-danger">*</span></label>
                                                                    <datalist id="levels">
                                                                        <option value="Kepala Utama">
                                                                        <option value="Kepala Bagian">
                                                                        <option value="Kepala Sub Bagian">
                                                                        <option value="Staff">
                                                                    </datalist>
                                                                </div>

                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button class="btn btn-outline-primary" name="tambah">Tambah</button>
                                                            </form>
                                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php include_once('extention/logoutModal.php') ?>
</body>
<script src="extention/password.js"></script>

</html>