<?php
// Konfigurasi database
$host = 'localhost';       // Host database
$username = 'root';        // Username database
$password = '';            // Password database
$dbname = 'sertifikat';    // Nama database

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set PDO error mode ke exception untuk menangani error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}

// Koneksi berhasil jika tidak ada exception
echo 'Koneksi berhasil!';
?>

