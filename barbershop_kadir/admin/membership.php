<?php
session_start();
include '../config/koneksi.php';
$pageTitle = 'Kelola Membership';

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['aktifkan'])) {
    $id = (int)$_GET['aktifkan'];
    $mulai = date('Y-m-d');
    $berakhir = date('Y-m-d', strtotime('+1 year'));

    mysqli_query($conn, "UPDATE membership SET status='Aktif', tanggal_mulai='$mulai', tanggal_berakhir='$berakhir' WHERE id='$id'");
    echo "<script>alert('Membership berhasil diaktifkan.'); window.location='membership.php';</script>";
    exit;
}

$query = mysqli_query($conn, "SELECT membership.*, users.nama, users.no_hp FROM membership JOIN users ON membership.id_user = users.id ORDER BY membership.id DESC");
if (!$query) {
    die(mysqli_error($conn));
}

include '../includes/admin_header.php';
?>

<div class="admin-top">
    <div>
        <span class="eyebrow">Membership</span>
        <h1 class="font-serif" style="font-size:3rem;margin:14px 0 0;">Kelola Membership</h1>
        <p class="muted">Aktifkan membership pelanggan setelah pembayaran dikonfirmasi.</p>
    </div>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr><th>No</th><th>Pelanggan</th><th>Metode</th><th>Harga</th><th>Status</th><th>Mulai</th><th>Berakhir</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><strong><?= htmlspecialchars($row['nama']); ?></strong><br><span class="muted"><?= htmlspecialchars($row['no_hp'] ?? '-'); ?></span></td>
                <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><span class="badge <?= $row['status'] === 'Aktif' ? 'badge-success' : 'badge-warning'; ?>"><?= htmlspecialchars($row['status']); ?></span></td>
                <td><?= $row['tanggal_mulai'] ?: '-'; ?></td>
                <td><?= $row['tanggal_berakhir'] ?: '-'; ?></td>
                <td>
                    <?php if ($row['status'] === 'Menunggu Pembayaran') { ?>
                        <a class="btn btn-success btn-sm" href="?aktifkan=<?= (int)$row['id']; ?>" onclick="return confirm('Aktifkan membership pelanggan ini?')">Aktifkan</a>
                    <?php } else { ?>
                        <span class="badge badge-success">Aktif</span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        <?php if ($no === 1) { ?><tr><td colspan="8" class="text-center muted">Belum ada data membership.</td></tr><?php } ?>
        </tbody>
    </table>
</div>

<?php include '../includes/admin_footer.php'; ?>
