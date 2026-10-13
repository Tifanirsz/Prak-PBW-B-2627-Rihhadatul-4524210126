
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Tambah Mahasiswa</title>
</head>

<body class="bg-gray-50 p-6 font-sans text-gray-800">

    <form action="store.php" method="POST"
        class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md flex flex-col">

        <h2 class="text-2xl font-bold mb-2">Tambah Mahasiswa</h2>
        <p class="text-sm text-gray-500 mb-5">
            Masukkan data mahasiswa dengan lengkap.
        </p>

        <label for="nim" class="text-sm font-semibold mb-1">NIM:</label>
        <input
            type="text"
            id="nim"
            name="nim"
            minlength="7"
            maxlength="15"
            required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500"
        >

        <label for="nama" class="text-sm font-semibold mb-1">Nama:</label>
        <input
            type="text"
            id="nama"
            name="nama"
            maxlength="100"
            required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500"
        >

        <label for="email" class="text-sm font-semibold mb-1">Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            maxlength="100"
            required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500"
        >

        <label for="prodi" class="text-sm font-semibold mb-1">Prodi:</label>
        <input
            type="text"
            id="prodi"
            name="prodi"
            maxlength="100"
            required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500"
        >

        <label for="angkatan" class="text-sm font-semibold mb-1">Angkatan:</label>
        <input
            type="number"
            id="angkatan"
            name="angkatan"
            min="2000"
            max="2100"
            required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500"
        >

        <label for="ipk" class="text-sm font-semibold mb-1">IPK:</label>
        <input
            type="number"
            id="ipk"
            name="ipk"
            min="0"
            max="4"
            step="0.01"
            required
            class="mb-6 p-2 border border-gray-300 rounded focus:outline-blue-500"
        >

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded">
            Simpan Data
        </button>

        <a href="index.php"
            class="text-center mt-3 bg-gray-200 hover:bg-gray-300 py-2 rounded">
            Kembali
        </a>

    </form>

</body>
</html>
