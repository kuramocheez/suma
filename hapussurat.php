<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php'); 
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM surat WHERE id = '$id'");
header("Location: daftarSurat.php");
?>