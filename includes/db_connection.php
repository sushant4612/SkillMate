<?php
    $host = "localhost";
    $port = "5432";
    $dbname = "skillmate";
    $user = "sushantpathare";
    $password = "";  

    $db = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    if (!$db) {
        die("Error in database connection: " . pg_last_error());
    }else{
        echo "Connected succesfully";
    }
?>