<?php
session_start();

// Pastikan user yang login adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect ke login jika bukan admin
    exit();
}

// Konten dashboard admin
echo "Selamat datang di Dashboard Admin!";
?>
