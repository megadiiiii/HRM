<?php
include_once 'dbConnect.php';

$attendances = [];

// Lấy dữ liệu từ bảng attendance kết hợp với bảng staff
$sql = "SELECT a.attendance_date, a.check_in, a.check_out, a.status, 
        s.staff_id, s.staff_name, s.department, s.position
        FROM `attendance` a
        INNER JOIN `staff` s ON a.staff_id = s.staff_id
        ORDER BY a.attendance_date DESC";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($con)); // Hiển thị lỗi nếu truy vấn sai
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $attendances[] = $row;
    }
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
    
    <?php if (count($attendances) > 0): ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Mã nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Phòng ban</th>
            <th>Chức vụ</th>
            <th>Ngày</th>
            <th>Giờ vào</th>
            <th>Giờ ra</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($attendances as $attendance): ?>
          <tr>
            <td><?php echo htmlspecialchars($attendance['staff_id']); ?></td>
            <td><?php echo htmlspecialchars($attendance['staff_name']); ?></td>
            <td><?php echo htmlspecialchars($attendance['department']); ?></td>
            <td><?php echo htmlspecialchars($attendance['position']); ?></td>
            <td><?php echo htmlspecialchars($attendance['attendance_date']); ?></td>
            <td><?php echo htmlspecialchars($attendance['check_in']); ?></td>
            <td><?php echo $attendance['check_out'] ? htmlspecialchars($attendance['check_out']) : '-'; ?></td>
            <td><?php echo htmlspecialchars($attendance['status']); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-danger">Không có lịch sử chấm công nào.</p>
    <?php endif; ?>

    <a href="attendance.php" class="btn btn-primary mt-3">Quay lại trang chấm công</a>
  </div>
</body>
</html>
