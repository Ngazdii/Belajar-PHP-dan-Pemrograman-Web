<?php

class Alamat {
    public $kota = "Yogyakarta";
}

class Mahasiswa {
    public $nama;
    public $alamatObj; // Properti berupa referensi objek lain

    public function __construct($nama, $alamat) {
        $this->nama = $nama;
        $this->alamatObj = $alamat;
    }
}

// Buat objek asli
$alamatAsli = new Alamat();
$mhs1 = new Mahasiswa("Budi", $alamatAsli);

// Lakukan Shallow Copy menggunakan clone
$mhs2 = clone $mhs1;

// Mengubah nama (properti primitif/level pertama pada mhs2)
$mhs2->nama = "Siti"; 

// Mengubah kota di dalam objek alamat melalui mhs2
$mhs2->alamatObj->kota = "Bandung";

// HASILNYA:
echo $mhs1->nama;             // Output: Budi (Aman, terpisah)
echo $mhs1->alamatObj->kota;  // Output: Bandung (IKUT BERUBAH!)