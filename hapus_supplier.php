<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Akses ditolak! 💥');window.location.href='login.php';</script>";
    exit;
}

$supplier_id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($supplier_id != 0) {
    mysqli_query($conn, "DELETE FROM supplier WHERE supplier_id=$supplier_id");
}

// redirect ke halaman supplier
header("Location: supplier.php");
exit;
