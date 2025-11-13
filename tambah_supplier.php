<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak! 💥');window.location.href='login.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_supplier']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);

    $query = "INSERT INTO supplier (nama_supplier, alamat, telepon) VALUES ('$nama','$alamat','$telepon')";
    if (mysqli_query($conn, $query)) {
        header("Location: supplier.php");
        exit;
    } else {
        echo "Gagal tambah supplier: ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tambah Supplier</title>
<link rel="stylesheet" href="style.css">
<style>
.container { width:90%; max-width:600px; margin:30px auto; background:#fff; padding:25px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
input, button { padding:10px; width:100%; margin:10px 0; border-radius:5px; border:1px solid #ddd; }
button { background:#007BFF; color:white; border:none; cursor:pointer; }
button:hover { opacity:0.9; }
</style>
</head>
<body>
<div class="container">
<h2>Tambah Supplier</h2>
<form method="post">
    <label>Nama Supplier:</label>
    <input type="text" name="nama_supplier" required>
    <label>Alamat:</label>
    <input type="text" name="alamat" required>
    <label>Telepon:</label>
    <input type="text" name="telepon" required>
    <button type="submit">Tambah Supplier</button>
</form>
</div>
</body>
</html>
