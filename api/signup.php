<?php
include('../includes/db_connection.php');
include('../controllers/SignupController.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $signupController = new SignupController();
    $signupController->signupUser(
        $_POST['username'],
        $_POST['password'],
        $_POST['confirm_password'],
        $_POST['email'],
        $_POST['age']
    );
}

// Close the database connection
pg_close($db);
?>
