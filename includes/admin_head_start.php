
<?php
	session_start();

	//Check whether the session variable SESS_MEMBER_ID is present or not
    include_once "./class/auth.php";


    include_once './includes/db_connect.php';
    include_once "./class/class.user.php";
    $user = new USER($conn);

    // $location = $user->locations();
    // echo '<pre>';
    // print_r($location);
    // echo '</pre>';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

