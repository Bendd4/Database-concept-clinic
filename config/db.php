<?php
    $conn = new mysqli("sql12.freemysqlhosting.net", "sql12613099", "PpwNvrl67G", "sql12613099");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    // $servername = "localhost";
    // $username = "root";
    // $password = "";

    // try {
    //     $conn = new PDO("mysql:host=$servername;dbname=backend_system", $username, $password);
    //     // set the PDO error mode to exception
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     echo "Connected successfully";
    // } catch(PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // }
?>