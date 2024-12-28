<?php
session_start();
require './db_config.php'; // Pastikan file ini berisi koneksi ke database

$error = ""; // Inisialisasi variabel error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $foto = trim($_POST['foto']);

    try {
        // Cek apakah username atau email sudah digunakan
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            if ($existing_user['username'] === $username) {
                throw new Exception("Username sudah terdaftar. Silakan gunakan username lain.");
            } elseif ($existing_user['email'] === $email) {
                throw new Exception("Email sudah terdaftar. Silakan gunakan email lain.");
            }
        }

        // Proses upload foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $maxFileSize = 50 * 1024 * 1024; // 50MB
            if ($_FILES['foto']['size'] > $maxFileSize) {
                throw new Exception("Ukuran file terlalu besar. Maksimal 50MB.");
            }

            $foto_name = $_FILES['foto']['name'];
            $foto_tmp = $_FILES['foto']['tmp_name'];
            $foto_extension = pathinfo($foto_name, PATHINFO_EXTENSION);
            $foto_new_name = uniqid() . '.' . $foto_extension;
            $foto_path = '../uploads/' . $foto_new_name;

            if (!move_uploaded_file($foto_tmp, $foto_path)) {
                throw new Exception("Gagal mengunggah foto.");
            }

            $foto = $foto_new_name;
        }

        // Simpan data ke database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, foto) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$username, $email, $password_hash, $foto])) {
            echo "Pendaftaran berhasil! Silakan <a href='login.php'>LOGIN</a>.";
        } else {
            throw new Exception("Terjadi kesalahan saat mendaftar.");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3>Registrasi Akun</h3>
                    </div>
                    <div class="card-body">
                        <form action="daptar.php" method="POST">
                            <!-- Username -->
                            <div class="mb-3">
                                <label for="foto" class="form-label">foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" placeholder="Masukkan foto" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password_hash" name="password_hash" placeholder="Masukkan password" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>Sudah memiliki akun? <a href="masuk.php">Login di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
