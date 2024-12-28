<?php
session_start();

// Pastikan user yang login adalah user biasa
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ./login.php"); // Redirect ke login jika bukan user
    exit();
}

// Konten dashboard user
echo "Selamat datang di Dashboard User!";
?>

