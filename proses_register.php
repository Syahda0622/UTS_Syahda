<?php
include 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    
    if ($role === "admin") {
        if ($password !== "admin123") {
            echo "<script>
                    alert('Password admin salah! Gunakan password khusus admin123.');
                    window.location.href='index.php?page=register';
                  </script>";
            exit;
        }
        
        $hashed_password = $password;
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

    
    $query = "INSERT INTO users (username, email, password, role) 
              VALUES ('$username', '$email', '$hashed_password', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location.href='index.php?page=login';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan: " . mysqli_error($conn) . "' );
                window.history.back();
              </script>";
    }

    exit;
}
?>
