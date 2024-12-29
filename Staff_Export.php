<?php 
    include_once '../HRM/dbConnect.php';
    require "../HRM/vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $speadsheet = new Spreadsheet();
    $sheet = $speadsheet->getActiveSheet();
    
    $sql_export = "SELECT * FROM `staff`";
    $data_export = mysqli_query($con, $sql_export);

    // Title
    $sheet->setCellValue("A1", "DANH SÁCH NHÂN VIÊN");

    // Header
    $sheet->setCellValue("A2", "STT"); 
    $sheet->setCellValue("B2", "Mã nhân viên");
    $sheet->setCellValue("C2", "Tên nhân viên");
    $sheet->setCellValue("D2", "Ngày, tháng, năm sinh");
    $sheet->setCellValue("E2", "Giới tính");
    $sheet->setCellValue("F2", "Phòng");
    $sheet->setCellValue("G2", "Vị trí công việc");
    $sheet->setCellValue("H2", "Địa chỉ");
    $sheet->setCellValue("I2", "Email");
    $sheet->setCellValue("J2", "Số điện thoại");
    $sheet->setCellValue("K2", "Ngày vào làm");
    $sheet->setCellValue("L2", "Trạng thái");

    // Data
    $rowCount = 3;
    $no = 1; // Biến đếm STT
    foreach ($data_export as $data) {
        $sheet->setCellValue("A" . $rowCount, $no); 
        $sheet->setCellValue("B" . $rowCount, $data["staff_id"]);
        $sheet->setCellValue("C" . $rowCount, $data["staff_name"]);
        $sheet->setCellValue("D" . $rowCount, $data["gender"]);
        $sheet->setCellValue("E". $rowCount, $data["dob"]);
        $sheet->setCellValue("F" . $rowCount, $data["department"]);
        $sheet->setCellValue("G" . $rowCount, $data["position"]);
        $sheet->setCellValue("H" . $rowCount, $data["address"]);
        $sheet->setCellValue("I" . $rowCount, $data["email"]);
        $sheet->setCellValue("J" . $rowCount, $data["phone"]);
        $sheet->setCellValue("K" . $rowCount, $data["start_date"]);
        $sheet->setCellValue("L" . $rowCount, $data["status"]);
        $rowCount++;
        $no++;
    }

    // Save   
    $writer = new Xlsx($speadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Danh_sach_nhan_vien.xlsx"');
    $writer->save('php://output');
?>
