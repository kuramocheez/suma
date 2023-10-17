<?php
session_start();
include_once('extention/securityNotLogin.php');
include_once('database/db.php'); 
$id = $_GET['id'];

mysqli_query($conn, "UPDATE user SET status = 'Active' WHERE id = '$id'");
header("Location: akun.php");
?>