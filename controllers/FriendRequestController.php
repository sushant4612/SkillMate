<?php

include("../models/FriendRequestModel.php");

class FriendRequestController {
    private $friendRequestModel;

    public function __construct($friendRequestModel) {
        $this->friendRequestModel = $friendRequestModel;
    }

    public function acceptRequest($requestId) {
        $this->friendRequestModel->acceptRequest($requestId);
    }

    public function declineRequest($requestId) {
        $this->friendRequestModel->declineRequest($requestId);
    }

    public function sendRequest($senderId, $receiverId) {
        $this->friendRequestModel->sendRequest($senderId, $receiverId);
    }

    // Additional methods for handling other actions can be added here
}
?>