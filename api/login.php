<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Adjust this based on your security requirements
header('Access-Control-Allow-Methods: POST');

include('../controllers/LoginController.php');
include('../includes/db_connection.php');

// Get the data from the AJAX request
$data = json_decode(file_get_contents("php://input"));
$loginController = new LoginController();


if (isset($data->username) && isset($data->password)) {
    $input = $data->username; // Assuming the user provides either username or email
    $password = $data->password;

    // Check if the input is an email
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        // Input is an email
        $loginController->loginUserByEmail($input, $password);
    } else {
        // Input is a username
        $loginController->loginUserByUsername($input, $password);
    }
} else {
    // Handle invalid or missing data
    http_response_code(400); // Bad Request
    echo json_encode(["status" => "error", "message" => "Invalid request data."]);
}

?>

