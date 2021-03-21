<?php 
error_reporting(0);

include_once './includes/db_connect.php';
include_once "./class/class.user.php";
$user = new USER($conn);
session_start();

session_destroy(); 
$user->logout();
header('Location: login.php'); exit;
        exit;	