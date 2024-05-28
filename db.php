<?php

function executeQuery($query) {
    // your database's name and name of table
    $database = 'coffeeshop';
    $tableName = 'users';
    // your database's password
    $password = '';
    // your database's server
    $host = 'localhost';
    // your database's username
    $user = 'root';

    // Connect to MySQL using MySQLi
    $connect = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Execute the query
    $result = $connect->query($query);

    // Close the connection
    $connect->close();

    return $result;
}

?>
