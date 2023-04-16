<?php
require_once 'config/db.php';


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
    <h1>update patient info</h1>
    <form action="edit_patient.php" method="POST">
        <div class="mb-3">
           
            <select name="id_type" class="form-control" id="id_type" disabled>
                <option value="patient">Patient</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" name="id" aria-describedby="id">
            <div id="search-results"></div>
        </div>

        <button type="submit" class="btn btn-success" name="search">search</button>
    </form>
    <?php

    ?>
    
</body>

</html>