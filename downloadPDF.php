<?php 
session_start();
include_once('database/db.php');
include_once('extention/securityNotLogin.php');
$file = $_POST['fileName'];
$filePath = './surat/' . $file;

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Length: ' . filesize($filePath));

readfile($filePath);
?>