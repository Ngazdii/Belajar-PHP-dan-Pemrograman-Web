<?php
declare(strict_types=1);
namespace SiNilai;
use InvalidArgumentException;
final class PenilaianReguler extends PenilaianDasar {
    protected function bobot(): array { return [0.4, 0.3, 0.3]; }
}