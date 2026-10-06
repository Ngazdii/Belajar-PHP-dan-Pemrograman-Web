<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
include 'config/koneksi.php';
include 'includes/db_upgrade.php';
ensure_transaksi_extra_columns($conn);

$id_produk = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id_produk' LIMIT 1");
if (!$queryProduk || mysqli_num_rows($queryProduk) === 0) {
    echo "<script>alert('Produk tidak ditemukan.'); window.location='produk.php';</script>";
    exit;
}
$data = mysqli_fetch_assoc($queryProduk);
$error = '';
$diskonAktif = false;

$member = mysqli_query($conn, "SELECT * FROM membership WHERE id_user='".(int)$_SESSION['id_user']."' AND status='Aktif' AND tanggal_berakhir >= CURDATE() LIMIT 1");
if ($member && mysqli_num_rows($member) > 0) {
    $diskonAktif = true;
}

$nama_default = $_SESSION['nama'] ?? '';
$userQ = mysqli_query($conn, "SELECT nama, no_hp FROM users WHERE id='".(int)$_SESSION['id_user']."' LIMIT 1");
if ($userQ && mysqli_num_rows($userQ) > 0) {
    $userData = mysqli_fetch_assoc($userQ);
    $nama_default = $userData['nama'] ?? $nama_default;
    $hp_default = $userData['no_hp'] ?? '';
} else {
    $hp_default = '';
}

if (isset($_POST['beli'])) {
    $jumlah = (int)($_POST['jumlah'] ?? 0);
    $nama_pembeli = trim($_POST['nama_pembeli'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $metode_pembayaran = $_POST['metode_pembayaran'] ?? '';

    if ($nama_pembeli === '') {
        $error = 'Nama pembeli wajib diisi.';
    } elseif ($no_hp === '') {
        $error = 'Nomor HP wajib diisi.';
    } elseif ($alamat === '') {
        $error = 'Alamat wajib diisi.';
    } elseif (!in_array($metode_pembayaran, ['QRIS', 'Bayar di Tempat'])) {
        $error = 'Pilih metode pembayaran terlebih dahulu.';
    } elseif ($jumlah <= 0) {
        $error = 'Jumlah pembelian tidak valid.';
    } elseif ($jumlah > (int)$data['stok']) {
        $error = 'Stok tidak mencukupi.';
    } else {
        $total = $jumlah * (int)$data['harga'];
        if ($diskonAktif) {
            $total = $total - ($total * 0.10);
        }
        $total = (int)$total;

        $nama_pembeli = mysqli_real_escape_string($conn, $nama_pembeli);
        $no_hp = mysqli_real_escape_string($conn, $no_hp);
        $alamat = mysqli_real_escape_string($conn, $alamat);
        $metode_pembayaran = mysqli_real_escape_string($conn, $metode_pembayaran);

        $insert = mysqli_query($conn, "INSERT INTO transaksi 
            (id_user, id_produk, nama_pembeli, no_hp, alamat, jumlah, total_harga, metode_pembayaran) 
            VALUES ('".(int)$_SESSION['id_user']."', '$id_produk', '$nama_pembeli', '$no_hp', '$alamat', '$jumlah', '$total', '$metode_pembayaran')");

        if ($insert) {
            mysqli_query($conn, "UPDATE produk SET stok = stok - $jumlah WHERE id='$id_produk'");
            echo "<script>alert('Pesanan berhasil dibuat. Silakan selesaikan pembayaran sesuai metode yang dipilih.'); window.location='riwayat.php';</script>";
            exit;
        } else {
            $error = mysqli_error($conn);
        }
    }
}

$pageTitle = 'Beli Produk';
include 'includes/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="grid grid-2" style="align-items:start;">
            <div class="card product-card">
                <span class="price-badge">Harga Rp <?= number_format($data['harga'], 0, ',', '.'); ?></span>
                <img class="product-img" style="height:360px;" src="https://images.unsplash.com/photo-1631729371254-42c2892f0e6e?q=80&w=900&auto=format&fit=crop" alt="<?= htmlspecialchars($data['nama_produk']); ?>">
            </div>
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-light btn-sm mb-3" href="produk.php">← Kembali</a>
                    <h1 class="font-serif" style="font-size:2.8rem;margin:0 0 10px;"><?= htmlspecialchars($data['nama_produk']); ?></h1>
                    <p><strong>Harga:</strong> Rp <?= number_format($data['harga'], 0, ',', '.'); ?></p>
                    <p class="muted"><?= nl2br(htmlspecialchars($data['deskripsi'])); ?></p>
                    <p><span class="badge badge-success">Stok: <?= (int)$data['stok']; ?></span></p>
                    <?php if ($diskonAktif) { ?><div class="alert alert-success">Membership aktif: kamu mendapat diskon 10%.</div><?php } ?>
                    <?php if ($error) { ?><div class="alert alert-danger"><?= htmlspecialchars($error); ?></div><?php } ?>

                    <form method="POST">
                        <div class="grid grid-2">
                            <div class="form-group">
                                <label>Nama Pembeli</label>
                                <input type="text" name="nama_pembeli" value="<?= htmlspecialchars($_POST['nama_pembeli'] ?? $nama_default); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" value="<?= htmlspecialchars($_POST['no_hp'] ?? $hp_default); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" placeholder="Contoh: Jl. Tribrata, Klitren, Gondokusuman, Yogyakarta" required><?= htmlspecialchars($_POST['alamat'] ?? ''); ?></textarea>
                        </div>

                        <div class="grid grid-2">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" min="1" max="<?= (int)$data['stok']; ?>" value="<?= htmlspecialchars($_POST['jumlah'] ?? '1'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metode_pembayaran" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="QRIS" <?= (($_POST['metode_pembayaran'] ?? '') === 'QRIS') ? 'selected' : ''; ?>>QRIS</option>
                                    <option value="Bayar di Tempat" <?= (($_POST['metode_pembayaran'] ?? '') === 'Bayar di Tempat') ? 'selected' : ''; ?>>Bayar di Tempat</option>
                                </select>
                            </div>
                        </div>

                        <div id="qrisPreview" class="qris-preview mb-3">
                            <p class="muted"><strong>Scan QRIS berikut jika memilih pembayaran QRIS:</strong></p>
                            <img src="assets/img/qris-baru.png?v=2" alt="QRIS Barbershop Kadir">
                        </div>

                        <button type="submit" name="beli" class="btn btn-primary">Konfirmasi Pembelian</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
const metodeSelect = document.getElementById('metode_pembayaran');
const qrisPreview = document.getElementById('qrisPreview');
function toggleQrisPreview() {
    qrisPreview.style.display = metodeSelect.value === 'QRIS' ? 'block' : 'none';
}
metodeSelect.addEventListener('change', toggleQrisPreview);
toggleQrisPreview();
</script>

<?php include 'includes/footer.php'; ?>
