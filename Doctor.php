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
            <a class="navbar-brand">Clinic</a>
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
    <div class=" container pt-5 ps-5 ">

        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <form method="POST">
                        <button type="submit" name="view_appointment_doctor" class="list-group-item list-group-item-action py-2 ripple">view_appointment_doctor</button>
                    </form>
                    <form method="POST">
                        <button type="submit" name="Update_patient" class="list-group-item list-group-item-action py-2 ripple">Update patient info</button>
                    </form>
                    <form method="POST">
                        <button type="submit" name="Add_patient_record" class="list-group-item list-group-item-action py-2 ripple">Add_patient_record</button>
                    </form>
                    <form method="POST">
                        <button type="submit" name="view_patient_info" class="list-group-item list-group-item-action py-2 ripple">view_patient_info</button>
                    </form>
                </div>
            </div>
        </nav>


        <!-- content -->

    </div>
    <div id="content" class="container pt-5 ps-5 " style="margin-left:15vw">

        <?php
      

        if (isset($_SESSION['Doctor_login'])) {
          
            $ID = $_SESSION['Doctor_login'];
            $sql_login = "SELECT * FROM employee WHERE emp_id = '$ID'";
            $result_login = $conn->query($sql_login);
            $row = $result_login->fetch_assoc();


           

            if (isset($_POST['view_appointment_doctor'])) {
                include('view_appointment_doctor.php');
            } elseif (isset($_POST['Update_patient'])) {
                include('Update_patient.php');
            } elseif (isset($_POST['Add_patient_record'])) {
                include('Add_patient_record.php');
            } elseif (isset($_POST['view_patient_info'])) {
                include('view_patient_info.php');
            } elseif (isset($_SESSION['update_error'])) {
                echo '<div class="alert alert-danger" role="alert">ไม่มีผู้ป่วยนี้ในฐานข้อมูล</div>';
                include('Update_patient.php');
                unset($_SESSION['update_error']);
            }
           
       
        }
        ?>
        <h3 class=" mt-4">Welcome, Doctor<?php echo $row['emp_fname'] . ' ' . $row['emp_lname'] ?></h3>
        <a href="logout.php" class="btn btn-danger">Logout</a>

    </div>




</body>

</html>