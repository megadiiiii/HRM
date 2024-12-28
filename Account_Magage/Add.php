<?php 
    include_once "dbConnect.php";

    $username = '';
    $mamon = '';
    $tenmon = '';
    $sotinchi = '';
    
    if(isset($_POST['btnAdd'])) {
        $username = $_POST['txtusername'];
        $mamon = $_POST['txtmamon'];
        $tenmon = $_POST['txttenmon'];
        $sotinchi = $_POST['txtsotinchi'];

        // Primary Key Check
        $sql_check = "SELECT * FROM `mon_hoc` WHERE `username` = '$username'";
        $result_check = mysqli_query($con, $sql_check);
        if(mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Trùng username! Vui lòng kiểm tra lại!')</script>";
        } else {
            $sql_insert = "INSERT INTO `mon_hoc`(`username`, `mamon`, `tenmon`, `sotinchi`) 
                            VALUES ('$username','$mamon','$tenmon','$sotinchi')";
            $data_insert = mysqli_query($con, $sql_insert);
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
    <meta name="viewport" content="wusernameth=device-wusernameth, initial-scale=1.0">
    <title>Thêm thông tin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form method="post" action="" style="wusernameth: 100%; padding: 100px 350px">
            <h3 style="text-align: center;">THÊM THÔNG TIN</h3>
            <div class="form-inline">
                <label for="username">username:</label>
                <input type="text" class="form-control" name="txtusername" value="<?php echo $username;?>">
                <label for="mamon">Mã môn:</label>
                <input type="text" class="form-control" name="txtmamon" value="<?php echo $mamon;?>">
                <label for="tenmon">Tên môn:</label>
                <input type="text" class="form-control" name="txttenmon" value="<?php echo $tenmon;?>">
                <label for="sotinchi">Số tín chỉ:</label>
                <input type="number" class="form-control" name="txtsotinchi" min="1" value="<?php echo $sotinchi;?>">
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="btnAdd">Thêm mới</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="btnBack">Quay lại</button>
            </div>
        </form>
    </div>
</body>
</html>