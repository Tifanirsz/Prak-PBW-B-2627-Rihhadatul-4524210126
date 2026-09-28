<?php

interface BisaDihitung
{
    public function hargaAkhir(): float;
}

class Produk implements BisaDihitung
{
    public function __construct(
        protected string $nama,
        protected float $harga
    ) {}

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function getNama(): string
    {
        return $this->nama;
    }
}

class ProdukDiskon extends Produk
{
    public function __construct(
        string $nama,
        float $harga,
        private float $diskon
    ) {
        parent::__construct($nama, $harga);
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }
}

$data = [
    new Produk('Keyboard', 25000),
    new ProdukDiskon('Mouse', 15000, 10)
];

foreach ($data as $produk) {
    echo $produk->getNama() . ' - Rp ' .
        number_format($produk->hargaAkhir(), 0, ',', '.') . "<br>";
}

?>