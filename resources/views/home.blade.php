<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Rapor</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">E-Rapor</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="/home" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
                <li class="nav-item"><a href="/product" class="nav-link">Product</a></li>
                <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="/login" class="nav-link btn btn-light text-primary ms-2 px-3">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="container text-center mt-5">
    <h1 class="fw-bold text-primary">Selamat Datang di E-Rapor</h1>
    <p class="text-muted">Sistem Pengolahan Rapor Siswa Berbasis Web</p>

    <a href="/login" class="btn btn-primary mt-3 px-4">Mulai Sekarang</a>
</div>

<!-- Feature Section -->
<div class="container mt-5">
    <div class="row text-center">

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="text-primary">Manajemen Nilai</h5>
                <p>Mengelola nilai siswa dengan mudah dan cepat.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="text-primary">Laporan Rapor</h5>
                <p>Cetak rapor otomatis dan rapi.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5 class="text-primary">Akses Online</h5>
                <p>Dapat diakses kapan saja dan dimana saja.</p>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="bg-primary text-white text-center mt-5 p-3">
    <small>© 2026 E-Rapor | Sistem Pengolahan Rapor Siswa</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>