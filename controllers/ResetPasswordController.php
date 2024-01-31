<?php
include('../models/UserModel.php');

class ResetPasswordController {
    private $userModel;

    public function __construct() {
        global $db;
        $this->userModel = new UserModel($db);
    }

    public function resetPassword($newPassword, $confirmPassword) {
        // Validate new password and confirm password
        // ...

        // Retrieve the username from the stored reset token
        $username = $this->userModel->getUsernameByResetToken($_SESSION['reset_token']);

        if ($username) {
            // Reset the user's password in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $this->userModel->updatePassword($username, $hashedPassword);

            // Clear the reset token from the session
            unset($_SESSION['reset_token']);

            return ['status' => 'success', 'message' => 'Password reset successful. You can now login with your new password.'];
        } else {
            return ['status' => 'error', 'message' => 'Invalid or expired reset token.'];
        }
    }
}
?>
