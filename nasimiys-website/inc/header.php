<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nasimiy's Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/nasimiys-website/assets/css/styles.css" rel="stylesheet" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/nasimiys-website/index.php">
      <span>EDUCenter Students</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if (isLoggedIn()): ?>
          <li class="nav-item"><a class="nav-link" href="/nasimiys-website/profile.php">Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="/nasimiys-website/students/list.php">Talabalar ro'yxati</a></li>
          <?php if (isAdmin()): ?>
            <li class="nav-item"><a class="nav-link" href="/nasimiys-website/admin.php">Admin Panel</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="/nasimiys-website/logout.php">Chiqish</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/nasimiys-website/index.php">Kirish</a></li>
          <li class="nav-item"><a class="nav-link" href="/nasimiys-website/register.php">Ro‘yxatdan o‘tish</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
