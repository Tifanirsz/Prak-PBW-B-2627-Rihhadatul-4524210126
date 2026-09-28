<?php
// biodata.php

function statusKelulusan(float $ipk): string
{
    if ($ipk < 0 || $ipk > 4) {
        return 'IPK tidak valid';
    }

    if ($ipk >= 3.50) {
        return 'Sangat Memuaskan';
    }

    if ($ipk >= 3.00) {
        return 'Memuaskan';
    }

    return 'Perlu Peningkatan';
}

// Data mahasiswa
$mahasiswa = [
    'nim' => '202601',
    'nama' => 'Andi Pratama',
    'prodi' => 'Teknik Informatika',
    'fakultas' => 'Fakultas Teknologi Informasi',
    'semester' => 1,
    'ipk' => 3.72
];

// Validasi IPK
$ipkValid = $mahasiswa['ipk'] >= 0 && $mahasiswa['ipk'] <= 4;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Biodata Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 30px;
        }

        .container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #2563eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        td:first-child {
            font-weight: bold;
            width: 35%;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Biodata Mahasiswa</h2>

    <table>
        <?php foreach ($mahasiswa as $kunci => $nilai): ?>
            <tr>
                <td><?= htmlspecialchars(ucfirst($kunci)) ?></td>
                <td><?= htmlspecialchars((string)$nilai) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>
        Predikat:
        <?= htmlspecialchars(statusKelulusan($mahasiswa['ipk'])) ?>
    </h3>

    <?php if (!$ipkValid): ?>
        <p>IPK harus berada pada rentang 0 sampai 4.</p>
    <?php endif; ?>

</div>

</body>
</html>