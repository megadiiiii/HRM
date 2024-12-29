<?php
include_once 'dbConnect.php';
//Xuat execl 
if (isset($_GET['export_excel'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=danh_sach_nhan_vien.xls");
    echo "ID\tHọ\tTên\tEmail\tPhòng Ban\tVị trí\tSố điện thoại\tMức lương\tNgày gia nhập\n";
    $sql = "SELECT * FROM employees";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['id'] . "\t" . $row['first_name'] . "\t" . $row['last_name'] . "\t" . $row['email'] . "\t" . $row['department'] . "\t" . $row['position'] . "\t" . $row['phone'] . "\t" . $row['salary'] . "\t" . $row['date_of_joining'] . "\n";
    }
    exit;
}
// Xử lý xóa nhân viên
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM employees WHERE id = $id";
    if (mysqli_query($con, $sql)) {
        header("Location: manage_employees.php");
    } else {
        echo "Lỗi: " . mysqli_error($con);
    }
}
// Lấy từ khóa tìm kiếm
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
$sql = "SELECT * FROM employees";
if ($search) {
    $sql .= " WHERE first_name LIKE '%$search%' 
              OR last_name LIKE '%$search%' 
              OR email LIKE '%$search%' 
              OR department LIKE '%$search%' 
              OR position LIKE '%$search%'";
}
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mt-4 mb-4">Quản Lý Nhân Viên</h1>
    <div class="mb-4">
        <a href="add_employee.php" class="btn btn-success">Thêm Nhân Viên Mới</a>
        <a href="manage_employees.php?export_excel=true" class="btn btn-primary">Xuất Excel</a>
    </div>
    <form class="mb-4" method="GET" action="manage_employees.php">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm nhân viên..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <div class="table-container">
        <h3>Danh Sách Nhân Viên</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Họ</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Phòng Ban</th>
                    <th>Vị trí</th>
                    <th>Số điện thoại</th>
                    <th>Mức lương</th>
                    <th>Ngày gia nhập</th>
                    <th>Chi tiết</th>
                    <th>Chỉnh sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <?php if ($row['profile_image']) { ?>
                                    <img src="<?php echo $row['profile_image']; ?>" class="profile-img">
                                <?php } else { ?>
                                    Không có ảnh
                                <?php } ?>
                            </td>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['position']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['salary']; ?></td>
                            <td><?php echo $row['date_of_joining']; ?></td>
                            <td>
                                <a href="info_employee.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Xem</a>
                            </td>
                            <td>
                                <a href="edit_employee.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            </td>
                            <td>
                                <a href="manage_employees.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="13" class="text-center">Không tìm thấy nhân viên phù hợp.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
