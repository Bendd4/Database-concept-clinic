<?php 

    session_start();
    unset($_SESSION['Doctor_login']);
    unset($_SESSION['Receptionist_login']);
    header('location: signin.php');

?>