<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldUsername = $_SESSION['username'];
    $newUsername = mysqli_real_escape_string($conn, $_POST['username']);

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // bikin folder uploads jika belum ada
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoName = time() . '_' . $_FILES['foto']['name'];
        $targetPath = $uploadDir . $fotoName;
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
            $sql = "UPDATE users SET username='$newUsername', foto='$fotoName' WHERE username='$oldUsername'";
        } else {
            $sql = "UPDATE users SET username='$newUsername' WHERE username='$oldUsername'";
        }
    } else {
        $sql = "UPDATE users SET username='$newUsername' WHERE username='$oldUsername'";
    }

    if (mysqli_query($conn, $sql)) {
        $_SESSION['username'] = $newUsername;
        header("Location: dashboard.php?page=user");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
