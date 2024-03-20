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
