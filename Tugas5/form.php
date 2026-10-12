
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 30px;
        }

        .container {
            width: 350px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Data Mahasiswa</h2>

    <form action="simpan.php" method="post">
        NIM:
        <input type="text" name="nim" required
               placeholder="Masukkan NIM">

        Nama:
        <input type="text" name="nama" required
               placeholder="Masukkan nama">

        Email:
        <input type="email" name="email" required
               placeholder="Masukkan email">

        Prodi:
        <input type="text" name="prodi" required
               placeholder="Masukkan program studi">

        Angkatan:
        <input type="number" name="angkatan"
               min="2000" max="2100" required
               placeholder="Masukkan angkatan">

        IPK:
        <input type="number" name="ipk"
               min="0" max="4" step="0.01" required
               placeholder="Masukkan IPK">

        <button type="submit">Simpan Data</button>
    </form>
</div>

</body>
</html>
