<?php
declare(strict_types=1);
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function teks(array $data, string $key, string $default = ''): string {
    $value = $data[$key] ?? $default;
    if (!is_string($value)) throw new InvalidArgumentException('Format ' . $key . ' tidak valid.');
    return trim($value);
}