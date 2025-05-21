
<?php
require_once 'inc/auth.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ism = trim($_POST['ism'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($ism === '' || $email === '' || $password === '') {
        $message = "Iltimos, barcha maydonlarni to‘ldiring.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Yaroqli email kiriting.";
    } else {
        $result = registerUser($ism, $email, $password);
        if ($result === true) {
            $message = "Ro‘yxatdan o‘tdingiz! Iltimos, tizimga kiring.";
        } else {
            $message = $result;
        }
    }
}

include 'inc/header.php';
?>

<h2>Ro'yxatdan o'tish</h2>

<?php if ($message): ?>
    <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="post" action="">
  <div class="mb-3">
    <label for="ism" class="form-label">Ism</label>
    <input type="text" class="form-control" id="ism" name="ism" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email manzil</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Parol</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-success">Ro'yxatdan o'tish</button>
</form>

<?php include 'inc/footer.php'; ?>
