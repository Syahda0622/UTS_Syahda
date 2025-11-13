<?php
include 'koneksi.php';
session_start();

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $expired_date = $_POST['expired_date'];

    $update = mysqli_query($conn, "UPDATE products SET nama='$nama', kategori='$kategori', harga='$harga', stok='$stok', expired_date='$expired_date' WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Produk berhasil diupdate!'); window.location='dashboard_admin.php?page=product';</script>";
    } else {
        echo "<script>alert('Gagal update produk!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Produk</h2>
    <form method="POST">
        <label>Nama Produk</label>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required>

        <label>Kategori</label>
        <input type="text" name="kategori" value="<?= $data['kategori'] ?>" required>

        <label>Harga</label>
        <input type="number" name="harga" value="<?= $data['harga'] ?>" required>

        <label>Stok</label>
        <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

        <label>Expired Date</label>
        <input type="date" name="expired_date" value="<?= $data['expired_date'] ?>" required>

        <button type="submit" name="update">Update</button>
    </form>
</div>
</body>
</html>
