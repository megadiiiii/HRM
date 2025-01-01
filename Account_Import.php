<?php 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Load the database configuration file 
include_once '../HRM/dbConnect.php'; 
 
$res_status = $res_msg = ''; 
if(isset($_POST['importAccount'])){ 
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
                    $username   = trim($line_arr[0]); 
                    $password  = trim($line_arr[1]); 
                    $staff_name  = trim($line_arr[2]); 
                    $role  = trim($line_arr[3]);
                    $staff_id  = trim($line_arr[4]);
                    $department = trim($line_arr[5]); 
                     
                    // Check whether member already exists in the database with the same course_id 
                    $prevQuery = "SELECT * FROM Account WHERE username = '".$username."'"; 
                    $prevResult = $con->query($prevQuery); 
                     
                    if($prevResult->num_rows > 0){ 
                        // Update member data in the database 
                        $con->query("UPDATE account 
                       SET `staff_name` = '$staff_name',
                           `staff_id` = '$staff_id',
                           `password` = '$password',
                           `department` = '$department',
                           `role` = '$role'
                       WHERE username = '$username'"); 
                    }else{ 
                        // Insert member data in the database 
                        $con->query("INSERT INTO `account`(`username`, `password`, `staff_name`, `role`, `staff_id`, `department`) 
                            VALUES ('$username','$password','$staff_name','$role','$staff_id','$department')"); 
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
    window.location.href = 'Account.php';
</script>";
exit();
