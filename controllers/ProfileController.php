<?php
include('../models/UserModel.php');

class ProfileController {
    private $userModel;

    public function __construct() {
        global $db;
        $this->userModel = new UserModel($db);
    }

    public function uploadProfilePhoto($userId, $imagePath) {
        // Call the uploadProfilePhoto method of the ProfileModel
        return $this->userModel->uploadProfilePhoto($userId, $imagePath);
    }
    
}
?>