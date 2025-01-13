<?php
  include_once "../HRM/dbConnect.php";
  include_once "../HRM/Data_Count.php";
  include_once '../HRM/Session.php';
  include_once '../HRM/Login_Info.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang chủ</title>
  <link rel="shortcut icon" type="image/png" href="../HRM/src/assets/images/logos/HRM_favicon.png" />
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
              <a class="sidebar-link" href="../HRM/Department.php" aria-expanded="false">
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
                    <a href="./Sign_In.php" class="btn btn-outline-info mx-3 mt-2 d-block">Đăng xuất</a>
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
          <div class="alert alert-info" role="alert">
              <b>Chào mừng <?php echo $username?> đến với Hệ thống Quản lý Nhân sự - HRM!</b>
          </div>
            <!-- NỘI DUNG PAGE TỪ ĐÂY -->
             <div class="card">
                <div class="card-body">
                <div class="row flex-nowrap">
                  <div class="col">
                    <div class="card card bg-info-subtle">
                      <div class="card-body text-center px-9 pb-4">
                        <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-info flex-shrink-0 mb-3 mx-auto">
                            <iconify-icon icon="ic:baseline-people" class="fs-7 text-white"></iconify-icon>
                          </div>
                          <h6 class="fw-normal fs-3 mb-1">Tổng số nhân viên</h6>
                          <h3 class="mb-3 d-flex align-items-center justify-content-center gap-1"><?php echo $staff_count?></h3>
                          <a href="../HRM/Staff.php" class="btn btn-outline-info m-1">Xem chi tiết</a>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card card bg-success-subtle">
                        <div class="card-body text-center px-9 pb-4">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-secondary flex-shrink-0 mb-3 mx-auto">
                            <iconify-icon icon="mingcute:department-fill" class="fs-7 text-white"></iconify-icon>
                          </div>
                            <h6 class="fw-normal fs-3 mb-1">Tổng số phòng ban</h6>
                            <h3 class="mb-3 d-flex align-items-center justify-content-center gap-1"><?php echo $department_count?></h3>
                            <a href="../HRM/Staff.php" class="btn btn-outline-success m-1">Xem chi tiết</a>
                          </div>
                        </div>
                      </div>
                    <div class="col">
                      <div class="card card bg-danger-subtle">
                        <div class="card-body text-center px-9 pb-4">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                            <iconify-icon icon="oui:training" class="fs-7 text-white"></iconify-icon>
                          </div>
                          <h6 class="fw-normal fs-3 mb-1">Khoá đào tạo nội bộ</h6>
                          <h3 class="mb-3 d-flex align-items-center justify-content-center gap-1"><?php echo $training_count?></h3>
                          <a href="../HRM/Training.php" class="btn btn-outline-danger m-1">Xem chi tiết</a>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card card bg-primary-subtle">
                        <div class="card-body text-center px-9 pb-4">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                            <iconify-icon icon="mdi:account-wrench" class="fs-7 text-white"></iconify-icon>
                          </div>
                          <h6 class="fw-normal fs-3 mb-1">Tài khoản nhân viên</h6>
                          <h3 class="mb-3 d-flex align-items-center justify-content-center gap-1"><?php echo $account_count ?></h3>
                          <a href="../HRM/Account.php" class="btn btn-outline-primary m-1">Xem chi tiết</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">  
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Quản lý nhân viên</h5>
                                <p class="card-text">Danh sách nhân viên, Thông tin nhân viên,...</p>
                                <a href="../HRM/Staff.php" class="btn btn-outline-info">Chuyển tới Quản lý Nhân viên</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Quản lý Phòng ban</h5>
                                <p class="card-text">Danh sách phòng ban, Mã phòng ban,...</p>
                                <a href="../HRM/Department.php" class="btn btn-outline-info">Chuyển tới Quản lý Phòng ban</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Quản lý Đào tạo nhân sự</h5>
                                <p class="card-text">Danh sách khoá đào tạo nhân sự, ...</p>
                                <a href="../HRM/Training.php" class="btn btn-outline-info">Chuyển tới Quản lý Đào tạo Nhân sự</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Quản lý giờ làm</h5>
                                <p class="card-text">Danh sách ngày công,...</p>
                                <a href="../HRM/Work_Time.php" class="btn btn-outline-info">Chuyển tới Quản lý giờ làm </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Khen thưởng - Kỷ luật</h5>
                                <p class="card-text">Danh sách Khen thưởng - Kỷ luật,...</p>
                                <a href="../HRM/Discipline.php" class="btn btn-outline-info">Chuyển tới Khen thưởng - Kỷ luật</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Quản lý Tài khoản</h5>
                                <p class="card-text">Danh sách Tài khoản, Mã Tài khoản,...</p>
                                <a href="../HRM/Account.php" class="btn btn-outline-info">Chuyển tới Quản lý Tài khoản</a>
                                </div>
                            </div>
                        </div>
                        
                </div>
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