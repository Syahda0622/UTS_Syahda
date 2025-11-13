<?php
include "koneksi.php";
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Users</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 70vh;
            text-align: center;
        }

        .profile-container h2 {
            font-size: 28px;
            color: #333;
        }

        .profile-container img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-top: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .logout-btn {
            margin-top: 20px;
            background-color: #ff4d4d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #d93636;
        }
    </style>
</head>
<body>
    <h1>User Authentication System</h1>
    <nav>
        <a href="index.php">Home</a> |
        <a href="index.php?page=login">Login</a> |
        <a href="index.php?page=register">Register</a> |
        <a href="datausers.php">Data Users</a> |
        <a href="logout.php">Logout</a> |
    </nav>
    <hr>

    <div class="profile-container">
        <h2>Haloo, <?php echo htmlspecialchars($_SESSION['username']); ?> 💖</h2>
        <p>Senang ketemu kamu lagi~</p>
        <img src="syahda.jpg" alt="Foto Syahda">
        <form method="POST" action="logout.php">
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
