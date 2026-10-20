<?php
$slug = 'beranda';
$stmt = mysqli_prepare($conn, 'SELECT judul, konten FROM halaman WHERE slug = ? LIMIT 1');

if (!$stmt) {
    echo '<p style="color:red;">Gagal menyiapkan query halaman: ' . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, 'UTF-8') . '</p>';
    return;
}

mysqli_stmt_bind_param($stmt, 's', $slug);

if (!mysqli_stmt_execute($stmt)) {
    echo '<p style="color:red;">Gagal memuat halaman: ' . htmlspecialchars(mysqli_stmt_error($stmt), ENT_QUOTES, 'UTF-8') . '</p>';
    mysqli_stmt_close($stmt);
    return;
}

$result = mysqli_stmt_get_result($stmt);
$halaman = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$halaman) {
    echo '<p style="color:red;">Konten beranda belum tersedia di database.</p>';
    return;
}
?>

<h2 style="color:#2c3e50; margin-top:0;"><?php echo htmlspecialchars($halaman['judul'], ENT_QUOTES, 'UTF-8'); ?></h2>
<center>
<p><img src="https://cdn.idntimes.com/content-images/post/20200522/10-47bdb0cfd5fb22088e1edc1716835154.JPG" alt="<?php echo htmlspecialchars($halaman['judul'], ENT_QUOTES, 'UTF-8'); ?>"></p>
</center>
<p><?php echo nl2br(htmlspecialchars($halaman['konten'], ENT_QUOTES, 'UTF-8')); ?></p>
