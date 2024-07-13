<?php

include 'db.php';
error_reporting(0);
session_start();

$error = ""; // Initialize error variable

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $usia = $_POST['usia'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Validate email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Check if email already exists
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            // Email is valid and does not exist in database

            // Validate password format
            if ($password === $cpassword) {
                if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                    // Password meets complexity requirements

                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

                    // Insert user data into database
                    $sql = "INSERT INTO users (nama, email, password_user, usia, jenis_kelamin)
                            VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "sssis", $nama, $email, $passwordHash, $usia, $jenis_kelamin);
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        // Successful registration
                        $_SESSION['success_message'] = "Pendaftaran Pengguna Berhasil.";
                        $nama = "";
                        $email = "";
                        $usia = "";
                        $jenis_kelamin = "";

                        // Redirect to login page after successful registration
                        echo "<script>alert('Pendaftaran Pengguna Berhasil.'); window.location='login-user.php';</script>";
                        exit();
                    } else {
                        // Database error
                        $error = "Ada Kesalahan dari Server!";
                    }
                } else {
                    // Password complexity requirements not met
                    $error = "Password tidak valid! Password harus mengandung huruf besar, kecil, angka, dan karakter khusus.";
                }
            } else {
                // Passwords do not match
                $error = "Password tidak sama!";
            }
        } else {
            // Email already exists
            $error = "Email Sudah Ada";
        }
    } else {
        // Invalid email format
        $error = "Email tidak valid!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            background-image: url();
        }

        .card {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 30px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .login-register-text {
            text-align: center;
        }
    </style>
    <title>CekMental</title>
</head>
<body>
<section class="card">
    <div class="container">
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST" class="login-email" name="registrationForm" onsubmit="return validateForm()">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>"
                       required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                       required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Konfirmasi Password" name="cpassword" required>
            </div>
            <div class="input-group">
                <select name="jenis_kelamin" required>
                    <option value="" disabled selected>Pilih Gender</option>
                    <option value="Laki-laki" <?php if ($jenis_kelamin === 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($jenis_kelamin === 'Perempuan') echo 'selected'; ?>>Perempuan
                    </option>
                </select>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Umur" name="usia" value="<?php echo htmlspecialchars($usia); ?>"
                       required>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Daftar</button>
            </div>
            <p class="login-register-text">Sudah punya akun? <a href="login-user.php">Login disini</a></p>
        </form>
    </div>
</section>

<script>
    function validateForm() {
        var email = document.forms["registrationForm"]["email"].value;
        if (!/\S+@\S+\.\S+/.test(email)) {
            alert("Format email tidak valid");
            return false;
        }
        return true;
    }
</script>

<script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
