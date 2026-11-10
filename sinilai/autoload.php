<?php
declare(strict_types=1);
spl_autoload_register(function (string $class): void {
    $prefix = 'SiNilai\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) return;
    $relative = substr($class, strlen($prefix));
    $file = __DIR__ . '/src/' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($file)) require_once $file;
});