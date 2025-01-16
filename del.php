<?php
$mpb = $_GET['Maphongban'];
include_once('./connectdb.php');
$sql = "delete from phongban where Maphongban='$mpb'";
$kq= mysqli_query($con, $sql);
if($kq)
    header('location:./phongban.php');
else
    echo "<script>alert('Xóa thất bại')</script>";
?>