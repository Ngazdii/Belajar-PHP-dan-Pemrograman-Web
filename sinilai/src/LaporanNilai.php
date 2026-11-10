<?php
declare(strict_types=1);
namespace SiNilai;
use InvalidArgumentException;
final class LaporanNilai {
    private Penilaian $strategi;
    public function __construct(Penilaian $strategi) { $this->strategi = $strategi; }
    public function buat(Mahasiswa $m): array {
        $akhir = $this->strategi->hitung($m->getTugas(), $m->getUts(), $m->getUas());
        $grade = Nilai::grade($akhir);
        return ['nim'=>$m->getNim(), 'nama'=>$m->getNama(), 'skema'=>$m->getSkema(),
            'tugas'=>$m->getTugas(), 'uts'=>$m->getUts(), 'uas'=>$m->getUas(),
            'akhir'=>$akhir, 'grade'=>$grade, 'status'=>$akhir >= Nilai::BATAS_LULUS ? 'Lulus' : 'Tidak lulus'];
    }
}