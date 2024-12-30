<?php 
    include_once "dbConnect.php";
    $department_id = $_GET['department_id'];
    $sql_del = "DELETE FROM `department` WHERE `department_id` = '$department_id'";
    $data_del = mysqli_query($con, $sql_del);
    if($data_del) {
        header('location: ../HRM/Department.php');
    }
?>