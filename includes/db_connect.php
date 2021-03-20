<?php
// error_reporting(0);
$dbusername = "root";
$dbpassword = "";
try {
    $conn = new PDO("mysql:host=localhost;port=3306;dbname=code_test", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'db connected';
} catch(PDOException $e) {
    echo "<center><br/><br/>Opps: System Under Critical Maintenance Window. <br/><br/> for any query please email taap@pekhom.com</center>";
}
?>