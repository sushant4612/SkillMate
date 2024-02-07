<?php
include('../includes/db_connection.php');
include('../controllers/IntrestController.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new IntrestController($db);
    $userController->submitInterests($_POST);
} else {
    // If request method is not POST
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
}
?>
