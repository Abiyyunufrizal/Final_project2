<?php
session_start();
require './db_config.php';

$error = ""; // Inisialisasi variabel error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Periksa apakah input sudah diisi
    if (!empty($_POST['username_or_email']) && !empty($_POST['password'])) {
        $usernameOrEmail = $_POST['username_or_email'];
        $password = $_POST['password'];

        try {
            // Cek apakah pengguna ada di database berdasarkan username atau email
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
            $user = $stmt->fetch();

            // Validasi data user dan password
            if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
                // Jika password benar, simpan informasi pengguna dalam sesi
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];  // Pastikan role disimpan dengan benar

                // Cek role dan alihkan pengguna ke halaman yang sesuai
                if ($_SESSION['role'] === 'admin') {
                    header("Location: ./admin_dashboard.php"); // Arahkan admin ke admin dashboard
                    exit();
                } elseif ($_SESSION['role'] === 'user') {
                    header("Location: ./user_dashboard.php"); // Arahkan user ke user dashboard
                    exit();
                } else {
                    $error = "Role tidak ditemukan.";
                }
            } else {
                $error = "Username, email, atau password salah.";
            }
        } catch (Exception $e) {
            $error = "Terjadi kesalahan: " . $e->getMessage();
        }
    } else {
        $error = "Harap isi semua kolom.";
    }
}
?>

<!-- Menampilkan error -->
<?php if ($error) { ?>
    <div class="error"><?php echo $error; ?></div>
<?php } ?>





<!DOCTYPE html>
<html>
<head>
  <title>Login/Sign up</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Add your custom CSS styles here */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    
    .container {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }
    
    .button {
      background-color: #4CAF50;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }
    
    .button:hover {
      background-color: #45a049;
    }
    
    .input-field {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login/Sign up</h2>
    <div class="button-group">
    </div>
    <input type="email" class="input-field" placeholder="admin@gmail.com">
    
    <input type="password" class="input-field" placeholder="admin">
    
   <a href="./admin/dashboard.php"> <button class="button">Login</button></a>
  
    <span>belum memiliki akun?<a href="daptar.php" class="button1">daptar disini</a>
    </span>
  </div>
</body>
</html>