<?php
    $host = 'localhost';
    $root = 'root';
    $password = '';
    $db = 'courtrecords_db';

    $conn = new mysqli($host, $root, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
