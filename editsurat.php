<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php');
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM surat JOIN penerima_surat ON penerima_surat.id_surat = surat.id WHERE surat.id = '$id'");
// $query = mysqli_query($conn, "SELECT * FROM surat WHERE id = '$id'");

$data = mysqli_fetch_array($query);
$fileName = $data['file'];
if (isset($_POST['ubah'])) {
    $nomorSurat = $_POST['nomorSurat'];
    // $tanggalDiterima = $_POST['tanggalDiterima'];
    // $formatTanggal = date('Y-m-d', strtotime($tanggalDiterima));
    $pengirim = $_POST['pengirim'];
    $perihal = $_POST['perihal'];
    // $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];
    $fileSize = $_FILES['surat']['size'];
    $fileError = $_FILES['surat']['error'];
    if ($fileError === 0 && $fileSize > 0) {
        $file = $_FILES['surat'];
        // unlink("./surat/$fileName");
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if ($fileExtension === 'pdf' && $fileExtension) {
            $uploadDirectory = './surat/';

            $destination = $uploadDirectory . $fileName;
            move_uploaded_file($fileTmpName, $destination);
        }
    }

    mysqli_query($conn, "UPDATE surat SET nomorSurat = '$nomorSurat', pengirim = '$pengirim', perihal = '$perihal', keterangan = '$keterangan', file = '$fileName' WHERE id = '$id'");
    setcookie('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Surat berhasil di ubah</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');
    header("Location: daftarSurat.php");
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
    <script src="lib/pdf.js/web/pdfjs.js"></script>
    <link rel="stylesheet" href="bg/bg.css">
    <title>Ubah Surat - SUMA</title>
</head>

<body>
    <?php include_once('extention/navbar.php') ?>
    <div class="container mt-2">
        <h2 class="mb-4 text-white">Ubah Surat</h2>
        <form action="readPDF.php" method="POST" target="_blank">
            <input type="text" hidden name="fileName" value="<?= $data['file'] ?>">
            <button class="btn btn-lg btn-primary">Lihat Surat Sebelumnya</button>
        </form>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-floating mt-2">
                <input type="text" id="nomorSurat" name="nomorSurat" class="form-control" placeholder="Nomor Surat" value="<?= $data['nomorSurat'] ?>">
                <label for="nomorSurat" class="form-label">Nomor Surat <span class="text-danger">*</span></label>
            </div>
            <div class="form-floating mt-2">
                <input type="date" id="tanggalDiterima" name="tanggalDiterima" class="form-control" placeholder="Tanggal Diterima" disabled value="<?= $data['tanggalDiterima'] ?>">
                <label for="tanngalDiterima" class="form-label">Tanggal Diterima <span class="text-danger">*</span></label>
            </div>
            <div class="form-floating mt-2">
                <input type="text" id="pengirim" name="pengirim" class="form-control" placeholder="Pengirim Surat" value="<?= $data['pengirim'] ?>">
                <label for="pengirim" class="form-label">Pengirim Surat <span class="text-danger">*</span></label>
            </div>
            <div class="form-floating mt-2">
                <input type="text" id="perihal" name="perihal" class="form-control" placeholder="Perihal Surat" value="<?= $data['perihal'] ?>">
                <label for="perihal" class="form-label">Perihal Surat <span class="text-danger">*</span></label>
            </div>
            
            <div class="form-floating mt-2">
                <textarea name="keterangan" id="keterangan" cols="30" rows="30" placeholder="Keterangan" class="form-control"><?= $data['Keterangan'] ?></textarea>
                <label for="keterangan" class="form-label">Keterangan Surat <span class="text-danger">*</span></label>
            </div>
            <div class="mt-2 mb-2">
            </div>
            <div class="form-floating mt-2">
                <input type="file" id="surat" name="surat" class="form-control" accept="application/pdf">
                <label for="surat" class="form-label">Upload Surat Baru <span class="text-danger">Only PDF*</span></label>
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" name="ubah">Ubah</button>
            </div>
        </form>
    </div>

    </div>
    <?php include_once('extention/logoutModal.php') ?>
</body>
<script src="extention/password.js"></script>

</html>