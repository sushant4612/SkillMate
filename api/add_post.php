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
        $imagePath = $_FILES['post_image']['tmp_name']; // Temporary path of the uploaded image
        $caption = $_POST['post_content'];

        // Create an instance of the PostController
        $postController = new PostController();

        // Call the createPost method to add the post
        $result = $postController->createPost($userId, $imagePath, $caption);

        if ($result) {
            // Post creation successful
            echo json_encode(["status" => "success", "message" => "Post created successfully!"]);
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
