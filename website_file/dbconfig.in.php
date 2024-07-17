<?php
$host = 'localhost';
$dbName = 'palestinian_souvenirs_online_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die($e->getMessage());
}
?>
