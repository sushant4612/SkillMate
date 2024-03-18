<?php
    include("../controllers/FriendRequestController.php");
    include('../includes/db_connection.php');

    $friendRequestController = new FriendRequestController(new FriendRequestModel($db));

    // Handle accept request
    if (isset($_POST['accept_request'])) {
        $requestId = $_POST['request_id'];
        $friendRequestController->acceptRequest($requestId);
    }

    // Handle decline request
    if (isset($_POST['decline_request'])) {
        $requestId = $_POST['request_id'];
        $friendRequestController->declineRequest($requestId);
    }

    // Handle send request
    if (isset($_POST['send_request'])) {
        $receiverId = $_POST['receiver_id'];
        $senderId = $_SESSION['uid'];
        $friendRequestController->sendRequest($senderId, $receiverId);
    }

?>