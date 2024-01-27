<?php
    $host = "localhost";
    $port = "5432";
    $dbname = "skillmate";  // Use the actual database name
    $user = "sushantpathare";
    $password = "";  // Use the actual password

    $db = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    if (!$db) {
        die("Error in database connection: " . pg_last_error());
    }else{
        echo "Connected succesfully";
    }
?>

