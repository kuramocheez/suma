<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php');
$id = $_GET['id'];
$tanggalNow = date('Y-m-d');
$query = mysqli_query($conn, "SELECT * FROM surat WHERE id = '$id'");
$data = mysqli_fetch_array($query);
$iduser = $_SESSION['user']['id'];
$user = mysqli_query($conn, "SELECT jabatan, bidang, level, fullname FROM user JOIN jabatan ON user.id_jabatan = jabatan.id WHERE user.id = '$iduser'");
$getBidang = mysqli_fetch_array($user);
$jabatan = $getBidang['jabatan'];
$bidang = $getBidang['bidang'];
$fullname = $getBidang['fullname'];
if (isset($_POST['kirim'])) {
    $keterangan = $_POST['keterangan'];
    mysqli_query($conn, "UPDATE penerima_surat SET keterangan = '$keterangan', statusSurat = 'Di Teruskan' WHERE penerima = '$jabatan' AND id_surat = '$id' AND penerima = '$jabatan'");
    foreach ($_POST['penerima'] as $penerima) {
        mysqli_query($conn, "INSERT INTO penerima_surat VALUES (NULL, '$id', '$penerima','$tanggalNow', '', 'Belum Dibaca')");
    }
    setcookie('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Surat berhasil di teruskan</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');
    header("Location: detail.php?id=$id");
}
if ($_SESSION['user']['level'] != "Staff") {
    $surat = mysqli_query($conn, "SELECT * FROM penerima_surat WHERE id_surat = '$id' AND penerima = '$jabatan'");
    $getSurat = mysqli_fetch_array($surat);
    $statusSurat = $getSurat['statusSurat'];
} else {
    $surat = mysqli_query($conn, "SELECT * FROM penerima_surat WHERE id_surat = '$id' AND penerima = '$fullname'");
    $getSurat = mysqli_fetch_array($surat);
    $statusSurat = $getSurat['statusSurat'];
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
    <link rel="stylesheet" href="bg/bg.css">
    <title>Detail Surat - SUMA</title>
</head>

<body>
    <?php include_once('extention/navbar.php') ?>
    <div class="container mt-2">
        <h2 class="mb-4 text-white">Detail Surat</h2>
        <?php if (isset($_COOKIE['pesan'])) {
            echo $_COOKIE['pesan'];
        } ?>
        <div class="d-flex flex-row justify-content-between">
            <div class="d-flex flex-column text-white">
                <h4>Keterangan Surat</h4>
                <div class="p-2"><strong>Nomor Surat: </strong><?= $data['nomorSurat'] ?></div>
                <div class="p-2"><strong>Perihal: </strong><?= $data['perihal'] ?></div>
                <div class="p-2"><strong>Pengirim: </strong><?= $data['pengirim'] ?></div>
                <div class="p-2"><strong>Keterangan: </strong><?= $data['Keterangan'] ?></div>
                <div class="d-flex flex-row">
                    <div class="me-2">
                        <form action="readPDF.php" method="POST" target="_blank">
                            <input type="text" hidden name="id" value="<?= $data['id'] ?>">
                            <input type="text" hidden name="fileName" value="<?= $data['file'] ?>">
                            <button onclick="Update()" class="btn btn-lg btn-primary">Lihat Surat</button>
                        </form>
                    </div>
                    <div>
                        <form action="downloadPDF.php" method="POST" target="_blank">
                            <input type="text" hidden name="fileName" value="<?= $data['file'] ?>">
                            <button class="btn btn-lg btn-success">Download Surat</button>
                        </form>
                    </div>
                </div>
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
                            <td id="status-surat"><?= $r['statusSurat'] ?></td>
                            <td><?= $r['keterangan'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <?php
                if ($statusSurat == "Sudah Dibaca") {
                ?>
                    <div id="proses-surat">
                        <h4 class="text-white">Proses Surat</h4>
                        <a href="terimasurat.php?id=<?= $id ?>" onclick="return confirm('Yakin terima surat ini?')" class="btn btn-primary">Terima Surat</a>
                        <?php
                        if ($_SESSION['user']['level'] != "Staff") {
                        ?>
                            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#teruskanSurat">Teruskan Surat</a>
                        <?php
                        }
                        ?>
                    </div>
            </div>
        </div>
    <?php
                }
    ?>



    <?php include_once('extention/teruskansurat.php') ?>

    </div>
    <?php include_once('extention/logoutModal.php') ?>

    </div>
</body>
<script src="extention/password.js"></script>
<script>
    function Update() {
        setTimeout(function() {
            location.reload();
        }, 2000);
    }
</script>

</html>