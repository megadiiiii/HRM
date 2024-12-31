<?php  
include_once 'dbConnect.php';
include_once '../HRM/Session.php';
include_once '../HRM/Login_Info.php';


// Khởi tạo giá trị mặc định
$staff_id = '';
$staff_name = '';
$dob = '';
$gender = '';
$department = '';
$position = '';
$start_date = '';
$address = '';
$email = '';
$phone = '';
$status = '';
$profile_image = '';

// Kiểm tra xem có nhận được staff_id không
if (isset($_GET['staff_id'])) {
    $staff_id = $_GET['staff_id'];

    // Lấy thông tin nhân viên từ cơ sở dữ liệu
    $query = "SELECT * FROM staff WHERE staff_id = '$staff_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Gán các giá trị từ cơ sở dữ liệu
        $staff_name = $row['staff_name'];
        $dob = $row['dob'];
        $gender = $row['gender'];
        $department = $row['department'];
        $position = $row['position'];
        $start_date = $row['start_date'];
        $address = $row['address'];
        $email = $row['email'];
        $phone = $row['phone'];
        $status = $row['status'];
        $profile_image = $row['profile_image'];
    } else {
        echo "<script>alert('Nhân viên không tồn tại!');</script>";
        header("Location: ../HRM/Staff.php");
    }
}

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_name = $_POST['staff_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $start_date = $_POST['start_date'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];

    // Xử lý hình ảnh nếu có tải lên
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $upload_dir = '../HRM/Upload/';
        
        // Lấy thông tin staff_id và staff_name (giả sử bạn nhận từ POST)
        $staff_id = isset($_POST['staff_id']) ? $_POST['staff_id'] : '';
        $staff_name = isset($_POST['staff_name']) ? $_POST['staff_name'] : '';
        
        // Kiểm tra staff_id và staff_name không rỗng
        if (empty($staff_id) || empty($staff_name)) {
            echo "<script>alert('Vui lòng cung cấp staff_id và staff_name!');</script>";
            $profile_image = null;
        } else {
            // Xử lý tên file
            $file_extension = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $file_name = $staff_id . '-' . $staff_name . '.' . $file_extension; 
            $target_file = $upload_dir . $file_name; // Đảm bảo sử dụng đường dẫn đầy đủ
    
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Tạo thư mục với quyền ghi
            }
    
            // Kiểm tra định dạng tệp (ví dụ: chỉ cho phép JPG, PNG)
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
    
            if (!in_array($file_extension, $allowed_extensions)) {
                echo "<script>alert('Định dạng tệp không hợp lệ! Chỉ chấp nhận JPG, PNG.');</script>";
                $profile_image = null;
            } else {
                // Di chuyển tệp đến thư mục đích
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                    $profile_image = $target_file; // Lưu đường dẫn đầy đủ đến file
                } else {
                    echo "<script>alert('Lỗi khi tải lên tệp. Vui lòng thử lại!');</script>";
                    $profile_image = null;
                }
            }
        }
    } else {
        $profile_image = null;
    }
        
    // Cập nhật thông tin nhân viên
    $sql = "UPDATE `staff` SET 
            `staff_name` = '$staff_name',
            `dob` = '$dob',
            `gender` = '$gender',
            `department` = '$department',
            `position` = '$position',
            `address` = '$address',
            `email` = '$email',
            `phone` = '$phone',
            `start_date` = '$start_date',
            `status` = '$status',
            `profile_image` = IF('$profile_image' != '', '$profile_image', `profile_image`)
            WHERE `staff_id` = '$staff_id'";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Cập nhật thông tin thành công!');</script>";
        header("Location: ../HRM/Staff.php");
    } else {
        echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại!');</script>";
    }
}

