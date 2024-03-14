<?php
// HomeController.php
include('../models/UserModel.php');

class HomeController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function displayHome() {
        echo "hello";
        session_start();
        if (isset($_SESSION['uid'])) {
            $uid = $_SESSION['uid'];
            $user = $this->userModel->getUserById($uid);
            if ($user) {
                include_once('../views/home.php');
            } else {
                echo "User not found or error occurred.";
            }
        } else {
            header("Location: ../views/login.php");
            exit();
        }
    }
}
?>
