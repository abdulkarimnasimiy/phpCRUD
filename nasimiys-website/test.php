<?php
$newPassword = 'YangiParol123'; // Yangi admin parolini shu yerga yozing
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
echo "Yangi parol uchun hash:\n";
echo $hashedPassword . "\n";
?>
