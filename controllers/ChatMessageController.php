<?php

include('../models/ChatMessageModel.php');

class ChatMessageController {
    private $chatMessageModel;

    public function __construct($chatMessageModel) {
        $this->chatMessageModel = $chatMessageModel;
    }

    public function getFriendChatMessages($userId) {
        return $this->chatMessageModel->getFriendChatMessages($userId);
    }

    public function getMessagesByUserId($userId) {
        return $this->chatMessageModel->getMessagesByUserId($userId);
    }

    public function sendMessage($senderId, $receiverId, $content) {
        return $this->chatMessageModel->sendMessage($senderId, $receiverId, $content);
    }
}

?>
