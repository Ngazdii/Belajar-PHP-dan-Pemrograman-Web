<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #2980b9; color: white; }
    </style>
</head>
<body>
    <h2>Data Mahasiswa (MVC Sederhana)</h2>
    <p>Berikut adalah daftar mahasiswa yang diambil melalui arsitektur MVC:</p>
    <table>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Jurusan</th>
        </tr>
        <?php $no = 1; foreach ($data as $mhs): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $mhs['nim']; ?></td>
            <td><?= $mhs['nama']; ?></td>
            <td><?= $mhs['jurusan']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>