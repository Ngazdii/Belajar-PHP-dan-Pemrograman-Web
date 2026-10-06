<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}
$pageTitle = $pageTitle ?? 'Admin Barbershop Kadir';
$currentFile = basename($_SERVER['PHP_SELF']);
function admin_active($fileName) {
    return basename($_SERVER['PHP_SELF']) === $fileName ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="admin-shell">
    <aside class="admin-sidebar">
        <a class="admin-brand" href="dashboard.php">Barbershop Kadir</a>
        <nav class="admin-menu">
            <a class="<?= admin_active('dashboard.php'); ?>" href="dashboard.php">Dashboard</a>
            <a class="<?= admin_active('produk.php'); ?>" href="produk.php">Kelola Produk</a>
            <a class="<?= admin_active('membership.php'); ?>" href="membership.php">Kelola Membership</a>
            <a class="<?= admin_active('transaksi.php'); ?>" href="transaksi.php">Kelola Transaksi</a>
            <a class="<?= admin_active('laporan.php'); ?>" href="laporan.php">Laporan</a>
            <a href="../index.php">Lihat Website</a>
            <a href="logout.php">Logout</a>
        </nav>
    </aside>
    <main class="admin-main">
