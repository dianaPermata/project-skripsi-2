<?php
// Include file database connection
include 'db.php';
session_start(); // Start session

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login-user.php');
    exit();
}

$diagnosis = null;
$selected_gejala = [];
$solusi_list = []; // Array to hold solutions
$penyakit_description = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $durasi_hubungan = isset($_POST['durasi_hubungan']) ? intval($_POST['durasi_hubungan']) : null;
    $penyebab_putus = isset($_POST['penyebab_putus']) ? mysqli_real_escape_string($conn, $_POST['penyebab_putus']) : null;
    $tanggal_putus = isset($_POST['tanggal_putus']) && !empty($_POST['tanggal_putus']) ? mysqli_real_escape_string($conn, $_POST['tanggal_putus']) : null;
    
    // Check if gejala array is set
    if (isset($_POST['gejala']) && is_array($_POST['gejala'])) {
        $selected_gejala = $_POST['gejala'];

        // Check if all gejala have been answered
        $all_answered = true;
        foreach ($selected_gejala as $gejala_id => $jawaban) {
            if (!in_array($jawaban, ['1', '0'])) {
                $all_answered = false;
                break;
            }
        }

        if ($all_answered) {
            // Prepare an array for selected gejala ids
            $selected_gejala_ids = [];
            foreach ($selected_gejala as $gejala_id => $jawaban) {
                if ($jawaban == '1') {
                    $selected_gejala_ids[] = $gejala_id;
                }
            }

            // If there are selected gejala
            if (!empty($selected_gejala_ids)) {
                $selected_gejala_ids_str = implode(",", $selected_gejala_ids);

                // Prepared statement to prevent SQL Injection
                $query = "SELECT penyakit.nama, penyakit.deskripsi 
                          FROM aturan 
                          JOIN penyakit ON aturan.penyakit_id = penyakit.id 
                          WHERE aturan.gejala_id IN ($selected_gejala_ids_str) 
                          GROUP BY penyakit.id 
                          HAVING COUNT(DISTINCT aturan.gejala_id) = ?";

                $stmt = mysqli_prepare($conn, $query);
                if ($stmt) {
                    // Count the number of selected symptoms
                    $count_gejala = count($selected_gejala_ids);
                    mysqli_stmt_bind_param($stmt, "i", $count_gejala);

                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $diagnosis = mysqli_fetch_assoc($result);

                        // Save consultation result to the 'konsultasi' table
                        if ($diagnosis) {
                            $nama_penyakit = mysqli_real_escape_string($conn, $diagnosis['nama']);
                            $penyakit_description = mysqli_real_escape_string($conn, $diagnosis['deskripsi']);
                            $userid = $_SESSION['user_id'];
                            $gejala_terpilih = mysqli_real_escape_string($conn, implode(",", $selected_gejala_ids));
                            $tanggal_konsultasi = date('Y-m-d'); // Current date (without time)

                            // Query to fetch solusi from solusi table based on diagnosis
                            $solusi_query = mysqli_query($conn, "SELECT solusi
                                FROM solusi
                                WHERE id_penyakit = (SELECT id FROM penyakit WHERE nama = '$nama_penyakit')");
                            while ($solusi_row = mysqli_fetch_assoc($solusi_query)) {
                                $solusi_list[] = mysqli_real_escape_string($conn, $solusi_row['solusi']);
                            }
                            $solusi_str = implode(", ", $solusi_list);

                            // Prepared statement for inserting into the database
                            $insert_query = "INSERT INTO konsultasi (userid, diagnosis, gejala_terpilih, tanggal_konsultasi, durasi_hubungan, penyebab_putus, tanggal_putus, solusi) 
                                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                            $stmt_insert = mysqli_prepare($conn, $insert_query);
                            if ($stmt_insert) {
                                mysqli_stmt_bind_param($stmt_insert, "isssssss", $userid, $nama_penyakit, $gejala_terpilih, $tanggal_konsultasi, $durasi_hubungan, $penyebab_putus, $tanggal_putus, $solusi_str);
                                mysqli_stmt_execute($stmt_insert);

                                // Check if insertion was successful
                                if (mysqli_stmt_affected_rows($stmt_insert) > 0) {
                                    // Insertion successful
                                } else {
                                    // Insertion failed
                                }
                            } else {
                                // Handle insert statement preparation error
                            }
                        }
                    } else {
                        // No diagnosis found
                        $nama_penyakit = "Penyakit belum terdiagnosa dengan baik";
                        $penyakit_description = "";
                        $solusi_list = [];

                        // Save consultation result with unknown disease to the 'konsultasi' table
                        $userid = $_SESSION['user_id'];
                        $gejala_terpilih = mysqli_real_escape_string($conn, implode(",", $selected_gejala_ids));
                        $tanggal_konsultasi = date('Y-m-d'); // Current date (without time)
                        $solusi_str = ""; // No solutions for unknown disease

                        // Prepared statement for inserting into the database
                        $insert_query = "INSERT INTO konsultasi (userid, diagnosis, gejala_terpilih, tanggal_konsultasi, durasi_hubungan, penyebab_putus, tanggal_putus, solusi) 
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                        $stmt_insert = mysqli_prepare($conn, $insert_query);
                        if ($stmt_insert) {
                            mysqli_stmt_bind_param($stmt_insert, "isssssss", $userid, $nama_penyakit, $gejala_terpilih, $tanggal_konsultasi, $durasi_hubungan, $penyebab_putus, $tanggal_putus, $solusi_str);
                            mysqli_stmt_execute($stmt_insert);

                            // Check if insertion was successful
                            if (mysqli_stmt_affected_rows($stmt_insert) > 0) {
                                // Insertion successful
                            } else {
                                // Insertion failed
                            }
                        } else {
                            // Handle insert statement preparation error
                        }
                    }
                } else {
                    // Handle statement preparation error
                }
            } else {
                // Handle case where no gejala selected
            }
        } else {
            // Handle case where not all gejala have been answered
            echo "<script>alert('Silahkan jawab semua pertanyaan untuk melakukan diagnosa.');</script>";
        }
    } else {
        // Handle case where gejala array is not set or not an array
    }
}

