<?php


require_once 'config/db.php';
if (!isset($_SESSION['Receptionist_login'])) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <h1>add Appointment</h1>
    <form action="Add_appointment_sql.php" method="post">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['warning'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php
                echo $_SESSION['warning'];
                unset($_SESSION['warning']);
                ?>
            </div>
        <?php } ?>
        <div class="mb-3">
            <label for="firstname" class="form-label">Patient ID</label>
            <input type="text" class="form-control" name="Patient" aria-describedby="Patient" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Doctor ID</label>
            <input type="text" class="form-control" name="Doctor" aria-describedby="Doctor" required>
        </div>


        <div class="mb-3">
            <label class="form-label">Appointment date</label>
            <input type="date" class="form-control" name="Appointment_date" required>
        </div>
        <div class="mb-3">
            <label class="form-label">start</label>
            <input type="time" class="form-control" name="start" required>
        </div>
        <div class="mb-3">
            <label class="form-label">end</label>
            <input type="time" class="form-control" name="end">
        </div>
        <button type="submit" name="Add_appointment_sql" class="btn btn-success">Add</button>
    </form>
    <div>

        <?php

        $sql_select = 'SELECT p.patient_fname AS "Patient Firstname", p.patient_lname  AS "Patient Lastname",  e.emp_fname AS "Doctor Firstname", e.emp_fname AS "Doctor Lastname", a.ap_date AS "Date" , a.ap_time_start AS "Starts at", a.ap_time_end AS "Ends around"
        FROM appointment AS a
        
        JOIN patient_profile AS p
        USING (patient_id)
        
        JOIN employee AS e
        ON (a.doctor_id = e.emp_id)
        
        ORDER BY ap_date ASC;

        ';
        $result_select = $conn->query($sql_select);
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Patient Firstname</th>
                        <th>Patient Lastname</th>
                        <th>Doctor Firstname</th>
                        <th>Doctor Lastname</th>
                        <th>Date</th>
                        <th>Starts at</th>
                        <th>Ends around</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows = $result_select->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $rows['Patient Firstname']; ?></td>
                            <td><?php echo $rows['Patient Lastname']; ?></td>
                            <td><?php echo $rows['Doctor Firstname']; ?></td>
                            <td><?php echo $rows['Doctor Lastname']; ?></td>
                            <td><?php echo $rows['Date']; ?></td>
                            <td><?php echo $rows['Starts at']; ?></td>
                            <td><?php echo $rows['Ends around']; ?></td>
                        </tr>

                    <?php }
                    ?>
                </tbody>
            </table>
            หมอไม่มีคนไข้
            <?php
            $sql_filter = "SELECT * FROM employee WHERE emp_id NOT IN (SELECT doctor_id FROM appointment) and role = 'Doctor';";
            $result_filter = $conn->query($sql_filter);
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Doctor Firstname</th>
                            <th>Doctor Lastname</th>
                            <th>emp_phone</th>
                            <th>work_shift_strat</th>
                            <th>work_shift_end</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rows = $result_filter->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $rows['emp_fname']; ?></td>
                                <td><?php echo $rows['emp_lname']; ?></td>
                                <td><?php echo $rows['emp_phone']; ?></td>
                                <td><?php echo $rows['work_shift_start']; ?></td>
                                <td><?php echo $rows['work_shift_end']; ?></td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>

</body>

</html>