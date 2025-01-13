<?php 
    include_once "dbConnect.php";
    
    // Lấy dữ liệu từ URL
    $course_id = $_GET['course_id'];
    $staff_id = $_GET['staff_id']; // Giả sử bạn có staff_id trong URL, ví dụ: Training_Del.php?course_id=xxx&staff_id=yyy
    
    // Câu lệnh SQL xóa bản ghi có cả course_id và staff_id
    $sql_del = "DELETE FROM `Training` WHERE `course_id` = '$course_id' AND `staff_id` = '$staff_id'";

    // Thực thi câu lệnh xóa
    $data_del = mysqli_query($con, $sql_del);
    
    // Nếu xóa thành công, chuyển hướng đến trang Training.php
    if($data_del) {
        header('location: ../HRM/Training.php');
    } else {
        // Thông báo lỗi nếu không xóa thành công
        echo "Có lỗi xảy ra trong quá trình xóa dữ liệu.";
    }
?>
