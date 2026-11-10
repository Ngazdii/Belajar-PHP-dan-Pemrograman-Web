<?php
declare(strict_types=1);
namespace SiNilai;
use InvalidArgumentException;
abstract class PenilaianDasar implements Penilaian {
    use ValidasiNilai;
    abstract protected function bobot(): array;
    final public function hitung(float $tugas, float $uts, float $uas): float {
        $this->validasi($tugas, $uts, $uas);
        [$a, $b, $c] = $this->bobot();
        return $tugas * $a + $uts * $b + $uas * $c;
    }
}