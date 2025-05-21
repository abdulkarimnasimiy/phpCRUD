<?php
// admin.php

require_once 'inc/auth.php';  // Sessiya va autentifikatsiya funksiyalari
require_once 'inc/db.php';    // Ma’lumotlar bazasi ulanishi

// Admin ruxsatini tekshirish
if (!isAdmin()) {
    header('HTTP/1.1 403 Forbidden');
    exit('Sizda admin sahifasiga kirish huquqi yo‘q!');
}

// Sahifa boshi
include 'inc/header.php';
?>

<div class="container mt-4">
    <h1>Admin panelga xush kelibsiz, <?= htmlspecialchars($_SESSION['user']['ism']) ?>!</h1>
    <p>Bu yerda siz talabalarni boshqarishingiz mumkin.</p>

    <a href="students/list.php" class="btn btn-primary mb-3">Talabalar boshqaruvi</a>

    <!-- Bu yerga qo'shimcha admin funksiyalar qo'shilishi mumkin -->

</div>

<?php
// Sahifa oxiri
include 'inc/footer.php';
?>
