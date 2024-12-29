<?php
include_once 'dbConnect.php';
// Xử lý xóa nhân viên
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM employees WHERE id = $id";
    if (mysqli_query($con, $sql)) {
        header("Location: manage_employees.php");
    } else {
        echo "Lỗi: " . mysqli_error($con);
    }
}
// Lấy từ khóa tìm kiếm
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
// tao kho chua 
$sql = "SELECT * FROM employees";
if ($search) {
    $sql .= " WHERE first_name LIKE '%$search%' 
              OR last_name LIKE '%$search%' 
              OR email LIKE '%$search%' 
              OR department LIKE '%$search%' 
              OR position LIKE '%$search%'";
}
// cho vao
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mt-4 mb-4">Quản Lý Nhân Viên</h1>
  <!-- them nv -->
    <div class="mb-4">
        <a href="add_employee.php" class="btn btn-success">Thêm Nhân Viên Mới</a>
    </div>
    <form class="mb-4" method="GET" action="manage_employees.php">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm nhân viên..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <!-- bang nv -->
    <div class="table-container">
        <h3>Danh Sách Nhân Viên</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th> 
                   <th>Hình ảnh</th>  
                   <th>Họ</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Phòng Ban</th>
                    <th>Vị trí</th>
                    <th>Số điện thoại</th>
                    <th>Mức lương</th>
                    <th>Ngày gia nhập</th>
                    <th>Chi tiết</th>
                    <th>Chỉnh sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td> <!-- Hiển thị ID -->
                            <td>
                                <?php if ($row['profile_image']) { ?>
                                    <img src="<?php echo $row['profile_image']; ?>" class="profile-img">
                                <?php } else { ?>
                                    Không có ảnh
                                <?php } ?>
                            </td>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['position']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['salary']; ?></td>
                            <td><?php echo $row['date_of_joining']; ?></td>
                            
                            <td>
                                <!-- Nút Xem chi tiết -->
                                <!-- togglet Kích hoạt modal Bootstrap khi bấm nút. -->
                                     <!-- target: Xác định modal nào sẽ được mở dua vao id  -->
                                <button 
                                    class="btn btn-info btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewEmployeeModal"
                                    data-id="<?php echo $row['id']; ?>"
                                    data-profile_image="<?php echo $row['profile_image']; ?>"
                                    data-first_name="<?php echo $row['first_name']; ?>"
                                    data-last_name="<?php echo $row['last_name']; ?>"
                                    data-email="<?php echo $row['email']; ?>"
                                    data-phone="<?php echo $row['phone']; ?>"
                                    data-position="<?php echo $row['position']; ?>"
                                    data-salary="<?php echo $row['salary']; ?>"
                                    data-date_of_joining="<?php echo $row['date_of_joining']; ?>"
                                    data-department="<?php echo $row['department']; ?>"
                                
                                >Xem</button>
                            </td>
                            <td>
                                <a href="edit_employee.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            </td>
                            <td>
                                <a href="manage_employees.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="13" class="text-center">Không tìm thấy nhân viên phù hợp.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal xem chi tiết -->
 <!-- id lay tu line 116 -->
  <!-- view-id hay gi do la hien thi dl khi modal mo -->
<div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEmployeeModalLabel">Thông Tin Chi Tiết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="view-id"></span></p>
                <div>
                    <p><strong>Hình ảnh:</strong></p>
                    <img id="view-profile_image" style="width: 100px; height: 100px; border-radius: 50%;" alt="Hình ảnh" />
                </div>
                <p><strong>Họ:</strong> <span id="view-first_name"></span></p>
                <p><strong>Tên:</strong> <span id="view-last_name"></span></p>
                <p><strong>Email:</strong> <span id="view-email"></span></p>
                <p><strong>Số điện thoại:</strong> <span id="view-phone"></span></p>
                <p><strong>Vị trí:</strong> <span id="view-position"></span></p>
                <p><strong>Mức lương:</strong> <span id="view-salary"></span></p>
                <p><strong>Ngày gia nhập:</strong> <span id="view-date_of_joining"></span></p>
                <p><strong>Phòng ban:</strong> <span id="view-department"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng </button>
            </div>
        </div>
    </div>
</div>

<script>
    const viewEmployeeModal = document.getElementById('viewEmployeeModal');
    viewEmployeeModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;// tra ve phan tu HTML da kich hoat modal(nut XEM)
        // Lấy dữ liệu từ các thuộc tính data cho vao modal
        document.getElementById('view-id').textContent = button.getAttribute('data-id');// hien thi du lieu tu data-id vao phan tu id='view-id'
        document.getElementById('view-first_name').textContent = button.getAttribute('data-first_name');
        document.getElementById('view-last_name').textContent = button.getAttribute('data-last_name');
        document.getElementById('view-email').textContent = button.getAttribute('data-email');
        document.getElementById('view-phone').textContent = button.getAttribute('data-phone');
        document.getElementById('view-position').textContent = button.getAttribute('data-position');
        document.getElementById('view-salary').textContent = button.getAttribute('data-salary');
        document.getElementById('view-date_of_joining').textContent = button.getAttribute('data-date_of_joining');
        document.getElementById('view-department').textContent = button.getAttribute('data-department');
        // Kiểm tra và hiển thị ảnh
        const profileImage = button.getAttribute('data-profile_image');
        const imgElement = document.getElementById('view-profile_image');
        if (profileImage) {
            imgElement.src = profileImage;
        } else {
            imgElement.src = 'https://via.placeholder.com/100'; // Ảnh mặc định nếu không có ảnh
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php 
// khi bấm nút xem thì cái show.bs.modal được khởi động, khi nó khởi động thì sẽ lấy data từ form button(là cái view-id đấy) ở trên 
// và cập nhật vào modal xong thì cái modal ở line 151 lấy được từ đó và hiển thị ra

?>