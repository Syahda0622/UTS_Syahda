<?php
include 'koneksi.php';
session_start();

$id = $_GET['id'];
$delete = mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

if ($delete) {
    echo "<script>alert('Produk berhasil dihapus!'); window.location='dashboard_admin.php?page=product';</script>";
} else {
    echo "<script>alert('Gagal menghapus produk!');</script>";
}
?>
