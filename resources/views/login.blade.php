<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Rapor</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary bg-opacity-10">

<div class="container d-flex justify-content-center align-items-center vh-100">
    
    <div class="card shadow-sm p-4 rounded-4" style="width: 380px;">
        
        <!-- Header -->
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary mb-1">E-RAPOR</h4>
            <small class="text-muted">Sistem Pengolahan Rapor Siswa</small>
        </div>

        <!-- Alert -->
        @if(session('error'))
            <div class="alert alert-danger py-2">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success py-2">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="/login">
            @csrf

            <!-- Role -->
            <div class="mb-3">
                <label class="form-label">Jenis Pengguna</label>
                <select name="role" class="form-select">
                    <option value="">Pilih Jenis Pengguna</option>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="wali_kelas">Wali Kelas</option>
                </select>
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">ID Pengguna</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan ID">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
            </div>

            <!-- Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    Masuk
                </button>
            </div>

        </form>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>