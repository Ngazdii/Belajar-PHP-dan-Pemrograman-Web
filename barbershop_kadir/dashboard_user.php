<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
$pageTitle = 'Dashboard Pelanggan';
include 'includes/header.php';
?>

<section class="page-section">
    <div class="container">
        <span class="eyebrow">Dashboard Pelanggan</span>
        <h1 class="font-serif" style="font-size:3rem;margin:16px 0 8px;">Halo, <?= htmlspecialchars($_SESSION['nama']); ?> 👋</h1>
        <p class="muted mb-3">Kelola pembelian produk, riwayat transaksi, dan membership kamu di sini.</p>

        <div class="grid grid-3 mt-4">
            <div class="card"><div class="card-body"><h3>Produk Grooming</h3><p class="muted">Lihat dan beli produk perawatan rambut.</p><a class="btn btn-primary" href="produk.php">Lihat Produk</a></div></div>
            <div class="card"><div class="card-body"><h3>Riwayat Transaksi</h3><p class="muted">Cek daftar pembelian yang pernah dilakukan.</p><a class="btn btn-info" href="riwayat.php">Lihat Riwayat</a></div></div>
            <div class="card"><div class="card-body"><h3>Membership</h3><p class="muted">Daftar atau cek status membership tahunan.</p><a class="btn btn-warning" href="membership.php">Kelola Membership</a></div></div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
