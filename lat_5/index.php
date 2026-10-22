<?php
session_start();
require_once 'koneksi.php';

$modul = $_GET['modul'] ?? 'beranda';

// Modul yang diizinkan
$allowedModules = [
    'beranda', 
    'profil', 
    'mahasiswa', 
    'mahasiswa_tambah', 
    'mahasiswa_edit', 
    'mahasiswa_hapus', 
    'kontak',
    'login',
    'logout',
    'admin_halaman', 
    'admin_konten'
];

// Modul terproteksi khusus admin
$protectedModules = [
    'mahasiswa', 
    'mahasiswa_tambah', 
    'mahasiswa_edit', 
    'mahasiswa_hapus',
    'admin_halaman', 
    'admin_konten'
];

if (in_array($modul, $protectedModules) && (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true)) {
    echo "<script>alert('Akses ditolak! Silakan login terlebih dahulu.'); window.location='index.php?modul=login';</script>";
    exit;
}

include 'header.php';

if (in_array($modul, $allowedModules)) {
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