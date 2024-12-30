<?php 
    include_once "dbConnect.php";
    $username = $_GET['username'];
    $sql_del = "DELETE FROM `account` WHERE `username` = '$username'";
    $data_del = mysqli_query($con, $sql_del);
    if($data_del) {
        header('location: ../HRM/Account.php');
    }
?>