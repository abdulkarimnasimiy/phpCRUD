<?php
require_once '../inc/auth.php';
require_once '../inc/db.php';

if (!isLoggedIn()) {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

header('Location: list.php');
exit;
