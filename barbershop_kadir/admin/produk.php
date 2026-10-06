<?php
session_start();
include '../config/koneksi.php';
$pageTitle = 'Kelola Produk';

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

$error = '';
if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $simpan = mysqli_query($conn, "INSERT INTO produk (nama_produk, harga, stok, deskripsi) VALUES ('$nama', '$harga', '$stok', '$deskripsi')");
    if ($simpan) {
        echo "<script>alert('Produk berhasil ditambahkan.'); window.location='produk.php';</script>";
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
    echo "<script>alert('Produk berhasil dihapus.'); window.location='produk.php';</script>";
    exit;
}

$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
if (!$produk) {
    die(mysqli_error($conn));
}

include '../includes/admin_header.php';
?>

<div class="admin-top">
    <div>
        <span class="eyebrow">Produk</span>
        <h1 class="font-serif" style="font-size:3rem;margin:14px 0 0;">Kelola Produk</h1>
        <p class="muted">Tambah dan kelola produk grooming yang muncul pada halaman pelanggan.</p>
    </div>
</div>

<?php if ($error) { ?><div class="alert alert-danger"><?= htmlspecialchars($error); ?></div><?php } ?>

<div class="grid grid-2" style="align-items:start;">
    <div class="card">
        <div class="card-header">Tambah Produk</div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group"><label>Nama Produk</label><input type="text" name="nama_produk" required></div>
                <div class="form-group"><label>Harga</label><input type="number" name="harga" min="0" required></div>
                <div class="form-group"><label>Stok</label><input type="number" name="stok" min="0" required></div>
                <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi"></textarea></div>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Produk</button>
            </form>
        </div>
    </div>

    <div class="table-wrap">
        <table>
            <thead><tr><th>No</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($produk)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= htmlspecialchars($row['nama_produk']); ?></strong><br><span class="muted"><?= htmlspecialchars($row['deskripsi']); ?></span></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?= (int)$row['stok']; ?></td>
                    <td><a class="btn btn-danger btn-sm" href="?hapus=<?= (int)$row['id']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a></td>
                </tr>
            <?php } ?>
            <?php if ($no === 1) { ?><tr><td colspan="5" class="text-center muted">Belum ada produk.</td></tr><?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/admin_footer.php'; ?>
