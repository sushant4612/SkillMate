<?php
    include('../includes/db_connection.php');
    session_start();
    if (isset($_SESSION['username'])) {
        // Access and display the username
        echo 'Username: ' . $_SESSION['username'];
    } else {
        // If the username session variable is not set, handle it accordingly
        echo 'Username not available.';
    }
?>