// Query to fetch symptoms for display in form
$gejala_result = mysqli_query($conn, "SELECT * FROM gejala");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>

        .checkbox-label {
            margin-left: 8px;
        }

        .footer {
            position: relative;
   left: 0;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
}
    </style>
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

<section class="container">
    <div class="mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Konsultasi</h4>
                    </div>
                    <div class="card-body">
                        <form action="konsultasi.php" method="POST">
                            <div class="mb-3">
                                <label for="durasi_hubungan" class="form-label">Durasi Hubungan (dalam bulan)</label>
                                <input type="number" class="form-control" id="durasi_hubungan" name="durasi_hubungan" required>
                            </div>
                            <div class="mb-3">
                                <label for="penyebab_putus" class="form-label">Penyebab Putus</label>
                                <input type="text" class="form-control" id="penyebab_putus" name="penyebab_putus" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_putus" class="form-label">Tanggal Putus</label>
                                <input type="date" class="form-control" id="tanggal_putus" name="tanggal_putus" required>
                            </div>
                            <?php while ($row = mysqli_fetch_assoc($gejala_result)) : ?>
                                <div class="mb-3">
                                    <label class="form-label">Apakah anda <?php echo $row['nama']; ?> pasca putus cinta</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gejala[<?php echo $row['id']; ?>]" id="gejala_<?php echo $row['id']; ?>_ya" value="1" required>
                                        <label class="form-check-label checkbox-label" for="gejala_<?php echo $row['id']; ?>_ya">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gejala[<?php echo $row['id']; ?>]" id="gejala_<?php echo $row['id']; ?>_tidak" value="0" required>
                                        <label class="form-check-label checkbox-label" for="gejala_<?php echo $row['id']; ?>_tidak">Tidak</label>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display the diagnosis and solutions if available -->
        <?php if (isset($diagnosis) && $diagnosis) : ?>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Hasil Diagnosa</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Diagnosis:</strong> <?php echo $diagnosis['nama']; ?></p>
                            <p><strong>Deskripsi:</strong> <?php echo $penyakit_description; ?></p>
                            <p><strong>Solusi:</strong></p>
                            <ul>
                                <?php foreach ($solusi_list as $solusi) : ?>
                                    <li><?php echo $solusi; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Hasil Diagnosa</h4>
                        </div>
                        <div class="card-body">
                            <p>Silahkan segera mencari bantuan professional terdekat di daerah anda</p>
                                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
</body>
</html>  form konsultasi buatlah pagination berupa next dan previous tapi diakhir pevoius berubah menjadi button diagnosa