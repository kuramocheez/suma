<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php');
$query = mysqli_query($conn, "SELECT * FROM surat ORDER BY surat.id DESC");
$tanggalDiterima = date('Y-m-d');
if (isset($_POST['tambah'])) {
    $nomorSurat = $_POST['nomorSurat'];
    $pengirim = $_POST['pengirim'];
    $perihal = $_POST['perihal'];
    // $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];
    $file = $_FILES['surat'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileExtension === 'pdf' && $fileExtension) {
        $uploadDirectory = './surat/';

        $destination = $uploadDirectory . $fileName;
        move_uploaded_file($fileTmpName, $destination);
    }
    
    mysqli_query($conn, "INSERT INTO surat VALUES(NULL, '$nomorSurat', '$pengirim', '$perihal', '$keterangan', '$fileName')");
    $newId = mysqli_insert_id($conn);
    mysqli_query($conn, "INSERT INTO penerima_surat VALUES(NULL, '$newId', 'Kepala Biro Pemerintahan & Otonomi Daerah', '$tanggalDiterima', '', 'Belum Dibaca')");
    setcookie('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Surat berhasil di tambahkan</strong><a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a></div>', time() + 5, '/');
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
    <link rel="stylesheet" href="bg/bg.css">
    <title>Daftar Surat - SUMA</title>
</head>

<body>
    <?php include_once('extention/navbar.php') ?>
    <div class="container mt-2">
        <h2 class="mb-4 text-white">Daftar Surat</h2>
        <?php if (isset($_COOKIE['pesan'])) {
            echo $_COOKIE['pesan'];
        } ?>    
        <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Keterangan</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $data['nomorSurat'] ?></td>
                            <td><?= $data['pengirim'] ?></td>
                            <td><?= $data['perihal'] ?></td>
                            <td><?= $data['Keterangan'] ?></td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="detailsurat.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-outline-success mb-2"><i class="bi bi-info-circle-fill"></i></a>
                                    <a href="editsurat.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-outline-warning mb-2"><i class="bi bi-pencil-square"></i></a>
                                    <a href="hapussurat.php?id=<?= $data['id'] ?>" onclick="return confirm('Yakin ingin menghapus surat?')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="7">
                            <div class="d-grid gap-2 mb-2">
                                <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambahSurat"><i class="bi bi-plus-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>


            </table>
        </div>
    </div>

    <!-- Tambah Surat Modal -->
    <div class="modal fade" id="tambahSurat" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class=" modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Surat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-warning"><span class="text-danger">*</span> Wajib diisi!</div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-floating mt-2">
                        <input type="text" id="nomorSurat" name="nomorSurat" class="form-control" placeholder="Nomor Surat">
                        <label for="nomorSurat" class="form-label">Nomor Surat <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="date" id="tanggalDiterima" class="form-control" placeholder="Tanggal Diterima" disabled value="<?= $tanggalDiterima ?>">
                        <label for="tanngalDiterima" class="form-label">Tanggal Diterima <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="text" id="pengirim" name="pengirim" class="form-control" placeholder="Pengirim Surat">
                        <label for="pengirim" class="form-label">Pengirim Surat <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="text" id="perihal" name="perihal" class="form-control" placeholder="Perihal Surat">
                        <label for="perihal" class="form-label">Perihal Surat <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mt-2">
                        <textarea name="keterangan" id="keterangan" cols="30" rows="30" placeholder="Keterangan" class="form-control"></textarea>
                        <label for="keterangan" class="form-label">Keterangan Surat </label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="file" id="surat" name="surat" class="form-control" accept="application/pdf">
                        <label for="surat" class="form-label">Upload Surat <span class="text-danger">Only PDF*</span></label>
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
    <?php include_once('extention/logoutModal.php') ?>
</body>
<script src="extention/password.js"></script>

</html>