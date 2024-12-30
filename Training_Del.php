<?php 
    include_once "dbConnect.php";
    $course_id = $_GET['course_id'];
    $sql_del = "DELETE FROM `Training` WHERE `course_id` = '$course_id'";
    $data_del = mysqli_query($con, $sql_del);
    if($data_del) {
        header('location: ../HRM/Training.php');
    }
?>