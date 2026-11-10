<?php
declare(strict_types=1);
namespace SiNilai;
use InvalidArgumentException;
interface Penilaian {
    public function hitung(float $tugas, float $uts, float $uas): float;
}