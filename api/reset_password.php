<?php
header('Content-Type: application/json');
include('../controllers/ResetPasswordController.php');
include('../includes/db_connection.php');
session_start();

$data = json_decode(file_get_contents("php://input"));

if (isset($data->newPassword) && isset($data->confirmPassword)) {
    $newPassword = $data->newPassword;
    $confirmPassword = $data->confirmPassword;

    $resetPasswordController = new ResetPasswordController();
    $response = $resetPasswordController->resetPassword($newPassword, $confirmPassword);

    echo json_encode($response);
} else {
    http_response_code(400); // Bad Request
    echo json_encode(["status" => "error", "message" => "Invalid request data."]);
}
?>
