<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Adjust this based on your security requirements
header('Access-Control-Allow-Methods: POST');

include('../controllers/PostController.php');
include('../includes/db_connection.php');
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required data is present
    if (isset($_FILES['post_image']) && isset($_POST['post_content'])) {
        // Retrieve data from the form
        $userId = $_SESSION['uid']; // Assuming the user is logged in and their ID is stored in the session
        $imageTmpPath = $_FILES['post_image']['tmp_name']; // Temporary path of the uploaded image
        $caption = $_POST['post_content'];

        // Define the destination directory
        $destinationDir = '../assets/images/';

        // Generate a unique filename
        $filename = uniqid() . '_' . basename($_FILES['post_image']['name']);

        // Define the destination path
        $destinationPath = $destinationDir . $filename;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($imageTmpPath, $destinationPath)) {
            // Create an instance of the PostController
            $postController = new PostController();

            // Call the createPost method to add the post
            $result = $postController->createPost($userId, $destinationPath, $caption);

            if ($result) {
                // Post creation successful
                echo json_encode(["status" => "success", "message" => "Post created successfully!"]);
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
