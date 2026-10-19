<?php

// 1. Memanggil koneksi database
require_once __DIR__ . '/koneksi.php';

// 2. Memanggil controller
require_once __DIR__ . '/controllers/MahasiswaController.php';

// 3. Membuat objek controller dengan koneksi database
$controller = new MahasiswaController($koneksi);

// 4. Menjalankan halaman data mahasiswa
$controller->index();

?>