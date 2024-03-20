<?php
class FriendRequestModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function acceptRequest($requestId) {
        // Update the status of the request to 'accepted'
        $query = "UPDATE friend_requests SET status = 'accepted' WHERE request_id = $1";
        pg_query_params($this->connection, $query, array($requestId));

        // Insert the accepted request into the friendships table
        $query = "INSERT INTO friendships (user_id1, user_id2, status) 
                  SELECT sender_id, receiver_id, 'accepted' 
                  FROM friend_requests 
                  WHERE request_id = $1";
        pg_query_params($this->connection, $query, array($requestId));

        $requestInfoQuery = "SELECT sender_id, receiver_id FROM friend_requests WHERE request_id = $1";
        $requestInfoResult = pg_query_params($this->connection, $requestInfoQuery, array($requestId));
        $requestInfo = pg_fetch_assoc($requestInfoResult);
        $senderId = $requestInfo['sender_id'];
        $receiverId = $requestInfo['receiver_id'];

        // Check if a chat already exists between the users
        $existingChatQuery = "SELECT * FROM chat_messages WHERE (sender_id = $1 AND receiver_id = $2) OR (sender_id = $2 AND receiver_id = $1)";
        $existingChatResult = pg_query_params($this->connection, $existingChatQuery, array($senderId, $receiverId));
        if (pg_num_rows($existingChatResult) == 0) {
            // Chat doesn't exist, create a new chat
            $createChatQuery = "INSERT INTO chat_messages (sender_id, receiver_id, content) VALUES ($1, $2, 'Chat started')";
            pg_query_params($this->connection, $createChatQuery, array($senderId, $receiverId));
        }

        // Delete all friend requests involving the sender or receiver of the accepted request
        $query = "DELETE FROM friend_requests WHERE sender_id = (SELECT sender_id FROM friend_requests WHERE request_id = $1)
                  OR receiver_id = (SELECT receiver_id FROM friend_requests WHERE request_id = $1)";
        pg_query_params($this->connection, $query, array($requestId));
    }

    public function declineRequest($requestId) {
        // Delete the declined request
        $query = "DELETE FROM friend_requests WHERE request_id = $1";
        pg_query_params($this->connection, $query, array($requestId));
    }

    public function sendRequest($senderId, $receiverId) {
        // Insert the new friend request
        $query = "INSERT INTO friend_requests (sender_id, receiver_id, status) VALUES ($1, $2, 'pending')";
        pg_query_params($this->connection, $query, array($senderId, $receiverId));
    }

    public function deleteRecommendation($receiverId) {
        // Delete recommendations for the specified user
        $query = "DELETE FROM recommendations WHERE recommended_user_id = $1";
        pg_query_params($this->connection, $query, array($receiverId));
    }

    // Additional methods for retrieving requests can be added here
}

?>
