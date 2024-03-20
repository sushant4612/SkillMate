<?php
// Include necessary files
include_once('../controllers/ChatMessageController.php');
include('../includes/db_connection.php');

// Check if required parameters are provided in the request
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['senderId']) && isset($data['receiverId']) && isset($data['content'])) {
    // Retrieve parameters from the request
    $senderId = $data['senderId'];
    $receiverId = $data['receiverId'];
    $content = $data['content'];

    // Create a database connection (assuming it's established already)

    // Initialize the model and controller
    $chatMessageModel = new ChatMessageModel($db);
    $chatMessageController = new ChatMessageController($chatMessageModel);

    // Call the controller method to send the message
    $result = $chatMessageController->sendMessage($senderId, $receiverId, $content);

    // Return the result as JSON response
    header('Content-Type: application/json');
    echo json_encode(array('message' => $result));
} else {
    // Return an error message if any required parameter is missing
    echo json_encode(array('error' => 'Missing required parameters'));
}
?>
