
<?php
include "koneksi.php";

$keyword = trim($_GET['keyword'] ?? '');

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT * FROM mahasiswa
     WHERE nim LIKE ? OR nama LIKE ?
     ORDER BY nama ASC"
);

$search = "%$keyword%";

mysqli_stmt_bind_param($stmt, "ss", $search, $search);
mysqli_stmt_execute($stmt);

$query = mysqli_stmt_get_result($stmt);

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
    <title>Data Mahasiswa</title>
</head>

<body class="bg-gray-50 p-6 font-sans text-gray-800">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">

        <h2 class="text-2xl font-bold mb-4">
            Data Mahasiswa
        </h2>

        <form method="GET" class="mb-4 flex flex-wrap gap-2">
            <input
                type="text"
                name="keyword"
                value="<?= e($keyword) ?>"
                placeholder="Cari NIM atau nama mahasiswa..."
                class="flex-1 min-w-48 border border-gray-300 rounded px-3 py-2"
            >

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Cari
            </button>

            <a href="index.php"
                class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">
                Reset
            </a>
        </form>

        <a href="create.php"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded mb-4">
            + Tambah Mahasiswa
        </a>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-left">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 p-3">NIM</th>
                        <th class="border border-gray-200 p-3">Nama</th>
                        <th class="border border-gray-200 p-3">Email</th>
                        <th class="border border-gray-200 p-3">Prodi</th>
                        <th class="border border-gray-200 p-3">Angkatan</th>
                        <th class="border border-gray-200 p-3">IPK</th>
                        <th class="border border-gray-200 p-3">Status IPK</th>
                        <th class="border border-gray-200 p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                            <tr class="hover:bg-gray-50 transition">

                                <td class="border border-gray-200 p-3">
                                    <?= e($data['nim']) ?>
                                </td>

                                <td class="border border-gray-200 p-3">
                                    <?= e($data['nama']) ?>
                                </td>

                                <td class="border border-gray-200 p-3">
                                    <?= e($data['email']) ?>
                                </td>

                                <td class="border border-gray-200 p-3">
                                    <?= e($data['prodi']) ?>
                                </td>

                                <td class="border border-gray-200 p-3">
                                    <?= e($data['angkatan']) ?>
                                </td>

                                <td class="border border-gray-200 p-3">
                                    <?= number_format((float) $data['ipk'], 2) ?>
                                </td>

                                <td class="border border-gray-200 p-3">
                                    <?php
                                    $ipk = (float) $data['ipk'];

                                    if ($ipk >= 3.50) {
                                        echo "Sangat Memuaskan";
                                    } elseif ($ipk >= 3.00) {
                                        echo "Memuaskan";
                                    } elseif ($ipk >= 2.00) {
                                        echo "Cukup";
                                    } else {
                                        echo "Perlu Peningkatan";
                                    }
                                    ?>
                                </td>

                                <td class="border border-gray-200 p-3 text-center whitespace-nowrap">
                                    <a href="edit.php?nim=<?= urlencode($data['nim']) ?>"
                                        class="text-blue-600 hover:underline font-medium">
                                        Edit
                                    </a>

                                    <span class="mx-1 text-gray-300">|</span>

                                    <a href="delete.php?nim=<?= urlencode($data['nim']) ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="text-red-600 hover:underline font-medium">
                                        Hapus
                                    </a>
                                </td>

                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="8"
                                class="border border-gray-200 p-4 text-center text-gray-500">
                                Data mahasiswa tidak ditemukan.
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>

</body>
</html>
