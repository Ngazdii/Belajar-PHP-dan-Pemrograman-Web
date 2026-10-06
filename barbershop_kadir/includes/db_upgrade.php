<?php
if (!function_exists('ensure_transaksi_extra_columns')) {
    function ensure_transaksi_extra_columns($conn) {
        $columns = [
            'nama_pembeli' => "ALTER TABLE transaksi ADD COLUMN nama_pembeli VARCHAR(100) NULL AFTER id_produk",
            'no_hp' => "ALTER TABLE transaksi ADD COLUMN no_hp VARCHAR(30) NULL AFTER nama_pembeli",
            'alamat' => "ALTER TABLE transaksi ADD COLUMN alamat TEXT NULL AFTER no_hp",
            'metode_pembayaran' => "ALTER TABLE transaksi ADD COLUMN metode_pembayaran ENUM('QRIS','Bayar di Tempat') NOT NULL DEFAULT 'Bayar di Tempat' AFTER total_harga"
        ];

        foreach ($columns as $column => $alterSql) {
            $check = mysqli_query($conn, "SHOW COLUMNS FROM transaksi LIKE '$column'");
            if ($check && mysqli_num_rows($check) == 0) {
                mysqli_query($conn, $alterSql);
            }
        }
    }
}
?>
