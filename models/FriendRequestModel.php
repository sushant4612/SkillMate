<?php
class FriendRequestModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function acceptRequest($requestId) {
        $query = "UPDATE friend_requests SET status = 'accepted' WHERE request_id = $1";
        pg_query_params($this->connection, $query, array($requestId));

        $query = "INSERT INTO friendships (user_id1, user_id2, status) 
                  SELECT sender_id, receiver_id, 'accepted' 
                  FROM friend_requests 
                  WHERE request_id = $1";
        pg_query_params($this->connection, $query, array($requestId));

        // Optionally, delete the request from the friend_requests table
        // $this->deleteRequest($requestId);
    }

    public function declineRequest($requestId) {
        $query = "DELETE FROM friend_requests WHERE request_id = $1";
        pg_query_params($this->connection, $query, array($requestId));
    }

    public function sendRequest($senderId, $receiverId) {
        $query = "INSERT INTO friend_requests (sender_id, receiver_id, status) VALUES ($1, $2, 'pending')";
        pg_query_params($this->connection, $query, array($senderId, $receiverId));
    }

    // Additional methods for retrieving requests can be added here
}
?>
