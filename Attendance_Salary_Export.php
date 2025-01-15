<?php 
    include_once '../HRM/dbConnect.php';
    require "../HRM/vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $speadsheet = new Spreadsheet();
    $sheet = $speadsheet->getActiveSheet();
    
    $sql_export = "SELECT staff.staff_id, staff.staff_name, staff.department, staff.position, staff.salary_level,
        SUM(attendance.worked) AS total_worked_days,
        (SUM(attendance.worked) * salary.salary) AS actual_salary
        FROM staff
        LEFT JOIN attendance ON staff.staff_id = attendance.staff_id
        LEFT JOIN salary ON staff.salary_level = salary.salary_level
        GROUP BY staff.staff_id, staff.staff_name, staff.department, staff.position, staff.salary_level, salary.salary;";
    $data_export = mysqli_query($con, $sql_export);

    // Title
    $sheet->setCellValue("A1", "BẢNG LƯƠNG TẠM TÍNH");

    // Header
    $sheet->setCellValue("A2", "STT"); 
    $sheet->setCellValue("B2", "Mã nhân viên");
    $sheet->setCellValue("C2", "Tên nhân viên");
    $sheet->setCellValue("D2", "Phòng");
    $sheet->setCellValue("E2", "Vị trí");
    $sheet->setCellValue("F2", "Bậc lương");
    $sheet->setCellValue("G2", "Tổng số ngày công");
    $sheet->setCellValue("H2", "Lương tạm tính");

    // Data
    $rowCount = 3;
    $no = 1; // Biến đếm STT
    foreach ($data_export as $data) {
        $sheet->setCellValue("A" . $rowCount, $no); 
        $sheet->setCellValue("B" . $rowCount, $data["staff_id"]);
        $sheet->setCellValue("C" . $rowCount, $data["staff_name"]);
        $sheet->setCellValue("D". $rowCount, $data["department"]);
        $sheet->setCellValue("E". $rowCount, $data["position"]);
        $sheet->setCellValue("F". $rowCount, $data["salary_level"]);
        $sheet->setCellValue("G". $rowCount, $data["total_worked_days"]);
        $sheet->setCellValue("H". $rowCount, $data["actual_salary"]);
        $rowCount++;
        $no++;
    }

    // Save   
    $writer = new Xlsx($speadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Bang_luong_tam_tinh.xlsx"');
    $writer->save('php://output');
?>
