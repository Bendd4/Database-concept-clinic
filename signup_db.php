<?php
session_start();
require_once 'config/db.php';

if (isset($_POST['signup'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $num = mysqli_real_escape_string($conn, $_POST['emp_num']);
    $work_end = mysqli_real_escape_string($conn, $_POST['work_shift_end']);
    $work_start = mysqli_real_escape_string($conn, $_POST['work_shift_start']);

    // Check if any field is empty
    if (empty($firstname) || empty($lastname) || empty($id) || empty($role) || empty($password) || empty($work_start) || empty($work_end) ) {
        $_SESSION['error'] = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
        header("location: index.php");
        exit();
    }
    
    // Check if the password and confirm password fields match
    if ($password != $c_password) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: index.php");
        exit();
    }


    
    // Check if the employee ID already exists in the database
    $sql_select = "SELECT emp_fname, emp_lname FROM employee WHERE emp_id = '$id'";
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows > 0) {
        $_SESSION['error'] = "มี ID นี้เเล้ว";
        header("location: index.php");
        exit();
    }
    
    // Check if the employee's name already exists in the database
    $sql_select = "SELECT emp_fname, emp_lname FROM employee WHERE emp_fname = '$firstname' AND emp_lname = '$lastname'";
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows > 0) {
        $_SESSION['error'] = "มีชื่อนี้เเล้ว";
        header("location: index.php");
        exit();
    }
    
    // Insert the new employee into the database
    $sql_insert = "INSERT INTO employee(emp_id,emp_fname,emp_lname,emp_phone,work_shift_start,work_shift_end,role,password)  VALUES ('$id', '$firstname', '$lastname', '$num', '$work_start', '$work_end', '$role', '$password')";
    $result_insert = $conn->query($sql_insert);
    if (!$result_insert) {
        $_SESSION['error'] = "ไม่สามารถเพิ่มข้อมูลพนักงานได้";
        header("location: index.php");
        exit();
    }
    
    $_SESSION[$role.'_login'] = $id;
    header("location: ".$role.".php");
    exit();
}
?>
