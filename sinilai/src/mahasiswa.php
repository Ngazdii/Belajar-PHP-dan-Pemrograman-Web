<?php
declare(strict_types=1);
namespace SiNilai;
use InvalidArgumentException;
class Mahasiswa {
    use ValidasiNilai;
    private string $nim;
    private string $nama;
    private float $tugas;
    private float $uts;
    private float $uas;
    private string $skema;
    public function __construct(string $nim, string $nama, float $tugas, float $uts, float $uas, string $skema = 'reguler') {
        $nim = trim($nim); $nama = trim($nama);
        if (!preg_match('/^[0-9]{7,15}$/D', $nim)) throw new InvalidArgumentException('NIM harus 7–15 digit.');
        if ($nama === '' || strlen($nama) > 100) throw new InvalidArgumentException('Nama wajib diisi, maksimal 100 byte.');
        $this->validasi($tugas, $uts, $uas);
        if (!in_array($skema, ['reguler', 'praktikum'], true)) throw new InvalidArgumentException('Skema tidak dikenal.');
        $this->nim = $nim; $this->nama = $nama;
        $this->tugas = $tugas; $this->uts = $uts; $this->uas = $uas; $this->skema = $skema;
    }
    public static function dariArray(array $data): self {
        $nilai = [];
        foreach (['tugas', 'uts', 'uas'] as $key) {
            $raw = teks($data, $key);
            if ($raw === '' || !is_numeric($raw)) throw new InvalidArgumentException('Nilai ' . $key . ' wajib berupa angka.');
            $nilai[$key] = (float) $raw;
        }
        return new self(teks($data, 'nim'), teks($data, 'nama'), $nilai['tugas'], $nilai['uts'], $nilai['uas'], teks($data, 'skema', 'reguler'));
    }
    public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; }
    public function getTugas(): float { return $this->tugas; }
    public function getUts(): float { return $this->uts; }
    public function getUas(): float { return $this->uas; }
    public function getSkema(): string { return $this->skema; }
}