<?php
class LabelContoh {
    private string $teks;
    public function __construct(string $teks) {
        if (trim($teks) === '') throw new InvalidArgumentException('Teks wajib diisi.');
        $this->teks = trim($teks);
    }
    public static function dariArray(array $data): self {
        if (!isset($data['teks']) || !is_string($data['teks'])) {
            throw new InvalidArgumentException('Format teks tidak valid.');
        }
        return new self($data['teks']);
    }
    public function getTeks(): string { return $this->teks; }
}
echo LabelContoh::dariArray(['teks'=>'Laporan Nilai'])->getTeks();