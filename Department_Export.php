<?php 
    include_once '../HRM/dbConnect.php';
    require "../HRM/vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $speadsheet = new Spreadsheet();
    $sheet = $speadsheet->getActiveSheet();
    
    $sql_export = "SELECT * FROM `department`";
    $data_export = mysqli_query($con, $sql_export);

    // Title
    $sheet->setCellValue("A1", "DANH SÁCH PHÒNG BAN");

    // Header
    $sheet->setCellValue("A2", "STT"); 
    $sheet->setCellValue("B2", "Mã phòng ban");
    $sheet->setCellValue("C2", "Tên phòng ban");
    $sheet->setCellValue("D2", "Tầng");
    $sheet->setCellValue("E2", "Trạng thái");
    // Data
    $rowCount = 3;
    $no = 1; // Biến đếm STT
    foreach ($data_export as $data) {
        $sheet->setCellValue("A" . $rowCount, $no); 
        $sheet->setCellValue("B" . $rowCount, $data["department_id"]);
        $sheet->setCellValue("C" . $rowCount, $data["department"]);
        $sheet->setCellValue("D" . $rowCount, $data["floor"]);
        $sheet->setCellValue("E" . $rowCount, $data["status"]);
        $rowCount++;
        $no++;
    }

    // Save   
    $writer = new Xlsx($speadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Danh_sach_phong_ban.xlsx"');
    $writer->save('php://output');
?>
