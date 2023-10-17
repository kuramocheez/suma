<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php');

$id_session = $_SESSION['user']['id'];
$query = mysqli_query($conn, "SELECT * FROM user JOIN jabatan ON user.id_jabatan = jabatan.id WHERE user.id = '$id_session'");
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan'])) {
    $nama = $_POST['name'];
    setcookie('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Nama Berhasil Diubah</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');

    $query = mysqli_query($conn, "UPDATE user SET fullname = '$nama' WHERE id = '$id_session'");
    header("Location: pengaturanAkun.php");
}
if (isset($_POST['ganti'])) {
    $pwLama = $_POST['pwLama'];
    $pwBaru = $_POST['pwBaru'];
    if ($pwLama != $data['password']) {
        setcookie('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Mengubah Password, Password Lama Salah</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');
        header("Location: pengaturanAkun.php");
    } else {
        setcookie('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password Berhasil Diubah</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');
        $query = mysqli_query($conn, "UPDATE user SET password = '$pwBaru' WHERE id = '$id_session'");
        header("Location: pengaturanAkun.php");
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
    <title>Pengaturan Akun Admin - SUMA</title>
    <style>
        .table-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
    <link rel="stylesheet" href="bg/bg.css">
</head>

<body>
    <?php include_once('extention/navbar.php'); ?>
    <div class="container mt-2">
        <h2 class="text-white">Pengaturan Akun</h2>
        <?php if (isset($_COOKIE['pesan'])) {
            echo $_COOKIE['pesan'];
        } ?>
        <div class="card mt-4">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Username</th>
                        <td><?= $data['username'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td><?= $data['fullname'] ?></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td><?= $data['jabatan'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mt-2">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gantiNama">Ganti Nama</a>
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#gantiPassword">Ganti Password</a>
        </div>
    </div>

    <?php include_once('extention/logoutModal.php'); ?>


    <!-- Ganti Nama Modal -->
    <div class="modal fade" id="gantiNama">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Nama</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap">
                            <label for="name" class="form-label">Nama Lengkap</label>
                        </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" name="simpan">Simpan</button>
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Ganti Nama Modal -->
    <div class="modal fade" id="gantiPassword">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST">
                        <div class="input-group mb-2">
                            <div class="form-floating">
                                <input type="password" id="passwordLama" name="pwLama" class="form-control" placeholder="******" aria-label="passwordLama" aria-describedby="show-pass">
                                <label for="passwordLama" class="form-label">Password Lama</label>
                            </div>
                            <span class="input-group-text" style="cursor: pointer;" id="show-pass-lama" onclick="togglePasswordLama()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg></span>
                        </div>
                        <div class="input-group mb-2">
                            <div class="form-floating">
                                <input type="password" id="password" name="pwBaru" class="form-control" placeholder="******" aria-label="password" aria-describedby="show-pass">
                                <label for="passwordBaru" class="form-label">Password Baru</label>
                            </div>
                            <span class="input-group-text" style="cursor: pointer;" id="show-pass" onclick="togglePassword()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg></span>
                        </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" name="ganti">Ganti</button>
                    </form>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="extention/password.js"></script>

</html>