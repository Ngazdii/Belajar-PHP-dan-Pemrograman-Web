CARA PASANG PROJECT BARBERSHOP KADIR DI LOCALHOST

1. Ekstrak folder barbershop_kadir ke:
   C:\xampp\htdocs\barbershop_kadir

2. Jalankan XAMPP:
   - Start Apache
   - Start MySQL

3. Buka phpMyAdmin, buat database:
   barbershop_kadir

4. Import file SQL:
   database/barbershop_kadir.sql

5. Buka website:
   http://localhost/barbershop_kadir/

6. Login admin:
   Username: admin
   Password: admin123

Catatan:
- UI Replit sudah dikonversi menjadi tampilan PHP Native.
- Backend PHP + MySQL tetap dipakai.
- Booking layanan diarahkan ke WhatsApp.
- Membership harus diaktifkan melalui admin.

UPDATE TERBARU:
- Form beli produk sekarang meminta nama pembeli, no. HP/WhatsApp, alamat, jumlah, dan metode pembayaran.
- Metode pembayaran pembelian produk: QRIS atau Bayar di Tempat.
- QRIS sudah diganti memakai gambar yang diberikan user.
- Halaman produk sudah menampilkan label harga secara jelas.
- Jika database lama sudah dipakai, sistem akan otomatis menambahkan kolom transaksi yang dibutuhkan saat halaman beli/transaksi dibuka.
