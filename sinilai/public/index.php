<?php
declare(strict_types=1);
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../autoload.php';
use SiNilai\Mahasiswa;
use SiNilai\PenilaianReguler;
use SiNilai\PenilaianPraktikum;
use SiNilai\LaporanNilai;
$data = ['nim'=>'','nama'=>'','tugas'=>'','uts'=>'','uas'=>'','skema'=>'reguler'];
$error = ''; $hasil = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    try {
        foreach (array_keys($data) as $key) $data[$key] = teks($_POST, $key, $data[$key]);
        $m = Mahasiswa::dariArray($data);
        $strategi = $m->getSkema() === 'reguler' ? new PenilaianReguler() : new PenilaianPraktikum();
        $laporan = new LaporanNilai($strategi);
        $hasil = $laporan->buat($m);
    } catch (InvalidArgumentException $ex) {
        $error = $ex->getMessage();
    }
}
require __DIR__ . '/../views/kalkulator.php';