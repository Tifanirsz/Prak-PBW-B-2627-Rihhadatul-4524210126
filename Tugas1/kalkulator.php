<?php
// Kalkulator.php

$hasil = null;
$pesan = '';
$a = '';
$b = '';
$operator = '+';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $a = $_POST['a'] ?? '';
    $b = $_POST['b'] ?? '';
    $operator = $_POST['operator'] ?? '+';

    // Modifikasi 1: Validasi input
    if (!is_numeric($a) || !is_numeric($b)) {
        $pesan = 'Input harus berupa angka.';
    } elseif (!in_array($operator, ['+', '-', '*', '/'])) {
        $pesan = 'Operator tidak valid.';
    } else {
        $a = (float) $a;
        $b = (float) $b;

        switch ($operator) {
            case '+':
                $hasil = $a + $b;
                break;

            case '-':
                $hasil = $a - $b;
                break;

            case '*':
                $hasil = $a * $b;
                break;

            case '/':
                if ($b == 0) {
                    $pesan = 'Pembagian dengan nol tidak diperbolehkan.';
                } else {
                    $hasil = $a / $b;
                }
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Sederhana</title>

    <!-- Modifikasi 2: Styling CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .kalkulator {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border-radius: 6px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .hasil {
            background: #dcfce7;
            padding: 12px;
            border-radius: 6px;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            padding: 12px;
            border-radius: 6px;
            color: #991b1b;
        }
    </style>
</head>

<body>

<div class="kalkulator">
    <h2>Kalkulator Sederhana</h2>

    <form method="post">

        <input
            type="number"
            step="any"
            name="a"
            placeholder="Masukkan angka pertama"
            value="<?= htmlspecialchars((string)$a) ?>"
            required
        >

        <select name="operator">
            <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>+</option>
            <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>-</option>
            <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>×</option>
            <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>÷</option>
        </select>

        <input
            type="number"
            step="any"
            name="b"
            placeholder="Masukkan angka kedua"
            value="<?= htmlspecialchars((string)$b) ?>"
            required
        >

        <button type="submit">Hitung</button>
    </form>

    <?php if ($pesan !== ''): ?>
        <p class="error">
            <?= htmlspecialchars($pesan) ?>
        </p>

    <?php elseif ($hasil !== null): ?>
        <p class="hasil">
            Hasil: <?= htmlspecialchars((string)$hasil) ?>
        </p>
    <?php endif; ?>

</div>

</body>
</html>