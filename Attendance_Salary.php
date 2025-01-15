<?php
include_once 'dbConnect.php'; // Kết nối cơ sở dữ liệu
include_once '../HRM/Session.php';
include_once '../HRM/Login_Info.php';

// Truy vấn dữ liệu từ bảng staff, attendance và salary
    $sql_list = "SELECT staff.staff_id, staff.staff_name, staff.department, staff.position, staff.salary_level,
        SUM(attendance.worked) AS total_worked_days,
        (SUM(attendance.worked) * salary.salary) AS actual_salary
        FROM staff
        LEFT JOIN attendance ON staff.staff_id = attendance.staff_id
        LEFT JOIN salary ON staff.salary_level = salary.salary_level
        GROUP BY staff.staff_id, staff.staff_name, staff.department, staff.position, staff.salary_level, salary.salary;";
    $data_list = mysqli_query($con, $sql_list);
  
    if (isset($_POST['btnBack'])) {
      header('location: ../HRM/Attendance.php');
    }

    if (isset($_POST['btnExportExcel'])) {
      header('location: ../HRM/Attendance_Salary_Export.php');
    }
// Xử lý thông báo
$message = "";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bảng lương tạm tính</title>
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
            <a class="sidebar-link" href="../HRM/Attendance.php" aria-expanded="false">
              <iconify-icon icon="ph:calendar-bold"></iconify-icon>
              <span class="hide-menu">Quản lý chuyên cần</span>
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
              <span class="hide-menu">Bảng lương tạm tính</span>
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
            <!-- NỘI DUNG PAGE TỪ ĐÂY -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-info-subtle-light px-3 py-2 rounded">
                    <li class="breadcrumb-item">
                        <a href="../HRM/Homepage.php" class="text-info d-flex align-items-center">
                        <i class="ti ti-home fs-4 mt-1"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="../HRM/Attendance.php" class="text-info d-flex align-items-center">
                            Quản lý chuyên cần
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-info " aria-current="page">Bảng lương tạm tính</li>
                </ol>
            </nav>
            <div class="row">
              <form method="post">            
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Bảng lương tạm tính</h5>
                                          <div class="table-responsive mb-4 border rounded-1">  
                        <table class="table table-hover mb-0 align-middle">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã nhân viên</th>
                                <th scope="col">Tên nhân viên</th>
                                <th scope="col">Phòng</th>
                                <th scope="col">Vị trí</th>
                                <th scope="col">Bậc lương</th>
                                <th scope="col">Tổng số ngày công</th>
                                <th scope="col">Lương tạm tính</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          if (isset($data_list) && mysqli_num_rows($data_list) > 0) {
                          $i = 1;
                          while ($row = mysqli_fetch_array($data_list)) {
                          ?>
                              <tr>
                                      <td><?php echo $i++ ?></td>
                                      <td><?php echo $row['staff_id'] ?></td>
                                      <td><?php echo $row['staff_name'] ?></td>
                                      <td><?php echo $row['department'] ?></td>
                                      <td><?php echo $row['position'] ?></td>
                                      <td><?php echo $row['salary_level'] ? $row['salary_level'] : "Chưa có"; ?></td>
                                      <td><?php echo $row['total_worked_days'] ? $row['total_worked_days'] : "0"; ?></td>
                                      <td><?php echo $row['actual_salary'] ? number_format($row['actual_salary'], 0, ',', '.') : "0"; ?></td>                              </tr>
                          <?php
                                  }
                              } else {
                                  echo "<tr><td colspan='10'>Không tìm thấy dữ liệu</td></tr>";
                              }
                          ?>
                        </tbody>
                        </table>
                  </div>  
                </div>
                <div class="form-actions">
                    <div class="card-body border-top">
                        <button type="submit" name="btnExportExcel" class="btn btn-info text-light ms-6">
                            Xuất Excel
                        </button>
                        <button type="submit" name="btnBack" class="btn btn-info ms-6">Quay lại</button>
                        <!-- <a href="javascript:void(0);" class="btn btn-info text-light ms-6" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a> -->

                    </form>
                </div>
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
  <script>
  function formToggle(ID){
      var element = document.getElementById(ID);
      if(element.style.display === "none"){
          element.style.display = "block";
      }else{
          element.style.display = "none";
      }
  }
  </script>
</body>

</html>