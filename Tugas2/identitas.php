<?php

interface Identitas
{
    public function ringkasan(): string;
}

class Mahasiswa implements Identitas
{
    private string $nim;
    private string $nama;
    protected float $ipk;

    public function __construct(string $nim, string $nama, float $ipk)
    {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->setIpk($ipk);
    }

    public function setIpk(float $ipk): void
    {
        if ($ipk < 0 || $ipk > 4) {
            throw new InvalidArgumentException('IPK harus 0 sampai 4.');
        }

        $this->ipk = $ipk;
    }

    public function getIpk(): float
    {
        return $this->ipk;
    }

    public function ringkasan(): string
    {
        return $this->nim . ' - ' . $this->nama . ' - IPK: ' . $this->ipk;
    }
}

$mhs = new Mahasiswa('202601', 'Andi Pratama', 3.75);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identitas Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background: white;
            padding: 35px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            text-align: center;
        }

        h2 {
            color: #2563eb;
            margin-bottom: 25px;
        }

        .info {
            background: #f8fafc;
            padding: 18px;
            border-radius: 8px;
            color: #334155;
            font-size: 16px;
            line-height: 1.8;
        }

        .badge {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 18px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Identitas Mahasiswa</h2>

        <div class="info">
            <?= htmlspecialchars($mhs->ringkasan()) ?>
        </div>

        <div class="badge">
            Mahasiswa Aktif
        </div>
    </div>

</body>
</html>