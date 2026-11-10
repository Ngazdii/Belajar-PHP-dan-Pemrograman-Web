<?php
declare(strict_types=1);
namespace SiNilai;
use InvalidArgumentException;
final class Nilai {
    public const BATAS_LULUS = 60;
    public static function grade(float $nilai): string {
        if (!is_finite($nilai) || $nilai < 0 || $nilai > 100) throw new InvalidArgumentException('Hasil penilaian tidak valid.');
        if ($nilai >= 85) return 'A';
        if ($nilai >= 75) return 'B';
        if ($nilai >= self::BATAS_LULUS) return 'C';
        if ($nilai >= 50) return 'D';
        return 'E';
    }
}