<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Templates</title>
    <style>
        /* Gaya Umum */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: center; /* Pusatkan semua kartu */
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            width: 300px; /* Lebar kartu tetap */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center; /* Pusatkan elemen dalam kartu */
            text-align: center; /* Teks di tengah */
        }

        .card-title {
            padding: 15px;
            font-size: 18px;
            color: #333;
            margin: 0;
            font-weight: bold;
        }

        .certificate {
            padding: 20px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            text-align: center; /* Pusatkan teks */
            background-position: center;
        }

        .cert-logo img,
        .award-header img {
            max-width: 300px; /* Ukuran maksimal gambar */
            height: auto;     /* Proporsi tetap */
            margin-bottom: 10px;
        }

        .cert-content {
            margin-top: 10px;
        }

        .cert-title {
            font-size: 16px;
            font-weight: bold;
            color: #222;
            margin: 10px 0 5px;
        }

        .cert-name {
            font-size: 14px;
            margin: 5px 0;
        }

        .cert-date {
            font-size: 12px;
            color: #555;
            margin-bottom: 10px;
        }

        .btn-template {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-template:hover {
            background-color: #0056b3;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Elemen menjadi vertikal */
                align-items: center;    /* Pusatkan elemen */
            }

            .card {
                width: 100%; /* Kartu mengambil lebar penuh */
                max-width: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sertifikat Beasiswa -->
        <div class="card">
            <h3 class="card-title">Sertifikat Penghargaan</h3>
            <div class="certificate scholarship-cert">
                <div class="cert-logo">
                    <img src="image/a.jpg" alt="Logo Beasiswa" class="cert-img" />
                </div>
                <div class="cert-content">
                    <h4 class="cert-title">CERTIFICATE OF SCHOLARSHIP</h4>
                    <p class="cert-name"></p>
                    <p class="cert-date">February 22, 2019</p>
                </div>
            </div>
            <a href="generate_certificate.php" class="btn-template">Pakai Template</a>
        </div>

        <!-- Sertifikat Penghargaan -->
        <div class="card">
            <h3 class="card-title">Sertifikat Apresiasi</h3>
            <div class="certificate award-cert">
                <div class="award-header">
                    <img src="image/b.jpg" alt="Logo Penghargaan" class="cert-img" />
                </div>
                <div class="cert-content">
                    <h4 class="cert-title">AWARD CERTIFICATE</h>
                    <p class="cert-name"></p>
                    <p class="cert-date">February 21, 2019</p>
                </div>
            </div>
            <a href="generate_certificate.php" class="btn-template">Pakai Template</a>
        </div>
    </div>
</body>
</html>
