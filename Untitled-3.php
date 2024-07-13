<?php
include 'auth.php';
include 'db.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $solusi = $_POST['solusi'];
        $sql = "INSERT INTO penyakit (kode, nama, deskripsi, solusi) VALUES ('$kode', '$nama', '$deskripsi', '$solusi')";
        mysqli_query($conn, $sql);
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $solusi = $_POST['solusi'];
        $sql = "UPDATE penyakit SET kode='$kode', nama='$nama', deskripsi='$deskripsi', solusi='$solusi' WHERE id=$id";
        mysqli_query($conn, $sql);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM penyakit WHERE id=$id";
        mysqli_query($conn, $sql);
    }
}

// Pagination parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10; // Number of records per page
$offset = ($page - 1) * $limit;

// Fetch data for display

$penyakit_query = mysqli_query($conn, "SELECT * FROM penyakit");

// Handle pagination
$total_records = mysqli_num_rows($penyakit_query);
$total_pages = ceil($total_records / $limit);

// Fetch data with pagination
$penyakit = mysqli_query($conn, "SELECT * FROM penyakit LIMIT $limit OFFSET $offset");
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

            <!-- Data Solusi Start -->
            <div class="container pt-4 px-4 mb-4">
                <h4>Data Penyakit</h4>
                <a href="#" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showAddModal()">Tambah Data</a>

                <!-- Modal Tambah Data -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penyakit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="penyakit.php">
                                    <div class="mb-3">
                                        <label for="kode" class="col-form-label">Kode:</label>
                                        <input type="text" class="form-control" id="kode" name="kode" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama" class="col-form-label">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-5">
                                        <label for="deskripsi" class="col-form-label">Deskripsi:</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-5">
                                        <label for="solusi" class="col-form-label">Solusi:</label>
                                        <textarea class="form-control" id="solusi" name="solusi" rows="3" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="add" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Tambah Data End -->

                <!-- Modal Edit Data -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Solusi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="penyakit.php">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                        <label for="edit-kode" class="col-form-label">Kode:</label>
                        <input type="text" class="form-control" id="edit-kode" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-nama" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="edit-nama" name="nama" required>
                    </div>
                    <div class="mb-5">
                        <label for="edit-deskripsi" class="col-form-label">Deskripsi:</label>
                        <textarea class="form-control" id="edit-deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="edit-solusi" class="col-form-label">Solusi:</label>
                        <textarea class="form-control" id="edit-solusi" name="solusi" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                <!-- Modal Edit Data End -->

                <!-- Modal Delete Data -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                <form method="POST" action="penyakit.php">
                                    <input type="hidden" id="delete-id" name="id">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Delete Data End -->

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="3" class="text-center">Kode</th>
                                <th width="10" class="text-center">Nama Penyakit</th>
                                <th width="30" class="justify">Deskripsi</th>
                                <th width="30" class="justify">solusi</th>
                                <th width="10" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = $offset + 1; // Hitung nomor urut berdasarkan offset
                            while ($row = mysqli_fetch_assoc($penyakit)) :
                            ?>
                                <tr>
                                    <td width="3" class="text-center"><?php echo $row['kode']; ?></td>
                                    <td width="10" class="text-center"><?php echo $row['nama']; ?></td>
                                    <td width="30" class="justify"><?php echo $row['deskripsi']; ?></td>
                                    <td width="30" class="justify"><?php echo $row['solusi']; ?></td>
                                    <td width="10" class="text-center">
                                        <a href="#" class="btn btn-warning m-1" data-bs-toggle="modal" data-bs-target="#editModal" onclick="fillEditModal(<?php echo $row['id']; ?>, '<?php echo $row['kode']; ?>', '<?php echo $row['nama']; ?>', '<?php echo $row['deskripsi']; ?>',  '<?php echo $row['solusi']; ?>')">Edit</a>
                                        <a href="#" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="confirmDelete(<?php echo $row['id']; ?>)">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="penyakit.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
                <!-- Pagination End -->
            </div>
            <!-- Data Solusi End -->
        </div>
        <!-- Content End -->
    </div>

    <script>
        function showAddModal() {
            document.getElementById('kode').value = '';
            document.getElementById('nama').value = '';
            document.getElementById('deskripsi').value = '';
            document.getElementById('solusi').value = '';
        }

        function fillEditModal(id, kode, nama, deskripsi,solusi) {
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-kode').value = kode;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-deskripsi').value = deskripsi;
    document.getElementById('edit-solusi').value = solusi;
}


        function confirmDelete(id) {
            document.getElementById('delete-id').value = id;
        }
    </script>

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
pada form edit ketika solusi mengandung text yang panjang tidak muncul valuenya lalu bagaimana untuk mengatasinya