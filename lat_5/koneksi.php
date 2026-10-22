<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_akademik_mhs";

// Membuat koneksi menggunakan MySQLi Prosedural
$koneksi = mysqli_connect($host, $username, $password, $dbname);

// Periksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>