<?php
include_once("./connectdb.php");
$mpb='';
$dpt='';
$mt='';
$sdt='';
$sql='Select * from phongban';
$phongban=mysqli_query($con,$sql);
//tim kiem
if(isset($_POST['btntimkiem'])){
   $mpb=$_POST['txtMaphongban'];
   $dpt=$_POST['txtdepartment'];
   $sql="Select*from phongban Where Maphongban like '%$mpb%'and department like '%$dpt%'";
   $data=mysqli_query($con,$sql);  
}
if(isset($_POST["btnnew"])){
   header('location:./upd.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tìm kiếm phòng ban</title>
   <link rel="stylesheet" href="./bootstrap.min.css">
</head>

<body>
   <div class="container">
      <form method="post" action="">
         <div class="form-group">
            <label for="mamon">Mã phòng ban</label>
            <input type="text" class="form-control" id="Maphongban" name="txtMaphongban" value="<?php echo $mpb ?>">
         </div>
         <div class="form-group">
            <label for="tenmon">Tên phòng ban</label>
            <input type="text" class="form-control" id="department" name="txtdepartment" value="<?php echo $dpt ?>">
         </div>
         <button type="submit" class="btn btn-primary" name="btnnew">Tạo mới</button>
         &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
         <button type="submit" class="btn btn-primary" name="btntimkiem">Tìm kiếm</button>
   </div>
   </form>
   </div>
   <table class="table table-striped">
      <thead>
         <tr>
            <th>STT</th>
            <th>Mã phòng ban</th>
            <th>Tên phòng ban</th>
            <th>Mô tả</th>
            <th>Số điện thoại</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if(isset($data)&&mysqli_num_rows($data)>0){
               $i=1;
               while($row = mysqli_fetch_assoc($data)){
                  ?>
         <tr>
            <td><?php echo $i++ ?></td>
            <td><?php echo $row['Maphongban'] ?></td>
            <td><?php echo $row['department'] ?></td>
            <td><?php echo $row['Mota'] ?></td>
            <td><?php echo $row['Sodienthoai'] ?></td>
            <td>
               <!-- link chinh sua va xoa -->
               <a href="./edit.php?Maphongban=<?php echo $row['Maphongban'] ?>">Sửa</a>
               &nbsp;&nbsp;&nbsp;
               <a href="./del.php?Maphongban=<?php echo $row['Maphongban'] ?>">Xóa</a>
               </td>
         </tr>
         <?php
               }
         }
         ?>
      </tbody>
   </table>
</body>

</html>