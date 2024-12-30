<?php 
    include_once '../HRM/dbConnect.php';
    require "../HRM/vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $speadsheet = new Spreadsheet();
    $sheet = $speadsheet->getActiveSheet();
    
    $sql_export = "SELECT * FROM `training`";
    $data_export = mysqli_query($con, $sql_export);

    // Title
    $sheet->setCellValue("A1", "DANH SÁCH KHOÁ ĐÀO TẠO NHÂN SỰ");

    // Header
    $sheet->setCellValue("A2", "STT"); 
    $sheet->setCellValue("B2", "Mã khoá đào tạo");
    $sheet->setCellValue("C2", "Tên khoá đào tạo");
    $sheet->setCellValue("D2", "Phòng");
    $sheet->setCellValue("E2", "Người đào tạo");
    $sheet->setCellValue("F2", "Đợt đào tạo");
    $sheet->setCellValue("G2", "Trạng thái");

    // Data
    $rowCount = 3;
    $no = 1; // Biến đếm STT
    foreach ($data_export as $data) {
        $sheet->setCellValue("A" . $rowCount, $no); 
        $sheet->setCellValue("B" . $rowCount, $data["course_id"]);
        $sheet->setCellValue("C" . $rowCount, $data["course_name"]);
        $sheet->setCellValue("D" . $rowCount, $data["department"]);
        $sheet->setCellValue("E" . $rowCount, $data["trainer"]);
        $sheet->setCellValue("F" . $rowCount, $data["course_date"]);
        $sheet->setCellValue("G" . $rowCount, $data["status"]);
        $rowCount++;
        $no++;
    }

    // Save   
    $writer = new Xlsx($speadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Danh_sach_dao_tao_nhan_su.xlsx"');
    $writer->save('php://output');
?>
