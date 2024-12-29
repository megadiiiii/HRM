<?php
// giai thich ki line 24

include_once 'dbConnect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Lấy thông tin nhân viên từ cơ sở dữ liệu
    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];// vi tri
    $salary = $_POST['salary'];// muc luong
    $date_of_joining = $_POST['date_of_joining'];
    $department = $_POST['department'];// phong ban
    // xử lý hình ảnh
    // tao bien file luu tru xong de sua
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = 'uploads/' . $_FILES['profile_image']['name'];
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image);
    } else {
        $profile_image = $row['profile_image']; // Giữ lại ảnh cũ nếu không upload ảnh mới
    }
    // Kiểm tra nếu ID mới đã tồn tại
    $check_id_sql = "SELECT * FROM employees WHERE id = $id AND id != $id";
    $check_id_result = mysqli_query($con, $check_id_sql);

    if (mysqli_num_rows($check_id_result) > 0) {
        echo "<script>alert('ID đã tồn tại. Vui lòng sử dụng ID khác.');</script>";
    } else {
        // lenh update xong ktra luon
        $sql = "UPDATE employees SET id = '$id', first_name = '$first_name', last_name = '$last_name', 
                email = '$email', phone = '$phone', position = '$position', salary = '$salary', 
                date_of_joining = '$date_of_joining', department = '$department', profile_image = '$profile_image' 
                WHERE id = $id";
        if (mysqli_query($con, $sql)) {
            header("Location: manage_employees.php");
        } else {
            echo "Lỗi: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="text-center mt-4 mb-4">Sửa Thông Tin Nhân Viên</h1>
    <form action="edit_employee.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" name="id" class="form-control" value="<?php echo $row['id']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">Họ</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo $row['first_name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Tên</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo $row['last_name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Vị trí</label>
            <input type="text" name="position" class="form-control" value="<?php echo $row['position']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">Mức lương</label>
            <input type="number" name="salary" class="form-control" value="<?php echo $row['salary']; ?>" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="date_of_joining" class="form-label">Ngày gia nhập</label>
            <input type="date" name="date_of_joining" class="form-control" value="<?php echo $row['date_of_joining']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Phòng ban</label>
            <input type="text" name="department" class="form-control" value="<?php echo $row['department']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="profile_image" class="form-label">Hình ảnh</label>
            <input type="file" name="profile_image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật Thông Tin</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
