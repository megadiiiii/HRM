<?php 
    include_once "dbConnect.php";

    $Id = '';
    $Name = '';
    $Trainer = '';
    $Date = '';
    $Department = '';
    $Status = '';
    
    if(isset($_POST['btnAdd'])) {
        $Id = $_POST['Id'];
        $Name = $_POST['Name'];
        $Date = $_POST['Date'];
        $Trainer = $_POST['Trainer'];
        $Department = $_POST['Department'];
        $Status = $_POST['Status'];

        
        // Primary Key Check
        $sql_check = "SELECT * FROM `daotao` WHERE `Id` = ?";
        $stmt_check = $con->prepare($sql_check);
        $stmt_check->bind_param("s", $Id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if($result_check->num_rows > 0) {
            echo "<script>alert('Trùng Id! Vui lòng kiểm tra lại!')</script>";
        } else {
            $sql_insert = "INSERT INTO `daotao`(`Id`, `Name`, `Trainer`, `Date`, `Department`, `Status`) 
                     VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $con->prepare($sql_insert);
            $stmt_insert->bind_param("ssssss", $Id, $Name, $Trainer, $Date, $Department, $Status);
            $data_insert = $stmt_insert->execute();
        }
        
        if($data_insert) {
            echo "<script>alert('Thêm thông tin thành công!')</script>";
        } else {            
            echo "<script>alert('Thêm thông tin thất bại!')</script>";
        }
    }
    
    if(isset($_POST['btnBack'])) {
        header('location:Search.php');
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form method="post" action="" style="width: 100%;">
            <h3 style="text-align: center;">THÊM THÔNG TIN</h3>
            <div class="form-inline">
            <label for="id">ID:</label>
                <input type="text" class="form-control" name="Id" value="<?php echo $Id;?>">
                <label for="Name:">Tên khoa:</label>
                <input type="text" class="form-control" name="Name" value="<?php echo $Name;?>">
                <label for="Trainer">Người đào tạo:</label>
                <input type="text" class="form-control" name="Trainer" value="<?php echo $Trainer;?>">
                <label for="Date">Date:</label>
                <input type="text" class="form-control" name="Date" value="<?php echo $Date;?>">
                <label for="Department">Phòng ban:</label>
                <input type="text" class="form-control" name="Department" value="<?php echo $Department;?>">
                <label for="Status">Status:</label>
                <select name="Status" class="form-control">
                    <option value="">---Chọn status---</option>
                            <option value="Đang đào tạo" <?php if($Status == 'Đang đào tạotạo') echo 'selected'; ?>>Đang đào tạo</option>
                            <option value="Chuẩn bị đào tạo" <?php if($Status == 'Chuẩn bị đào tạo') echo 'selected'; ?>>Chuẩn bị đào tạo</option>
                            <option value="Hủy" <?php if($Status == 'Hủy') echo 'selected'; ?>>Hủy</option>
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="btnAdd">Thêm mới</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="btnBack">Quay lại</button>
            </div>
        </form>
    </div>
</body>
</html>
