<?php

header('Content-Type: text/plain');

$servername = 'db';
$username = 'user';
$password = 'password';
$database = 'database';

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed (MySQLi): {$conn->connect_error}" . PHP_EOL);
}
$conn->close();
echo 'Connected successfully (MySQLi)' . PHP_EOL;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn = null;
    echo 'Connected successfully (PDO)' . PHP_EOL;
} catch(PDOException $e) {
    echo 'Connection failed (PDO): ' . $e->getMessage() . PHP_EOL;
}

echo 'EOS' . PHP_EOL;
