-- Database untuk Sistem Informasi Barbershop Kadir
CREATE DATABASE IF NOT EXISTS barbershop_kadir;
USE barbershop_kadir;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  no_hp VARCHAR(30) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password)
SELECT 'admin', 'admin123'
WHERE NOT EXISTS (SELECT 1 FROM admin WHERE username='admin');

CREATE TABLE IF NOT EXISTS produk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_produk VARCHAR(100) NOT NULL,
  harga INT NOT NULL,
  stok INT NOT NULL DEFAULT 0,
  deskripsi TEXT NULL
);

CREATE TABLE IF NOT EXISTS transaksi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_user INT NOT NULL,
  id_produk INT NOT NULL,
  nama_pembeli VARCHAR(100) NULL,
  no_hp VARCHAR(30) NULL,
  alamat TEXT NULL,
  jumlah INT NOT NULL,
  total_harga INT NOT NULL,
  metode_pembayaran ENUM('QRIS','Bayar di Tempat') NOT NULL DEFAULT 'Bayar di Tempat',
  tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS membership (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_user INT NOT NULL,
  metode_pembayaran ENUM('QRIS','Bayar di Tempat') NOT NULL,
  harga INT NOT NULL DEFAULT 100000,
  tanggal_mulai DATE NULL,
  tanggal_berakhir DATE NULL,
  status ENUM('Menunggu Pembayaran','Aktif') DEFAULT 'Menunggu Pembayaran'
);


-- Tambahan untuk database lama yang tabel transaksinya belum memiliki kolom identitas dan metode pembayaran
ALTER TABLE transaksi ADD COLUMN IF NOT EXISTS nama_pembeli VARCHAR(100) NULL AFTER id_produk;
ALTER TABLE transaksi ADD COLUMN IF NOT EXISTS no_hp VARCHAR(30) NULL AFTER nama_pembeli;
ALTER TABLE transaksi ADD COLUMN IF NOT EXISTS alamat TEXT NULL AFTER no_hp;
ALTER TABLE transaksi ADD COLUMN IF NOT EXISTS metode_pembayaran ENUM('QRIS','Bayar di Tempat') NOT NULL DEFAULT 'Bayar di Tempat' AFTER total_harga;
