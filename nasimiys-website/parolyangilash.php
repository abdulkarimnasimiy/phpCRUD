<?php
require_once 'inc/db.php';

$newHash = '$2y$10$q1LROJL1mH1uIxD7TewAP.1vsCLHgiAWkQ9/gMD2MqCW2YebiQzcC'; // bu yerga o'zingiz yaratgan hashni qo'ying
$adminEmail = 'admin@example.com';

$sql = "UPDATE users SET parol = ? WHERE email = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$newHash, $adminEmail])) {
    echo "Admin paroli muvaffaqiyatli yangilandi.";
} else {
    echo "Xatolik yuz berdi!";
}
