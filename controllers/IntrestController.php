<?php
include('../models/UserModel.php');

class IntrestController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function submitInterests($formData) {
        session_start();

        // Check if user is logged in
        if (!isset($_SESSION['username'])) {
            http_response_code(401);
            echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
            exit();
        }

        // Get username from session
        $username = $_SESSION['username'];

        $userId = $this->userModel->getUserIdByUsername($username);
        if ($userId === null) {
            // Handle error: username not found
            return;
        }

        // Clear existing interests
        $this->userModel->clearInterests($userId);

        // Check if interests are submitted
        if (isset($formData['interests']) && is_array($formData['interests'])) {
            // Get interests array from form submission
            $interests = $formData['interests'];

            // Loop through submitted interests and add them for the user
            foreach ($interests as $interest) {
                $this->userModel->addInterest($username, $interest);
            }
            http_response_code(200);
            echo json_encode(["status" => "success", "message" => "Interests added successfully"]);
            session_unset();
            session_destroy();
            header('Location: ../views/success.html');            
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "No interests submitted"]);
        }
    }
}
?>
