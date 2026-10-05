<?php 
require_once 'koneksi.php'; 
 
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS akademik"; 
 
if (mysqli_query($koneksi, $sqlCreateDB)){ 
    echo "Database berhasil dibuat atau sudah ada.<br>"; 
} else { 
    echo "Error membuat database: " . mysqli_error($koneksi) . "<br>"; 
} 
 
mysqli_set_charset($koneksi, "utf8mb4"); 
 
mysqli_select_db($koneksi, 'akademik'); 
 
$sqlCreateTables = [ 
    "CREATE TABLE IF NOT EXISTS mahasiswa ( 
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        nim VARCHAR(15) NOT NULL UNIQUE, 
        nama VARCHAR(100) NOT NULL, 
        email VARCHAR(120) NOT NULL UNIQUE, 
        prodi VARCHAR(80) NOT NULL, 
        angkatan YEAR NOT NULL, 
        ipk DECIMAL(3,2) DEFAULT 0.00 
    ) ENGINE=InnoDB", 
 
    "CREATE TABLE IF NOT EXISTS dosen ( 
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        nidn VARCHAR(20) NOT NULL UNIQUE, 
        nama VARCHAR(100) NOT NULL, 
        email VARCHAR(120) NOT NULL UNIQUE 
    ) ENGINE=InnoDB", 
 
    "CREATE TABLE IF NOT EXISTS mata_kuliah ( 
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        kode_mk VARCHAR(12) NOT NULL UNIQUE, 
        nama_mk VARCHAR(100) NOT NULL, 
        sks TINYINT UNSIGNED NOT NULL, 
        dosen_id BIGINT UNSIGNED, 
        CONSTRAINT fk_mk_dosen 
        FOREIGN KEY (dosen_id) REFERENCES dosen(id) 
        ON UPDATE CASCADE 
        ON DELETE SET NULL 
    ) ENGINE=InnoDB", 
 
    "CREATE TABLE IF NOT EXISTS krs ( 
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        mahasiswa_id BIGINT UNSIGNED NOT NULL, 
        semester TINYINT UNSIGNED NOT NULL, 
        tahun_ajaran VARCHAR(9) NOT NULL, 
        CONSTRAINT fk_krs_mahasiswa 
        FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE 
    ) ENGINE=InnoDB", 
 
    "CREATE TABLE IF NOT EXISTS mk_krs ( 
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        krs_id BIGINT UNSIGNED NOT NULL, 
        mata_kuliah_id BIGINT UNSIGNED NOT NULL, 
        CONSTRAINT fk_mkkrs_krs 
        FOREIGN KEY (krs_id) REFERENCES krs(id) 
        ON UPDATE CASCADE 
        ON DELETE CASCADE 
    ) ENGINE=InnoDB" 
]; 
 
foreach ($sqlCreateTables as $sql) {
    if (mysqli_query($koneksi, $sql)) {
        echo "Tabel berhasil dibuat atau sudah ada.<br>";
    } else {
        echo "Error membuat tabel: " . mysqli_error($koneksi) . "<br>";
    }
}


/* =========================
   ALTER TABLE
   Menambahkan kolom baru
   ========================= */

// 1. Menambahkan nomor telepon mahasiswa
$sqlAlter1 = "ALTER TABLE mahasiswa 
              ADD COLUMN no_telp VARCHAR(15) AFTER email";

// 2. Menambahkan alamat mahasiswa
$sqlAlter2 = "ALTER TABLE mahasiswa 
              ADD COLUMN alamat VARCHAR(200) AFTER no_telp";

// 3. Menambahkan jabatan dosen
$sqlAlter3 = "ALTER TABLE dosen 
              ADD COLUMN jabatan VARCHAR(50) AFTER email";

// 4. Menambahkan semester mata kuliah
$sqlAlter4 = "ALTER TABLE mata_kuliah 
              ADD COLUMN semester TINYINT UNSIGNED AFTER sks";

// 5. Menambahkan status KRS
$sqlAlter5 = "ALTER TABLE krs 
              ADD COLUMN status ENUM('Aktif', 'Selesai', 'Batal') 
              DEFAULT 'Aktif' AFTER tahun_ajaran";

// 6. Menambahkan nilai pada mata kuliah yang diambil
$sqlAlter6 = "ALTER TABLE mk_krs 
              ADD COLUMN nilai DECIMAL(4,2) DEFAULT NULL AFTER mata_kuliah_id";


$sqlAlterTables = [
    $sqlAlter1,
    $sqlAlter2,
    $sqlAlter3,
    $sqlAlter4,
    $sqlAlter5,
    $sqlAlter6
];

foreach ($sqlAlterTables as $sql) {
    if (mysqli_query($koneksi, $sql)) {
        echo "Kolom berhasil ditambahkan.<br>";
    } else {
        echo "Kolom gagal ditambahkan: " . mysqli_error($koneksi) . "<br>";
    }
}

echo "<br>Database akademik siap digunakan.";
?>