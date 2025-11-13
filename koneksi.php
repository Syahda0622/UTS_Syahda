<?php
$host = "localhost"; // biasanya localhost
$user = "root"; // username MySQL
$pass = ""; // password MySQL (kosong kalau pakai XAMPP default)
$db   = "dbusers"; // nama database

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
