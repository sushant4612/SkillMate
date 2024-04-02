<?php

class ProfileModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProfilePhotoPath($userId) {
        // Prepare the SQL query
        $query = "SELECT profile_photo FROM users WHERE user_id = $1";

        // Execute the query with user ID as parameter
        $result = pg_query_params($this->db, $query, array($userId));

        // Check if the query was successful
        if ($result) {
            // Fetch the profile photo path from the result
            $row = pg_fetch_assoc($result);
            if ($row) {
                return $row['profile_photo'];
            } else {
                // If user has no profile photo set, return default path
                return "../assets/images/icons/user.png";
            }
        } else {
            // Handle query error
            return false;
        }
    }
}
?>