<?php
session_start();
require_once 'config/db.php';

print_r($_POST);
$p = $_POST['patient'];
$d = $_POST['doctor'];
$date = $_POST['date'];
$start_time = $_POST['starts_at'];
$end_time = $_POST['ends_around'];



    

    
    // Check if the employee name already exists in the database
    $sql_delete = "DELETE FROM appointment 
    WHERE patient_id = '$p' 
    AND doctor_id = '$d' 
 
    AND ap_date = '$date' 
    AND ap_time_start = '$start_time' 
    AND ap_time_end = '$end_time'";
    $result_select = $conn->query($sql_delete);
   
    if (!$result_select) {
        $_SESSION['error'] = "ไม่สามารถเพิ่มข้อมูลพนักงานได้";
        header("location: Receptionist.php");
        exit();
    }
    
    

    


?>
