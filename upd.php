<?php
include_once("./connectdb.php");
$mpb='';
$dpt='';
$mt='';
$sdt='';
$sql="select * from phongban";
$phongban=mysqli_query($con,$sql);
//tim kiem 
//kiem tra xem co an vao nut submit chua
if(isset($_POST["btnsubmit"])){
    //lay du lieu tu form
    $mpb=$_POST["txtMaphongban"];
    $dpt=$_POST["txtdepartment"];
    $mt=$_POST["txtMota"];
    $sdt=$_POST["txtSodienthoai"];
    //tao cau lenh insert
    $sql1="insert into phongban values(N'$mpb',N'$dpt',N'$mt','$sdt')";
    //thuc thi cau lenh
    $kq = mysqli_query($con,$sql1);
    if($kq)
    echo "<script>alert('Thêm mới thành công <3')</script>";
   else
   echo "<script>alert('Thêm mới thất bại :<')</script>";
}
if(isset($_POST["btnback"])){
   header('location:./phongban.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update phòng ban</title>
   <link rel="stylesheet" href="./bootstrap.min.css">
</head>

<body>
   <div class="container">
      <form action="" method="POST">
         <div class="form-group">
            <label>Mã phòng ban</label>
            <input type="text" class="form-control" id="Maphongban" name="txtMaphongban" value="<?php echo $mpb ?>">
         </div>
         <div class="form-group">
            <label>Tên phòng ban</label>
            <input type="text" class="form-control" id="department" name="txtdepartment" value="<?php echo $dpt ?>">
         </div>
         <div class="form-group">
            <label>Mô tả</label>
            <input type="text" class="form-control" id="Mota" name="txtMota" value="<?php echo $mt ?>">
         </div>
         <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" class="form-control" id="Sodienthoai" name="txtSodienthoai" value="<?php echo $sdt ?>">
         </div>
         <button type="submit" class="btn btn-primary" name="btnback">Trở lại</button>
         &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
         <button type="submit" class="btn btn-primary" name="btnsubmit">Xác nhận</button>
      </form>
   </div>
</body>

</html>