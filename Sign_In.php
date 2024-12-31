<?php
session_start();
include_once "../HRM/dbConnect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Kiểm tra trong cơ sở dữ liệu
    $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Lưu thông tin vào session
        $_SESSION['username'] = $user['username'];
        $_SESSION['staff_name'] = $user['staff_name'];
        $_SESSION['role'] = $user['role'];

        // Chuyển hướng đến trang chủ
        header("Location: Homepage.php");
        exit();
    } else {
        echo "Sai tên đăng nhập hoặc mật khẩu!";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Matdash Free</title>
  <link rel="shortcut icon" type="image/png" href="../HRM/src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../HRM/src/assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body"> 
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                <img src="../HRM/src/assets/images/logos/Logo.png" alt="" style="width: 150px; transform: translateX(5%);">
                </a>
                <h5 class="text-center">Hệ thống quản lí nhân sự - HRM</h5>
                <form method="post">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control border border-info" placeholder="Tên đăng nhập" name="username">
                      <label>
                        <i class="ti ti-user me-2 fs-4 text-info"></i>
                        <span class="border-start border-info ps-3">Tên đăng nhập</span>
                      </label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control border border-info" placeholder="Mật khẩu" name="password">
                      <label>
                        <i class="ti ti-lock me-2 fs-4 text-info"></i>
                        <span class="border-start border-info ps-3">Mật khẩu</span>
                      </label>
                    </div>

                    <div class="d-md-flex align-items-center">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="sf2" value="check">
                        <label class="form-check-label" for="sf2">Ghi nhớ đăng nhập</label>
                      </div>
                      <div class="mt-3 mt-md-0 ms-auto">
                        <button type="submit" class="btn btn-info hstack gap-6" name="btnLogin">
                          <i class="ti ti-send me-2 fs-4"></i>
                          Đăng nhập
                        </button>
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
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>