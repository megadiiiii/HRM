<?php
include_once 'dbConnect.php'; // Kết nối cơ sở dữ liệuCó mặt

// Lấy danh sách tất cả nhân viên có trạng thái "Đang làm việc"
$sql_staff = "SELECT staff_id, staff_name, department, position 
                  FROM staff
                  WHERE status = 'Đang làm việc'";
$result_staff = mysqli_query($con, $sql_staff);

// Biến lưu thông báo
$message = "";

// Xử lý chấm công
if (isset($_POST['btnSubmit'])) {
    $staff_id = $_POST['staff_id'];
    $attendance_date = $_POST['attendance_date'];
    $attendance_status = $_POST['attendance_status'];

    // Kiểm tra nếu bản ghi đã tồn tại trong bảng attendance
    $sql_check_attendance = "SELECT * FROM attendance WHERE staff_id = '$staff_id' AND attendance_date = '$attendance_date'";
    $result_check_attendance = mysqli_query($con, $sql_check_attendance);

    if (mysqli_num_rows($result_check_attendance) > 0) {
        // Nếu đã có bản ghi, thông báo lỗi
        $message = "<p class='text-danger'>Nhân viên $staff_id đã được chấm công vào ngày $attendance_date.</p>";
    } else {
        // Nếu chưa có bản ghi, thêm mới
        $worked = ($attendance_status === 'Có mặt') ? 1 : 0;
        $sql_insert = "INSERT INTO attendance (staff_id, attendance_date, attendance_status, worked) 
                       VALUES ('$staff_id', '$attendance_date', '$attendance_status', $worked)";
        if (mysqli_query($con, $sql_insert)) {
            $message = "<p class='text-success'>Chấm công thành công cho nhân viên $staff_id vào ngày $attendance_date.</p>";
        } else {
            $message = "<p class='text-danger'>Lỗi chấm công: " . mysqli_error($con) . "</p>";
        }
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

    <!-- Thêm nút "Lịch sử chấm công" và "Tính Lương" -->
    <div class="d-flex justify-content-between mb-4">
      <a href="attendance_history.php" class="btn btn-info">Xem Lịch Sử Chấm Công</a>
      <a href="staff_salary.php" class="btn btn-success">Tính Lương</a>
    </div>

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
          <th>Số ngày công</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($result_staff) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result_staff)): ?>
            <?php
              // Truy vấn tổng số ngày công từ bảng attendance
              $sql_worked = "SELECT IFNULL(SUM(worked), 0) AS total_worked 
                                  FROM attendance 
                                  WHERE staff_id = '" . $row['staff_id'] . "'";
              $result_worked = mysqli_query($con, $sql_worked);
              $worked = mysqli_fetch_assoc($result_worked)['total_worked'];
            ?>
            <tr>
              <td><?php echo $row['staff_id']; ?></td>
              <td><?php echo $row['staff_name']; ?></td>
              <td><?php echo $row['department']; ?></td>
              <td><?php echo $row['position']; ?></td>
              <form method="POST">
                <td>
                  <input type="date" name="attendance_date" class="form-control" value="<?php echo date('dd-mm-yyyy'); ?>">
                </td>
                <td>
                  <select name="attendance_status" class="form-select">
                    <option value="Có mặt">Có mặt</option>
                    <option value="Vắng">Vắng</option>

                  </select>
                </td>
                <td>
                  <input type="hidden" name="staff_id" value="<?php echo $row['staff_id']; ?>">
                  <button type="submit" name="btnSubmit" class="btn btn-primary btn-sm">Chấm công</button>
                </td>
              </form>
              <td><?php echo $worked; ?></td>
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
