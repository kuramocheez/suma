<?php 
if(isset($_SESSION['user']))
{
    header("Location: home.php");
}
?>