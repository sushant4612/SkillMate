<?php
include('../models/UserModel.php');

class SignupController {
    private $userModel;

    public function __construct() {
        global $db;
        // echo $db;
        $this->userModel = new UserModel($db);
    }

    public function signupUser($username, $password, $confirmPassword, $email, $age) {
        // Validate input
        if (!$this->validateInput($username, $password, $confirmPassword, $email, $age)) {
            $this->sendErrorResponse("Invalid input. Please check your data.");
            return;
        }

        // Check if username already exists
        if ($this->userModel->isUsernameTaken($username)) {
            $this->sendErrorResponse("Username is already taken.");
            return;
        }

         // Check if email already exists
        if ($this->userModel->isEmailTaken($email)) {
            $this->sendErrorResponse("Email is already registered. Please use a different email.");
            return;
        }

        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $result = $this->userModel->createUser($username, $hashedPassword, $email, $age);

        if ($result) {
            session_start();
            $_SESSION['username'] = $username;
            $this->sendSuccessResponse("Registration successful! You can now login.");
        } else {
            $this->sendErrorResponse("Error: Registration failed.");
        }
    }

    private function validateInput($username, $password, $confirmPassword, $email, $age) {

        return !empty($username) && !empty($password) && !empty($confirmPassword) && !empty($email) && !empty($age);
    }

    private function sendSuccessResponse($message) {
        http_response_code(200);
        echo json_encode(["status" => "success", "message" => $message]);
    }

    private function sendErrorResponse($message) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => $message]);
    }
}
?>
