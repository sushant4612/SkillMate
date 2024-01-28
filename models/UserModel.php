
<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByUsername($username) {
        if ($this->db === null) {
            // Handle the case where the database connection is not established
            // echo 'inside';
            return null;
        }
    
        $query = "SELECT * FROM users WHERE username = $1";
        $result = pg_query_params($this->db, $query, array($username));
    
        // Check for errors in the query
        if (!$result) {
            return null;
        }
    
        // Fetch user data from the result
        $userData = pg_fetch_assoc($result);
    
        return $userData;
    }

    public function getUserByEmail($email) {
        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM users WHERE email = $1";
        $result = pg_query_params($this->db, $query, array($email));
    
        if (!$result) {
            return null;
        }
    
        $userData = pg_fetch_assoc($result);
        return $userData;
    }
    

    public function isUsernameTaken($username) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = pg_query($this->db, $query);
        return pg_num_rows($result) > 0;
    }

    public function isEmailTaken($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = $1";
        $result = pg_query_params($this->db, $query, array($email));

        if ($result) {
            $count = pg_fetch_result($result, 0, 0);
            return $count > 0;
        } else {
            // Handle query error if needed
            return false;
        }
    }

    public function createUser($username, $password, $email, $age) {
        // Insert user data into the 'users' table
        $query = "INSERT INTO users (username, password, email, age) VALUES ('$username', '$password', '$email', $age)";
        return pg_query($this->db, $query);
    }

    // Other methods for updating, deleting, or retrieving user data...
}

?>