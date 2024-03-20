<?php

class ChatMessageModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getFriendChatMessages($userId) {
        $query = "SELECT 
                    cm.sender_id,
                    cm.receiver_id,
                    cm.content,
                    cm.created_at AS message_created_at,
                    sender.username AS sender_username,
                    receiver.username AS receiver_username
                  FROM 
                    chat_messages cm
                  JOIN 
                    users sender ON cm.sender_id = sender.user_id
                  JOIN 
                    users receiver ON cm.receiver_id = receiver.user_id
                  JOIN 
                    friendships f ON (cm.sender_id = f.user_id1 AND cm.receiver_id = f.user_id2) OR 
                                    (cm.sender_id = f.user_id2 AND cm.receiver_id = f.user_id1)
                  WHERE 
                    (cm.sender_id = $1 OR cm.receiver_id = $1)
                    AND f.status = 'accepted'
                  ORDER BY 
                    cm.created_at DESC";

        $result = pg_query_params($this->db, $query, array($userId));

        $friendChatMessages = array();
        while ($row = pg_fetch_assoc($result)) {
            $friendChatMessages[] = $row;
        }

        // Group messages by sender/receiver user IDs
        $groupedMessages = array();
        foreach ($friendChatMessages as $message) {
            $userId = ($message['sender_id'] == $userId) ? $message['receiver_id'] : $message['sender_id'];
            if (!isset($groupedMessages[$userId]) || $message['message_created_at'] > $groupedMessages[$userId]['message_created_at']) {
                $groupedMessages[$userId] = $message;
            }
        }

        return array_values($groupedMessages);
    }

    public function getMessagesByUserId($userId) {
        $query = "SELECT 
                    cm.message_id,
                    cm.sender_id,
                    sender.username AS sender_name,
                    cm.receiver_id,
                    receiver.username AS receiver_name,
                    cm.content,
                    cm.created_at AS message_created_at
                  FROM 
                    chat_messages cm
                  JOIN 
                    users sender ON cm.sender_id = sender.user_id
                  JOIN 
                    users receiver ON cm.receiver_id = receiver.user_id
                  WHERE 
                    cm.sender_id = $1 OR cm.receiver_id = $1";
        
        $result = pg_query_params($this->db, $query, array($userId));
        
        $messages = [];
        while ($row = pg_fetch_assoc($result)) {
            $messages[] = $row;
        }
    
        return $messages;
    }
    

    public function sendMessage($senderId, $receiverId, $content) {
        $query = "INSERT INTO chat_messages (sender_id, receiver_id, content) VALUES ($1, $2, $3)";
        return pg_query_params($this->db, $query, array($senderId, $receiverId, $content));
    }
}
?>
