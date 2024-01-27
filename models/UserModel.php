<!-- models/UserModel.php -->

<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function isUsernameTaken($username) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = pg_query($this->db, $query);
        return pg_num_rows($result) > 0;
    }

    public function createUser($username, $password, $email, $age) {
        // Insert user data into the 'users' table
        $query = "INSERT INTO users (username, password, email, age) VALUES ('$username', '$password', '$email', $age)";
        return pg_query($this->db, $query);
    }

    // Other methods for updating, deleting, or retrieving user data...
}

?>