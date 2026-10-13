
<?php
include "koneksi.php";

$berhasil = false;
$pesan = "";

$nim = "";
$nama = "";
$ipk = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $prodi = trim($_POST['prodi'] ?? '');
    $angkatan = $_POST['angkatan'] ?? '';
    $ipk = $_POST['ipk'] ?? '';

    // Modifikasi 1: Validasi data
    if (
        $nim === '' ||
        $nama === '' ||
        $prodi === '' ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        filter_var($angkatan, FILTER_VALIDATE_INT) === false ||
        (int) $angkatan < 2000 ||
        (int) $angkatan > 2100 ||
        !is_numeric($ipk) ||
        !is_finite((float) $ipk) ||
        (float) $ipk < 0 ||
        (float) $ipk > 4
    ) {
        $pesan = "Data tidak valid. Periksa kembali input!";
    } else {

        // Modifikasi 2: Memeriksa NIM mahasiswa
        $stmt = mysqli_prepare(
            $koneksi,
            "SELECT nim FROM mahasiswa WHERE nim = ?"
        );

        mysqli_stmt_bind_param($stmt, "s", $nim);
        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($hasil) == 0) {
            $pesan = "Data mahasiswa tidak ditemukan!";
        } else {

            $angkatan = (int) $angkatan;
            $ipk = (float) $ipk;

            // Memperbarui data mahasiswa
            $stmt = mysqli_prepare(
                $koneksi,
                "UPDATE mahasiswa
                 SET nama = ?,
                     email = ?,
                     prodi = ?,
                     angkatan = ?,
                     ipk = ?
                 WHERE nim = ?"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "sssids",
                $nama,
                $email,
                $prodi,
                $angkatan,
                $ipk,
                $nim
            );

            try {
                if (mysqli_stmt_execute($stmt)) {
                    $berhasil = true;
                    $pesan = "Data mahasiswa berhasil diperbarui!";
                } else {
                    $pesan = "Data gagal diperbarui.";
                }
            } catch (mysqli_sql_exception $e) {
                $pesan = "Data gagal diperbarui. Email mungkin sudah digunakan.";
            }
        }
    }

} else {
    header("Location: index.php");
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
    <title>Hasil Pembaruan Data</title>
</head>

<body class="min-h-screen bg-slate-100">

    <main class="min-h-screen w-full flex items-center justify-center p-4 sm:p-6">

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
                    ? 'Pembaruan Berhasil'
                    : 'Pembaruan Gagal' ?>
            </h1>

            <p class="text-gray-600 mb-6">
                <?= e($pesan) ?>
            </p>

            <?php if ($berhasil) { ?>

                <div class="bg-gray-50 rounded-xl p-5 text-left mb-6">

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
                        IPK Terbaru
                    </p>
                    <p class="font-semibold text-gray-800">
                        <?= number_format((float) $ipk, 2) ?>
                    </p>

                </div>

            <?php } ?>

            <a href="index.php"
                class="block w-full bg-blue-600 hover:bg-blue-700
                text-white font-semibold py-3 px-4 rounded-lg transition">
                Kembali ke Data Mahasiswa
            </a>

            <?php if (!$berhasil) { ?>

                <button type="button" onclick="history.back()"
                    class="block w-full mt-3 bg-gray-100 hover:bg-gray-200
                    text-gray-700 font-semibold py-3 px-4 rounded-lg transition">
                    Kembali ke Form Edit
                </button>

            <?php } ?>

        </div>

    </main>

</body>
</html>
