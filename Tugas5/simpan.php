
<?php
include "koneksi.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$prodi = $_POST['prodi'];
$angkatan = $_POST['angkatan'];
$ipk = $_POST['ipk'];

if ($ipk < 0 || $ipk > 4) {
    $pesan = "IPK harus antara 0 sampai 4.";
    $warna = "#dc3545";
} else {
    $query = mysqli_query(
        $koneksi,
        "INSERT INTO mahasiswa
        (nim, nama, email, prodi, angkatan, ipk)
        VALUES
        ('$nim', '$nama', '$email', '$prodi', '$angkatan', '$ipk')"
    );

    if ($query) {
        $pesan = "Data mahasiswa berhasil disimpan!";
        $warna = "#198754";
    } else {
        $pesan = "Data gagal disimpan. NIM mungkin sudah terdaftar.";
        $warna = "#dc3545";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Penyimpanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5eeee;
            text-align: center;
            padding-top: 100px;
        }

        .card {
            background: white;
            width: 350px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px #ddd;
        }

        h2 {
            color: <?= $warna ?>;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #4e0e0e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Hasil Penyimpanan</h2>
    <p><?= htmlspecialchars($pesan) ?></p>
    <a href="form.php">Kembali ke Form</a>
</div>

</body>
</html>
