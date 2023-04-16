<?php

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['Doctor_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin.php');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Page</title>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 240px;
            }
        }

        #content {
            max-width: 1200px;
            /* adjust as needed */
            margin: 0 auto;
            /* center the div horizontally */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav float-left">
                <li class="nav-item d-lg-none">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </li>
            </ul>
            <a class="navbar-brand">Update</a>
            <ul class="navbar-nav float-right">
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['Doctor_login'])) {
                        echo $_SESSION['Doctor_login'];
                    }

                    ?>
                </li>
            </ul>
    </nav>

    <?php


    require_once 'config/db.php';

    // Get the ID parameter from the AJAX request
    $id = $_POST['id'];

 
        // Perform a database query to search for the ID
        $sql_select = 'SELECT *
                   FROM patient_profile 
                   WHERE patient_id = ' . $id;

        $result_select = $conn->query($sql_select);

        // If no patient was found with the given ID, show an error message
        if ($result_select->num_rows == 0) {
            $_SESSION['update_error'] = 'ไม่มีผู้ป่วยในฐานข้อมูล';
            header('Location: Doctor.php');
            exit;
        } else {
            // Fetch the patient data from the database
            $patient = $result_select->fetch_assoc();
    ?>

            <form action="update_patient_sql.php" method="post" class='p-5'>
                <div class="form-group pt-5">
                    <label for="patient-id">Patient ID</label>
                    <input type="text" class="form-control" name='id' value="<?php echo $patient['patient_id']; ?>">
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="patient-fname">First Name</label>
                        <input type="text" class="form-control" name='fname' value="<?php echo $patient['patient_fname']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="patient-lname">Last Name</label>
                        <input type="text" class="form-control" name='lname' value="<?php echo $patient['patient_lname']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="date-of-birth">Date of Birth</label>
                        <input type="date" class="form-control" name='dob' value="<?php echo $patient['date_of_birth']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="blood-type">Blood Type</label>
                        <input type="text" class="form-control" name='blood' value="<?php echo $patient['blood_type']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="conginetal-disease">Congenital Disease</label>
                    <textarea class="form-control" name='cd' rows="3"><?php echo $patient['conginetal_disease']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success" name="update">Update Profile</button>
            </form>

    <?php
        }

    ?>
</body>