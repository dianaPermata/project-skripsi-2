<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
    <style>

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
<body>
    <!-- Navbar -->
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


    <!-- Navbar End -->

    <!-- Content -->
    <div class="color-bg">
        <div class="container-fluid banner">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content">
                    <h1>Hai Guys!<span> Bagaimana Kabarmu ? </span></h1>
                    <p class="text-align-justify">Yuk perhatikan kesehatan mentalmu dengan langkah pertama menuju pikiran yang lebih sehat setelah mengalami patah hati dengan melakukan identifikasi kesehatan mental di CekMental</p>
                        <a href="<?php echo isset($_SESSION['user_id']) ? 'konsultasi.php' : 'login-user.php'; ?>" class="btn btn-primary">Mulai Identifikasi</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="gambar/Download_Dating_couple_having_a_conflict_and_relationship_problems__for_free__1_-removebg-preview.png" alt="Gambar Banner" class="banner-image">
                </div>
            </div>
        </div>
                </div>


                
<div class="cards mb-5">
        <div class="col-lg-12 text-center">
            <div class="main-text">
                <h1>Alur Identifikasi</h1>
                <p>Berikut ini alur identifikasi kesehatan mental pasca putus cinta yang harus dilakukan</p>
            </div>
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card single-card-active">
                        <div class="card-body">
                            <div class="single-card-text">
                                <h3>Login Akun</h3>
                                <p>Pengguna harus melakukan login sebelum melakukan identifikasi, jika belum memiliki silahkan anda melakukan registrasi akun terlebih dahulu</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card single-card-active">
                        <div class="card-body">
                            <div class="single-card-text">
                                <h3>Identifikasi</h3>
                                <p>Lakukan identifikasi kesehatan mental anda dengan menjawab pertanyaan yang disediakan oleh sistem berdasarkan keadaan anda saat ini</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card single-card-active">
                        <div class="card-body">
                            <div class="single-card-text">
                                <h3>Hasil & Solusi</h3>
                                <p>Setelah identifikasi kesehatan mental pasca putus cinta anda akan diberikan hasil identifikasi berupa nama penyakit dan solusinya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <header class="header text-center mt-5">
            <div class="container">
              <h3>Cara Menjaga Kesehatan Mental Pasca Putus Cinta</h3>
              <p>Panduan dan Tips untuk Menjaga Kesehatan Mental Anda</p>
            </div>
          </header>


  <!-- Tips Section -->
 <!-- Tips Section -->
<section class="tips">
  <div class="container">
    <div class="row">
      <div>
        <h5>1. Berbicara dengan Teman</h5>
        <p>Mengobrol dengan teman dekat atau anggota keluarga dapat membantu mengurangi beban emosional yang Anda rasakan.</p>
      </div>
      <div>
        <h5>2. Jaga Kesehatan Fisik</h5>
        <p>Olahraga secara teratur dan makan makanan sehat dapat membantu meningkatkan mood Anda dan mengurangi stres.</p>
      </div>
      <div>
        <h5>3. Luangkan Waktu untuk Diri</h5>
        <p>    Melakukan hobi yang Anda nikmati atau mencoba sesuatu yang baru dapat membantu mengalihkan pikiran dari perasaan negatif.</p>
      </div>
      <div>
        <h5>4. Menghindari Media Sosial</h5>
        <p>Mengambil istirahat dari media sosial dapat membantu menghindari perasaan cemburu atau sakit hati melihat update dari mantan pasangan.</p>
      </div>
      <div>
        <h5>5. Fokus Pada Diri Sendiri</h5>
        <p>Gunakan waktu ini untuk fokus pada diri sendiri, mungkin dengan mengikuti kursus baru, membaca buku, atau mengejar hobi yang pernah tertunda.</p>
      </div>
      <div>
        <h5>6. Lakukan Identifikasi Kesehatan Mental</h5>
        <p>Lakukan Identifikasi Kesehatan Mental di CekMental jika merasakan gejala gangguan mental sebagai bentuk penanganan pertama</p>
      </div>
      <div>
        <h5>7. Cari Bantuan Professional</h5>
        <p>Jika perasaan Anda terlalu berat untuk ditangani sendiri, pertimbangkan untuk berbicara dengan konselor atau terapis profesional.</p>
      </div>
    </div>
  </div>
</section>



    <div class="footer  bg-light">
  <p class="copy-right">&copy;|Repost by Posyandu Kesehatan Jiwa
          </p>
</div>

    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
