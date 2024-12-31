<?php 
    include_once "dbConnect.php";
    $staff_id = $_GET['staff_id'];
    $sql_del = "DELETE FROM `work_time` WHERE `staff_id` = '$staff_id'";
    $data_del = mysqli_query($con, $sql_del);
    if($data_del) {
        header('location: ../HRM/Work_time.php');
    }
?>