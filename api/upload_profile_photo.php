<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Adjust this based on your security requirements
header('Access-Control-Allow-Methods: POST');

include('../controllers/ProfileController.php'); // Include the ProfileController
include('../includes/db_connection.php'); // Include the file for database connection
session_start(); // Start the session

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required data is present
    if (isset($_FILES['profilePhoto'])) {
        // Retrieve user ID from the session
        $userId = $_SESSION['uid'];

        // Define the destination directory for profile photos
        $destinationDir = '../assets/images/profiles/';

        // Generate a unique filename for the profile photo
        $filename = uniqid() . '_' . basename($_FILES['profilePhoto']['name']);

        // Define the destination path for the profile photo
        $destinationPath = $destinationDir . $filename;
        $_SESSION['profile-photo'] = $destinationPath;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $destinationPath)) {
            // Create an instance of the ProfileController
            $profileController = new ProfileController();

            // Call the method to update the profile photo path in the database
            $result = $profileController->uploadProfilePhoto($userId, $destinationPath);

            if ($result) {           // Profile photo upload successful
                echo json_encode(["status" => "success", "message" => "Profile photo uploaded successfully!"]);
            } else {
                // Failed to update profile photo path in the database
                echo json_encode(["status" => "error", "message" => "Failed to update profile photo path in the database."]);
            }
        } else {
            // Failed to move the uploaded file
            echo json_encode(["status" => "error", "message" => "Failed to move uploaded file."]);
        }
    } else {
        // Handle missing or invalid data
        http_response_code(400); // Bad Request
        echo json_encode(["status" => "error", "message" => "Invalid request data."]);
    }
} else {
    // Handle invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed."]);
}
?>
