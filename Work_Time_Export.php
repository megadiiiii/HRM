<?php 
    include_once '../HRM/dbConnect.php';
    require "../HRM/vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $speadsheet = new Spreadsheet();
    $sheet = $speadsheet->getActiveSheet();
    
    $sql_export = "SELECT * FROM `work_time`";
    $data_export = mysqli_query($con, $sql_export);

    // Title
    $sheet->setCellValue("A1", "DANH SÁCH GIỜ LÀM VIỆC");

    // Header
    $sheet->setCellValue("A2", "STT"); 
    $sheet->setCellValue("B2", "Mã nhân viên");
    $sheet->setCellValue("C2", "Tên nhân viên");
    $sheet->setCellValue("D2", "Phòng");
    $sheet->setCellValue("E2", "Vị trí");
    $sheet->setCellValue("F2", "Số ngày làm việc");
    $sheet->setCellValue("G2", "Ca làm việc");

    // Data
    $rowCount = 3;
    $no = 1; // Biến đếm STT
    foreach ($data_export as $data) {
        $sheet->setCellValue("A" . $rowCount, $no); 
        $sheet->setCellValue("B" . $rowCount, $data["staff_id"]);
        $sheet->setCellValue("C" . $rowCount, $data["staff_name"]);
        $sheet->setCellValue("D" . $rowCount, $data["department"]);
        $sheet->setCellValue("E" . $rowCount, $data["position"]);
        $sheet->setCellValue("F" . $rowCount, $data["workday"]);
        $sheet->setCellValue("G" . $rowCount, $data["working_hours"]);
        $rowCount++;
        $no++;
    }

    // Save   
    $writer = new Xlsx($speadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Danh_sach_gio_lam_viec.xlsx"');
    $writer->save('php://output');
?>
