<?php
require_once 'inc/auth.php';

if (isLoggedIn()) {
    header('Location: profile.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (loginUser($email, $password)) {
        header('Location: profile.php');
        exit;
    } else {
        $message = "Email yoki parol noto‘g‘ri.";
    }
}

include 'inc/header.php';
?>

<h2>Kirish</h2>
<?php if ($message): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="post" action="">
  <div class="mb-3">
    <label for="email" class="form-label">Email manzil</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Parol</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">Kirish</button>
</form>

<?php include 'inc/footer.php'; ?>

