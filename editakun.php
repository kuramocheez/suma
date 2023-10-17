<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php');
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT user.id, username, fullname, id_jabatan, level, status FROM user JOIN jabatan ON user.id_jabatan = jabatan.id WHERE user.id = '$id'");
$data = mysqli_fetch_array($query);
$surat = $data[''];
if (isset($_POST['ubahakun'])) {
    $username = $_POST['username'];
    $fullname = $_POST['name'];
    $bagian = $_POST['bagian'];
    $level = $_POST['level'];
    mysqli_query($conn, "UPDATE user SET fullname = '$fullname', id_jabatan = '$bagian', level = '$level' WHERE id = '$id'");
    setcookie('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Akun berhasil diubah</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');
    header("Location: akun.php");
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
    <script src="node_modules/bootstrap-icons/font/bootstrap-icons.json"></script>

    <title>Ubah Akun - SUMA</title>
</head>

<body>
    <?php include_once('extention/navbar.php') ?>
    <div class="container mt-2">
        <h2 class="mb-4">Ubah Akun</h2>
        <form method="POST">
            <div class="form-floating mt-2">
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="<?= $data['fullname'] ?>">
                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            </div>
            <div class="form-floating mt-2">
                <input type="text" name="username" class="form-control" placeholder="Username" disabled value="<?= $data['username'] ?>">
                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
            </div>

            <div class="form-floating mt-2">
                <input type="text" name="bagian" class="form-control" placeholder="bagian" list="bidang" value="<?= $data['id_jabatan'] ?>">
                <label for="bagian" class="form-label">Jabatan</label>
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
                <input type="text" name="level" class="form-control" placeholder="level" list="levels" value="<?= $data['level'] ?>">
                <label for="level" class="form-label">Level Akses <span class="text-danger">*</span></label>
                <datalist id="levels">
                    <option value="Kepala Utama">
                    <option value="Kepala Bagian">
                    <option value="Kepala Sub Bagian">
                    <option value="Staff">
                </datalist>
            </div>
            <div class="mt-2">
                <button class="btn btn-outline-success" name="ubahakun">Ubah Akun</button>
            </div>
        </form>
    </div>
    <?php include_once('extention/logoutModal.php') ?>
</body>
<script src="extention/password.js"></script>

</html>