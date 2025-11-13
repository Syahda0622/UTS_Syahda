<?php
session_start();
include 'koneksi.php';

// Cek login & role admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>
            alert('Akses ditolak! Hanya admin yang bisa masuk 💥');
            window.location.href = 'login.php';
          </script>";
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Kelola Supplier</title>
<link rel="stylesheet" href="style.css">
<style>
    body { font-family: Arial, sans-serif; background: #f4f6f9; margin:0; padding:0; }
    .site-title { background: #007BFF; text-align:center; padding:15px 0; font-size:24px; font-weight:bold; color:white; margin-bottom:20px; }
    nav { background:#f8f9fa; padding:10px; text-align:center; border-bottom:1px solid #ddd; }
    nav a { color:#007BFF; text-decoration:none; margin:0 10px; font-weight:bold; }
    nav a:hover { text-decoration:underline; }
    .container { width:90%; max-width:1000px; background:#fff; margin:30px auto; padding:25px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
    table { width:100%; border-collapse:collapse; margin-top:10px; margin-bottom:30px; }
    th, td { padding:10px; border:1px solid #ddd; text-align:center; }
    th { background-color:#007BFF; color:white; }
    .btn { background-color:#007BFF; color:white; border:none; padding:8px 16px; border-radius:5px; cursor:pointer; text-decoration:none; display:inline-block; }
    .btn-warning { background:#ffc107; color:black; }
    .btn-danger { background:#dc3545; }
    .btn:hover { opacity:0.9; }
</style>
</head>
<body>

<div class="site-title">Kelola Supplier</div>

<nav>
    <a href="dashboard_admin.php?page=dashboard">Dashboard</a> |
    <a href="dashboard_admin.php?page=users">Master User</a> |
    <a href="dashboard_admin.php?page=product">Product</a> |
    <a href="supplier.php">Supplier</a> |
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
<h2>Daftar Supplier</h2>
<?php
$querySupp = mysqli_query($conn, "SELECT * FROM supplier");
echo "<table>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>";

while ($supp = mysqli_fetch_assoc($querySupp)) {
    // pakai supplier_id
    $id = isset($supp['supplier_id']) ? $supp['supplier_id'] : 0;
    echo "<tr>
            <td>{$supp['nama_supplier']}</td>
            <td>{$supp['alamat']}</td>
            <td>{$supp['telepon']}</td>
            <td>
                <a href='edit_supplier.php?id={$id}' class='btn btn-warning'>Edit</a>
                <a href='hapus_supplier.php?id={$id}' class='btn btn-danger' onclick='return confirm(\"Hapus supplier ini?\");'>Hapus</a>
            </td>
          </tr>";
}
echo "</table>";
?>
<div style="text-align:center; margin-top:20px;">
    <a href="tambah_supplier.php" class="btn">+ Tambah Supplier</a>
</div>
</div>

</body>
</html>
