<?php
// Autoloader sederhana untuk memanggil kelas otomatis berdasarkan Namespace
spl_autoload_register(function ($class) {
    // Ubah namespace App\Controllers\... menjadi path folder app/Controllers/...
    $file = __DIR__ . '/app/' . str_replace(['App\\', '\\'], ['', '/'], $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Jalankan Controller dan Method yang diinginkan
use App\Controllers\MahasiswaController;

$controller = new MahasiswaController();
$controller->indeks();
?>