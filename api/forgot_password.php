<?php
header('Content-Type: application/json');
include('../controllers/ForgotPasswordController.php');
include('../includes/db_connection.php');

$data = json_decode(file_get_contents("php://input"));

if (isset($data->username) && isset($data->email)) {
    $username = $data->username;
    $email = $data->email;

    $forgotPasswordController = new ForgotPasswordController();
    $response = $forgotPasswordController->initiatePasswordReset($username, $email);

    echo json_encode($response);
} else {
    http_response_code(400); // Bad Request
    echo json_encode(["status" => "error", "message" => "Invalid request data."]);
}
?>
