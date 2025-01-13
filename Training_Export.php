<?php 
    include_once '../HRM/dbConnect.php';
    require "../HRM/vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $speadsheet = new Spreadsheet();
    $sheet = $speadsheet->getActiveSheet();
    
    $sql_export = "SELECT * FROM `training`
                LEFT JOIN `course` ON `course`.`course_id` = `training`.`course_id`
                LEFT JOIN `staff` ON `staff`.`staff_id` = `training`.`staff_id`";
    $data_export = mysqli_query($con, $sql_export);

    // Title
    $sheet->setCellValue("A1", "DANH SÁCH KHOÁ ĐÀO TẠO NHÂN SỰ");

    // Header
    $sheet->setCellValue("A2", "STT"); 
    $sheet->setCellValue("B2", "Mã khoá đào tạo");
    $sheet->setCellValue("C2", "Tên khoá đào tạo"); 
    $sheet->setCellValue("D2", "Người được đào tạo");
    $sheet->setCellValue("E2", "Mã nhân viên");
    $sheet->setCellValue("F2", "Phòng");
    $sheet->setCellValue("G2", "Đợt đào tạo");
    $sheet->setCellValue("H2", "Trạng thái");

    // Data
    $rowCount = 3;
    $no = 1; // Biến đếm STT
    foreach ($data_export as $data) {
        $sheet->setCellValue("A" . $rowCount, $no); 
        $sheet->setCellValue("B" . $rowCount, $data["course_id"]);
        $sheet->setCellValue("C" . $rowCount, $data["course_name"]);
        $sheet->setCellValue("D" . $rowCount, $data["staff_name"]);
        $sheet->setCellValue("E" . $rowCount, $data["staff_id"]);
        $sheet->setCellValue("F" . $rowCount, $data["department"]);
        $sheet->setCellValue("G" . $rowCount, $data["course_date"]);
        $sheet->setCellValue("H" . $rowCount, $data["status"]);
        $rowCount++;
        $no++;
    }

    // Save   
    $writer = new Xlsx($speadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Danh_sach_khoa_dao_tao.xlsx"');
    $writer->save('php://output');
?>
