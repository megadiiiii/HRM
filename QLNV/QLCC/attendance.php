<?php 
include_once 'dbConnect.php';

// Lấy danh sách tất cả nhân viên có trạng thái "Đang làm việc" từ bảng staff
$sql_employees = "SELECT staff_id, staff_name, department, position, status 
                  FROM staff
                  WHERE status = 'Đang làm việc'";
$result_employees = mysqli_query($con, $sql_employees);

// Biến để lưu thông báo
$message = "";

// Xử lý chấm công
if (isset($_POST['btnSubmit'])) {
    $staff_id = $_POST['staff_id'];
    $attendance_date = $_POST['attendance_date'];
    $check_in = !empty($_POST['check_in']) ? $_POST['check_in'] : "08:00:00"; // Giá trị mặc định nếu không nhập
    $check_out = !empty($_POST['check_out']) ? $_POST['check_out'] : "17:00:00"; // Giá trị mặc định nếu không nhập
    $status = $_POST['status'];

    $sql_check_employee = "SELECT * FROM staff WHERE staff_id = '$staff_id'";
    $result = mysqli_query($con, $sql_check_employee);

    if (mysqli_num_rows($result) > 0) {
        // Chèn dữ liệu chấm công vào bảng attendance
        $sql_insert = "INSERT INTO `attendance` (`staff_id`, `attendance_date`, `check_in`, `check_out`, `status`) 
                       VALUES ('$staff_id', '$attendance_date', '$check_in', '$check_out', '$status')";
        if (mysqli_query($con, $sql_insert)) {
            $message = "<p class='text-success'>Chấm công thành công cho nhân viên $staff_id!</p>";
        } else {
            $message = "<p class='text-danger'>Lỗi chấm công: " . mysqli_error($con) . "</p>";
        }
    } else {
        $message = "<p class='text-danger'>Nhân viên không tồn tại.</p>";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chấm công nhân viên</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Danh sách nhân viên</h2>

    <!-- Hiển thị thông báo -->
    <?php if (!empty($message)): ?>
      <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <!-- Thêm nút "Lịch sử chấm công" và "Tính Lương" -->
    <div class="d-flex justify-content-between mb-4">
      <a href="attendance_history.php" class="btn btn-info">Xem Lịch Sử Chấm Công</a>
      <a href="staff_salary.php" class="btn btn-success">Tính Lương</a>
    </div>

    <!-- Hiển thị danh sách nhân viên -->
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Mã nhân viên</th>
          <th>Tên nhân viên</th>
          <th>Phòng ban</th>
          <th>Vị trí</th>
          <th>Trạng thái</th>
          <th>Ngày</th>
          <th>Giờ vào</th>
          <th>Giờ ra</th>
          <th>Trạng thái chấm công</th>
          <th>Chấm công</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result_employees) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result_employees)): ?>
            <tr>
              <td><?php echo $row['staff_id']; ?></td>
              <td><?php echo $row['staff_name']; ?></td>
              <td><?php echo $row['department']; ?></td>
              <td><?php echo $row['position']; ?></td>
              <td><?php echo $row['status']; ?></td>
              <!-- Form riêng cho mỗi nhân viên , nghĩa là không bắt buộc điền tất mới chấm được-->
              <form method="POST">
                <td>
                  <input type="date" name="attendance_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </td>
                <td>
                  <input type="time" name="check_in" class="form-control" value="08:00:00">
                </td>
                <td>
                  <input type="time" name="check_out" class="form-control" value="17:00:00">
                </td>
                <td>
                  <select name="status" class="form-select">
                    <option value="PRESENT">Có mặt</option>
                    <option value="ABSENT">Vắng</option>
                    <option value="LEAVE">Nghỉ</option>
                  </select>
                </td>
                <td>
                  <input type="hidden" name="staff_id" value="<?php echo $row['staff_id']; ?>">
                  <button type="submit" name="btnSubmit" class="btn btn-primary btn-sm">Chấm công</button>
                </td>
              </form>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="10" class="text-center">Không có nhân viên nào để hiển thị.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
