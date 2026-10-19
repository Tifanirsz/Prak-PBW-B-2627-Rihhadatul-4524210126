<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        h1 {
            color: #1f2937;
        }

        .tambah {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #1f2937;
            color: white;
        }

        .edit {
            color: #2563eb;
            font-weight: bold;
        }

        .kosong {
            text-align: center;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Daftar Produk</h1>
    <p>Kelola data produk penjualan dengan mudah.</p>

    <?php if (isset($_GET['pesan'])): ?>
        <p style="color: green;">
            <?= $_GET['pesan'] == 'tambah'
                ? 'Produk berhasil ditambahkan!'
                : 'Produk berhasil diperbarui!' ?>
        </p>
    <?php endif; ?>

    <a class="tambah" href="index.php?aksi=create">
        + Tambah Produk
    </a>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if (count($produk) > 0): ?>
            <?php foreach ($produk as $i => $p): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?= htmlspecialchars($p['nama_produk']) ?>
                    </td>
                    <td>
                        Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                    </td>
                    <td><?= $p['stok'] ?></td>
                    <td>
                        <a class="edit"
                           href="index.php?aksi=edit&id=<?= $p['id'] ?>">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="kosong">
                    Belum ada data produk.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>