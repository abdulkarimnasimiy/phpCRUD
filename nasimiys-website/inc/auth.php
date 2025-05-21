<?php
session_start();
require_once 'db.php';

function registerUser($ism, $email, $password) {
    global $pdo;
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return "Bu email bilan foydalanuvchi mavjud!";
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (ism, email, parol) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$ism, $email, $hash])) {
        return true;
    }
    return "Ro‘yxatdan o‘tishda xatolik yuz berdi.";
}

function loginUser($email, $password) {
    global $pdo;
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    var_dump($user); // Bu yerda foydalanuvchi ma'lumotlarini ko'rish mumkin (keyin o'chiring)

    if ($user && password_verify($password, $user['parol'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'ism' => $user['ism'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'user'
        ];
        setcookie('last_login', date('Y-m-d H:i:s'), time() + 3600 * 24 * 30, '/');
        return true;
    } else {
        echo "Parol noto‘g‘ri."; // Bu xabarni faqat test uchun qoldiring, real loyihada xavfsizlik uchun umumiy xabar bering
        return false;
    }
}



function isLoggedIn() {
    return isset($_SESSION['user']);
}

function logoutUser() {
    session_destroy();
    setcookie('last_login', '', time() - 3600, '/');
    header('Location: index.php');
    exit;
}

function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}
