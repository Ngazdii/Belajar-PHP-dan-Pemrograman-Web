<?php
require_once 'koneksi.php';
include 'header.php';

$modul =$_GET['modul'] ?? 'beranda';

// Menambahkan modul CRUD ke dalam daftar yang diizinkan
$allowedModules = [
    'beranda', 
    'profil', 
    'mahasiswa', 
    'mahasiswa_tambah', 
    'mahasiswa_edit', 
    'mahasiswa_hapus', 
    'kontak'
];

if (in_array($modul,$allowedModules)) {
    $fileTujuan = "pages/" . $modul . ".php";
    
    if (file_exists($fileTujuan)) {
        include $fileTujuan;
    } else {
        echo "<p style='color:red;'>Berkas konten <code>{$modul}.php</code> tidak ditemukan.</p>";
    }
} else {
    echo "<h2 style='color:red;'>Error 404: Halaman Tidak Ditemukan!</h2>";
    echo "<p>Modul yang Anda minta tidak terdaftar dalam sistem.</p>";
}

include 'footer.php';
?>