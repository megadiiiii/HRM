<?php  
// giai thich ki line 14
include_once 'dbConnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $id = $_POST['id_nhan_vien'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $date_of_joining = $_POST['date_of_joining'];
    $department = $_POST['department'];
    // cho anh vao uploads
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = 'uploads/' . $_FILES['profile_image']['name'];
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image);
    } else {
        $profile_image = null;
    }
    // check xem co chua
    $check = "SELECT * FROM employees WHERE id = $id";
    $result = mysqli_query($con, $check);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('ID đã tồn tại. Vui lòng sử dụng ID khác.');</script>";
    } else {
        // lenh de them vao database
        $sql = "INSERT INTO employees (id, first_name, last_name, email, phone, position, salary, date_of_joining, department, profile_image) 
                VALUES ('$id', '$first_name', '$last_name', '$email', '$phone', '$position', '$salary', '$date_of_joining', '$department', '$profile_image')";
        if (mysqli_query($con, $sql)) {
            header("Location: manage_employees.php");
        } else {
            echo "Oh loi roi: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="text-center mt-4 mb-4">Thêm Nhân Viên Mới</h1>
    <form action="add_employee.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" name="id_nhan_vien" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">Họ</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Tên</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Vị trí</label>
            <input type="text" name="position" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">Mức lương</label>
            <input type="number" name="salary" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="date_of_joining" class="form-label">Ngày gia nhập</label>
            <input type="date" name="date_of_joining" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Phòng ban</label>
            <input type="text" name="department" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="profile_image" class="form-label">Hình ảnh</label>
            <input type="file" name="profile_image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Thêm Nhân Viên</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
