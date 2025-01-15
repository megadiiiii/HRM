<?php
include_once 'dbConnect.php'; // Kết nối cơ sở dữ liệu

// Truy vấn dữ liệu từ bảng staff, attendance và salary
$sql = "SELECT 
            staff.staff_id, 
            staff.staff_name, 
            staff.department, 
            staff.salary_level, 
            SUM(attendance.worked) AS total_worked_days, -- Tổng số ngày công
            (SUM(attendance.worked) * salary.salary) AS actual_salary -- Tính lương thực lĩnh
        FROM staff
        LEFT JOIN attendance ON staff.staff_id = attendance.staff_id
        LEFT JOIN salary ON staff.salary_level = salary.salary_level
        GROUP BY staff.staff_id, staff.staff_name, staff.department, staff.salary_level, salary.salary";
$result = $con->query($sql);

// Xử lý thông báo
$message = "";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý mức lương</title>
    <!-- Liên kết Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Quản lý mức lương</h2>

        <!-- Bảng hiển thị thông tin nhân viên -->
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Mã nhân viên</th>
                        <th>Tên nhân viên</th>
                        <th>Phòng ban</th>
                        <th>Bậc lương</th>
                        <th>Tổng số ngày công</th>
                        <th>Lương thực lĩnh (VND)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['staff_id']; ?></td>
                            <td><?php echo $row['staff_name']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['salary_level'] ? $row['salary_level'] : "Chưa có"; ?></td>
                            <td><?php echo $row['total_worked_days'] ?: 0; ?></td>
                            <td><?php echo $row['actual_salary'] ? number_format($row['actual_salary'], 0, ',', '.') : "0"; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                Không có dữ liệu trong bảng.
            </div>
        <?php endif; ?>
    </div>
    <!-- Liên kết Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
