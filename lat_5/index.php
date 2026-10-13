<?php
// 1. Memuat komponen layout bagian atas
include 'header.php';

// 2. Menangkap parameter 'modul' dari URL (Default ke 'beranda' jika kosong)
$modul = $_GET['modul'] ?? 'beranda';

// 3. Menerapkan Whitelisting demi Keamanan (Cegah LFI Vulnerability)
$allowedModules = ['beranda', 'profil', 'mahasiswa', 'kontak'];

if (in_array($modul, $allowedModules)) {
    $fileTujuan = "pages/" . $modul . ".php";
    
    // Pastikan file benar-benar ada sebelum di-include
    if (file_exists($fileTujuan)) {
        include $fileTujuan;
    } else {
        echo "<p style='color:red;'>Maaf, berkas konten <code>{$modul}.php</code> belum dibuat.</p>";
    }
} else {
    // Tampilan jika modul tidak terdaftar dalam whitelist (Error 404)
    echo "<h2 style='color:red;'>Error 404: Halaman Tidak Ditemukan!</h2>";
    echo "<p>Maaf, halaman yang Anda akses melalui parameter URL tidak tersedia.</p>";
}

// 4. Memuat komponen layout bagian bawah
include 'footer.php';
?>