<?php
require_once 'koneksi.php';

mysqli_select_db($koneksi, 'akademik');

$sqlInsert = "INSERT IGNORE INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES
('2026001', 'Andi Pratama', 'Andi@kampus.ac.id', 'Teknik Informatika', 2026, 3.5),
('2026002', 'Siti Rahma', 'siti@kampus.ac.id', 'Sistem Informasi', 2026, 3.82),
('2026003', 'Budi Santoso', 'budi@kampus.ac.id', 'Teknik Informatika', 2026, 3.20)";

if (mysqli_query($koneksi, $sqlInsert)) {
    echo "[INSERT] Data mahasiswa berhasil dimasukkan ke tabel.\n\n";
} else {
    echo "[INSERT] Gagal memasukkan data: " . mysqli_error($koneksi) . "\n\n";
}

$sqlSelect = "SELECT nim, nama, prodi, ipk
FROM mahasiswa
WHERE ipk >= 3.50
ORDER BY ipk DESC, nama ASC
LIMIT 10";

$result = mysqli_query($koneksi, $sqlSelect);

echo "--- HASIL QUERY SELECT ---\n";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "NIM   : " . $row['nim'] . "\n";
        echo "Nama  : " . $row['nama'] . "\n";
        echo "Prodi : " . $row['prodi'] . "\n";
        echo "IPK   : " . $row['ipk'] . "\n";
    }
} else {
    echo "Tidak ada data mahasiswa dengan kriteria tersebut. \n";
}

mysqli_close($koneksi);