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
    <title>Document</title>
</head>

<body>
    <h1>View Appointment</h1>
    <p>This is the content for the "View Appointment" page.</p>

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
            <?php } ?>
                </tbody>
            </table>
        </div>
<?php
    
?>



   
</body>

</html>