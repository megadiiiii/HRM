<?php
// Bắt đầu session
session_start();
include_once("../HRM/dbConnect.php");

// Kiểm tra nếu người dùng đã đăng nhập
function isLoggedIn() {
    return isset($_SESSION['username']) && isset($_SESSION['staff_name']);
}

// Đăng nhập: Lưu thông tin người dùng vào session
function login($username, $staff_name) {
    $_SESSION['username'] = $username;
    $_SESSION['staff_name'] = $staff_name;

    // Cập nhật thời gian đăng nhập
    $_SESSION['last_login'] = time();
}

// Đăng xuất: Xoá tất cả session
function logout() {
    session_unset(); // Xoá tất cả session
    session_destroy(); // Huỷ session

    // Chuyển hướng về trang đăng nhập
    header('Location: Sign_In.php');
    exit();
}

// Kiểm tra thời gian hết hạn session (optional)
function sessionTimeout($timeout_duration = 3600) {
    if (isset($_SESSION['last_login']) && (time() - $_SESSION['last_login']) > $timeout_duration) {
        logout(); // Đăng xuất nếu session hết hạn
    } else {
        $_SESSION['last_login'] = time(); // Cập nhật lại thời gian đăng nhập
    }
}
?>
