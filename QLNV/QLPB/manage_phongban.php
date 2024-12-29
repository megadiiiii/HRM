<?php
include_once 'dbConnect.php';
// Xuất Excel
if (isset($_GET['export_excel'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=danh_sach_phong_ban.xls");
    echo "ID\tTên Phòng Ban\tMô Tả\tGhi Chú\tSố Điện Thoại\n";
    $sql = "SELECT id, department_name, mô_tả, ghi_chú, số_điện_thoại FROM phongban";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['id'] . "\t" . $row['department_name'] . "\t" . $row['mô_tả'] . "\t" . $row['ghi_chú'] . "\t" . $row['số_điện_thoại'] . "\n";
    }
    exit;
}
// Xử lý xóa phòng ban
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM phongban WHERE id = $id";
    if (mysqli_query($con, $sql)) {
        header("Location: manage_phongban.php");
    } else {
        echo "Lỗi: " . mysqli_error($con);
    }
}
// Lấy từ khóa tìm kiếm
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
$sql = "SELECT id, department_name, mô_tả, ghi_chú, số_điện_thoại FROM phongban";
if ($search) {
    $sql .= " WHERE department_name LIKE '%$search%' 
              OR mô_tả LIKE '%$search%' 
              OR ghi_chú LIKE '%$search%' 
              OR số_điện_thoại LIKE '%$search%'";
}
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Phòng Ban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="text-center mt-4 mb-4">Quản Lý Phòng Ban</h1>
    <div class="mb-4">
        <a href="add_phongban.php" class="btn btn-success">Thêm Phòng Ban Mới</a>
        <a href="manage_phongban.php?export_excel=true" class="btn btn-primary">Xuất Excel</a>
    </div>
    <form class="mb-4" method="GET" action="manage_phongban.php">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm phòng ban..." value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <div class="table-container">
        <h3>Danh Sách Phòng Ban</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Phòng Ban</th>
                    <th>Mô Tả</th>
                    <th>Ghi Chú</th>
                    <th>Số Điện Thoại</th>
                    <th>Chỉnh sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['department_name']; ?></td>
                            <td><?php echo $row['mô_tả']; ?></td>
                            <td><?php echo $row['ghi_chú']; ?></td>
                            <td><?php echo $row['số_điện_thoại']; ?></td>
                            <td>
                                <a href="edit_phongban.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            </td>
                            <td>
                                <a href="manage_phongban.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="7" class="text-center">Không tìm thấy phòng ban phù hợp.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
