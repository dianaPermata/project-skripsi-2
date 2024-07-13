<?php
include 'auth.php'; // Include authentication check if needed
include 'db.php'; // Include your database connection

// Pagination configuration
$results_per_page = 10; // Number of results per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number, default is 1

// Calculate the starting point for the results shown on the current page
$start_from = ($current_page - 1) * $results_per_page;

// Handle form submissions (if needed)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        // Process form submission for adding consultation data
        $userid = $_POST['userid'];
        $diagnosis = $_POST['diagnosis'];
        $tanggal_konsultasi = date('Y-m-d H:i:s'); // Example timestamp for consultation date/time
        
        // Insert query for consultation data
        $sql = "INSERT INTO konsultasi (userid, diagnosis, tanggal_konsultasi) VALUES ('$userid', '$diagnosis', '$tanggal_konsultasi')";
        mysqli_query($conn, $sql);
    }
}

// Fetch total number of records
$sql_count = "SELECT COUNT(*) AS total FROM konsultasi";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total'];

// Calculate total pages
$total_pages = ceil($total_records / $results_per_page);

// Fetch consultation data for display with pagination
$sql = "SELECT konsultasi.id_konsultasi, users.nama AS nama_user, users.jenis_kelamin, konsultasi.diagnosis, konsultasi.tanggal_konsultasi, users.usia, konsultasi.durasi_hubungan, konsultasi.penyebab_putus, konsultasi.tanggal_putus, GROUP_CONCAT(gejala.nama SEPARATOR ', ') AS gejala_terpilih, konsultasi.solusi
        FROM konsultasi
        JOIN users ON konsultasi.userid = users.id_user
        LEFT JOIN gejala ON FIND_IN_SET(gejala.id, konsultasi.gejala_terpilih)
        GROUP BY konsultasi.id_konsultasi
        LIMIT $start_from, $results_per_page";



$konsultasi = mysqli_query($conn, $sql);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

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
                <a href="index.html" class="navbar-brand mx-4 mb-3 ">
                    <h3 class="text-primary">CekMental</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link"><i class="bi bi-house-door me-2"></i>Dashboard</a>
                    <a href="penyakit.php" class="nav-item nav-link"><i class="fas fa-plus-circle me-2"></i>Data Penyakit</a>
                    <a href="gejala.php" class="nav-item nav-link"><i class="fas fa-list me-2"></i>Data Gejala</a>
                    <a href="solusi.php" class="nav-item nav-link"><i class="fas fa-exclamation-circle me-2"></i>Data Solusi</a>
                    <a href="aturan.php" class="nav-item nav-link"><i class="fas fa-exclamation-circle me-2"></i>Aturan</a>
                    <a href="riwayat-konsultasi.php" class="nav-item nav-link"><i class="bi bi-person-lines-fill"></i>Riwayat Identifikasi</a>
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
                <h4 class="mb-4">Data Hasil Identifikasi</h4>

                <!-- Display existing consultation data -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="20">Nama</th>
                                <th class="text-center" width="10">Jenis Kelamin</th>
                                <th class="text-center" width="5">Usia</th>
                                <th class="text-center" width="10">Tanggal Identifikasi</th>
                                <th class="text-center" width="20">Hasil</th>
                                <th class="text-center" width="30">Gejala</th>
                                <th class="text-center" width="30">Konsultasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($konsultasi)) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $row['nama_user']; ?></td>
                                    <td class="text-center"><?php echo $row['jenis_kelamin']; ?></td>
                                    <td class="text-center"><?php echo $row['usia']; ?></td>
                                    <td class="text-center"><?php echo $row['tanggal_konsultasi']; ?></td>
                                    <td class="text-center"><?php echo $row['diagnosis']; ?></td>
                                    <td class="text-justify"><?php echo $row['gejala_terpilih']; ?></td>
                                    <td class="text-justify"><?php echo $row['solusi']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination links -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                            <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
                                <a class="page-link" href="riwayat-konsultasi.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div
    </div>

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

</html>
