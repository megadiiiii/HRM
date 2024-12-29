<?php 
    include_once "dbConnect.php";
    $Id = $_GET['Id'];
    $sql_del = "DELETE FROM `daotao` WHERE `Id` = '$Id'";
    $data_del = mysqli_query($con, $sql_del);
    if($data_del) {
        header('location:Search.php');
    }
?>