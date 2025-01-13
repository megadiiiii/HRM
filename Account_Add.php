<?php 
    include_once '../HRM/dbConnect.php';
    include_once '../HRM/Session.php';
    include_once '../HRM/Login_Info.php';

    $staff_name = '';
    $username = '';
    $password = '';
    $role = '';

    if (isset($_POST['btnAdd'])) {
        $staff_name = $_POST['staff_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
    
        // Kiểm tra trùng lặp username
        $sql_check = "SELECT * FROM `account` WHERE `username` = '$username'";
        $result_check = mysqli_query($con, $sql_check);
    
        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Tên đăng nhập đã tồn tại! Vui lòng kiểm tra lại.')</script>";
        } else {
            // Chèn dữ liệu vào bảng account
            $sql_insert = "INSERT INTO `account`(`username`, `password`, `staff_name`, `role`) 
                            VALUES ('$username','$password','$staff_name','$role')";
            $data = mysqli_query($con, $sql_insert);
    
            if ($data) {
                echo "<script>alert('Thêm thông tài khoản thành công!'); window.location='Account.php';</script>";
            } else {
                echo "<script>alert('Thêm thông tài khoản thất bại!')</script>";
            }
        }

      }
      if (isset($_POST['btnBack'])) {
        header('location: ../HRM/Account.php');
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
            <a class="sidebar-link" href="../HRM/Discipline.php" aria-expanded="false">
              <iconify-icon icon="mingcute:warning-fill"></iconify-icon>
              <span class="hide-menu">Khen thưởng - Kỷ luật</span>
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
                        <a href="../HRM/Account.php" class="text-info d-flex align-items-center">
                        Quản lý tài khoản
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-info " aria-current="page">Tạo tài khoản</li>
                </ol>
            </nav> 
            <div class="card">
                <form method="post">
                  <div>
                    <div class="card-body">
                      <h4 class="card-title">Tạo mới tài khoản</h4>
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="staff_name" class="form-control" placeholder="Họ và tên">
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" name="username" class="form-control form-control-danger" placeholder="Tên đăng nhập">
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="form-label">Mật khẩu</label>
                            <input type="text" name="password" class="form-control form-control-danger" placeholder="Mật khẩu">
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Quyền tài khoản</label>
                            <select name="role" class="form-select"tabindex="1">
                                <option value="">--Chọn quyền tài khoản--</option>
                                <option value="Giám đốc">Giám đốc</option>
                                <option value="Admin">Admin</option>
                                <option value="Trưởng phòng">Trưởng phòng</option>
                                <option value="Nhân viên/Kỹ thuật viên">Nhân viên/Kỹ thuật viên</option>
                            </select>
                          </div>
                        </div>
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
  <script src="../HRM/src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../HRM/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../HRM/src/assets/js/sidebarmenu.js"></script>
  <script src="../HRM/src/assets/js/app.min.js"></script>
  <script src="../HRM/src/assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html> 