<?php
session_start();
include '../config/koneksi.php';
include '../includes/db_upgrade.php';
ensure_transaksi_extra_columns($conn);
$pageTitle = 'Laporan';

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

$totalTransaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi"))['total'] ?? 0;
$totalPendapatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(total_harga),0) AS total FROM transaksi"))['total'] ?? 0;
$totalProduk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk"))['total'] ?? 0;
$totalMemberAktif = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM membership WHERE status='Aktif'"))['total'] ?? 0;
$transaksiTerbaru = mysqli_query($conn, "SELECT transaksi.*, users.nama AS nama_akun, produk.nama_produk FROM transaksi JOIN users ON transaksi.id_user = users.id JOIN produk ON transaksi.id_produk = produk.id ORDER BY transaksi.tanggal DESC LIMIT 5");

include '../includes/admin_header.php';
?>

<div class="admin-top">
    <div>
        <span class="eyebrow">Laporan</span>
        <h1 class="font-serif" style="font-size:3rem;margin:14px 0 0;">Laporan Barbershop</h1>
        <p class="muted">Ringkasan pendapatan, transaksi, produk, dan membership.</p>
    </div>
</div>

<div class="grid grid-4 mb-3">
    <div class="metric"><span>Total Transaksi</span><strong><?= (int)$totalTransaksi; ?></strong></div>
    <div class="metric"><span>Total Pendapatan</span><strong>Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?></strong></div>
    <div class="metric"><span>Total Produk</span><strong><?= (int)$totalProduk; ?></strong></div>
    <div class="metric"><span>Member Aktif</span><strong><?= (int)$totalMemberAktif; ?></strong></div>
</div>

<div class="card">
    <div class="card-header">Transaksi Terbaru</div>
    <div class="table-wrap" style="box-shadow:none;border:0;border-radius:0;">
        <table>
            <thead><tr><th>Tanggal</th><th>Pelanggan</th><th>Produk</th><th>Metode</th><th>Total</th></tr></thead>
            <tbody>
            <?php if ($transaksiTerbaru) { while ($row = mysqli_fetch_assoc($transaksiTerbaru)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['tanggal']); ?></td>
                    <td><?= htmlspecialchars($row['nama_pembeli'] ?: $row['nama_akun']); ?></td>
                    <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                    <td><?= htmlspecialchars($row['metode_pembayaran'] ?: '-'); ?></td>
                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                </tr>
            <?php }} ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/admin_footer.php'; ?>
