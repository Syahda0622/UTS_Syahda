<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['username'])) {
    echo "<script>
            alert('Silakan login dulu 💙');
            window.location.href = 'login.php';
          </script>";
    exit;
}

$username = $_SESSION['username'];
$queryUser = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$userData = mysqli_fetch_assoc($queryUser);

// Tentukan page
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- pakai CSS yang sudah ada -->
    <style>
        /* Judul di atas navbar */
        .site-title {
            background: #f4f6f9;
            text-align: center;
            padding: 15px 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        /* Table product agar lebih rapi */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        h3.kategori-title {
            margin-top: 30px;
            color: #007BFF;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>

    <!-- Judul di atas navbar -->
    <div class="site-title">User Authentication System</div>

    <!-- Navbar -->
    <nav>
        <div>
            <a href="?page=dashboard">Dashboard</a> |
            <a href="?page=product">Product</a> |
            <a href="?page=user">User</a> |
            <a href="logout.php">Logout</a> |
        </div>
    </nav>

    <!-- Kontainer utama -->
    <div class="container">
        <?php
        if ($page == 'dashboard') {
            echo "<h2>Dashboard</h2>";
            echo "<p>Halo, $username! Selamat datang di dashboard 💙</p>";
        } 
        elseif ($page == 'product') {
            echo "<h2>Product</h2>";

            // Ambil semua kategori unik
            $queryKategori = mysqli_query($conn, "SELECT DISTINCT kategori FROM products");
            while ($kat = mysqli_fetch_assoc($queryKategori)) {
                $kategori = htmlspecialchars($kat['kategori']);
                echo "<h3 class='kategori-title'>$kategori</h3>";

                // Ambil semua produk di kategori ini
                $queryProduk = mysqli_query($conn, "SELECT * FROM products WHERE kategori='$kategori'");
                echo "<table>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Expired Date</th>
                        </tr>";
                while ($prod = mysqli_fetch_assoc($queryProduk)) {
                    echo "<tr>
                            <td>".htmlspecialchars($prod['nama'])."</td>
                            <td>".htmlspecialchars($prod['harga'])."</td>
                            <td>".htmlspecialchars($prod['stok'])."</td>
                            <td>".htmlspecialchars($prod['expired_date'])."</td>
                          </tr>";
                }
                echo "</table>";
            }
        } 
        elseif ($page == 'user') {
            echo "<h2>Profil User</h2>";
            echo "<div style='text-align:center;'>";

            $foto = isset($userData['foto']) && !empty($userData['foto']) ? $userData['foto'] : 'default.png';
            echo "<img src='uploads/".$foto."' style='width:120px; height:120px; border-radius:50%; margin-bottom:15px;'><br>";

            echo "<p>Username: ".htmlspecialchars($userData['username'])."</p>";
            echo "</div>";

            echo "
            <h3 style='text-align:center;'>Update Profil</h3>
            <form action='update_username.php' method='POST' enctype='multipart/form-data'>
                <label>Username:</label>
                <input type='text' name='username' value='".htmlspecialchars($userData['username'])."' required>

                <label>Foto Profil:</label>
                <input type='file' name='foto'>

                <button type='submit'>Update</button>
            </form>";
        } else {
            echo "<p>Halaman tidak ditemukan</p>";
        }
        ?>
    </div>
</body>
</html>
