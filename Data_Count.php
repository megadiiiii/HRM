<?php 
    include_once '../HRM/dbConnect.php';
    // Khai báo biến cho từng bảng
    $account_count = 0;
    $staff_count = 0;
    $department_count = 0;
    $training_count = 0;
    $diligent_count = 0;
    
    // Truy vấn đếm số hàng cho từng bảng và gán vào biến
    $sql_account = "SELECT COUNT(*) AS total_rows FROM account";
    $result_account = $con->query($sql_account);
    if ($result_account) {
        $row = $result_account->fetch_assoc();
        $account_count = $row['total_rows'];
    }
    
    $sql_staff = "SELECT COUNT(*) AS total_rows FROM staff";
    $result_staff = $con->query($sql_staff);
    if ($result_staff) {
        $row = $result_staff->fetch_assoc();
        $staff_count = $row['total_rows'];
    }
    
    $sql_department = "SELECT COUNT(*) AS total_rows FROM department";
    $result_department = $con->query($sql_department);
    if ($result_department) {
        $row = $result_department->fetch_assoc();
        $department_count = $row['total_rows'];
    }
    
    $sql_training = "SELECT COUNT(*) AS total_rows FROM training";
    $result_training = $con->query($sql_training);
    if ($result_training) {
        $row = $result_training->fetch_assoc();
        $training_count = $row['total_rows'];
    }
    
    $sql_diligent = "SELECT COUNT(*) AS total_rows FROM diligent";
    $result_diligent = $con->query($sql_diligent);
    if ($result_diligent) {
        $row = $result_diligent->fetch_assoc();
        $diligent_count = $row['total_rows'];
    }
?>