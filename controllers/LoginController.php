<?php
include('../models/UserModel.php');

class LoginController {
    private $userModel;

    public function __construct() {
        global $db;
        $this->userModel = new UserModel($db);
    }

    public function getLoggedInUserId($username) {
        $uId = $this->userModel->getUserIdByUsername($username);
        return $uId;
    }

    
    public function loginUserByUsername($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
    
        if ($user && password_verify($password, $user['password'])) {
            $this->sendSuccessResponse("Login successful!");
        } else {
            $this->sendErrorResponse("Invalid username or password.");
        }
    }
    
    public function loginUserByEmail($email, $password) {
        $user = $this->userModel->getUserByEmail($email);
    
        if ($user && password_verify($password, $user['password'])) {
            $this->sendSuccessResponse("Login successful!");
        } else {
            $this->sendErrorResponse("Invalid email or password.");
        }
    }

    private function sendSuccessResponse($message) {
        http_response_code(200);
        echo json_encode(["status" => "success", "message" => $message]);
    }

    private function sendErrorResponse($message) {
        http_response_code(401); // Unauthorized
        echo json_encode(["status" => "error", "message" => $message]);
    }
}
?>
