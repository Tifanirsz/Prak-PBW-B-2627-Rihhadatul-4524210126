<?php 
require_once 'koneksi.php'; 
 
mysqli_select_db($koneksi, 'akademik'); 


// =========================================
// 0. TAMBAH 2 TABEL BARU
// =========================================

echo "=== 0. MEMBUAT 2 TABEL BARU ===\n";

// Tabel 1: alamat mahasiswa
$sqlTabel1 = "CREATE TABLE IF NOT EXISTS alamat_mahasiswa (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_id BIGINT UNSIGNED NOT NULL,
    alamat VARCHAR(200) NOT NULL,
    kota VARCHAR(50) NOT NULL,
    CONSTRAINT fk_alamat_mahasiswa
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB";

if (mysqli_query($koneksi, $sqlTabel1)) {
    echo "Tabel alamat_mahasiswa berhasil dibuat atau sudah ada.\n";
} else {
    echo "Gagal membuat tabel alamat_mahasiswa: " . mysqli_error($koneksi) . "\n";
}


// Tabel 2: nilai mahasiswa
$sqlTabel2 = "CREATE TABLE IF NOT EXISTS nilai_mahasiswa (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_id BIGINT UNSIGNED NOT NULL,
    mata_kuliah_id BIGINT UNSIGNED NOT NULL,
    nilai DECIMAL(5,2) NOT NULL,
    CONSTRAINT fk_nilai_mahasiswa
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    CONSTRAINT fk_nilai_mk
    FOREIGN KEY (mata_kuliah_id) REFERENCES mata_kuliah(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB";

if (mysqli_query($koneksi, $sqlTabel2)) {
    echo "Tabel nilai_mahasiswa berhasil dibuat atau sudah ada.\n\n";
} else {
    echo "Gagal membuat tabel nilai_mahasiswa: " . mysqli_error($koneksi) . "\n\n";
}


// =========================================
// 1. UPDATE: Mengubah data IPK
// =========================================

echo "=== 1. PROSES UPDATE DATA ===\n"; 

$sqlUpdate = "UPDATE mahasiswa 
              SET ipk = 3.40 
              WHERE nim = '2025003'"; 

if (mysqli_query($koneksi, $sqlUpdate)) { 
    echo "Data IPK mahasiswa dengan NIM 2025003 berhasil diubah menjadi 3.40.\n\n"; 
} else { 
    echo "Gagal UPDATE: " . mysqli_error($koneksi) . "\n\n"; 
} 


// =========================================
// 2. SELECT & GROUP BY: Rekap jumlah mahasiswa per prodi
// =========================================

echo "=== 2. REKAP MAHASISWA PER PRODI ===\n"; 

$sqlRekap = "SELECT prodi, COUNT(*) AS jumlah, ROUND(AVG(ipk),2) AS rata_ipk 
FROM mahasiswa 
GROUP BY prodi 
ORDER BY jumlah DESC"; 
 
$resultRekap = mysqli_query($koneksi, $sqlRekap); 
 
if (mysqli_num_rows($resultRekap) > 0) { 
    while ($row = mysqli_fetch_assoc($resultRekap)) { 
        echo "Prodi         : " . $row['prodi'] . "\n";
        echo "Jumlah        : " . $row['jumlah'] . "\n";
        echo "Rata-rata IPK : " . $row['rata_ipk'] . "\n"; 
        echo "----------------------------------------\n"; 
    } 
} else { 
    echo "Belum ada data rekap prodi.\n"; 
} 

echo "\n"; 


// =========================================
// 3. SELECT: Verifikasi sebelum penghapusan
// =========================================

echo "=== 3. VERIFIKASI DATA (NIM 2025003) ===\n"; 

$sqlVerifikasi = "SELECT * 
                   FROM mahasiswa 
                   WHERE nim = '2025003'"; 

$resultVerifikasi = mysqli_query($koneksi, $sqlVerifikasi); 
 
if (mysqli_num_rows($resultVerifikasi) > 0) { 

    $row = mysqli_fetch_assoc($resultVerifikasi); 

    echo "Data Ditemukan!\n"; 
    echo "NIM   : " . $row['nim'] . "\n"; 
    echo "Nama  : " . $row['nama'] . "\n"; 
    echo "IPK   : " . $row['ipk'] . "\n\n"; 


    // =========================================
    // 4. DELETE: Menghapus data
    // =========================================

    echo "=== 4. PROSES HAPUS DATA ===\n"; 

    $sqlDelete = "DELETE FROM mahasiswa 
                  WHERE nim = '2025003'"; 

    if (mysqli_query($koneksi, $sqlDelete)) { 
        echo "[SUKSES] Data mahasiswa dengan NIM 2025003 berhasil dihapus dari database.\n"; 
    } else { 
        echo "[ERROR] Gagal menghapus data: " . mysqli_error($koneksi) . "\n"; 
    } 

} else { 

    echo "Data mahasiswa dengan NIM 2025003 TIDAK DITEMUKAN 
    (Mungkin sudah terhapus sebelumnya).\n"; 
} 


mysqli_close($koneksi); 

?>