<?php
include 'auth.php'; // Pastikan file auth.php memvalidasi sesi pengguna
include 'db.php'; // Koneksi ke database

// Pastikan koneksi berhasil
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Pagination configuration
$results_per_page = 10; // Jumlah hasil per halaman
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Halaman saat ini, default adalah 1

// Hitung titik awal untuk hasil yang ditampilkan pada halaman saat ini
$start_from = ($current_page - 1) * $results_per_page;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_solusi = $_POST['kode_solusi'];
    $deskripsi = $_POST['deskripsi'];

    if (isset($_POST['add'])) {
        $sql = "INSERT INTO solusi (kode_solusi, deskripsi) VALUES ('$kode_solusi', '$deskripsi')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Query SQL gagal dieksekusi: " . mysqli_error($conn));
        }
    } elseif (isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $sql = "UPDATE solusi SET kode_solusi='$kode_solusi', deskripsi='$deskripsi' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Query SQL gagal dieksekusi: " . mysqli_error($conn));
        }
    } elseif (isset($_POST['delete'])) {
        $id = intval($_POST['id']);
        $sql = "DELETE FROM solusi WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Query SQL gagal dieksekusi: " . mysqli_error($conn));
        }
    }

    // Redirect untuk menghindari resubmission
    header('Location: solusi.php');
    exit();
}

// Menghitung jumlah total record
$sql_count = "SELECT COUNT(*) AS total FROM solusi";
$result_count = mysqli_query($conn, $sql_count);
if (!$result_count) {
    die("Query SQL gagal dieksekusi: " . mysqli_error($conn));
}
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total'];

// Menghitung total halaman
$total_pages = ceil($total_records / $results_per_page);

// Mengambil data untuk ditampilkan
$sql = "SELECT id, kode_solusi, deskripsi FROM solusi LIMIT $start_from, $results_per_page";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query SQL gagal dieksekusi: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Solusi - CekMental</title>
    <!-- Tautan CSS dan JS diletakkan di sini -->
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
    <div class="container">
        <!-- Tampilan tabel data solusi -->
        <h2>Data Solusi</h2>
        <!-- Tombol tambah data -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showAddModal()">Tambah Data</button>

        <!-- Modal tambah dan edit data -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Isi modal di sini -->
        </div>

        <!-- Tabel data solusi -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Solusi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['kode_solusi']; ?></td>
                            <td><?php echo $row['deskripsi']; ?></td>
                            <td>
                                <!-- Tombol edit -->
                                <button onclick="editSolusi(<?php echo $row['id']; ?>, '<?php echo $row['kode_solusi']; ?>', '<?php echo htmlspecialchars($row['deskripsi']); ?>')" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                                <!-- Tombol hapus -->
                                <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                    <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
                        <a class="page-link" href="solusi.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <!-- JavaScript dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript kustom untuk mengatur perilaku modal -->
    <script>
        function showAddModal() {
            // Implementasi logika untuk menampilkan modal tambah data
        }

        function editSolusi(id, kode_solusi, deskripsi) {
            // Implementasi logika untuk menampilkan modal edit data
        }

        function confirmDelete(id) {
            // Implementasi logika untuk menampilkan konfirmasi hapus
        }
    </script>
</body>

</html>
