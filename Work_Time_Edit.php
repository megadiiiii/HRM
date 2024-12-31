<?php 
    include_once '../HRM/dbConnect.php';
    include_once '../HRM/Session.php';
    include_once '../HRM/Login_Info.php';

    $staff_name = '';
    $workday = '';
    $staff_id = '';
    $working_hours = '';
    $department = '';
    $position = '';

    if (isset($_GET['staff_id'])) {
        $staff_id = $_GET['staff_id'];
    
        // Lấy thông tin sinh viên từ cơ sở dữ liệu
        $sql_select = "SELECT * FROM work_time WHERE staff_id = '$staff_id'";
        $result_select = mysqli_query($con, $sql_select);
    
        if ($row = mysqli_fetch_assoc($result_select)) {
            $staff_name = $row['staff_name'];
            $workday = $row['workday'];
            $staff_id = $row['staff_id'];
            $working_hours = $row['working_hours'];
            $department = $row['department'];
            $position = $row['position'];
        } else {
            echo "<script>alert('Không tìm thấy nhân viên!'); window.location='List.php';</script>";
            exit();
        }
    }
    
    // Xử lý khi người dùng nhấn nút Lưu
    if (isset($_POST['btnSave'])) {
        $staff_name = $_POST['staff_name'];
        $workday = $_POST['workday'];
        $working_hours = $_POST['working_hours'];
        $department = $_POST['department'];
        $position = $_POST['position'];
    
        // Cập nhật thông tin sinh viên
        $sql_update = "UPDATE work_time 
                       SET `staff_name` = '$staff_name',
                           `workday` = '$workday',
                           `working_hours` = '$working_hours',
                           `department` = '$department',
                           `position` = '$position'
                       WHERE staff_id = '$staff_id'";
    
        $data = mysqli_query($con, $sql_update);
    
        if ($data) {
            echo "<script>alert('Cập nhật giờ làm thành công!'); window.location='work_time.php';</script>";
        } else {
            echo "<script>alert('Cập nhật giờ làm thất bại!')</script>";
        }
    }
    
        $sql = "SELECT * FROM work_time";
        $class = mysqli_query($con, $sql);
        
        if (isset($_POST['btnBack'])) {
          header('location: ../HRM/work_time.php');
        }
        
        $sql = "SELECT * FROM department";
        $data = mysqli_query($con, $sql);
        mysqli_close($con);
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
              <iconify-icon icon="material-symbols:home"></iconify-icon>
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
                        <h5 class="mb-0 fs-12"><?php echo $staff_id?></h5>
                        <span class="text-success fs-11"><?php echo $position?></span>                                              
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
                        <a href="../HRM/work_time.php" class="text-info d-flex align-items-center">
                        Quản lý giờ làm
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-info " aria-current="page">Chỉnh sửa giờ làm</li>
                </ol>
            </nav> 
            <div class="card">
                <form method="post">
                  <div>
                    <div class="card-body">
                      <h4 class="card-title">Chỉnh sửa giờ làm</h4>
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="staff_name" class="form-control" placeholder="Họ và tên" value="<?php echo $staff_name?>">
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="form-label">Mã nhân viên</label>
                            <input type="text" name="workday" class="form-control form-control-danger" placeholder="Mã nhân viên" value="<?php echo $workday?>">
                          </div>
                        </div>
                        <!--/span-->
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
                    </div>
                    <!--/span-->
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Số ngày làm việc</label>
                            <input type="number" name="workday" class="form-control form-control-danger" placeholder="Số ngày làm việc" min="14" max="31" value="<?php echo $workday?>">
                            </div>
                          </div>
                          <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Ca làm việc</label>
                            <select name="working_hours" class="form-select" data-placeholder="Ca làm việc" tabindex="1">
                                <option value="">--Ca làm việc--</option>
                                <option value="Part-time: 10h-14h" <?php if($working_hours == 'Part-time: 10h-14h') echo 'selected'; ?>>Part-time: 10h-14h</option>
                                <option value="Part-time: 18h-22h" <?php if($working_hours == 'Part-time: 18h-22h') echo 'selected'; ?>>Part-time: 18h-22h</option>
                                <option value="Full-time: 6h-14h" <?php if($working_hours == 'Full-time: 6h-14h') echo 'selected'; ?>>Full-time: 6h-14h</option>
                                <option value="Full-time: 14h-22h" <?php if($working_hours == 'Full-time: 14h-22h') echo 'selected'; ?>>Full-time: 14h-22h</option>
                                <option value="Full-time: 22h-6h" <?php if($working_hours == 'Full-time: 22h-6h') echo 'selected'; ?>>Full-time: 22h-6h</option>
                            </select>
                          </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <div class="form-actions">
                      <div class="card-body border-top">
                        <button type="submit" name="btnSave" class="btn btn-info text-light">Cập nhật</button>
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