if (isset($_POST['btnPreview'])) {
    $staff_id = $_POST['staff_id'];

    // Kiểm tra mã nhân viên
    if (!empty($staff_id)) {
        // Tạo đường dẫn đến ảnh dựa vào mã nhân viên
        $upload_dir = '../HRM/Upload/';
        $image_file = $upload_dir . $staff_id . '.jpg'; // Đổi định dạng ảnh nếu cần (jpg, png, ...)

        // Kiểm tra xem ảnh có tồn tại không
        if (file_exists($image_file)) {
            // Chuyển hướng đến ảnh
            header("Location: $image_file");
            exit;
        } else {
            echo "<script>alert('Ảnh không tồn tại cho mã nhân viên $staff_id');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập mã nhân viên');</script>";
    }
}
    $sql = "SELECT * FROM department";
    $data = mysqli_query($con, $sql);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý tài khoản</title>
  <link rel="shortcut icon" type="image/png" href="../HRM/src/assets/images/logos/HRM_Favicon.png" style="width: 32px;" />
  <link rel="stylesheet" href="../HRM/src/assets/css/styles.min.css" />
  <link rel="stylesheet" href="../HRM/src/assets/css/ov_style.css">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="../HRM/Homepage.php" class="text-nowrap logo-img">
          <img src="../HRM/src/assets/images/logos/HRM_Text.png" alt="" /, style="width: 150px; transform: translateX(25%);">
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="sidebar-item">
              <a class="sidebar-link" href="../HRM/Homepage.php" aria-expanded="false">
              <iconify-icon icon="material-symbols:home-outline"></iconify-icon>
              <span class="hide-menu">Trang chủ</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../HRM/Staff.php" aria-expanded="false">
              <iconify-icon icon="ic:baseline-people"></iconify-icon>
              <span class="hide-menu">Quản lý nhân viên</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./Department.php" aria-expanded="false">
              <iconify-icon icon="mingcute:department-fill"></iconify-icon>
              <span class="hide-menu">Quản lý phòng ban</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../HRM/Training.php" aria-expanded="false">
              <iconify-icon icon="oui:training"></iconify-icon>
              <span class="hide-menu">Quản lý đào tạo nhân sự</span>
              </a>
            </li>
            <li class="sidebar-item">
            <a class="sidebar-link" href="../HRM/Work_Time.php" aria-expanded="false">
              <iconify-icon icon="ph:calendar-bold"></iconify-icon>
              <span class="hide-menu">Quản lý giờ làm</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../HRM/Account.php" aria-expanded="false">
              <iconify-icon icon="mdi:account-wrench"></iconify-icon>
              <span class="hide-menu">Quản lý tài khoản</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../HRM/src/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom gap-6">
                        <img src="../HRM/src/assets/images/profile/user-1.jpg" class="rounded-circle" width="56" height="56" alt="matdash-img">
                        <div>
                        <h5 class="mb-0 fs-12"><?php echo $username?></h5>
                        <span class="text-success fs-11"><?php echo $role?></span>                                              
                        </div>
                    </div>
                    <a href="./Sign_In.php" class="btn btn-outline-secondary mx-3 mt-2 d-block">Đăng xuất</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
            <!-- NỘI DUNG PAGE TỪ ĐÂY -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-info-subtle-light px-3 py-2 rounded">
                    <li class="breadcrumb-item">
                        <a href="../HRM/Homepage.php" class="text-info d-flex align-items-center">
                        <i class="ti ti-home fs-4 mt-1"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="../HRM/Staff.php" class="text-info d-flex align-items-center">
                        Quản lý nhân viên
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-info " aria-current="page">Chỉnh sửa thông tin</li>
                </ol>
            </nav> 
            <div class="row">              
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title fw-semibold"> <?php echo $staff_name ?></h5>
                      <p class="card-subtitle mb-0 lh-base"> <?php echo $staff_id ?></p>
                      <p class="card-subtitle mb-0 lh-base"> <?php echo $department ?></p>
                      <p class="card-subtitle mb-0 lh-base"> <?php echo $position ?></p>
    
                      <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="py-4 my-1">
                                <img src="<?php echo $profile_image; ?>" alt="Hình ảnh nhân viên" style="max-width: 300px" class="rounded">
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8"> 
                    <div class="card">
                    <form method="post" enctype="multipart/form-data">
                      <div>
                        <div class="card-body">
                          <h4 class="card-title">Chỉnh sửa thông tin nhân viên</h4>
                          <div class="row pt-3">
                              <div class="col-md-6">
                                <div class="mb-3 has-danger">
                                  <label class="form-label">Mã nhân viên</label>
                                  <input type="text" name="staff_id" class="form-control form-control-danger" placeholder="Mã nhân viên" value="<?php echo "$staff_id" ?>" readonly>
                                </div>
                              </div>
                              <!--/span-->
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="staff_name" class="form-control" placeholder="Họ và tên" value="<?php echo "$staff_name" ?>">
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                              <div class="mb-3 has-danger">
                                <label class="form-label">Ngày, tháng, năm sinh</label>
                                <input type="date" name="dob" class="form-control form-control-danger" value="<?php echo $dob; ?>">
    
                              </div>
                            </div>                    
                            <!--/span-->
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Giới tính</label>
                                <select name="gender" class="form-select" data-placeholder="Giói tính" tabindex="1">
                                    <option value="Nam" <?php if($gender == 'Nam') echo 'selected'; ?>>Nam</option>
                                    <option value="Nữ" <?php if($gender == 'Nữ') echo 'selected'; ?>>Nữ</option>
                                </select>
                              </div>
                            </div>
                          </div>
    
                          <!--/row-->
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Phòng ban</label>
                                <select name="department" class="form-select" data-placeholder="Choose a Category" tabindex="1">
                                <?php 
                                      if(isset($data)&&mysqli_num_rows($data)>0){
                                          while($row=mysqli_fetch_assoc($data)){
                                  ?>
                                              <option value="<?php echo $row['department'] ?>" <?php if($department==$row['department']) echo 'selected' ?>>
                                                  <?php echo $row['department'] ?>
                                              </option>
                                  <?php
                                          }
                                      }
                                  ?>                               
                                </select>
                              </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Vị trí</label>
                                <select name="position" class="form-select"tabindex="1">
                                    <option value="Giám đốc" <?php if($position == 'Giám đốc') echo 'selected'; ?>>Giám đốc</option>
                                    <option value="Admin" <?php if($position == 'Admin') echo 'selected'; ?>>Admin</option>
                                    <option value="Trưởng phòng" <?php if($position == 'Trưởng phòng') echo 'selected'; ?>>Trưởng phòng</option>
                                    <option value="Nhân viên/Kỹ thuật viên" <?php if($position == 'Nhân viên/Kỹ thuật viên') echo 'selected'; ?>>Nhân viên/Kỹ thuật viên</option>
                                </select>
                              </div>
                            </div>
                            <!--/span-->
                          </div>
                          
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="mb-3">
                                      <label class="form-label">Địa chỉ</label>
                                      <input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="<?php echo "$address" ?>">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo "$email" ?>">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="<?php echo "$phone" ?>">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                  <div class="mb-3 has-danger">
                                    <label class="form-label">Ngày bắt đầu làm việc</label>
                                    <input type="date" name="start_date" class="form-control form-control-danger" placeholder="Ngày bắt đầu làm việc" value="<?php echo isset($start_date) ? $start_date : ''; ?>">
                                  </div>
                                </div>                    
                                <!--/span-->
                            </div>
    
                            <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" data-placeholder="Giói tính" tabindex="1">
                                  <option value="Đang làm việc" <?php if($status == 'Đang làm việc') echo 'selected'; ?>>Đang làm việc</option>
                                  <option value="Đã nghỉ việc" <?php if($status == 'Đã nghỉ việc') echo 'selected'; ?>>Đã nghỉ việc</option>
                                </select>
                              </div>
                            </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="mb-3 has-danger">
                                        <label class="form-label">Hình ảnh nhân viên</label>
                                        <input type="file" class="form-control" name="profile_image" placeholder="Hình ảnh nhân viên"> 
                                    </div>
                                </div>                    
                                <!--/span-->
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <div class="card-body border-top">
                                <button type="submit" name="btnAdd" class="btn btn-info text-light">Cập nhật</button>
                                <button type="submit" name="btnBack" class="btn btn-danger ms-6">Huỷ</button>
                            </div>
                        </div>
                      </div>
                    </form>
                    </div>
                </div>
            </div>  
      </div>
    </div>
  </div>
  <script src="../HRM/src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../HRM/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../HRM/src/assets/js/sidebarmenu.js"></script>
  <script src="../HRM/src/assets/js/app.min.js"></script>
  <script src="../HRM/src/assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html> 