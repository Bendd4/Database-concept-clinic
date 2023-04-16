<?php
session_start();
require_once 'config/db.php';

if (isset($_POST['Add_patient_record'])) {
 
    $Patient = $_POST['Patient'];
    $Doctor =  $_POST['Doctor'];
    $illness =  $_POST['illness'];
    $result =  $_POST['result'];
  
    $note = $_POST['note'];

    

    
    // Insert the new patient into the database
    $sql_insert = "INSERT INTO patient_record  VALUES ('$Patient', '$Doctor', '$illness', '$result', '$note')";
    $result_insert = $conn->query($sql_insert);
    if (!$result_insert) {
        $_SESSION['error'] = "ไม่สามารถเพิ่มข้อมูลพนักงานได้";
        header("location: Receptionist.php");
        exit();
    }
    header("location: D.php");
    exit();

}
?>
