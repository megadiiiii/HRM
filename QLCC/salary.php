<?php
include_once 'dbConnect.php'; // Kết nối cơ sở dữ liệu

// Lấy danh sách tất cả nhân viên có trạng thái "Đang làm việc" từ bảng staff
$sql_employees = "SELECT staff.staff_id, staff.staff_name, staff.department, staff.position, 
                  IFNULL(SUM(attendance.worked), 0) AS total_worked
                  FROM staff
                  LEFT JOIN attendance ON staff.staff_id = attendance.staff_id
                  WHERE staff.status = 'Đang làm việc'
                  GROUP BY staff.staff_id";
$result_employees = mysqli_query($con, $sql_employees);

// Biến để lưu thông báo
$message = "";

// Xử lý chấm công
if (isset($_POST['btnSubmit'])) {
    $staff_id = $_POST['staff_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    // Kiểm tra nếu nhân viên tồn tại trong bảng staff
    $sql_check_staff = "SELECT * FROM staff WHERE staff_id = '$staff_id'";
    $result_check_staff = mysqli_query($con, $sql_check_staff);

    if (mysqli_num_rows($result_check_staff) > 0) {
        // Kiểm tra nếu đã có bản ghi chấm công cho nhân viên và ngày đó
        $sql_check_attendance = "SELECT * FROM attendance WHERE staff_id = '$staff_id' AND attendance_date = '$attendance_date'";
        $result_check = mysqli_query($con, $sql_check_attendance);

        if (mysqli_num_rows($result_check) > 0) {
            // Nếu bản ghi tồn tại, không cho phép chấm công lại
            $message = "<p class='text-danger'>Đã chấm công cho nhân viên $staff_id vào ngày $attendance_date. Không thể chấm công lại!</p>";
        } else {
            // Nếu bản ghi chưa tồn tại, thêm mới
            $worked = ($status === 'PRESENT') ? 1 : 0;
            $sql_insert = "INSERT INTO attendance (staff_id, attendance_date, attendance_status, worked) 
                           VALUES ('$staff_id', '$attendance_date', '$status', $worked)";
            if (mysqli_query($con, $sql_insert)) {
                $message = "<p class='text-success'>Đã chấm công thành công cho nhân viên $staff_id vào ngày $attendance_date.</p>";
            } else {
                $message = "<p class='text-danger'>Lỗi chấm công: " . mysqli_error($con) . "</p>";
            }
        }
    } else {
        $message = "<p class='text-danger'>Nhân viên với ID $staff_id không tồn tại trong hệ thống.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý chấm công</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Danh sách nhân viên</h2>

    <!-- Hiển thị thông báo -->
    <?php if (!empty($message)): ?>
      <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <!-- Bảng danh sách nhân viên -->
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Mã nhân viên</th>
          <th>Tên nhân viên</th>
          <th>Phòng ban</th>
          <th>Vị trí</th>
          <th>Ngày</th>
          <th>Trạng thái chấm công</th>
          <th>Chấm công</th>
          <th>Tổng ngày công</th>
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
              <form method="POST">
                <td>
                  <input type="date" name="attendance_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
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
              <td><?php echo $row['total_worked']; ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">Không có nhân viên nào để hiển thị.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
