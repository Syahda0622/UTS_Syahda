<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak! 💥');window.location.href='login.php';</script>";
    exit;
}

$supplier_id = isset($_GET['id']) ? $_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM supplier WHERE supplier_id=$supplier_id");
$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_supplier']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);

    $update = "UPDATE supplier SET nama_supplier='$nama', alamat='$alamat', telepon='$telepon' WHERE supplier_id=$supplier_id";
    if (mysqli_query($conn, $update)) {
        header("Location: supplier.php");
        exit;
    } else {
        echo "Gagal update supplier: ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Supplier</title>
<link rel="stylesheet" href="style.css">
<style>
.container { width:90%; max-width:600px; margin:30px auto; background:#fff; padding:25px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
input, button { padding:10px; width:100%; margin:10px 0; border-radius:5px; border:1px solid #ddd; }
button { background:#ffc107; color:black; border:none; cursor:pointer; }
button:hover { opacity:0.9; }
</style>
</head>
<body>
<div class="container">
<h2>Edit Supplier</h2>
<form method="post">
    <label>Nama Supplier:</label>
    <input type="text" name="nama_supplier" value="<?php echo $data['nama_supplier']; ?>" required>
    <label>Alamat:</label>
    <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required>
    <label>Telepon:</label>
    <input type="text" name="telepon" value="<?php echo $data['telepon']; ?>" required>
    <button type="submit">Update Supplier</button>
</form>
</div>
</body>
</html>
