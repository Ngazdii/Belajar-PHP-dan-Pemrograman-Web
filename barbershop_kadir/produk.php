<?php
session_start();
include 'config/koneksi.php';

$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
if (!$produk) {
    die("Query produk gagal: " . mysqli_error($conn));
}

$pageTitle = 'Produk Barbershop';
include 'includes/header.php';
?>

<section class="page-section">
    <div class="container">
        <h1 class="section-title">Grooming Store</h1>
        <p class="section-subtitle">Lengkapi gayamu dengan produk perawatan rambut pria berkualitas dari Barbershop Kadir.</p>

        <div class="grid grid-3">
            <?php if (mysqli_num_rows($produk) === 0) { ?>
                <div class="card" style="grid-column:1/-1;"><div class="card-body text-center"><h3>Produk belum tersedia</h3><p class="muted">Admin dapat menambahkan produk melalui menu Kelola Produk.</p></div></div>
            <?php } ?>

            <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
                <div class="card product-card">
                    <span class="price-badge">Harga Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                    <img class="product-img" src="https://images.unsplash.com/photo-1631729371254-42c2892f0e6e?q=80&w=800&auto=format&fit=crop" alt="<?= htmlspecialchars($row['nama_produk']); ?>">
                    <div class="card-body">
                        <h3><?= htmlspecialchars($row['nama_produk']); ?></h3>
                        <p><strong>Harga:</strong> Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                        <p class="muted"><?= nl2br(htmlspecialchars($row['deskripsi'] ?: 'Produk perawatan rambut pria berkualitas.')); ?></p>
                        <p><span class="badge <?= $row['stok'] > 0 ? 'badge-success' : 'badge-danger'; ?>">Stok: <?= (int)$row['stok']; ?></span></p>
                        <?php if ($row['stok'] <= 0) { ?>
                            <span class="btn btn-light">Stok Habis</span>
                        <?php } elseif (isset($_SESSION['id_user'])) { ?>
                            <a class="btn btn-primary" href="beli.php?id=<?= (int)$row['id']; ?>">Beli Produk</a>
                        <?php } else { ?>
                            <a class="btn btn-secondary" href="login.php">Login untuk Beli</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
