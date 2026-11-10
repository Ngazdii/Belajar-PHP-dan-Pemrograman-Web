<?php
class MahasiswaContoh {
    public string $nama = '';
    public float $nilai = 0;
    public function lulus(): bool {
        return $this->nilai >= 60;
    }
}
$budi = new MahasiswaContoh();
$budi->nama = 'Budi';
$budi->nilai = 80;
echo $budi->nama . ': ' . ($budi->lulus() ? 'Lulus' : 'Tidak lulus');