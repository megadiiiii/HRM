<?php 
    include_once '../HRM/dbConnect.php';
    require "../HRM/vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $speadsheet = new Spreadsheet();
    $sheet = $speadsheet->getActiveSheet();
    
    $sql_export = "SELECT * FROM `account`";
    $data_export = mysqli_query($con, $sql_export);

    // Title
    $sheet->setCellValue("A1", "DANH SÁCH TÀI KHOẢN NHÂN VIÊN");

    // Header
    $sheet->setCellValue("A2", "STT"); 
    $sheet->setCellValue("B2", "Tên nhân viên");
    $sheet->setCellValue("C2", "Tên đăng nhập");
    $sheet->setCellValue("D2", "Mật khẩu");
    $sheet->setCellValue("E2", "Quyền tài khoản");

    // Data
    $rowCount = 3;
    $no = 1; // Biến đếm STT
    foreach ($data_export as $data) {
        $sheet->setCellValue("A" . $rowCount, $no); 
        $sheet->setCellValue("B" . $rowCount, $data["staff_name"]);
        $sheet->setCellValue("C" . $rowCount, $data["username"]);
        $sheet->setCellValue("D" . $rowCount, $data["password"]);
        $sheet->setCellValue("E" . $rowCount, $data["role"]);
        $rowCount++;
        $no++;
    }

    // Save   
    $writer = new Xlsx($speadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Danh_sach_tai_khoan.xlsx"');
    $writer->save('php://output');
?>
