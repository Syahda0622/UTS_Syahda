<?php
include "koneksi.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <form method="POST">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan Email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan Password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <p>Belum punya akun? 
        <a href="index.php?page=register">Register di sini</a>
    </p>
</div>

<?php
if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $data = mysqli_fetch_assoc($query);

    // Cek apakah user ditemukan dan password cocok (baik hash atau polos)
    if ($data && (password_verify($password, $data['password']) || $password === $data['password'])) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        // Tentukan redirect sesuai role
        if ($data['role'] === 'admin') {
            $redirect = 'dashboard_admin.php';
        } else {
            $redirect = 'dashboard.php';
        }

        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: 'Hai, " . htmlspecialchars($data['username']) . " 💕',
            showConfirmButton: false,
            timer: 1800
        }).then(function() {
            window.location.href = '$redirect';
        });
        </script>";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Login gagal!',
            text: 'Email atau password salah 😭',
        });
        </script>";
    }
}
?>

</body>
</html>
