<?php

include('../models/PostModel.php');

class FeedController {
    private $postModel;

    public function __construct($db) {
        $this->postModel = new PostModel($db);
    }

    public function getFeedPosts($userId) {
        $feedPosts = $this->postModel->getFeedPosts($userId);
        if ($feedPosts) {
            // Send the feed posts as JSON response
            http_response_code(200); // Success
            echo json_encode(["status" => "success", "feed_posts" => $feedPosts]);
        } else {
            // Handle error
            http_response_code(500); // Internal Server Error
            echo json_encode(["status" => "error", "message" => "Failed to fetch feed posts."]);
        }
    }
}
?>
