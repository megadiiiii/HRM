<?php
// Thông tin kết nối cơ sở dữ liệu
$host = 'localhost'; // Tên host
$username = 'root'; // Tên tài khoản MySQL
$password = ''; // Mật khẩu MySQL (để trống nếu không có)
$dbname = 'hrm'; // Tên cơ sở dữ liệu

// Tạo kết nối
$con = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($con->connect_error) {
    die("Kết nối thất bại: " . $con->connect_error);
}
?>
