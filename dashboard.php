<?php
include 'auth.php';
include 'db.php';

// Menghitung jumlah pengguna yang telah melakukan konsultasi
$query_users = "SELECT COUNT(DISTINCT userid) AS total_users FROM konsultasi";
$result_users = mysqli_query($conn, $query_users);
$row_users = mysqli_fetch_assoc($result_users);
$total_users = $row_users['total_users'];

// Menghitung jumlah penyakit
$query_penyakit = "SELECT COUNT(*) AS total_penyakit FROM penyakit";
$result_penyakit = mysqli_query($conn, $query_penyakit);
$row_penyakit = mysqli_fetch_assoc($result_penyakit);
$total_penyakit = $row_penyakit['total_penyakit'];

// Menghitung jumlah gejala
$query_gejala = "SELECT COUNT(*) AS total_gejala FROM gejala";
$result_gejala = mysqli_query($conn, $query_gejala);
$row_gejala = mysqli_fetch_assoc($result_gejala);
$total_gejala = $row_gejala['total_gejala'];

// Menghitung jumlah aturan
$query_aturan = "SELECT COUNT(*) AS total_aturan FROM aturan";
$result_aturan = mysqli_query($conn, $query_aturan);
$row_aturan = mysqli_fetch_assoc($result_aturan);
$total_aturan = $row_aturan['total_aturan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CekMental</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="assets/admin-css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-3 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">CekMental</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link active"><i class="bi bi-house-door me-2"></i>Dashboard</a>
                    <a href="penyakit.php" class="nav-item nav-link"><i class="fas fa-plus-circle me-2"></i>Data Penyakit</a>
                    <a href="gejala.php" class="nav-item nav-link"><i class="fas fa-list me-2"></i>Data Gejala</a>
                    <a href="solusi.php" class="nav-item nav-link"><i class="fas fa-list me-2"></i>Data Solusi</a>
                    <a href="aturan.php" class="nav-item nav-link"><i class="fas fa-exclamation-circle me-2"></i>Aturan</a>
                    <a href="riwayat-konsultasi.php" class="nav-item nav-link"><i class="fas fa-exclamation-circle me-2"></i>Riwayat Identifikasi</a>
                    <a href="logout.php" class="nav-item nav-link"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0 pt-3 pb-3">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0">
                        <i class="fa fa-hashtag"></i>
                    </h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0 text-decoration-none">
                    <i class="fa fa-bars"></i>
                </a>
            </nav>
            <!-- Navbar End -->

            <div class="container pt-4 px-4 mb-4">
                <h1>Dashboard</h1>

                <div class="row row-cols-1 row-cols-md-2 g-4 mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-users me-2"></i>Jumlah Pengguna yang Berkonsultasi</h5>
                                <p class="card-text"><?php echo $total_users; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-diagnoses me-2"></i>Jumlah Penyakit</h5>
                                <p class="card-text"><?php echo $total_penyakit; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-heartbeat me-2"></i>Jumlah Gejala</h5>
                                <p class="card-text"><?php echo $total_gejala; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-exclamation-circle me-2"></i>Jumlah Aturan</h5>
                                <p class="card-text"><?php echo $total_aturan; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/chart/chart.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>
</body>

</html>
