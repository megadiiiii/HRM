<?php
include_once 'dbConnect.php';

// Lấy ID nhân viên từ URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Truy vấn thông tin chi tiết của nhân viên cùng với tên phòng ban
    $sql = "SELECT e.*, p.department_name 
            FROM employees e
            LEFT JOIN phongban p ON e.department = p.id
            WHERE e.id = $id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $employee = mysqli_fetch_assoc($result);
    } else {
        echo "Không tìm thấy nhân viên với ID này.";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Thông Tin Nhân Viên</h1>
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4">
                <?php if ($employee['profile_image']) { ?>
                    <img src="<?php echo $employee['profile_image']; ?>" class="profile-img" alt="Hình ảnh nhân viên">
                <?php } else { ?>
                    <img src="https://via.placeholder.com/120" class="profile-img" alt="Hình ảnh mặc định">
                <?php } ?>
            </div>
            <p><strong>ID:</strong> <?php echo $employee['id']; ?></p>
            <p><strong>Họ:</strong> <?php echo $employee['first_name']; ?></p>
            <p><strong>Tên:</strong> <?php echo $employee['last_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $employee['email']; ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $employee['phone']; ?></p>
            <p><strong>Phòng ban:</strong> <?php echo $employee['department_name']; ?></p> <!-- Hiển thị tên phòng ban -->
            <p><strong>Vị trí:</strong> <?php echo $employee['position']; ?></p>
            <p><strong>Mức lương:</strong> <?php echo $employee['salary']; ?></p>
            <p><strong>Ngày gia nhập:</strong> <?php echo $employee['date_of_joining']; ?></p>
        </div>
    </div>
    <div class="mt-4 text-center">
        <a href="manage_employees.php" class="btn btn-primary">Quay lại</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
