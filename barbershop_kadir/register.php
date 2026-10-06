<?php
session_start();
include 'config/koneksi.php';

$error = '';
if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' LIMIT 1");
    if ($cek && mysqli_num_rows($cek) > 0) {
        $error = 'Username sudah digunakan.';
    } else {
        $simpan = mysqli_query($conn, "INSERT INTO users (nama,email,no_hp,username,password) VALUES ('$nama','$email','$no_hp','$username','$password')");
        if ($simpan) {
            echo "<script>alert('Registrasi berhasil. Silakan login.'); window.location='login.php';</script>";
            exit;
        } else {
            $error = mysqli_error($conn);
        }
    }
}

$pageTitle = 'Registrasi Pelanggan';
include 'includes/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="form-card">
            <h1 class="font-serif text-center" style="font-size:2.4rem;margin:0 0 8px;">Registrasi</h1>
            <p class="muted text-center mb-3">Buat akun pelanggan Barbershop Kadir.</p>

            <?php if ($error) { ?><div class="alert alert-danger"><?= htmlspecialchars($error); ?></div><?php } ?>

            <form method="POST">
                <div class="form-group"><label>Nama Lengkap</label><input type="text" name="nama" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
                <div class="form-group"><label>No HP</label><input type="text" name="no_hp" required></div>
                <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
                <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
                <button type="submit" name="register" class="btn btn-primary btn-block">Registrasi</button>
            </form>

            <p class="text-center muted mt-3">Sudah punya akun? <a style="color:var(--primary);font-weight:800;" href="login.php">Login</a></p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
