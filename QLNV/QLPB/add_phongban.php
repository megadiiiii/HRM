<?php
include_once 'dbConnect.php';

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $department_name = mysqli_real_escape_string($conn, $_POST['department_name']);
    $mo_ta = mysqli_real_escape_string($conn, $_POST['mo_ta']);
    $ghi_chu = mysqli_real_escape_string($conn, $_POST['ghi_chu']);
    $so_dien_thoai = mysqli_real_escape_string($conn, $_POST['so_dien_thoai']);

    // Kiểm tra xem tên phòng ban đã tồn tại hay chưa
    $check = "SELECT * FROM phongban WHERE department_name = '$department_name'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Tên phòng ban đã tồn tại. Vui lòng sử dụng tên khác.');</script>";
    } else {
        // Chèn dữ liệu vào bảng phongban
        $sql = "INSERT INTO phongban (department_name, mô_tả, ghi_chú, số_điện_thoại) 
                VALUES ('$department_name', '$mo_ta', '$ghi_chu', '$so_dien_thoai')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Thêm phòng ban thành công!'); window.location.href='manage_phongban.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm phòng ban: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phòng Ban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="text-center mt-4 mb-4">Thêm Phòng Ban Mới</h1>
    <form action="add_phongban.php" method="POST">
        <div class="mb-3">
            <label for="department_name" class="form-label">Tên Phòng Ban</label>
            <input type="text" name="department_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="mo_ta" class="form-label">Mô Tả</label>
            <textarea name="mo_ta" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="ghi_chu" class="form-label">Ghi Chú</label>
            <textarea name="ghi_chu" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
            <input type="text" name="so_dien_thoai" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Thêm Phòng Ban</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
