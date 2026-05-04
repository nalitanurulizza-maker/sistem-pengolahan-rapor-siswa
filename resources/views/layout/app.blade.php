<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-RAPOR SMA | @yield('title')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #1e6fdc;
            --primary-dark: #1a2340;
            --sidebar-bg: #1a2634;
            --sidebar-hover: #243342;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e8edf2;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid #2c3e50;
        }

        .sidebar-header h1 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .sidebar-header p {
            font-size: 11px;
            color: #95a5a6;
            margin-top: 5px;
        }

        .sidebar-menu {
            flex: 1;
            padding: 15px 0;
            overflow-y: auto;
        }

        .menu-section {
            padding: 10px 20px;
            font-size: 11px;
            text-transform: uppercase;
            color: #7f8c8d;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        .menu-item {
            display: block;
            padding: 12px 20px 12px 30px;
            color: #bdc3c7;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .menu-item:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
        }

        .menu-item.active {
            background: var(--sidebar-hover);
            color: #ffffff;
            border-left: 3px solid var(--primary);
        }

        .sidebar-footer {
            padding: 15px 20px;
            border-top: 1px solid #2c3e50;
        }

        .sidebar-footer a {
            color: #e74c3c;
            text-decoration: none;
            font-size: 14px;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: 0.2s;
        }

        .sidebar-footer a:hover {
            background: #2c3e50;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* HEADER */
        .header {
            background: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header h2 {
            font-size: 18px;
            color: #2c3e50;
            font-weight: 600;
        }

        .user-info {
            font-size: 13px;
            color: #7f8c8d;
            background: #f5f6fa;
            padding: 8px 15px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        /* CONTENT */
        .content-body {
            padding: 25px 30px;
            flex: 1;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }
            .sidebar-header h1,
            .sidebar-header p,
            .menu-section,
            .menu-item span,
            .sidebar-footer a span {
                display: none;
            }
            .main-content {
                margin-left: 60px;
            }
            .content-body {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1>E - RAPOR</h1>
            <p>E-RAPOR SMA | 2026/2027</p>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-section">Dashboard</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                📊 <span>Dashboard</span>
            </a>

            <div class="menu-section" style="margin-top: 10px;">DATA MASTER</div>
            <a href="{{ route('admin.data-siswa') }}" class="menu-item {{ request()->routeIs('admin.data-siswa') ? 'active' : '' }}">
                + <span>Data Siswa</span>
            </a>
            <a href="{{ route('admin.data-guru') }}" class="menu-item {{ request()->routeIs('admin.data-guru') ? 'active' : '' }}">
                + <span>Data Guru</span>
            </a>
            <a href="{{ route('admin.data-wali-kelas') }}" class="menu-item {{ request()->routeIs('admin.data-wali-kelas') ? 'active' : '' }}">
                + <span>Data Wali Kelas</span>
            </a>

            <div class="menu-section" style="margin-top: 10px;">AKADEMIK</div>
            <a href="{{ route('admin.mata-pelajaran') }}" class="menu-item {{ request()->routeIs('admin.mata-pelajaran') ? 'active' : '' }}">
                + <span>Mata Pelajaran</span>
            </a>
            <a href="{{ route('admin.tahun-akademik') }}" class="menu-item {{ request()->routeIs('admin.tahun-akademik') ? 'active' : '' }}">
                + <span>Tahun Akademik</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none;border:none;color:#e74c3c;cursor:pointer;width:100%;text-align:left;padding:10px;font-size:14px;">
                    🚪 KELUAR
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- HEADER -->
        <header class="header">
            <h2>E-RAPOR SMA | Tahun Pelajaran : 2026/2027</h2>
            <div style="display:flex;align-items:center;gap:15px;">
                <div class="user-info">
                    👤 {{ Auth::user()->name ?? 'Admin' }}
                </div>
            </div>
        </header>

        <!-- CONTENT BODY -->
        <div class="content-body">
            @yield('content')
        </div>
    </main>

</body>
</html>