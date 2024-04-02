<?php
    include('../includes/db_connection.php');
    include('../models/ProfileModel.php');

    class Profile {
        private $profileModel;
    
        public function __construct() {
            global $db;
            $this->profileModel = new ProfileModel($db);
        }
    
        public function showProfile($userId) {
            // Get profile photo path from the model
            $profilePhotoPath = $this->profileModel->getProfilePhotoPath($userId);
            return $profilePhotoPath;
        }
    }
?>