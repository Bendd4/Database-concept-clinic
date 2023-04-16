<?php 

session_start();
require_once 'config/db.php';

if (isset($_POST['signin'])) {
    $ID = $_POST['ID'];
    $password = $_POST['password'];

    if (empty($ID)) {
        $_SESSION['error'] = 'กรุณากรอก ID';
        header("location: signin.php");
        exit();
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signin.php");
        exit();
    } else {
        try {
            $sql_login = "SELECT * FROM employee WHERE emp_id = '$ID'";
            $result_login = $conn->query($sql_login);

            if ($result_login->num_rows > 0) {
                $row = $result_login->fetch_assoc();
                if ($password == $row['password']) {
                    if ($row['role'] == 'Receptionist') {
                        $_SESSION['Receptionist_login'] = $row['emp_id'];
                        header("location: Receptionist.php");
                        exit();
                    } else {
                        $_SESSION['Doctor_login'] = $row['emp_id'];
                        header("location: Doctor.php");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'รหัสผ่านผิด';
                    header("location: signin.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                header("location: signin.php");
                exit();
            }

        } catch(PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header("location: signin.php");
            exit();
        }
    }
}
