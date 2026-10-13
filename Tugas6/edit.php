
<?php
include "koneksi.php";

$nim = trim($_GET['nim'] ?? '');

if ($nim === '') {
    echo "<script>
        alert('NIM tidak ditemukan!');
        window.location.href = 'index.php';
    </script>";
    exit;
}

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT * FROM mahasiswa WHERE nim = ?"
);

mysqli_stmt_bind_param($stmt, "s", $nim);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>
        alert('Data mahasiswa tidak ditemukan!');
        window.location.href = 'index.php';
    </script>";
    exit;
}

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Edit Data Mahasiswa</title>
</head>

<body class="min-h-screen bg-slate-100 p-6 font-sans text-gray-800">

    <div class="max-w-3xl mx-auto">

        <a href="index.php"
            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium mb-5">
            &larr; Kembali ke Data Mahasiswa
        </a>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-blue-700 text-white p-6">
                <p class="text-blue-100 text-sm mb-1">DATA AKADEMIK</p>
                <h1 class="text-2xl font-bold">Edit Data Mahasiswa</h1>
                <p class="text-sm text-blue-100 mt-2">
                    Perbarui informasi mahasiswa pada formulir berikut.
                </p>
            </div>

            <form action="update.php" method="POST" class="p-6">

                <div class="mb-6 rounded-lg bg-blue-50 border border-blue-100 p-4">
                    <p class="text-sm text-gray-500">NIM Mahasiswa</p>
                    <p class="text-lg font-bold text-blue-800">
                        <?= e($data['nim']) ?>
                    </p>
                    <input type="hidden" name="nim"
                        value="<?= e($data['nim']) ?>">
                    <p class="text-xs text-gray-500 mt-1">
                        NIM digunakan sebagai identitas dan tidak dapat diubah.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label for="nama"
                            class="block text-sm font-semibold mb-2">
                            Nama Lengkap
                        </label>
                        <input type="text" id="nama" name="nama"
                            value="<?= e($data['nama']) ?>"
                            maxlength="100" required
                            class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                    </div>

                    <div>
                        <label for="email"
                            class="block text-sm font-semibold mb-2">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                            value="<?= e($data['email']) ?>"
                            maxlength="100" required
                            class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                    </div>

                    <div>
                        <label for="prodi"
                            class="block text-sm font-semibold mb-2">
                            Program Studi
                        </label>
                        <input type="text" id="prodi" name="prodi"
                            value="<?= e($data['prodi']) ?>"
                            maxlength="100" required
                            class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                    </div>

                    <div>
                        <label for="angkatan"
                            class="block text-sm font-semibold mb-2">
                            Tahun Angkatan
                        </label>
                        <input type="number" id="angkatan" name="angkatan"
                            value="<?= e($data['angkatan']) ?>"
                            min="2000" max="2100" required
                            class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                    </div>

                    <div class="md:col-span-2">
                        <label for="ipk"
                            class="block text-sm font-semibold mb-2">
                            Indeks Prestasi Kumulatif (IPK)
                        </label>
                        <input type="number" id="ipk" name="ipk"
                            value="<?= e($data['ipk']) ?>"
                            min="0" max="4" step="0.01" required
                            class="w-full rounded-lg border border-gray-300 p-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                        <p class="text-xs text-gray-500 mt-2">
                            Masukkan nilai IPK antara 0.00 sampai 4.00.
                        </p>
                    </div>

                </div>

                <div class="flex flex-col sm:flex-row gap-3 mt-8">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                        Simpan Perubahan
                    </button>

                    <a href="index.php"
                        class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-lg transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
