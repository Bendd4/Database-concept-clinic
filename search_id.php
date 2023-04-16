<?php


require_once 'config/db.php';



?>

<?php
// Get the ID parameter from the AJAX request
$id = $_GET['id'];
$id_type = $_GET['id_type'];
if ($id_type == 'employee') {
    $id_type = 'emp';
} else {
    $id_type = 'patient';
}
echo $id_type;
// Perform a database query to search for the ID
$sql_select = 'SELECT 
patient_id as "p_id", doctor_id as "d_id",
p.patient_fname AS "Patient Firstname", p.patient_lname  
AS "Patient Lastname",  e.emp_fname AS "Doctor Firstname", e.emp_fname 
AS "Doctor Lastname", a.ap_date AS "Date" , a.ap_time_start AS "Starts at", a.ap_time_end 
AS "Ends around"
FROM appointment AS a

JOIN patient_profile AS p
USING (patient_id)

JOIN employee AS e
ON (a.doctor_id = e.emp_id)
where ' . $id_type . '_id = "' . $id . '"
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
                    <td>
                        <form action="delete_appointment.php" method="POST">
                            <input type="hidden" name="patient" value="<?php echo $rows['p_id']; ?>">
                            <input type="hidden" name="doctor" value="<?php echo $rows['d_id']; ?>">
                          
                            <input type="hidden" name="date" value="<?php echo $rows['Date']; ?>">
                            <input type="hidden" name="starts_at" value="<?php echo $rows['Starts at']; ?>">
                            <input type="hidden" name="ends_around" value="<?php echo $rows['Ends around']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>


                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
