<?php
require_once '../inc/auth.php';
require_once '../inc/db.php';

if (!isLoggedIn() || !isAdmin()) {  // faqat admin qo‘shishi mumkin
    header('Location: ../index.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ism = trim($_POST['ism'] ?? '');
    $familiya = trim($_POST['familiya'] ?? '');
    $guruh = trim($_POST['guruh'] ?? '');

    $web_dasturlash = $_POST['web_dasturlash'] ?? null;
    $kompyuter_tarmoqlari = $_POST['kompyuter_tarmoqlari'] ?? null;
    $ehtimollar_statistika = $_POST['ehtimollar_statistika'] ?? null;
    $masofaviy_talim = $_POST['masofaviy_talim'] ?? null;
    $suniy_intellekt = $_POST['suniy_intellekt'] ?? null;

    // Oddiy validatsiya: bo‘sh emas va 0-100 orasida bo‘lsin
    $valid = true;
    $fields = [
        'Web Dasturlash' => $web_dasturlash,
        'Kompyuter Tarmoqlari' => $kompyuter_tarmoqlari,
        'Ehtimollar va Statistika' => $ehtimollar_statistika,
        'Masofaviy Ta\'lim' => $masofaviy_talim,
        'Suniy Intellekt' => $suniy_intellekt,
    ];

    foreach ($fields as $name => $value) {
        if ($value === null || $value === '' || !is_numeric($value) || $value < 0 || $value > 100) {
            $message = "Iltimos, barcha fanlar uchun 0 dan 100 gacha bo‘lgan baholarni to‘g‘ri kiriting: $name.";
            $valid = false;
            break;
        }
    }

    if ($ism === '' || $familiya === '' || $guruh === '') {
        $message = "Iltimos, barcha maydonlarni to‘ldiring.";
        $valid = false;
    }

    if ($valid) {
        $sql = "INSERT INTO students (ism, familiya, guruh, web_dasturlash, kompyuter_tarmoqlari, ehtimollar_statistika, masofaviy_talim, suniy_intellekt) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$ism, $familiya, $guruh, $web_dasturlash, $kompyuter_tarmoqlari, $ehtimollar_statistika, $masofaviy_talim, $suniy_intellekt])) {
            header('Location: list.php');
            exit;
        } else {
            $message = "Xatolik yuz berdi.";
        }
    }
}

include '../inc/header.php';
?>

<h2>Yangi talaba qo'shish</h2>

<?php if ($message): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="post" action="">
    <div class="mb-3">
        <label for="ism" class="form-label">Ism</label>
        <input type="text" class="form-control" id="ism" name="ism" required>
    </div>
    <div class="mb-3">
        <label for="familiya" class="form-label">Familiya</label>
        <input type="text" class="form-control" id="familiya" name="familiya" required>
    </div>
    <div class="mb-3">
        <label for="guruh" class="form-label">Guruh</label>
        <input type="text" class="form-control" id="guruh" name="guruh" required>
    </div>

    <!-- Fanlar uchun baholar -->
    <div class="mb-3">
        <label for="web_dasturlash" class="form-label">Web Dasturlash (0-100)</label>
        <input type="number" class="form-control" id="web_dasturlash" name="web_dasturlash" min="0" max="100" required>
    </div>
    <div class="mb-3">
        <label for="kompyuter_tarmoqlari" class="form-label">Kompyuter Tarmoqlari (0-100)</label>
        <input type="number" class="form-control" id="kompyuter_tarmoqlari" name="kompyuter_tarmoqlari" min="0" max="100" required>
    </div>
    <div class="mb-3">
        <label for="ehtimollar_statistika" class="form-label">Ehtimollar va Statistika (0-100)</label>
        <input type="number" class="form-control" id="ehtimollar_statistika" name="ehtimollar_statistika" min="0" max="100" required>
    </div>
    <div class="mb-3">
        <label for="masofaviy_talim" class="form-label">Masofaviy Ta'lim (0-100)</label>
        <input type="number" class="form-control" id="masofaviy_talim" name="masofaviy_talim" min="0" max="100" required>
    </div>
    <div class="mb-3">
        <label for="suniy_intellekt" class="form-label">Suniy Intellekt (0-100)</label>
        <input type="number" class="form-control" id="suniy_intellekt" name="suniy_intellekt" min="0" max="100" required>
    </div>

    <button type="submit" class="btn btn-success">Qo'shish</button>
    <a href="list.php" class="btn btn-secondary ms-2">Ortga</a>
</form>

<?php include '../inc/footer.php'; ?>
