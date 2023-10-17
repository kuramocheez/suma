<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php'); 
$id = $_GET['id'];
$iduser = $_SESSION['user']['id'];
$fullname = $_SESSION['user']['fullname'];
$user = mysqli_query($conn, "SELECT jabatan, bidang FROM user JOIN jabatan ON user.id_jabatan = jabatan.id WHERE user.id = '$iduser'");
$getBidang = mysqli_fetch_array($user);
if($_SESSION['user']['level'] != "Staff")
{
    $penerima = $getBidang['jabatan'];
}else{
    $penerima = $fullname;  
}
mysqli_query($conn, "UPDATE penerima_surat SET statusSurat = 'Sudah Diterima', keterangan = 'Surat Sudah Dibaca dan Diterima' WHERE id_surat = '$id' AND penerima = '$penerima'");
header("Location: detail.php?id=$id");
