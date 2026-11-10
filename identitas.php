<?php
class IdentitasContoh {
    public string $nama = '';
}
$pertama = new IdentitasContoh();
$kedua = new IdentitasContoh();
$ketiga = new IdentitasContoh();
$pertama->nama = 'Budi';
$kedua->nama = 'Siti';
$ketiga->nama = 'Asep';
echo $pertama->nama . ', ' . $kedua->nama . ', dan ' . $ketiga->nama;