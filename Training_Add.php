<?php 
    include_once '../HRM/dbConnect.php';
    include_once '../HRM/Session.php';
    include_once '../HRM/Login_Info.php';

    $course_id = '';
    $course_name = '';
    $course_date = '';
    $trainer = '';
    $department = '';
    $status = '';

    if (isset($_POST['btnAdd'])) {
        $course_name = $_POST['course_name'];
        $course_date = $_POST['course_date'];
        $course_id = $_POST['course_id'];
        $trainer = $_POST['trainer'];
        $department = $_POST['department'];
        $status = $_POST['status'];
    
        // Kiểm tra trùng lặp course_id
        $sql_check = "SELECT * FROM `training` WHERE `course_id` = '$course_id'";
        $result_check = mysqli_query($con, $sql_check);
    
        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Mã đào tạo đã tồn tại! Vui lòng kiểm tra lại.')</script>";
        } else {
            // Chèn dữ liệu vào bảng Training
            $sql_insert = "INSERT INTO `Training`(`course_id`, `trainer`, `course_name`, `status`, `course_date`, `department`) 
                            VALUES ('$course_id','$trainer','$course_name','$status','$course_date','$department')";
            $data = mysqli_query($con, $sql_insert);
    
            if ($data) {
                echo "<script>alert('Thêm đợt đào tạo thành công!'); window.location='Training.php';</script>";
            } else {
                echo "<script>alert('Thêm đợt đào tạo thất bại!')</script>";
            }
        }

      }
      if (isset($_POST['btnBack'])) {
        header('location: ../HRM/Training.php');
      }

      $sql = "SELECT * FROM department";
      $data = mysqli_query($con, $sql);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý đào tạo nhân sự</title>
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
              <span class="hide-menu">Kỷ luật</span>
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
                        <a href="../HRM/Training.php" class="text-info d-flex align-items-center">
                        Quản lý đào tạo nhân sự
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-info " aria-current="page">Tạo khoá đào tạo</li>
                </ol>
            </nav> 
            <div class="card">
                <form method="post">
                  <div>
                    <div class="card-body">
                      <h4 class="card-title">Tạo mới khoá đào tạo</h4>
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Tên khoá đào tạo</label>
                            <input type="text" name="course_name" class="form-control" placeholder="Tên khoá đào tạo">
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="form-label">Mã khoá đào tạo</label>
                            <input type="text" name="course_id" class="form-control form-control-danger" placeholder="Mã khoá đào tạo">
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="form-label">Đợt đào tạo</label>
                            <input type="date" name="course_date" class="form-control form-control-danger" placeholder="Đợt đào tạo">
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="form-label">Người được đào tạo</label>
                            <input type="text" name="staff_name" class="form-control form-control-danger" placeholder="Người đào tạo">
                          </div>
                        </div>
                        <!--/span-->
                      </div>

                      <!--/row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Phòng ban</label>
                            <select name="department" class="form-select" data-placeholder="Choose a Category" tabindex="1">
                              <option value="">--Chọn phòng ban--</option>
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
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-select"tabindex="1">
                                <option value="">--Chọn trạng thái--</option>
                                <option value="Đã hoàn thành">Đã hoàn thành</option>
                                <option value="Đang đào tạo">Đang đào tạo</option>
                                <option value="Chưa bắt đầu">Chưa bắt đầu</option>
                                <option value="Đã huỷ">Đã huỷ</option>
                            </select>
                          </div>
                        </div>
                        <!--/span-->
                      </div>
                    </div>
                    
                    <div class="form-actions">
                      <div class="card-body border-top">
                        <button type="submit" name="btnAdd" class="btn btn-info text-light">Thêm mới</button>
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