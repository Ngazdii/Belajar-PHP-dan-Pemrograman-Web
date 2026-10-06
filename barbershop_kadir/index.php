<?php
session_start();
$pageTitle = 'Barbershop Kadir - Grooming Premium';
include 'includes/header.php';
?>

<section class="hero">
    <div class="container hero-grid">
        <div>
            <span class="eyebrow">✂️ Classic cut, modern style</span>
            <h1>Barbershop Kadir</h1>
            <p>Sistem informasi membership, penjualan produk grooming, dan booking layanan via WhatsApp untuk Barbershop Kadir.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="produk.php">Lihat Produk</a>
                <a class="btn btn-light" href="#booking">Booking via WhatsApp</a>
                <?php if (!isset($_SESSION['id_user'])) { ?>
                    <a class="btn btn-secondary" href="register.php">Daftar Akun</a>
                <?php } ?>
            </div>
        </div>
        <div class="hero-card">
            <img src="https://images.unsplash.com/photo-1622286342621-4bd786c2447c?q=80&w=900&auto=format&fit=crop" alt="Barbershop Kadir">
            <div class="stat-grid">
                <div class="stat"><strong>2</strong><span class="muted">Kapster</span></div>
                <div class="stat"><strong>10%</strong><span class="muted">Diskon Member</span></div>
                <div class="stat"><strong>WA</strong><span class="muted">Booking</span></div>
            </div>
        </div>
    </div>
</section>

<section class="page-section">
    <div class="container">
        <h2 class="section-title">Layanan Utama</h2>
        <p class="section-subtitle">Pilih layanan grooming yang tersedia di Barbershop Kadir. Untuk pemesanan antrean, pelanggan diarahkan melalui WhatsApp.</p>

        <div class="grid grid-3">
            <div class="card product-card">
                <img class="product-img" src="https://images.unsplash.com/photo-1622286342621-4bd786c2447c?q=80&w=700&auto=format&fit=crop" alt="Haircut">
                <div class="card-body">
                    <span class="badge badge-primary mb-2">Mulai Rp40.000</span>
                    <h3>Haircut</h3>
                    <p class="muted">Potongan rambut rapi sesuai gaya pelanggan, dilengkapi finishing styling.</p>
                </div>
            </div>
            <div class="card product-card">
                <img class="product-img" src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=700&auto=format&fit=crop" alt="Shaving">
                <div class="card-body">
                    <span class="badge badge-primary mb-2">Mulai Rp20.000</span>
                    <h3>Shaving</h3>
                    <p class="muted">Cukur kumis atau jenggot agar tampilan lebih bersih dan profesional.</p>
                </div>
            </div>
            <div class="card product-card">
                <img class="product-img" src="https://images.unsplash.com/photo-1559599101-f09722fb4948?q=80&w=700&auto=format&fit=crop" alt="Creambath">
                <div class="card-body">
                    <span class="badge badge-primary mb-2">Mulai Rp50.000</span>
                    <h3>Creambath</h3>
                    <p class="muted">Perawatan rambut dan pijat kepala untuk pengalaman grooming yang lebih nyaman.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="booking" class="page-section" style="background:#fff;border-top:1px solid var(--border);border-bottom:1px solid var(--border);">
    <div class="container grid grid-2" style="align-items:center;">
        <div>
            <h2 class="section-title" style="text-align:left;">Booking Layanan</h2>
            <p class="muted">Sesuai rancangan sistem, booking layanan diarahkan melalui WhatsApp agar pelanggan bisa langsung konfirmasi jadwal dengan pihak barbershop.</p>
            <div class="actions mt-3">
                <a class="btn btn-success" target="_blank" href="https://wa.me/62081220579728?text=Halo%20Barbershop%20Kadir,%20saya%20ingin%20booking%20layanan.">Booking via WhatsApp</a>
                <a class="btn btn-secondary" href="membership.php">Lihat Membership</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Alamat</h3>
                <p class="muted">Jl. Tribrata, Klitren<br>Kec. Gondokusuman, Yogyakarta</p>
                <h3>Kontak</h3>
                <p><a class="btn btn-light" target="_blank" href="https://wa.me/62081220579728">+62 812-2057-9728</a></p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
