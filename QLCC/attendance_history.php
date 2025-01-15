<?php
include_once 'dbConnect.php'; // Kết nối cơ sở dữ liệu

// Lấy dữ liệu từ bảng attendance kết hợp với bảng staff
$sql = "SELECT a.attendance_date, a.attendance_status, 
               s.staff_id, s.staff_name, s.department, s.position
        FROM `attendance` a
        INNER JOIN `staff` s ON a.staff_id = s.staff_id
        ORDER BY a.attendance_date DESC"; // Sắp xếp theo ngày chấm công giảm dần

$result = mysqli_query($con, $sql);

// Kiểm tra xem có dữ liệu hay không
if (mysqli_num_rows($result) == 0) {
    // Nếu không có dữ liệu chấm công, cập nhật số ngày công về 0 cho tất cả nhân viên
    $update_sql = "UPDATE attendance SET worked = 0 WHERE status = 'Đang làm việc'";
    mysqli_query($con, $update_sql);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lịch sử chấm công</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Lịch sử chấm công</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
      <!-- Hiển thị bảng tất cả lịch sử chấm công -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Mã nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Phòng ban</th>
            <th>Chức vụ</th>
            <th>Trạng thái chấm công</th>
            <th>Ngày chấm công</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['staff_id']); ?></td>
              <td><?php echo htmlspecialchars($row['staff_name']); ?></td>
              <td><?php echo htmlspecialchars($row['department']); ?></td>
              <td><?php echo htmlspecialchars($row['position']); ?></td>
              <td><?php echo htmlspecialchars($row['attendance_status']); ?></td>
              <td><?php echo htmlspecialchars($row['attendance_date']); ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-danger">Không có lịch sử chấm công nào.</p>
    <?php endif; ?>

    <a href="attendance.php" class="btn btn-primary mt-3">Quay lại trang chấm công</a>
  </div>
</body>
</html>
