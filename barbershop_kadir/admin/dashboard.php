<?php
session_start();
include '../config/koneksi.php';
$pageTitle = 'Dashboard Admin';

$totalProduk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk"))['total'] ?? 0;
$totalTransaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi"))['total'] ?? 0;
$totalPendapatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(total_harga),0) AS total FROM transaksi"))['total'] ?? 0;
$totalMemberAktif = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM membership WHERE status='Aktif'"))['total'] ?? 0;

include '../includes/admin_header.php';
?>

<div class="admin-top">
    <div>
        <span class="eyebrow">Admin Panel</span>
        <h1 class="font-serif" style="font-size:3rem;margin:14px 0 0;">Dashboard</h1>
        <p class="muted">Selamat datang, <?= htmlspecialchars($_SESSION['username_admin']); ?>.</p>
    </div>
</div>

<div class="grid grid-4 mb-3">
    <div class="metric"><span>Total Produk</span><strong><?= (int)$totalProduk; ?></strong></div>
    <div class="metric"><span>Total Transaksi</span><strong><?= (int)$totalTransaksi; ?></strong></div>
    <div class="metric"><span>Pendapatan</span><strong>Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?></strong></div>
    <div class="metric"><span>Member Aktif</span><strong><?= (int)$totalMemberAktif; ?></strong></div>
</div>

<div class="grid grid-3">
    <div class="card"><div class="card-body"><h3>Kelola Produk</h3><p class="muted">Tambah dan hapus produk grooming.</p><a class="btn btn-primary" href="produk.php">Buka</a></div></div>
    <div class="card"><div class="card-body"><h3>Kelola Membership</h3><p class="muted">Aktifkan pengajuan membership pelanggan.</p><a class="btn btn-success" href="membership.php">Buka</a></div></div>
    <div class="card"><div class="card-body"><h3>Laporan</h3><p class="muted">Lihat ringkasan pendapatan dan transaksi.</p><a class="btn btn-info" href="laporan.php">Buka</a></div></div>
</div>

<?php include '../includes/admin_footer.php'; ?>
