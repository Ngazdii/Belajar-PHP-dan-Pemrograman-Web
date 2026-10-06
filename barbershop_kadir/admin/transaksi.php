<?php
session_start();
include '../config/koneksi.php';
include '../includes/db_upgrade.php';
ensure_transaksi_extra_columns($conn);
$pageTitle = 'Kelola Transaksi';

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT transaksi.*, users.nama AS nama_akun, produk.nama_produk 
                              FROM transaksi 
                              JOIN users ON transaksi.id_user = users.id 
                              JOIN produk ON transaksi.id_produk = produk.id 
                              ORDER BY transaksi.tanggal DESC");
if (!$query) {
    die(mysqli_error($conn));
}

include '../includes/admin_header.php';
?>

<div class="admin-top">
    <div>
        <span class="eyebrow">Transaksi</span>
        <h1 class="font-serif" style="font-size:3rem;margin:14px 0 0;">Kelola Transaksi</h1>
        <p class="muted">Pantau transaksi pembelian produk pelanggan.</p>
    </div>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pembeli</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['tanggal']); ?></td>
                <td><?= htmlspecialchars($row['nama_pembeli'] ?: $row['nama_akun']); ?></td>
                <td><?= htmlspecialchars($row['no_hp'] ?: '-'); ?></td>
                <td><?= htmlspecialchars($row['alamat'] ?: '-'); ?></td>
                <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                <td><?= (int)$row['jumlah']; ?></td>
                <td><?= htmlspecialchars($row['metode_pembayaran'] ?: '-'); ?></td>
                <td><strong>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></strong></td>
            </tr>
        <?php } ?>
        <?php if ($no === 1) { ?><tr><td colspan="9" class="text-center muted">Belum ada transaksi.</td></tr><?php } ?>
        </tbody>
    </table>
</div>

<?php include '../includes/admin_footer.php'; ?>
