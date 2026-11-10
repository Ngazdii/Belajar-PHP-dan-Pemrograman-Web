<?php
declare(strict_types=1);
namespace SiNilai;
use InvalidArgumentException;
trait ValidasiNilai {
    protected function validasi(float ...$daftar): void {
        foreach ($daftar as $nilai) {
            if (!is_finite($nilai) || $nilai < 0 || $nilai > 100) throw new InvalidArgumentException('Nilai harus 0–100.');
        }
    }
}