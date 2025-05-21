<?php
require_once 'inc/auth.php';

if (!isLoggedIn()) {
    header('Location: index.php');
    exit;
}

include 'inc/header.php';
?>

<h2>Profil sahifasi</h2>
<p>Assalomu alaykum, <?= htmlspecialchars($_SESSION['user']['ism']) ?>!</p>
<p>Oxirgi kirish vaqti: <?= $_COOKIE['last_login'] ?? 'No ma\'lumot' ?></p>

<?php include 'inc/footer.php'; ?>

