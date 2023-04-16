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
    <h1>Add patient</h1>
    <form action="Add_patient_sql.php" method="post">
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
                <label for="firstname" class="form-label">ID</label>
                <input type="text" class="form-control" name="ID" aria-describedby="ID" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" aria-describedby="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname" aria-describedby="lastname" required> 
            </div>        
     
     
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="Date_of_Birth" required>
            </div>
            <div class="mb-3">
                <label class="form-label">blood_type</label>
                <input type="text" class="form-control" name="blood_type" required>
            </div>
            <div class="mb-3">
                <label class="form-label">conginetal_disease</label>
                <input type="text" class="form-control" name="conginetal_disease" >
            </div>
            <button type="submit" name="Add_patient_sql" class="btn btn-success">Add</button>
        </form>

    <?php
    
    ?>
     
</body>

</html>
