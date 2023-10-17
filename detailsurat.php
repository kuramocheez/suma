<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php');
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM surat WHERE id = '$id'");
$data = mysqli_fetch_array($query);
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
    <link rel="stylesheet" href="bg/bg.css">
    <title>Detail Surat - SUMA</title>
</head>

<body>
    <?php include_once('extention/navbar.php') ?>
    <div class="container mt-2">
        <h2 class="mb-4 text-white">Detail Surat</h2>
        <div class="d-flex flex-row justify-content-between">
            <div class="d-flex flex-column text-white">
                <h4>Keterangan Surat</h4>
                <div class="p-2"><strong>Nomor Surat: </strong><?= $data['nomorSurat'] ?></div>
                <div class="p-2"><strong>Perihal: </strong><?= $data['perihal'] ?></div>
                <div class="p-2"><strong>Pengirim: </strong><?= $data['pengirim'] ?></div>
                <div class="p-2"><strong>Keterangan: </strong><?= $data['Keterangan'] ?></div>
            </div>
            <div class="d-flex flex-column">
                <h4 class="text-white">Tracking Surat</h4>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM penerima_surat WHERE id_surat = ''$id");
                ?>

                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Penerima</th>
                        <th>Tanggal Diterima</th>
                        <th>Status Surat</th>
                        <th>Keterangan</th>
                    </tr>
                    <?php
                    $ambil = mysqli_query($conn, "SELECT * FROM penerima_surat WHERE id_surat = $id");
                    $no = 1;
                    while ($r = mysqli_fetch_array($ambil)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r['penerima'] ?></td>
                            <td><?= date('D, d-F-Y', strtotime($r['tanggalDiterima'])) ?></td>
                            <td><?= $r['statusSurat'] ?></td>
                            <td><?= $r['keterangan'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <form action="readPDF.php" method="POST" target="_blank">
            <input type="text" hidden name="fileName" value="<?= $data['file'] ?>">
            <button class="btn btn-lg btn-primary mb-5">Lihat Surat</button>
        </form>
    </div>
    <?php include_once('extention/logoutModal.php') ?>
</body>
<script src="extention/password.js"></script>

</html>