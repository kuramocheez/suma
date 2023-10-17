<?php
session_start();
include_once('database/db.php');
include_once('extention/securityNotLogin.php');
$id = $_POST['id'];
$jabatan = $_SESSION['user']['id_jabatan'];
$fullname = $_SESSION['user']['fullname'];
$query = mysqli_query($conn, "SELECT jabatan FROM jabatan WHERE id = '$jabatan'");
$data = mysqli_fetch_array($query);
if ($_SESSION['user']['level'] != "Staff")
{
    $penerima = $data['jabatan'];
}else{
    $penerima = $fullname;
}
$ambil = mysqli_query($conn, "SELECT statusSurat FROM penerima_surat WHERE id_surat = '$id' AND penerima = '$penerima'");
$cek = mysqli_fetch_array($ambil);
if ($_SESSION['user']['level'] != "Admin" && $cek['statusSurat'] == "Belum Dibaca") {
    mysqli_query($conn, "UPDATE penerima_surat SET statusSurat = 'Sudah Dibaca' WHERE id_surat ='$id' AND penerima = '$penerima'");
}
$file = $_POST['fileName'];
$filePath = './surat/' . $file;


header('Content-Type: application/pdf');
// header('Content-Disposition: inline; name="' . $file . '"; filename="' . $file . '"');
// header('Content-Length: ' . filesize($filePath));
readfile($filePath);
?>
