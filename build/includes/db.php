<?php
// Legacy-style MySQL connection utility (simulating MySQL 4.x)
// Use mysqli for compatibility, but only use features available in MySQL 4.x

function db_connect() {
    $host = getenv('MYSQL_HOST') ?: 'mysql';
    $user = getenv('MYSQL_USER') ?: 'cyberctf';
    $pass = getenv('MYSQL_PASSWORD') ?: 'cyberctf123';
    $db   = getenv('MYSQL_DATABASE') ?: 'cyberctf';
    $port = getenv('MYSQL_PORT') ?: 3306;

    $conn = mysqli_connect($host, $user, $pass, $db, $port);
    if (!$conn) {
        die('Database connection error: ' . mysqli_connect_error());
    }
    return $conn;
} 