<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mycertificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hero {
            background: linear-gradient(to bottom right, #4e73df, #224abe);
            color: white;
            padding: 50px 0;
            text-align: center;
        }

        .feature {
            padding: 20px;
            text-align: center;
        }

        .feature h3 {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Mycertificate</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Galery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Buat Sertifikat Acara Profesional dengan Mudah</h1>
            <p>Rancang, sesuaikan, dan bagikan sertifikat untuk acara Anda hanya dengan beberapa klik.</p>
            <a href="generate_certificate.php" class="btn btn-light btn-lg">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="container mt-5">
        <div class="row">
            <div class="col-md-4 feature">
                <i class="bi bi-palette" style="font-size: 2rem;"></i>
                <h3>Custom Designs</h3>
                <p>Buat sertifikat dengan desain unik dan profesional.</p>
            </div>
            <div class="col-md-4 feature">
                <i class="bi bi-people" style="font-size: 2rem;"></i>
                <h3>Personalisasi Otomatis</h3>
                <p>Secara otomatis menambahkan detail peserta ke sertifikat.</p>
            </div>
            <div class="col-md-4 feature">
                <i class="bi bi-envelope" style="font-size: 2rem;"></i>
                <h3>Berbagi dengan Mudah</h3>
                <p>Kirim sertifikat melalui email atau berikan tautan yang dapat diunduh.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 CertifyNow. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>