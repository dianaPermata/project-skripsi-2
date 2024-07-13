<?php
// Include file database connection
include 'db.php';
session_start(); // Start session

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login-user.php');
    exit();
}

// Initialize variables
$diagnosis = null;
$selected_gejala = [];
$solusi_list = [];
$penyakit_description = '';

// Fetch all symptoms
$gejala_result = mysqli_query($conn, "SELECT * FROM gejala");
$gejala_list = [];
while ($row = mysqli_fetch_assoc($gejala_result)) {
    $gejala_list[] = $row;
}

// Split symptoms into pages of 5 questions each
$gejala_per_page = 3;
$gejala_pages = array_chunk($gejala_list, $gejala_per_page);

// Get the current page from session or set to 0
$current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 0;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store current page responses in session
    if (isset($_POST['gejala'])) {
        $_SESSION['responses'] = isset($_SESSION['responses']) ? $_SESSION['responses'] : [];
        $_SESSION['responses'][$current_page] = $_POST['gejala'];
    }

    // Store additional fields in session
    $_SESSION['durasi_hubungan'] = $_POST['durasi_hubungan'];
    $_SESSION['penyebab_putus'] = $_POST['penyebab_putus'];
    $_SESSION['tanggal_putus'] = $_POST['tanggal_putus'];

    // If next button is clicked
    if (isset($_POST['next'])) {
        $current_page++;
        $_SESSION['current_page'] = $current_page;
    }
    // If previous button is clicked
    elseif (isset($_POST['previous'])) {
        $current_page--;
        $_SESSION['current_page'] = $current_page;
    }
    // If finish button is clicked
    elseif (isset($_POST['finish'])) {
        // Merge all responses
        $selected_gejala = [];
        foreach ($_SESSION['responses'] as $responses) {
            $selected_gejala = array_merge($selected_gejala, $responses);
        }

        // Process and store the consultation results in the database
        $user_id = $_SESSION['user_id'];
        $tanggal_konsultasi = date('Y-m-d H:i:s');
        $durasi_hubungan = $_SESSION['durasi_hubungan'];
        $penyebab_putus = $_SESSION['penyebab_putus'];
        $tanggal_putus = $_SESSION['tanggal_putus'];

        // Insert consultation details into database
        $insert_query = "INSERT INTO konsultasi (userid, hasil, deskripsi, solusi, tanggal_konsultasi, durasi_hubungan, penyebab_putus, tanggal_putus) 
                        VALUES ('$user_id', '$diagnosis[nama]', '$penyakit_description', '" . implode(", ", $solusi_list) . "', '$tanggal_konsultasi', '$durasi_hubungan', '$penyebab_putus', '$tanggal_putus')";
        
        if (mysqli_query($conn, $insert_query)) {
            // Success
        } else {
            // Error
        }

        // Clear session variables
        unset($_SESSION['current_page']);
        unset($_SESSION['responses']);
        unset($_SESSION['durasi_hubungan']);
        unset($_SESSION['penyebab_putus']);
        unset($_SESSION['tanggal_putus']);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi</title>
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
                        <?php foreach ($gejala_pages[$current_page] as $gejala) : ?>
                                <div class="mb-3">
                                    <label class="form-label">Apakah anda <?php echo $gejala['nama']; ?> pasca putus cinta</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gejala[<?php echo $gejala['id']; ?>]" id="gejala_<?php echo $gejala['id']; ?>_ya" value="1" required>
                                        <label class="form-check-label checkbox-label" for="gejala_<?php echo $gejala['id']; ?>_ya">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gejala[<?php echo $gejala['id']; ?>]" id="gejala_<?php echo $gejala['id']; ?>_tidak" value="0" required>
                                        <label class="form-check-label checkbox-label" for="gejala_<?php echo $gejala['id']; ?>_tidak">Tidak</label>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="d-flex justify-content-between">
                                <?php if ($current_page > 0) : ?>
                                    <button type="submit" name="previous" class="btn btn-secondary">Previous</button>
                                <?php endif; ?>
                                <?php if ($current_page < count($gejala_pages) - 1) : ?>
                                    <button type="submit" name="next" class="btn btn-primary">Next</button>
                                <?php else : ?>
                                    <button type="submit" name="finish" class="btn btn-success">Finish</button>
                                <?php endif; ?>
                            </div>
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
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finish'])): ?>
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
</html>
