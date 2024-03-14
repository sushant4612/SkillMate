<?php
include('../controllers/FeedController.php');
include('../includes/db_connection.php');

// Create a new instance of FeedController
$feedController = new FeedController($db);

// Check if the user is logged in and get the user ID
session_start();
if (isset($_SESSION['uid'])) {
    $userId = $_SESSION['uid'];
    $feedController->getFeedPosts($userId);
} else {
    // Handle unauthorized access
    http_response_code(401); // Unauthorized
    echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
}
?>
