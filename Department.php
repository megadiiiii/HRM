<?php 
    include_once '../HRM/dbConnect.php';

    $department_id = '';
    $department = '';
    $description = '';
    $status = '';
    
    if(isset($_POST['btnSearch'])) {
        $department_id = $_POST['department_id'];
        $department = $_POST['department'];
        $status = $_POST['status'];
    }        
        // Search SQL
        $sql_search = "SELECT * FROM department WHERE `status` LIKE '%$status%' 
                                                AND `department_id` LIKE '%$department_id%'        
                                                AND `department` LIKE '%$department%'";
        $data_search = mysqli_query($con, $sql_search);

    if(isset($_POST['btnAdd'])) {
        header('location: ../HRM/Department_Add.php');
    }

    if(isset($_POST['btnExportExcel'])) {
        header('location: ../HRM/Department_Export.php');
    }

    mysqli_close($con);

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý phòng ban</title>
  <link rel="shortcut icon" type="image/png" href="../HRM/src/assets/images/logos/Logo.png" style="width: 32px;" />
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
          <img src="../HRM/src/assets/images/logos/Logo.png" alt="" /, style="width: 150px; transform: translateX(25%);">
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
            <a class="sidebar-link" href="../HRM/Diligent.php" aria-expanded="false">
              <iconify-icon icon="ph:calendar-bold"></iconify-icon>
              <span class="hide-menu">Quản lý chuyên cần</span>
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
                        <h5 class="mb-0 fs-12"> <?php echo $admin_name?></h5>
                        <p class="mb-0 text-dark"> <?php echo $username?></p>
                        <span class="text-success fs-11">Admin</span>                        
                    </div>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
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
                    <li class="breadcrumb-item active text-info " aria-current="page">Quản lí phòng ban</li>
                </ol>
            </nav>
            <div class="row">
                <div class="card">
                <form method="post">
                  <div>
                    <div class="card-body">
                      <h4 class="card-title">Tìm kiếm phòng ban</h4>
                      <div class="row pt-3">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Tên phòng</label>
                            <input type="text" name="department" class="form-control" placeholder="Tên phòng" >
                          </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                          <div class="mb-3 has-danger">
                            <label class="form-label">Mã phòng</label>
                            <input type="text" name="department_id" class="form-control form-control-danger" placeholder="Mã phòng" >
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                              <select name="status" class="form-select" data-placeholder="Giói tính" tabindex="1">
                                <option value="Đang hoạt động">Đang hoạt động</option>
                                <option value="Dừng hoạt động">Dừng hoạt động</option>
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
                        <button type="submit" name="btnAdd" class="btn btn-info text-light ms-6">
                          <i class="ti ti-circle-plus"></i>
                          Tạo mới
                        </button>
                        <button type="submit" name="btnExportExcel" class="btn btn-info text-light ms-6">
                          <i class="ti ti-file-arrow-right"></i>
                          Xuất Excel
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Danh sách phòng ban</h5>
                    <div class="table-responsive mb-4 border rounded-1">  
                      <table class="table table-hover mb-0 align-middle">
                      <thead class="table-info">
                          <tr>
                              <th scope="col">STT</th>
                              <th scope="col">Mã phòng</th>
                              <th scope="col">Tên phòng</th>
                              <th scope="col">Tầng</th>
                              <th scope="col">Trạng thái</th>
                              <th scope="col">Chức năng</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        if (isset($data_search) && mysqli_num_rows($data_search) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_array($data_search)) {
                        ?>
                            <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['department_id'] ?></td>
                                    <td><?php echo $row['department'] ?></td>
                                    <td><?php echo $row['floor'] ?></td>
                                    <td class="<?php echo $row['status'] == 'Đang hoạt động' ? 'text-success' : 'text-danger'; ?>">
                                        <?php echo $row['status']; ?>
                                    </td>
  
                                    <td>
                                        <a class="btn btn-warning" href="Department_Edit.php?department_id=<?php echo $row['department_id']; ?>">
                                          <i class="ti ti-edit"></i>
                                        </a>
                                        <a class="btn btn-danger" href="Department_Del.php?department_id=<?php echo $row['department_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa phòng này?')">
                                          <i class="ti ti-trash"></i>
                                        </a>
                                    </td>
                            </tr>
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