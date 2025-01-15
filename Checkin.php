<?php 
    include_once '../HRM/dbConnect.php';
    include_once '../HRM/Session.php';
    include_once '../HRM/Login_Info.php';

    $staff_id = '';
    $staff_name = '';
    $department = '';
    $working_hours = '';
    $checkin_status = '';
    $checkin_date = '';

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
    $checkin_date = isset($_POST['checkin_date']) ? $_POST['checkin_date'] : '';
    $checkin_status = isset($_POST['checkin_status']) ? $_POST['checkin_status'] : '';



    // Kiểm tra nếu bản ghi đã tồn tại trong bảng attendance
    $sql_check_attendance = "SELECT * FROM attendance WHERE staff_id = '$staff_id' AND checkin_date = '$checkin_date'";
    $result_check_attendance = mysqli_query($con, $sql_check_attendance);

    if (mysqli_num_rows($result_check_attendance) > 0) {
    // Nếu đã có bản ghi, thông báo lỗi
    $message = "<p class='text-danger'>Nhân viên $staff_id đã được chấm công vào ngày $checkin_date.</p>";
    } else {
    // Nếu chưa có bản ghi, thêm mới
    $worked = ($checkin_status === 'Có mặt') ? 1 : 0;
    $sql_insert = "INSERT INTO attendance (staff_id, checkin_date, checkin_status, worked) 
        VALUES ('$staff_id', '$checkin_date', '$checkin_status', $worked)";
    if (mysqli_query($con, $sql_insert)) {
        $message = "<p class='text-success'>Chấm công thành công cho nhân viên $staff_id vào ngày $checkin_date.</p>";
        } else {
            $message = "<p class='text-danger'>Lỗi chấm công: " . mysqli_error($con) . "</p>";
            }
        }
    }
    
    if(isset($_POST['btnSearch'])) {
      $staff_id = $_POST['staff_id'];
      $staff_name = $_POST['staff_name'];
      $department = $_POST['department'];
      $checkin_status = $_POST['checkin_status'];

    }        
        // Search SQL
            $sql_search = "SELECT * 
                        FROM `attendance`
                        LEFT JOIN `staff` AS s ON `s`.`staff_id` = `attendance`.`staff_id`
                        LEFT JOIN `salary` AS sal ON `s`.`salary_level` = `sal`.`salary_level`
                        WHERE `s`.`staff_name` LIKE '%$staff_name%'
                        AND `s`.`department` LIKE '%$department%'";
        $data_search = mysqli_query($con, $sql_search);

    if(isset($_POST['btnCheckin'])) {
        header('location: ../HRM/Checkin.php');
    }

    if(isset($_POST['btnExportExcel'])) {
      header('location: ../HRM/Checkin.php');
    }

    if(isset($_POST['btnHistory'])) {
      header('location: ../HRM/Work_time.php');
    }
  $sql = "SELECT * FROM `department`";
  $data = mysqli_query($con, $sql);


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chấm công</title>
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
                    <li class="breadcrumb-item active text-info " aria-current="page">Chấm công</li>
                </ol>
            </nav>
            <div class="row">
                <div class="card">
                <form method="post">
                  <div>
                    <div class="card-body">
                      <h4 class="card-title">Chấm công</h4>
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="staff_name" class="form-control" placeholder="Họ và tên" >
                          </div>
                        </div>                        
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="form-label">Mã nhân viên</label>
                            <input type="text" name="staff_id" class="form-control" placeholder="Tên đăng nhập" >
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ngày chấm công</label>
                                <input type="date" name="checkin_date" class="form-control form-control-danger">
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="checkin_status" class="form-select"tabindex="1">
                                <option value="">--Chọn trạng thái--</option>
                                <option value="Có mặt">Có mặt</option>
                                <option value="Vắng mặt">Vắng mặt</option>
                            </select>
                          </div>
                        </div>

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
                      </div>
                    </div>
                    
                    <div class="form-actions">
                      <div class="card-body border-top">
                        <button type="submit" name="btnSearch" class="btn btn-info text-light">
                          <i class="ti ti-search"></i>
                          Tìm kiếm
                        </button>
                        <button type="submit" name="btnHistory" class="btn btn-info text-light ms-6">
                          <i class="ti ti-search"></i>
                          Lịch sử chấm công
                        </button>
                        <button type="submit" name="btnExportExcel" class="btn btn-info text-light ms-6">
                          <i class="ti ti-file-arrow-right"></i>
                          Xuất Excel
                        </button>
                        <!-- <a href="javascript:void(0);" class="btn btn-info text-light ms-6" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a> -->

                      </form>
                      </div>
                      </div>
                  </div>
                </form>
                </div>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Danh sách tài khoản</h5>
                    <div class="table-responsive mb-4 border rounded-1">  
                      <table class="table table-hover mb-0 align-middle">
                      <thead class="table-info">
                          <tr>
                              <th scope="col">Mã nhân viên</th>
                              <th scope="col">Tên nhân viên</th>
                              <th scope="col">Phòng</th>
                              <th scope="col">Vị trí</th>
                              <th scope="col">Ngày chấm công</th>
                              <th scope="col">Trạng thái</th>
                              <th scope="col">Chấm công</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                            <?php if (mysqli_num_rows($result_staff) > 0): ?>
                            <?php $i = 1; // Initialize the counter ?>
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
                                    <input type="date" name="checkin_date" class="form-control" value="<?php echo date('dd-mm-yyyy'); ?>">
                                    </td>
                                    <td>
                                    <select name="checkin_status" class="form-select">
                                        <option value="Có mặt">Có mặt</option>
                                        <option value="Vắng">Vắng</option>

                                    </select>
                                    </td>
                                    <td>
                                    <input type="hidden" name="staff_id" value="<?php echo $row['staff_id']; ?>">
                                    <button type="submit" name="btnSubmit" class="btn btn-info btn-sm">
                                        <i class="ti ti-circle-plus"></i>
                                    </button>
                                    </td>
                                </form>
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