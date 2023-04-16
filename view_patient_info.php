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
    <h1>view patient info</h1>
    <form method="POST">
        <div class="mb-3">
           
            <select name="id_type" class="form-control" id="id_type" onchange="updateFormFields()"disabled>
                <option value="patient">Patient</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" name="id" id="id" aria-describedby="id" oninput="searchId(this.value)">
            <div id="search-results"></div>
        </div>

        <!-- <button type="submit" class="btn btn-success" name="search">search</button> -->
    </form>
    <?php

    ?>
    <script>
        function updateFormFields() {
            const idType = document.getElementById("id_type").value;
            const idLabel = document.querySelector("label[for=id]");
            const idPlaceholder = (idType === "patient") ? "Enter Patient ID" : "Enter Employee ID";
            idLabel.textContent = idPlaceholder;
            document.getElementById("id").placeholder = idPlaceholder;

            // Make an AJAX call to the search_id.php file to update the search results
            const id = document.getElementById("id").value;
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("search-results").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "search_patient.php?id=" + id, true);
            xmlhttp.send();
        }

        function searchId(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("search-results").innerHTML = this.responseText;
                }
            };
            const idType = document.getElementById("id_type").value;
            xmlhttp.open("GET", "search_patient.php?id=" + id , true);
            xmlhttp.send();
        }
    </script>
</body>

</html>