<?php

class PostModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createPost($userId, $imagePath, $caption) {
        // Insert post data into the 'photos' table
        $query = "INSERT INTO photos (user_id, image_path, caption) VALUES ($1, $2, $3)";
        $result = pg_query_params($this->db, $query, array($userId, $imagePath, $caption));

        return $result;
    }

    public function deletePost($postId) {
        // Delete post data from the 'photos' table
        $query = "DELETE FROM photos WHERE photo_id = $1";
        $result = pg_query_params($this->db, $query, array($postId));

        return $result;
    }

    public function getFeedPosts($userId) {
      $query = "SELECT 
                  photos.*, 
                  COUNT(photo_likes.like_id) AS like_count, 
                  COUNT(photo_comments.comment_id) AS comment_count,
                  users.fullname,
                  users.username
                FROM 
                  photos
                LEFT JOIN 
                  photo_likes ON photos.photo_id = photo_likes.photo_id
                LEFT JOIN 
                  photo_comments ON photos.photo_id = photo_comments.photo_id
                LEFT JOIN 
                  users ON photos.user_id = users.user_id
                WHERE 
                  (photos.user_id IN (
                    SELECT user_id2 
                    FROM friendships 
                    WHERE user_id1 = $userId 
                    AND status = 'accepted'
                  )
                  OR photos.user_id IN (
                    SELECT user_id1 
                    FROM friendships 
                    WHERE user_id2 = $userId 
                    AND status = 'accepted'
                  )
                  OR photos.user_id = $userId)
                GROUP BY 
                  photos.photo_id,
                  users.fullname,
                  users.username
                ORDER BY 
                  photos.created_at DESC";
      
      $result = pg_query($this->db, $query);
      $feedPosts = array();
      while ($row = pg_fetch_assoc($result)) {
          $feedPosts[] = $row;
      }
      return $feedPosts;
  }
  
  
  
    
    
    // You can add more methods here for other post-related actions
}

?>
