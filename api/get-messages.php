<?php
// Include necessary files
include_once('../controllers/ChatMessageController.php');
include('../includes/db_connection.php');

// Check if userId parameter is provided in the request
if (isset($_GET['userId'])) {
    // Retrieve userId from the request
    $userId = $_GET['userId'];

    // Initialize the model and controller
    $chatMessageModel = new ChatMessageModel($db);
    $chatMessageController = new ChatMessageController($chatMessageModel);

    // Call the controller method to get messages by user ID
    $messages = $chatMessageController->getMessagesByUserId($userId);

    // Return the messages as JSON response
    header('Content-Type: application/json');
    echo json_encode($messages);
} else {
    // Return an error message if userId parameter is missing
    echo "User ID parameter is missing!";
}
?>
