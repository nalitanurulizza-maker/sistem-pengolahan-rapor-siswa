<!DOCTYPE html>
<html>
<head>
    <title>E-Rapor Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #0f172a;
            color: white;
            position: fixed;
        }

        .sidebar h4 {
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #1e293b;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .stat-card {
            border-radius: 10px;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">

        <h4>E-RAPOR</h4>

        <a href="#">Dashboard</a>

        <p class="px-3 mt-3 text-secondary">DATA INDUK</p>

        <a href="#">Data Siswa</a>
        <a href="#">Data Guru</a>
        <a href="#">Mata Pelajaran</a>

        <p class="px-3 mt-3 text-secondary">AKADEMIK</p>

        <a href="#">Input Nilai</a>
        <a href="#">Presensi</a>
        <a href="#">Ekstrakurikuler</a>

        <p class="px-3 mt-3 text-secondary">ADMIN</p>

        <a href="#">Cetak Rapor</a>
        <a href="#" class="text-danger">Logout</a>

    </div>


    <!-- Content -->
    <div class="content">

        <h4 class="mb-4">Dashboard</h4>

        <div class="row mb-4">

            <div class="col-md-3">
                <div class="stat-card">
                    <p>Kurikulum Aktif</p>
                    <h5>Kurikulum Merdeka</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <p>Total Siswa</p>
                    <h5>320 Siswa</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <p>Input Nilai</p>
                    <h5 class="text-success">85% Complete</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <p>Status Rapor</p>
                    <h5 class="text-warning">Siap Cetak</h5>
                </div>
            </div>

        </div>


        <!-- Tabel Input Nilai -->
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h5>Form Input Nilai</h5>
                <button class="btn btn-primary">
                    Simpan Semua Data
                </button>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                        </tr>
                    </thead>

                    <tbody>
                       
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>