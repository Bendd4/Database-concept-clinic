<?php
session_start();
require_once 'config/db.php';

if (isset($_POST['Add_patient_sql'])) {
   $ID = $_POST['ID'];
    $firstname = $_POST['firstname'];
    $lastname =  $_POST['lastname'];
    $dob =  $_POST['Date_of_Birth'];
    $blood_type =  $_POST['blood_type'];
    $conginetal_disease =  $_POST['conginetal_disease'];


    

    
    // Check if the employee name already exists in the database
    $sql_select = "SELECT patient_id FROM patient_profile WHERE patient_id = '$ID'";
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows > 0) {
        $_SESSION['error'] = "มีข้อมูลผู้ป่วยอยู่เเล้ว";
        header("location: Receptionist.php");
        exit();
    }
    

    
    // Insert the new patient into the database
    $sql_insert = "INSERT INTO patient_profile  VALUES ('$ID','$firstname', '$lastname', '$dob', '$blood_type', '$conginetal_disease')";
    $result_insert = $conn->query($sql_insert);
    if (!$result_insert) {
        $_SESSION['error'] = "ไม่สามารถเพิ่มข้อมูลพนักงานได้";
        header("location: Receptionist.php");
        exit();
    }
    header("location: Receptionist.php");
    exit();

}
?>
