<?php
require_once 'config/db.php';

// Get the ID parameter from the AJAX request
$id = $_GET['id'];

try {
    // Perform a database query to search for the ID
    $sql_select = 'SELECT *
                   FROM patient_profile 
                   WHERE patient_id = '.$id;

    $result_select = $conn->query($sql_select);

    // If no patient was found with the given ID, show an error message
    if ($result_select->num_rows == 0) {
        echo '<div class="alert alert-danger">Patient not found</div>';
    } else {
        // Fetch the patient data from the database
        $patient = $result_select->fetch_assoc();
?>

    <form>
        <div class="form-group">
            <label for="patient-id">Patient ID</label>
            <input type="text" class="form-control" id="patient-id" value="<?php echo $patient['patient_id']; ?>" readonly>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="patient-fname">First Name</label>
                <input type="text" class="form-control" id="patient-fname" value="<?php echo $patient['patient_fname']; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="patient-lname">Last Name</label>
                <input type="text" class="form-control" id="patient-lname" value="<?php echo $patient['patient_lname']; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="date-of-birth">Date of Birth</label>
                <input type="text" class="form-control" id="date-of-birth" value="<?php echo $patient['date_of_birth']; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="blood-type">Blood Type</label>
                <input type="text" class="form-control" id="blood-type" value="<?php echo $patient['blood_type']; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="conginetal-disease">Congenital Disease</label>
            <textarea class="form-control" id="conginetal-disease" rows="3" readonly><?php echo $patient['conginetal_disease']; ?></textarea>
        </div>
    </form>

<?php
    }
} catch (mysqli_sql_exception $exception) {
    
}
?>
