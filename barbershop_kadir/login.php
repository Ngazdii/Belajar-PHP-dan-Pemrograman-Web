<?php
session_start();
include 'config/koneksi.php';

if (isset($_SESSION['id_user'])) {
    header("Location: dashboard_user.php");
    exit;
}

$error = '';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' LIMIT 1");

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        if (password_verify($password, $data['password'])) {
            $_SESSION['id_user'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['username'] = $data['username'];
            header("Location: dashboard_user.php");
            exit;
        } else {
            $error = 'Password salah.';
        }
    } else {
        $error = 'Username tidak ditemukan.';
    }
}

$pageTitle = 'Login Pelanggan';
include 'includes/header.php';
?>

<section class="page-section">
    <div class="container">
        <div class="form-card">
            <h1 class="font-serif text-center" style="font-size:2.4rem;margin:0 0 8px;">Login Pelanggan</h1>
            <p class="muted text-center mb-3">Masuk untuk membeli produk, melihat riwayat, dan mengelola membership.</p>

            <?php if ($error) { ?><div class="alert alert-danger"><?= htmlspecialchars($error); ?></div><?php } ?>

            <form method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </form>

            <p class="text-center muted mt-3">Belum punya akun? <a style="color:var(--primary);font-weight:800;" href="register.php">Registrasi</a></p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
