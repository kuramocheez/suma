<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php');
$id_session = $_SESSION['user']['id'];
$query = mysqli_query($conn, "SELECT * FROM user JOIN jabatan ON user.id_jabatan = jabatan.id WHERE user.id = '$id_session'");
$data = mysqli_fetch_array($query);
$jabatan = $data['jabatan'];
$fullname = $data['fullname'];

if ($data['level'] == 'Admin') {
    $q = mysqli_query($conn, "SELECT surat.id, surat.nomorSurat, surat.pengirim, surat.perihal, penerima_surat.tanggalDiterima FROM surat LEFT JOIN penerima_surat ON penerima_surat.id_surat = surat.id WHERE penerima = 'Kepala Biro Pemerintahan & Otonomi Daerah' ORDER BY surat.id DESC");
} else if ($data['level'] == "Kepala Utama" || $data['level'] == 'Kepala Bagian' || $data['level'] == 'Kepala Sub Bagian') {
    $q = mysqli_query($conn, "SELECT surat.id, surat.nomorSurat, surat.pengirim, surat.perihal, penerima_surat.tanggalDiterima FROM surat LEFT JOIN penerima_surat ON penerima_surat.id_surat = surat.id WHERE penerima = '$jabatan' ORDER BY surat.id DESC");
} else if ($data['level'] == 'Staff') {
    $q = mysqli_query($conn, "SELECT surat.id, surat.nomorSurat, surat.pengirim, surat.perihal, penerima_surat.tanggalDiterima FROM surat LEFT JOIN penerima_surat ON penerima_surat.id_surat = surat.id WHERE penerima = '$fullname' ORDER BY surat.id DESC");
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
    <title>Home - SUMA</title>
</head>

<body>
    <?php
    include_once('extention/navbar.php');
    ?>
    <div class="container mt-2">
        <h2 class="text-white">Selamat Datang, <?= $data['fullname'] ?></h2>

        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Tanggal Diterima</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($d = mysqli_fetch_array($q)) {
                    ?>
                        <tr>
                            <td><?= $d['nomorSurat'] ?></td>
                            <td><?= date('D, d F Y', strtotime($d['tanggalDiterima'])) ?></td>
                            <td><?= $d['pengirim'] ?></td>
                            <td><?= $d['perihal'] ?></td>
                            <td>
                                <div class="d-flex flex-column">
                                    <?php
                                    if ($data['level'] == "Admin") {
                                    ?>
                                        <a href="detailsurat.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-outline-success mb-2"><i class="bi bi-info-circle-fill"></i></a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="detail.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-outline-success mb-2"><i class="bi bi-info-circle-fill"></i></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once("extention/logoutModal.php"); ?>
</body>

</html>