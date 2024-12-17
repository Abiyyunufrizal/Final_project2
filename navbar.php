<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#certificate">Sertifikat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten untuk demonstrasi -->
    <section id="home" class="py-5 bg-light text-center">
        <div class="container">
            <h1>Home Section</h1>
            <p>Welcome to the home page of the dashboard.</p>
        </div>
    </section>

    <section id="about" class="py-5 text-center">
        <div class="container">
            <h1>Tentang </h1>
            <p>Aplikasi ini dirancang khusus untuk memudahkan Anda dalam membuat sertifikat custom untuk berbagai jenis acara. Dengan antarmuka yang sederhana dan fitur yang canggih, aplikasi ini memungkinkan Anda untuk:

                Mendesain sertifikat unik sesuai tema acara Anda, seperti seminar, workshop, kompetisi, atau acara perusahaan.
                Menyesuaikan elemen sertifikat, seperti nama penerima, jenis acara, tanggal, dan tanda tangan digital, dengan mudah.
                Mengelola dan menyimpan sertifikat dalam format digital, siap untuk dicetak atau dikirimkan secara online.</p>
        </div>
    </section>

    <section id="certificate" class="py-5 bg-light text-center">
        <div class="container">
            <h1>Sertifikat Section</h1>
            <p>Kelola dan buat sertifikat di sini.</p>
        </div>
    </section>

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
