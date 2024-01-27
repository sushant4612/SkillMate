<!-- controllers/SignupController.php -->

<?php
include('../includes/db_connection.php');
include('../models/UserModel.php');

class SignupController {
    private $userModel;

    public function __construct() {
        global $db;
        $this->userModel = new UserModel($db);
    }

    public function signupUser($username, $password, $confirmPassword, $email, $age) {
        // Validate input
        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            return;
        }

        // Check if username already exists
        if ($this->userModel->isUsernameTaken($username)) {
            echo "Username is already taken.";
            return;
        }

        // Additional validation for email and age can be added here

        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $result = $this->userModel->createUser($username, $hashedPassword, $email, $age);

        if ($result) {
            echo "Registration successful! You can now <a href='login.html'>login</a>.";
        } else {
            echo "Error: Registration failed.";
        }
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $signupController = new SignupController();
    $signupController->signupUser(
        $_POST['username'],
        $_POST['password'],
        $_POST['confirm_password'],
        $_POST['email'],
        $_POST['age']
    );
}

// Close the database connection
pg_close($db);
?>