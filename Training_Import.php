<?php 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Load the database configuration file 
include_once '../HRM/dbConnect.php'; 
 
$res_status = $res_msg = ''; 
if(isset($_POST['importTraining'])){ 
    // Allowed mime types 
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'); 
     
    // Validate whether selected file is a CSV file 
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){ 
         
        // If the file is uploaded 
        if(is_uploaded_file($_FILES['file']['tmp_name'])){ 
             
            // Open uploaded CSV file with read-only mode 
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r'); 
             
            // Skip the first line 
            fgetcsv($csvFile); 
             
            // Parse data from CSV file line by line 
            while(($line = fgetcsv($csvFile)) !== FALSE){ 
                $line_arr = !empty($line)?array_filter($line):''; 
                if(!empty($line_arr)){ 
                    // Get row data 
                    $course_id   = trim($line_arr[0]); 
                    $course_name  = trim($line_arr[1]); 
                    $trainer  = trim($line_arr[2]); 
                    $department  = trim($line_arr[3]);
                    $course_date  = trim($line_arr[4]);
                    $status = trim($line_arr[5]); 
                     
                    // Check whether member already exists in the database with the same course_id 
                    $prevQuery = "SELECT * FROM training WHERE course_id = '".$course_id."'"; 
                    $prevResult = $con->query($prevQuery); 
                     
                    if($prevResult->num_rows > 0){ 
                        // Update member data in the database 
                        $con->query("UPDATE training SET course_name = '".$course_name."', trainer = '".$trainer."', course_date = '".$course_date."', department = '".$department."'  WHERE course_id = '".$course_id."'"); 
                    }else{ 
                        // Insert member data in the database 
                        $con->query("INSERT INTO `Training`(`course_id`, `trainer`, `course_name`, `status`, `course_date`, `department`) 
                            VALUES ('$course_id','$trainer','$course_name','$status','$course_date','$department')"); 
                    } 
                } 
            } 
             
            // Close opened CSV file 
            fclose($csvFile); 
             
            $res_status = 'success'; 
            $res_msg = 'Thông tin đã được nhập thành công.'; 
        }else{ 
            $res_status = 'danger'; 
            $res_msg = 'Có lỗi xảy ra, vui lòng thử lại.'; 
        } 
    }else{ 
        $res_status = 'danger'; 
        $res_msg = 'Vui lòng chọn file .csv.'; 
    } 
} 
 
// Display an alert and redirect 
echo "<script>
    alert('$res_msg');
    window.location.href = 'Training.php';
</script>";
exit();
