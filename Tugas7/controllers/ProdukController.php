<?php
require_once __DIR__ . "/../models/ProdukModel.php";

$model = new ProdukModel();

$aksi = $_GET['aksi'] ?? 'index';

if ($aksi == 'create') {
    require __DIR__ . "/../views/produk/create.php";
    exit;
}

if ($aksi == 'store' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama_produk'] ?? '');
    $harga = $_POST['harga'] ?? '';
    $stok = $_POST['stok'] ?? '';

    if (
        $nama === '' ||
        !is_numeric($harga) ||
        $harga < 0 ||
        filter_var($stok, FILTER_VALIDATE_INT) === false ||
        $stok < 0
    ) {
        echo "<script>
            alert('Data produk tidak valid!');
            window.location.href = 'index.php?aksi=create';
        </script>";
        exit;
    }

    if ($model->tambah($nama, $harga, $stok)) {
        header("Location: index.php?pesan=tambah");
        exit;
    }

    die("Gagal menambahkan produk.");
}

if ($aksi == 'edit') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $produk = $id ? $model->getById($id) : null;

    if (!$produk) {
        die("Produk tidak ditemukan.");
    }

    require __DIR__ . "/../views/produk/edit.php";
    exit;
}

if ($aksi == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nama = trim($_POST['nama_produk'] ?? '');
    $harga = $_POST['harga'] ?? '';
    $stok = $_POST['stok'] ?? '';

    if (
        !$id ||
        $nama === '' ||
        !is_numeric($harga) ||
        $harga < 0 ||
        filter_var($stok, FILTER_VALIDATE_INT) === false ||
        $stok < 0
    ) {
        die("Data produk tidak valid.");
    }

    if ($model->update($id, $nama, $harga, $stok)) {
        header("Location: index.php?pesan=update");
        exit;
    }

    die("Gagal mengubah produk.");
}

$produk = $model->getAll();

require __DIR__ . "/../views/produk/index.php";
?>