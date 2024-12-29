<?php 
    include_once "dbConnect.php";

    $Id = '';
    $Name = '';
    $Trainer = '';
    $Date = '';
    $Department = '';
    $Status = '';
    
    if (isset($_GET['Id'])) {
        $Id = $_GET['Id'];

        $sql_select = "SELECT * FROM `daotao` WHERE `Id` = '$Id'";
        $result = mysqli_query($con, $sql_select);

        if ($row = mysqli_fetch_assoc($result)) {
            $Name = $row['Name'];
            $Trainer = $row['Trainer'];
            $Date = $row['Date'];
            $Department = $row['Department'];
            $Status = $row['Status'];
            
            
        } else {
            echo "<script>alert('Không tìm thấy khoa!'); window.location='Search.php';</script>";
        }
    } else {
        echo "<script>alert('Không có khoa!'); window.location='Search.php';</script>";
    }


    // Xử lý khi người dùng nhấn nút Lưu
    if (isset($_POST['btnEdit'])) {
        $Id = $_POST['Id'];
        $Name = $_POST['Name'];
        $Trainer = $_POST['Trainer'];
        $Date = $_POST['Date'];
        $Department = $_POST['Department'];
        $Status = $_POST['Status'];
        // Cập nhật thông tin 
        $sql_update = "UPDATE `daotao` SET Name = '$Name', Trainer = '$Trainer', Date = '$Date' ,Department = '$Department', Status = '$Status'  Where Id = '$Id'";
        $data_update = mysqli_query($con, $sql_update);

        if ($data_update) {
            echo "<script>alert('Cập nhật thông tin thành công!'); window.location='Search.php';</script>";
        } else {
            echo "<script>alert('Cập nhật thông tin thất bại!')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KHOA </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form method="post" action="" style="width: 100%; padding: 100px 350px">
            <h3 style="text-align: center;">CẬP NHẬT THÔNG TIN</h3>
            <div class="form-inline">
                <label for="id">ID:</label>
                <input type="text" class="form-control" name="Id" value="<?php echo $Id;?>" readonly>
                <label for="Name:">Tên khoa:</label>
                <input type="text" class="form-control" name="Name" value="<?php echo $Name;?>">
                <label for="Trainer">Người đào tạo:</label>
                <input type="text" class="form-control" name="Trainer" value="<?php echo $Trainer;?>">
                <label for="Date">Date:</label>
                <input type="text" class="form-control" name="Date" value="<?php echo $Date;?>">
                <label for="Department">Department:</label>
                <input type="text" class="form-control" name="Department" value="<?php echo $Department;?>">
                <label for="Status">Status:</label>
                <select name="Status" class="form-control">
                    <option value="">---Chọn status---</option>
                            <option value="Đang đào tạo" <?php if($Status == 'Đang đào tạotạo') echo 'selected'; ?>>Đang đào tạo</option>
                            <option value="Chuẩn bị đào tạo" <?php if($Status == 'Chuẩn bị đào tạo') echo 'selected'; ?>>Chuẩn bị đào tạo</option>
                            <option value="Hủy" <?php if($Status == 'Hủy') echo 'selected'; ?>>Hủy</option>
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="btnEdit">Cập nhật</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="btnBack">Quay lại</button>
            </div>
        </form>
    </div>
</body>
</html>