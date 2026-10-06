<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$basePath = defined('BASE_PATH') ? BASE_PATH : '';
$pageTitle = $pageTitle ?? 'Barbershop Kadir';
$currentFile = basename($_SERVER['PHP_SELF']);
function is_active_page($fileName) {
    return basename($_SERVER['PHP_SELF']) === $fileName ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="<?= $basePath; ?>assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container navbar">
        <a class="brand" href="<?= $basePath; ?>index.php">Barbershop Kadir</a>

        <nav class="nav-links">
            <a class="<?= is_active_page('index.php'); ?>" href="<?= $basePath; ?>index.php">Beranda</a>
            <a class="<?= is_active_page('produk.php'); ?>" href="<?= $basePath; ?>produk.php">Produk</a>
            <a class="<?= is_active_page('membership.php'); ?>" href="<?= $basePath; ?>membership.php">Membership</a>
            <a href="<?= $basePath; ?>index.php#booking">Booking</a>
            <a href="<?= $basePath; ?>admin/login.php">Admin</a>
        </nav>

        <div class="nav-actions">
            <?php if (isset($_SESSION['id_user'])) { ?>
                <a class="btn btn-secondary btn-sm" href="<?= $basePath; ?>dashboard_user.php">Dashboard</a>
                <a class="btn btn-danger btn-sm" href="<?= $basePath; ?>logout.php">Logout</a>
            <?php } else { ?>
                <a class="btn btn-secondary btn-sm" href="<?= $basePath; ?>login.php">Login</a>
                <a class="btn btn-primary btn-sm" href="<?= $basePath; ?>register.php">Daftar</a>
            <?php } ?>
        </div>
    </div>
</header>
<main>
