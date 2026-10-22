<?php
$query = mysqli_query($koneksi, "SELECT * FROM halaman WHERE slug='profil'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    echo "<h2>" . htmlspecialchars($data['judul']) . "</h2>";
    
    // Tampilkan foto kalau file fotonya ada di folder uploads
    if (!empty($data['foto']) && file_exists('uploads/' . $data['foto'])) {
        echo "<p><img src='uploads/" . htmlspecialchars($data['foto']) . "' alt='Foto Profil' style='max-width: 100%; height: auto; border-radius: 6px; margin-bottom: 15px;'></p>";
    }
    
    echo "<div>" . $data['konten'] . "</div>";
} else {
    echo "<h2>Profil Kampus</h2><p>Konten belum diisi.</p>";
}
?>