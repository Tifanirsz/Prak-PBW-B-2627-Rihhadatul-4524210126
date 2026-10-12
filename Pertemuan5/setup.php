<?php
include "koneksi.php";

$sql = "CREATE TABLE IF NOT EXISTS mahasiswa (
    nim VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    prodi VARCHAR(100) NOT NULL,
    angkatan INT NOT NULL,
    ipk DECIMAL(3,2) NOT NULL
)";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "Tabel mahasiswa berhasil dibuat";
} else {
    echo "Tabel mahasiswa gagal dibuat: " . mysqli_error($koneksi);
}
?>