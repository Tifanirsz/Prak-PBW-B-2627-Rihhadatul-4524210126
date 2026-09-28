<?php

interface BisaDihitung
{
    public function hargaAkhir(): float;
}

class Produk implements BisaDihitung
{
    protected string $nama;
    protected float $harga;

    public function __construct(
        string $nama,
        float $harga
    ) {
        // Modifikasi 1: Validasi harga
        if ($harga < 0) {
            throw new InvalidArgumentException(
                'Harga tidak boleh negatif.'
            );
        }

        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getHarga(): float
    {
        return $this->harga;
    }
}

class ProdukDiskon extends Produk
{
    private float $diskon;

    public function __construct(
        string $nama,
        float $harga,
        float $diskon
    ) {
        // Modifikasi 2: Validasi diskon
        if ($diskon < 0 || $diskon > 100) {
            throw new InvalidArgumentException(
                'Diskon harus antara 0 sampai 100 persen.'
            );
        }

        parent::__construct($nama, $harga);

        $this->diskon = $diskon;
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }

    public function getDiskon(): float
    {
        return $this->diskon;
    }
}

$daftar = [
    new Produk('Keyboard', 250000),
    new ProdukDiskon('Mouse', 150000, 10),
    new ProdukDiskon('Headset', 300000, 15)
];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Harga Produk</title>
</head>
<body>

    <h2>Daftar Harga Produk</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama Produk</th>
            <th>Harga Awal</th>
            <th>Diskon</th>
            <th>Harga Akhir</th>
        </tr>

        <?php foreach ($daftar as $produk): ?>

            <tr>
                <td>
                    <?= htmlspecialchars($produk->getNama()) ?>
                </td>

                <td>
                    Rp <?= number_format($produk->getHarga(), 0, ',', '.') ?>
                </td>

                <td>
                    <?php
                    if ($produk instanceof ProdukDiskon) {
                        echo $produk->getDiskon() . '%';
                    } else {
                        echo 'Tidak ada';
                    }
                    ?>
                </td>

                <td>
                    Rp <?= number_format($produk->hargaAkhir(), 0, ',', '.') ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</body>
</html>