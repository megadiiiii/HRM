<?php 
    include_once "dbConnect.php";

    $Id = '';
    $Name = '';
    $Trainer = '';
    $Date = '';
    $Department = '';
    $Status = '';
    
    if(isset($_POST['btnSearch'])) {
        $Id = $_POST['Id'];
        $Name = $_POST['Name'];
        $Status = $_POST['Status'];
    }        
        // Search SQL
        $sql_search = "SELECT * FROM `daotao` WHERE Id LIKE '%$Id%' 
                                                AND Name LIKE '%$Name%'
                                                AND Status LIKE '%$Status%'";       
        $data_search = mysqli_query($con, $sql_search);

    if(isset($_POST['btnAdd'])) {
        header('location:Add.php');
    }

    mysqli_close($con);

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
        <form method="post" action="" style="width: 100%; padding: 50px 350px">
            <h3 style="text-align: center;">TÌM KIẾM</h3>
            <div class="form-inline">
                <label for="Id">ID:</label>
                <input type="text" class="form-control" name="Id" value="<?php echo $Id;?>">
                <label for="Name">Tên khoa:</label>
                <input type="text" class="form-control" name="Name" value="<?php echo $Name;?>">
                <label for="Status">Trạng thái:</label>
                <input type="text" class="form-control" name="Status" value="<?php echo $Status;?>">
                <select name="Status" class="form-control">
                            <option value="">---Chọn status---</option>
                            <option value="Đang đào tạo" <?php if($Status == 'Đang đào tạotạo') echo 'selected'; ?>>Đang đào tạo</option>
                            <option value="Chuẩn bị đào tạo" <?php if($Status == 'Chuẩn bị đào tạo') echo 'selected'; ?>>Chuẩn bị đào tạo</option>
                            <option value="Hủy" <?php if($Status == 'Hủy') echo 'selected'; ?>>Hủy</option>
                </select>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="btnSearch">Tìm kiếm</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="btnAdd">Thêm mới</button>
            </div>
        </form>
        
        <h3 style="text-align: center;">DANH SÁCH</h3>
        <table class="table table-bordered table-stripped" border="1" style="width:100%">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>  
                    <th>Tên khoa</th>
                    <th>Người đào tạo</th>
                    <th>Ngày đào tạo</th>
                    <th>Phòng ban</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
            <?php
            if (isset($data_search) && mysqli_num_rows($data_search) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_array($data_search)) {
            ?>
                <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['Id'] ?></td>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['Trainer'] ?></td>
                        <td><?php echo $row['Date'] ?></td>
                        <td><?php echo $row['Department'] ?></td>
                        <td><?php echo $row['Status'] ?></td>
                        <td>
                            <a class="btn btn-warning" href="Edit.php?Id=<?php echo $row['Id']; ?>">Sửa</a>
                            <a class="btn btn-danger" href="Delete.php?Id=<?php echo $row['Id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa khoa này?')">Xóa</a>
                        </td>
                </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='10'>Không tìm thấy dữ liệu</td></tr>";
                }
            ?>
        </tbody>
    </div>
</body>
</html>