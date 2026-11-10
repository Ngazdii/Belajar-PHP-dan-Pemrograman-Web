<?php
declare(strict_types=1);
namespace SiNilai;
use InvalidArgumentException;
final class PenilaianPraktikum extends PenilaianDasar {
    protected function bobot(): array { return [0.6, 0.2, 0.2]; }
}