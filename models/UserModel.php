
<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // UserModel.php

    public function updatePassword($userId, $newPassword) {
        // Hash the new password before updating
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $query = "UPDATE users SET password = $1, reset_token = NULL WHERE id = $2";
        $result = pg_query_params($this->db, $query, array($hashedPassword, $userId));

        return $result !== false; // Return true if the update was successful
    }

    public function storeResetToken($username, $email, $resetToken) {
        // Update the 'users' table with the reset token
        $query = "UPDATE users SET reset_token = $1 WHERE username = $2 AND email = $3";
        pg_query_params($this->db, $query, array($resetToken, $username, $email));
    }
    

    public function getUsernameByResetToken($resetToken) {
        $query = "SELECT username FROM users WHERE reset_token = $1";
        $result = pg_query_params($this->db, $query, array($resetToken));
    
        if ($result) {
            $username = pg_fetch_result($result, 0, 0);
            return $username;
        } else {
            // Handle query error if needed
            return false;
        }
    }
    

    public function getUserByUsernameOrEmail($username, $email) {
        if ($this->db === null) {
            // Handle the case where the database connection is not established
            return null;
        }

        // Query to retrieve user by username or email
        $query = "SELECT * FROM users WHERE username = $1 OR email = $2";
        $result = pg_query_params($this->db, $query, array($username, $email));

        // Check for errors in the query
        if (!$result) {
            return null;
        }

        // Fetch user data from the result
        $userData = pg_fetch_assoc($result);

        return $userData;
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