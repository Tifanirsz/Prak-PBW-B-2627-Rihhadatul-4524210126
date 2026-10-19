<?php
require_once __DIR__ . "/../koneksi.php";

class ProdukModel
{
    private $koneksi;

    public function __construct()
    {
        global $koneksi;
        $this->koneksi = $koneksi;
    }

    public function getAll()
    {
        $query = mysqli_query(
            $this->koneksi,
            "SELECT * FROM produk ORDER BY id DESC"
        );

        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "SELECT * FROM produk WHERE id = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function tambah($nama, $harga, $stok)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "INSERT INTO produk (nama_produk, harga, stok)
             VALUES (?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sdi",
            $nama,
            $harga,
            $stok
        );

        return mysqli_stmt_execute($stmt);
    }

    public function update($id, $nama, $harga, $stok)
    {
        $stmt = mysqli_prepare(
            $this->koneksi,
            "UPDATE produk
             SET nama_produk = ?, harga = ?, stok = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sdii",
            $nama,
            $harga,
            $stok,
            $id
        );

        return mysqli_stmt_execute($stmt);
    }
}
?>