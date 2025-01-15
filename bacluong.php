<?php
include_once 'dbConnect.php'; // Gọi file kết nối cơ sở dữ liệu

// Truy vấn dữ liệu từ bảng staff, salarygrade, attendance và salary_scale
$sql = "SELECT 
            staff.staff_id, 
            staff.staff_name, 
            staff.department, 
            staff.position, 
            salarygrade.salary_level,
            salary_scale.coefficient AS salary_coefficient, 
            salarygrade.allowance, 
            IFNULL(SUM(attendance.worked), 0) AS total_worked_days,
            (salary_scale.coefficient * IFNULL(SUM(attendance.worked), 0) + salarygrade.allowance) AS actual_salary -- Tính lương thực lĩnh
        FROM staff
        LEFT JOIN salarygrade ON staff.staff_id = salarygrade.staff_id
        LEFT JOIN salary_scale ON salarygrade.salary_level = salary_scale.level
        LEFT JOIN attendance ON staff.staff_id = attendance.staff_id
        GROUP BY staff.staff_id";
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
                        <th>Vị trí</th>
                        <th>Bậc lương</th>
                        <th>Số tiền lương cơ bản (VND)</th>
                        <th>Phụ cấp (VND)</th>
                        <th>Ngày công</th>
                        <th>Lương thực lĩnh (VND)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['staff_id']; ?></td>
                            <td><?php echo $row['staff_name']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['position']; ?></td>
                            <td><?php echo $row['salary_level'] ? $row['salary_level'] : "Chưa có"; ?></td>
                            <td><?php echo $row['salary_coefficient'] ? number_format($row['salary_coefficient'], 0, ',', '.') : "Chưa có"; ?></td>
                            <td><?php echo $row['allowance'] ? number_format($row['allowance'], 0, ',', '.') : "0"; ?></td>
                            <td><?php echo $row['total_worked_days'] ? $row['total_worked_days'] : 0; ?></td>
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
