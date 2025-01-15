<?php
include_once 'dbConnect.php';

// Lấy thông tin phòng ban từ cơ sở dữ liệu
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "SELECT * FROM phongban WHERE id = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Không tìm thấy phòng ban với ID này.'); window.location.href='manage_phongban.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID phòng ban không được cung cấp.'); window.location.href='manage_phongban.php';</script>";
    exit;
}

// Cập nhật thông tin phòng ban
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $department_name = mysqli_real_escape_string($con, $_POST['department_name']);
    $mo_ta = mysqli_real_escape_string($con, $_POST['mo_ta']);
    $ghi_chu = mysqli_real_escape_string($con, $_POST['ghi_chu']);
    $so_dien_thoai = mysqli_real_escape_string($con, $_POST['so_dien_thoai']);

    // Cập nhật cơ sở dữ liệu
    $update_sql = "UPDATE phongban SET 
                    department_name = '$department_name', 
                    mô_tả = '$mo_ta', 
                    ghi_chú = '$ghi_chu', 
                    số_điện_thoại = '$so_dien_thoai' 
                    WHERE id = $id";

    if (mysqli_query($con, $update_sql)) {
        echo "<script>alert('Cập nhật phòng ban thành công!'); window.location.href='manage_phongban.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . mysqli_error($con) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Phòng Ban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="text-center mt-4 mb-4">Sửa Phòng Ban</h1>
    <form action="edit_phongban.php?id=<?php echo $row['id']; ?>" method="POST">
        <div class="mb-3">
            <label for="department_name" class="form-label">Tên Phòng Ban</label>
            <input type="text" name="department_name" class="form-control" value="<?php echo $row['department_name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="mo_ta" class="form-label">Mô Tả</label>
            <textarea name="mo_ta" class="form-control" rows="3"><?php echo $row['mô_tả']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="ghi_chu" class="form-label">Ghi Chú</label>
            <textarea name="ghi_chu" class="form-control" rows="3"><?php echo $row['ghi_chú']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
            <input type="text" name="so_dien_thoai" class="form-control" value="<?php echo $row['số_điện_thoại']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
