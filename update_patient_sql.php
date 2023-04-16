<?php
require_once 'config/db.php';

// Check if the form was submitted
if (isset($_POST['update'])) {
    // Get the form data
   
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $blood = $_POST['blood'];
    $cd = $_POST['cd'];

    
        // Perform a database query to update the patient profile
        $sql_update = "UPDATE patient_profile SET
                            patient_fname = '$fname',
                            patient_lname = '$lname',
                            date_of_birth = '$dob',
                            blood_type = '$blood',
                            conginetal_disease = '$cd'
                       WHERE patient_id = $id";

        $conn->query($sql_update);

        // Redirect the user back to the patient list page
        $_SESSION['update'] = 'success';
        

        header('Location: Doctor.php');
        exit();
        
       
       
     

   
    } 

?>
