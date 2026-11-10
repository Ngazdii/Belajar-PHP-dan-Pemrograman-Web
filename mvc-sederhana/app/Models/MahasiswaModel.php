<?php
namespace App\Models;

class MahasiswaModel {
    public function getDataMahasiswa(): array {
        // Simulasi data dari database
        return [
            ["nama" => "Budi Santoso", "nim" => "M012022001", "jurusan" => "Teknik Informatika"],
            ["nama" => "Siti Aminah", "nim" => "M012022002", "jurusan" => "Sistem Informasi"],
            ["nama" => "Joko Anwar", "nim" => "M012022003", "jurusan" => "Teknik Komputer"]
        ];
    }
}
?>