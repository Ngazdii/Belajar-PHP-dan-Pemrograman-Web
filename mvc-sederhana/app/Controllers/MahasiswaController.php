<?php
namespace App\Controllers;

use App\Models\MahasiswaModel;

class MahasiswaController {
    public function indeks() {
        // 1. Instansiasi Model dan ambil datanya
        $model = new MahasiswaModel();
        $data = $model->getDataMahasiswa();

        // 2. Kirim data ke file View untuk ditampilkan
        require_once __DIR__ . '/../Views/mahasiswa_view.php';
    }
}
?>