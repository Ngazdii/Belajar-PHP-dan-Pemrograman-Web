<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
include 'config/koneksi.php';

$id_user = (int)$_SESSION['id_user'];
$error = '';
$success = isset($_GET['pengajuan']) && $_GET['pengajuan'] === 'berhasil';

$cek = mysqli_query($conn, "SELECT * FROM membership WHERE id_user='$id_user' ORDER BY id DESC LIMIT 1");
$data = $cek ? mysqli_fetch_assoc($cek) : null;

if (isset($_POST['daftar'])) {
    $metode = mysqli_real_escape_string($conn, $_POST['metode_pembayaran'] ?? '');
    $harga = 100000;

    if (!in_array($metode, ['QRIS', 'Bayar di Tempat'])) {
        $error = 'Pilih metode pembayaran terlebih dahulu.';
    } elseif ($data && in_array($data['status'], ['Menunggu Pembayaran', 'Aktif'])) {
        $error = 'Kamu sudah memiliki pengajuan atau membership aktif.';
    } else {
        $simpan = mysqli_query($conn, "INSERT INTO membership (id_user, metode_pembayaran, harga, status) VALUES ('$id_user', '$metode', '$harga', 'Menunggu Pembayaran')");
        if ($simpan) {
            // Tidak pakai alert "pembayaran berhasil", karena pembayaran belum diverifikasi admin.
            header("Location: membership.php?pengajuan=berhasil");
            exit;
        } else {
            $error = mysqli_error($conn);
        }
    }
}

// Ambil ulang data setelah kemungkinan proses daftar
$cek = mysqli_query($conn, "SELECT * FROM membership WHERE id_user='$id_user' ORDER BY id DESC LIMIT 1");
$data = $cek ? mysqli_fetch_assoc($cek) : null;

$pageTitle = 'Membership';
include 'includes/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="actions mb-3"><a class="btn btn-light" href="dashboard_user.php">← Dashboard</a></div>
        <h1 class="section-title">Membership Tahunan</h1>
        <p class="section-subtitle">Dengan membership tahunan Barbershop Kadir, pelanggan bisa mendapatkan diskon khusus member dan promo eksklusif.</p>

        <div class="grid grid-2" style="align-items:start;">
            <div class="card">
                <div class="card-body">
                    <span class="badge badge-primary mb-2">Rp100.000 / Tahun</span>
                    <h2 class="font-serif" style="font-size:2.4rem;margin:0 0 10px;">Benefit Member</h2>
                    <ul class="muted">
                        <li>Diskon 10% untuk pembelian produk.</li>
                        <li>Akses promo khusus pelanggan member.</li>
                        <li>Status berlaku selama 1 tahun setelah diaktifkan admin.</li>
                    </ul>
                    <p class="muted">Metode pembayaran tersedia melalui QRIS atau Bayar di Tempat.</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Status Membership</div>
                <div class="card-body">
                    <?php if ($error) { ?><div class="alert alert-danger"><?= htmlspecialchars($error); ?></div><?php } ?>
                    <?php if ($success) { ?><div class="alert alert-success">Pengajuan membership berhasil dibuat. Status masih menunggu pembayaran atau aktivasi admin.</div><?php } ?>

                    <?php if ($data) { ?>
                        <?php
                            $badgeClass = $data['status'] === 'Aktif' ? 'badge-success' : 'badge-warning';
                        ?>
                        <p><span class="badge <?= $badgeClass; ?>"><?= htmlspecialchars($data['status']); ?></span></p>
                        <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($data['metode_pembayaran']); ?></p>
                        <p><strong>Harga:</strong> Rp <?= number_format($data['harga'], 0, ',', '.'); ?></p>
                        <p><strong>Tanggal Mulai:</strong> <?= $data['tanggal_mulai'] ?: '-'; ?></p>
                        <p><strong>Tanggal Berakhir:</strong> <?= $data['tanggal_berakhir'] ?: '-'; ?></p>

                        <?php if ($data['status'] === 'Menunggu Pembayaran' && $data['metode_pembayaran'] === 'QRIS') { ?>
                            <div class="alert alert-info">
                                Silakan scan QRIS di bawah ini untuk pembayaran membership. Setelah membayar, admin akan mengaktifkan membership.
                            </div>
                            <div class="qris-box">
                                <img src="assets/img/qris-baru.png?v=2" alt="QRIS Barbershop Kadir">
                            </div>
                        <?php } elseif ($data['status'] === 'Menunggu Pembayaran' && $data['metode_pembayaran'] === 'Bayar di Tempat') { ?>
                            <div class="alert alert-info">
                                Pengajuan membership sudah dibuat. Silakan lakukan pembayaran Rp <?= number_format($data['harga'], 0, ',', '.'); ?> langsung di kasir Barbershop Kadir.
                            </div>
                        <?php } elseif ($data['status'] === 'Aktif') { ?>
                            <div class="alert alert-success">Membership kamu sudah aktif.</div>
                        <?php } ?>
                    <?php } else { ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metode_membership" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="Bayar di Tempat">Bayar di Tempat</option>
                                </select>
                            </div>

                            <div id="qrisMembershipPreview" class="qris-preview mb-3" style="display:none;">
                                <p class="muted"><strong>Scan QRIS setelah klik Daftar Membership.</strong></p>
                                <img src="assets/img/qris-baru.png?v=2" alt="QRIS Barbershop Kadir">
                            </div>

                            <button type="submit" name="daftar" class="btn btn-primary">Daftar Membership</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
const metodeMembership = document.getElementById('metode_membership');
const qrisMembershipPreview = document.getElementById('qrisMembershipPreview');
if (metodeMembership && qrisMembershipPreview) {
    metodeMembership.addEventListener('change', function () {
        qrisMembershipPreview.style.display = this.value === 'QRIS' ? 'block' : 'none';
    });
}
</script>

<?php include 'includes/footer.php'; ?>
