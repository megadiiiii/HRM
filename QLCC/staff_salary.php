<?php
// b thêm cột salary_hour trong bảng staff đấy.
include_once 'dbConnect.php';

// Lấy dữ liệu nhân viên và tính lương
$sql = "SELECT s.staff_id, s.staff_name, s.department, s.position, s.salary_hour,
        COUNT(a.attendance_date) AS total_days,
        SUM(TIMESTAMPDIFF(HOUR, a.check_in, a.check_out)) AS total_hours
        FROM staff s
        LEFT JOIN attendance a ON s.staff_id = a.staff_id
        WHERE a.status = 'PRESENT'
        GROUP BY s.staff_id, s.staff_name, s.department, s.position, s.salary_hour";
$result = mysqli_query($con, $sql);

// Biến thông báo
$message = "";

?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tính Lương Nhân Viên</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <style>
      .profile-img {
          border-radius: 50%;
          width: 50px;
          height: 50px;
      }
      .custom-table th, .custom-table td {
          vertical-align: middle;
          text-align: center;
      }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Bảng Tính Lương Nhân Viên</h2>

    <!-- Hiển thị thông báo -->
    <?php if (!empty($message)): ?>
      <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <table class="table table-striped table-bordered custom-table">
      <thead class="table-primary">
        <tr>
          <th>Mã nhân viên</th>
          <th>Tên nhân viên</th>
          <th>Phòng ban</th>
          <th>Vị trí</th>
          <th>Số ngày làm việc</th>
          <th>Tổng giờ làm</th>
          <th>Lương theo giờ (VND)</th>
          <th>Tổng lương (VND)</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['staff_id']; ?></td>
              <td><?php echo $row['staff_name']; ?></td>
              <td><?php echo $row['department']; ?></td>
              <td><?php echo $row['position']; ?></td>
              <td><?php echo $row['total_days'] ? $row['total_days'] : 0; ?> ngày</td>
              <td><?php echo $row['total_hours'] ? $row['total_hours'] : 0; ?> giờ</td>
              <td><?php echo number_format($row['salary_hour']); ?></td>
              <td>
                <?php 
                  $total_salary = ($row['total_hours'] ? $row['total_hours'] : 0) * $row['salary_hour'];
                  echo number_format($total_salary);
                ?> VND
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">Không có dữ liệu lương để hiển thị.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
