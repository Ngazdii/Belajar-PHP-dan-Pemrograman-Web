<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
include 'config/koneksi.php';
include 'includes/db_upgrade.php';
ensure_transaksi_extra_columns($conn);

$id_user = (int)$_SESSION['id_user'];
$query = mysqli_query($conn, "SELECT transaksi.*, produk.nama_produk FROM transaksi JOIN produk ON transaksi.id_produk = produk.id WHERE transaksi.id_user = '$id_user' ORDER BY transaksi.tanggal DESC");
if (!$query) {
    die(mysqli_error($conn));
}

$pageTitle = 'Riwayat Transaksi';
include 'includes/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="actions mb-3"><a class="btn btn-light" href="dashboard_user.php">← Dashboard</a></div>
        <h1 class="section-title">Riwayat Transaksi</h1>
        <p class="section-subtitle">Daftar pembelian produk yang pernah kamu lakukan.</p>

        <div class="table-wrap">
            <table>
                <thead><tr><th>No</th><th>Tanggal</th><th>Produk</th><th>Nama</th><th>Alamat</th><th>Metode</th><th>Jumlah</th><th>Total</th></tr></thead>
                <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['tanggal']); ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                        <td><?= htmlspecialchars($row['nama_pembeli'] ?: '-'); ?></td>
                        <td><?= htmlspecialchars($row['alamat'] ?: '-'); ?></td>
                        <td><?= htmlspecialchars($row['metode_pembayaran'] ?: '-'); ?></td>
                        <td><?= (int)$row['jumlah']; ?></td>
                        <td><strong>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong></td>
                    </tr>
                <?php } ?>
                <?php if ($no === 1) { ?><tr><td colspan="8" class="text-center muted">Belum ada transaksi.</td></tr><?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
