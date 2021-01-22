<?php
session_start();


if(!isset($_SESSION['user'])){
    header("location:login.php");
    exit();
}else{
    $_SESSION = array();
    session_destroy();
    header("location:login.php");
    exit();
}
?>