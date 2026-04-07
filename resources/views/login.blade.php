<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Pengolahan Rapor Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container text-center mt-5">
    <h2 class="fw-bold">E-RAPOR</h2>
    <h5>Sistem Pengolahan Rapor Siswa</h5>
</div>

<div class="container d-flex justify-content-center mt-4">
    <div class="card shadow" style="width: 400px;">
        <div class="card-body">

            <form>
                <div class="mb-3">
                    <select class="form-select">
                        <option selected>Pilih Jenis Pengguna</option>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="wali_kelas">Wali Kelas</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="ID Pengguna">
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">
                    Masuk
                </button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>