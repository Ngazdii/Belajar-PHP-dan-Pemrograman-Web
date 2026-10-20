<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Website Dinamis & MySQLi</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
    header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
    nav { background: #34495e; padding: 10px; text-align: center; }
    nav a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
    nav a:hover { color: #1abc9c; text-decoration: underline; }
    .container { max-width: 800px; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); min-height: 250px; }
    footer { text-align: center; padding: 15px; background: #2c3e50; color: white; margin-top: 40px; font-size: 13px; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background-color: #2c3e50; color: white; }
  </style>
</head>
<body>

  <header>
    <h1 style="margin:0;">Portal Akademik Kampus Nusantara</h1>
  </header>

  <nav>
    <a href="index.php?modul=beranda">Beranda</a>
    <a href="index.php?modul=profil">Profil Kampus</a>
    <a href="index.php?modul=mahasiswa">Data Mahasiswa (MySQLi)</a>
    <a href="index.php?modul=kontak">Kontak</a>
  </nav>

  <div class="container">