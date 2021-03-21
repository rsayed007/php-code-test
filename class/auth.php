<?php
    // echo '<pre>';
    // print_r($_SESSION['SES_USER_id']);
    // echo '<br>';
    // print_r($_SESSION['SESS_USER_DB_LOGINKEY']);
    // echo '<br>';
    // print_r($_SESSION['SES_USER_ROLL']);
    // echo '</pre>';
    if ($_SESSION['SES_USER_ROLL'] !== 'ADMIN') {
        header("location: login.php");
		exit();
    }
	if((!isset($_SESSION['SES_USER_id']) || (trim($_SESSION['SES_USER_id']) == '') || $_SESSION['SESS_USER_DB_LOGINKEY']!=$_SESSION['SESS_USER_LOGINKEY'])) {
		header("location: admin_login.php");
		exit();
	}
