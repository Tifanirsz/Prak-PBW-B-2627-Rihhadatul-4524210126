
<?php
include "koneksi.php";

$berhasil = false;
$pesan = "";
$nim = trim($_GET['nim'] ?? '');
$nama = "";
$email = "";

if ($nim === '') {
    $pesan = "NIM mahasiswa tidak ditemukan!";
} else {

    // Modifikasi 1: Mengambil data mahasiswa sebelum dihapus
    $stmt = mysqli_prepare(
        $koneksi,
        "SELECT nama, email FROM mahasiswa WHERE nim = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $nim);
    mysqli_stmt_execute($stmt);

    $hasil = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($hasil);

    if (!$data) {
        $pesan = "Data mahasiswa tidak ditemukan atau sudah dihapus!";
    } else {
        $nama = $data['nama'];
        $email = $data['email'];

        // Modifikasi 2: Menghapus data menggunakan prepared statement
        $stmt = mysqli_prepare(
            $koneksi,
            "DELETE FROM mahasiswa WHERE nim = ?"
        );

        mysqli_stmt_bind_param($stmt, "s", $nim);

        try {
            if (mysqli_stmt_execute($stmt)) {
                $berhasil = true;
                $pesan = "Data mahasiswa berhasil dihapus dari database.";
            } else {
                $pesan = "Data mahasiswa gagal dihapus.";
            }
        } catch (mysqli_sql_exception $e) {
            $pesan = "Data gagal dihapus karena masih memiliki relasi dengan data lain.";
        }
    }
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
    <title>Hasil Penghapusan Data</title>
</head>

<body class="min-h-screen bg-slate-100">

    <main class="min-h-screen flex items-center justify-center p-4 sm:p-6">

        <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-6 sm:p-8 text-center">

            <div class="mx-auto mb-5 flex items-center justify-center
                w-16 h-16 rounded-full
                <?= $berhasil
                    ? 'bg-green-100 text-green-600'
                    : 'bg-red-100 text-red-600' ?>">

                <span class="text-3xl font-bold">
                    <?= $berhasil ? '&#10003;' : '!' ?>
                </span>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-3">
                <?= $berhasil
                    ? 'Penghapusan Berhasil'
                    : 'Penghapusan Gagal' ?>
            </h1>

            <p class="text-gray-600 mb-6">
                <?= e($pesan) ?>
            </p>

            <?php if ($berhasil) { ?>

                <div class="bg-red-50 border border-red-100 rounded-xl p-5 text-left mb-6">

                    <p class="text-xs font-semibold uppercase tracking-wide text-red-600 mb-4">
                        Data yang telah dihapus
                    </p>

                    <p class="text-sm text-gray-500 mb-1">
                        Nama Mahasiswa
                    </p>
                    <p class="font-semibold text-gray-800 mb-4 break-words">
                        <?= e($nama) ?>
                    </p>

                    <p class="text-sm text-gray-500 mb-1">
                        NIM
                    </p>
                    <p class="font-semibold text-gray-800 mb-4 break-words">
                        <?= e($nim) ?>
                    </p>

                    <p class="text-sm text-gray-500 mb-1">
                        Email
                    </p>
                    <p class="font-semibold text-gray-800 break-words">
                        <?= e($email) ?>
                    </p>

                </div>

            <?php } ?>

            <a href="index.php"
                class="block w-full bg-blue-600 hover:bg-blue-700
                text-white font-semibold py-3 px-4 rounded-lg transition">
                Kembali ke Data Mahasiswa
            </a>

        </div>

    </main>

</body>
</html>
