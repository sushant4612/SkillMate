<?php

include('../models/PostModel.php');

class PostController {
    private $postModel;

    public function __construct() {
        global $db;
        $this->postModel = new PostModel($db);
    }

    public function createPost($userId, $imagePath, $caption) {
        // Perform additional validation if needed
        if (!$userId || !$imagePath || !$caption) {
            $this->sendErrorResponse("Invalid data provided.");
            return;
        }

        // Call the createPost method in the model to insert the post into the database
        $result = $this->postModel->createPost($userId, $imagePath, $caption);

        if ($result) {
            // Post creation successful
            $this->sendSuccessResponse("Post created successfully!");
        } 
    }

    public function deletePost($postId) {
        // Perform additional validation if needed
        if (!$postId) {
            $this->sendErrorResponse("Invalid data provided.");
            return;
        }

        // Call the deletePost method in the model to delete the post from the database
        $result = $this->postModel->deletePost($postId);

        if ($result) {
            // Post deletion successful
            $this->sendSuccessResponse("Post deleted successfully!");
        } else {
            // Post deletion failed
            $this->sendErrorResponse("Failed to delete post.");
        }
    }

    private function sendSuccessResponse($message) {
        http_response_code(200);
        echo json_encode(["status" => "success", "message" => $message]);
    }

    private function sendErrorResponse($message) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => $message]);
    }
}

?>
