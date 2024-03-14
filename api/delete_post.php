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
    if (isset($_POST['post_id'])) {
        // Retrieve the post ID from the form
        $postId = $_POST['post_id'];

        // Create an instance of the PostController
        $postController = new PostController();

        // Call the deletePost method to delete the post
        $result = $postController->deletePost($postId);

        if ($result) {
            // Post deletion successful
            echo json_encode(["status" => "success", "message" => "Post deleted successfully!"]);
        } else {
            // Post deletion failed
            echo json_encode(["status" => "error", "message" => "Failed to delete post."]);
        }
    } else {
        // Handle missing post ID
        http_response_code(400); // Bad Request
        echo json_encode(["status" => "error", "message" => "Missing post ID."]);
    }
} else {
    // Handle invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(["status" => "error", "message" => "Only POST requests are allowed."]);
}
?>
