<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 30px;
        }

        .container {
            max-width: 450px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
        }

        input {
            box-sizing: border-box;
            width: 100%;
            padding: 11px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 11px 18px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Tambah Produk</h1>

    <form action="index.php?aksi=store" method="POST">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk"
               maxlength="100" required>

        <label>Harga Produk (Rp)</label>
        <input type="number" name="harga"
               min="0" step="0.01" required>

        <label>Stok Produk</label>
        <input type="number" name="stok"
               min="0" step="1" required>

        <button type="submit">Simpan Produk</button>
    </form>

    <p><a href="index.php">← Kembali ke daftar produk</a></p>
</div>
</body>
</html>