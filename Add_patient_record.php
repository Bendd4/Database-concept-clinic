<?php


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
    <title>Document</title>
</head>

<body>
    <h1>add patient record</h1>
    <form action="add_patient_record_sql.php" method="post">

        <div class="mb-3">
            <label for="firstname" class="form-label">Patient ID</label>
            <input type="text" class="form-control" name="Patient" aria-describedby="Patient" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Doctor ID</label>
            <input type="text" class="form-control" name="Doctor" aria-describedby="Doctor" required>
        </div>


        <div class="mb-3">
            <label class="form-label">illness</label>
            <input type="text" class="form-control" name="illness" required>
        </div>
        <div class="mb-3">
            <label class="form-label">result</label>
            <input type="text" class="form-control" name="result">
        </div>


        <div class="mb-3">
            <label class="form-label">note</label>
            <input type="text" class="form-control" name="note">
        </div>
        <button type="submit" name="Add_patient_record" class="btn btn-success">Add</button>
    </form>
    <div>


    </div>

</body>

</html>