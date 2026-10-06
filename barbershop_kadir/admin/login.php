<?php
session_start();
include '../config/koneksi.php';

if (isset($_SESSION['id_admin'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' LIMIT 1");
    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        if ($password === $data['password'] || password_verify($password, $data['password'])) {
            $_SESSION['id_admin'] = $data['id'];
            $_SESSION['username_admin'] = $data['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = 'Password salah.';
        }
    } else {
        $error = 'Username admin tidak ditemukan.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<section class="hero" style="min-height:100vh;">
    <div class="container">
        <div class="form-card">
            <h1 class="font-serif text-center" style="font-size:2.4rem;margin:0 0 8px;">Login Admin</h1>
            <p class="muted text-center mb-3">Masuk ke dashboard pengelolaan Barbershop Kadir.</p>
            <?php if ($error) { ?><div class="alert alert-danger"><?= htmlspecialchars($error); ?></div><?php } ?>
            <form method="POST">
                <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
                <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
                <button type="submit" name="login" class="btn btn-dark btn-block">Login Admin</button>
            </form>
            <p class="text-center muted mt-3"><a style="color:var(--primary);font-weight:800;" href="../index.php">← Kembali ke Website</a></p>
        </div>
    </div>
</section>
</body>
</html>
