<?php
// Sertakan file koneksi database
include 'db.php';
session_start(); // Mulai sesi

// Redirect ke login jika pengguna belum login
if (!isset($_SESSION['user_id'])) {
    header('Location: login-user.php');
    exit();
}

// Tangani data sesi dan lakukan diagnosa
$durasi_hubungan = $_SESSION['durasi_hubungan'] ?? null;
$penyebab_putus = $_SESSION['penyebab_putus'] ?? null;
$tanggal_putus = $_SESSION['tanggal_putus'] ?? null;
$gejala_terpilih = $_SESSION['gejala'] ?? [];
$gejala_terpilih_str = implode(', ', $gejala_terpilih);

// Proses diagnosa berdasarkan gejala yang dipilih
$diagnosis_result = "Hasil Diagnosa Placeholder";
$deskripsi_penyakit = "Deskripsi Penyakit Placeholder";
$solusi = "Solusi Placeholder";

if (count($gejala_terpilih) > 0) {
    $jumlah_positif = array_sum($gejala_terpilih);
    if ($jumlah_positif > 5) {
        $diagnosis_result = 'Depresi pasca putus cinta';
        $query = "SELECT deskripsi FROM penyakit WHERE nama_penyakit = '$diagnosis_result'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $deskripsi_penyakit = $row['deskripsi'];
        }

        $query_solusi = "SELECT deskripsi_solusi FROM solusi WHERE id_penyakit = (SELECT id_penyakit FROM penyakit WHERE nama_penyakit = '$diagnosis_result')";
        $result_solusi = mysqli_query($conn, $query_solusi);
        if ($result_solusi && mysqli_num_rows($result_solusi) > 0) {
            $row_solusi = mysqli_fetch_assoc($result_solusi);
            $solusi = $row_solusi['deskripsi_solusi'];
        }
    } else {
        $diagnosis_result = 'Kondisi mental yang baik pasca putus cinta';
        $query = "SELECT deskripsi FROM penyakit WHERE nama_penyakit = '$diagnosis_result'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $deskripsi_penyakit = $row['deskripsi'];
        }

        $query_solusi = "SELECT deskripsi_solusi FROM solusi WHERE id_penyakit = (SELECT id_penyakit FROM penyakit WHERE nama_penyakit = '$diagnosis_result')";
        $result_solusi = mysqli_query($conn, $query_solusi);
        if ($result_solusi && mysqli_num_rows($result_solusi) > 0) {
            $row_solusi = mysqli_fetch_assoc($result_solusi);
            $solusi = $row_solusi['deskripsi_solusi'];
        }
    }
}

// Simpan hasil konsultasi ke database
$user_id = $_SESSION['user_id'];
$tanggal_konsultasi = date('Y-m-d H:i:s');
$query = "INSERT INTO konsultasi (userid, diagnosis, gejala_terpilih, tanggal_konsultasi, durasi_hubungan, penyebab_putus, tanggal_putus)
          VALUES ('$user_id', '$diagnosis_result', '$gejala_terpilih_str', '$tanggal_konsultasi', '$durasi_hubungan', '$penyebab_putus', '$tanggal_putus')";
mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-navbar">
    <div class="container">
        <a class="navbar-brand logo" href="index.php"><p>Cek<span>Mental</span></p></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="index.php">Beranda</a>
                <a class="nav-link active" href="konsultasi.php">Identifikasi</a>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a class="nav-link active" href="logout.php">Logout</a>
                <?php else : ?>
                    <a class="nav-link active" href="login-user.php">Login/Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<section>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Hasil Diagnosa</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Durasi Hubungan:</strong> <?php echo htmlspecialchars($durasi_hubungan); ?> bulan</p>
                        <p><strong>Penyebab Putus:</strong> <?php echo htmlspecialchars($penyebab_putus); ?></p>
                        <p><strong>Tanggal Putus:</strong> <?php echo htmlspecialchars($tanggal_putus); ?></p>
                        <p><strong>Hasil Diagnosa:</strong> <?php echo htmlspecialchars($diagnosis_result); ?></p>
                        <p><strong>Deskripsi Penyakit:</strong> <?php echo htmlspecialchars($deskripsi_penyakit); ?></p>
                        <p><strong>Solusi:</strong> <?php echo htmlspecialchars($solusi); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="footer bg-light">
    <p class="copy-right">&copy; | Repost by Posyandu Kesehatan Jiwa</p>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
