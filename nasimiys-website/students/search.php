<?php
require_once '../inc/auth.php';
require_once '../inc/db.php';

// Foydalanuvchi tizimga kiritilganligini tekshirish
if (!isLoggedIn()) {
    http_response_code(403);
    echo json_encode(['error' => 'Ruxsat yo‘q']);
    exit;
}

// Qidiruv so‘rovi
$q = $_GET['q'] ?? '';
$q = trim($q);

try {
    if ($q === '') {
        // Agar qidiruv so‘rovi bo‘sh bo‘lsa, barcha talabalarni olib kelamiz
        $sql = "SELECT * FROM students ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } else {
        // Qidiruv so‘rovi bo‘lsa, ism, familiya yoki guruh bo‘yicha qidiramiz
        $sql = "SELECT * FROM students WHERE ism LIKE :q OR familiya LIKE :q OR guruh LIKE :q ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['q' => "%$q%"]);
    }

    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($students);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server xatosi: ' . $e->getMessage()]);
    exit;
}
 