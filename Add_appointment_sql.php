<?php
session_start();
require_once 'config/db.php';

if (isset($_POST['Add_appointment_sql'])) {
   
    $Doctor = $_POST['Doctor'];
    $Patient =  $_POST['Patient'];
    $Appointment_date =  $_POST['Appointment_date'];
    $start =  $_POST['start'];
    $end =  $_POST['end'];


    

    
    // // Check if the employee name already exists in the database
    // $sql_select = "SELECT patient_fname, patient_lname FROM patient_profile WHERE patient_fname = '$firstname' and patient_lname = '$lastname'";
    // $result_select = $conn->query($sql_select);
    // if ($result_select->num_rows > 0) {
    //     $_SESSION['error'] = "มีข้อมูลผู้ป่วยอยู่เเล้ว";
    //     header("location: Receptionist.php");
    //     exit();
    // }
    

    
    // Insert the new patient into the database
    $sql_insert = "INSERT INTO appointment  VALUES ('$Patient', '$Doctor', '$Appointment_date', '$start', '$end')";
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
