<?php
include_once 'dbConnect.php';

$attendances = [];

// Lấy dữ liệu từ bảng attendance kết hợp với bảng staff và nhóm theo ngày
$sql = "SELECT a.attendance_date, a.attendance_status, 
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
        $attendances[$row['attendance_date']][] = $row; // Nhóm theo ngày
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
      <?php foreach ($attendances as $attendance_date => $attendees): ?>
        <h4 class="mt-4">Ngày: <?php echo htmlspecialchars($attendance_date); ?></h4>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Mã nhân viên</th>
              <th>Tên nhân viên</th>
              <th>Phòng ban</th>
              <th>Chức vụ</th>
              <th>Trạng thái chấm công</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($attendees as $attendance): ?>
            <tr>
              <td><?php echo htmlspecialchars($attendance['staff_id']); ?></td>
              <td><?php echo htmlspecialchars($attendance['staff_name']); ?></td>
              <td><?php echo htmlspecialchars($attendance['department']); ?></td>
              <td><?php echo htmlspecialchars($attendance['position']); ?></td>
              <td><?php echo htmlspecialchars($attendance['attendance_status']); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-danger">Không có lịch sử chấm công nào.</p>
    <?php endif; ?>

    <a href="attendance.php" class="btn btn-primary mt-3">Quay lại trang chấm công</a>
  </div>
</body>
</html>
