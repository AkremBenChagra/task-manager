<?php
$host = 'localhost';
$username='root';
$password='';
$dbname='task_manager';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>