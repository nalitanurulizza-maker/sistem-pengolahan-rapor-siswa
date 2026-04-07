<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
* {
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI', sans-serif;
}

body {
  display:flex;
  background:#eef5fb;
}

/* SIDEBAR */
.sidebar {
  width:250px;
  height:100vh;
  background:linear-gradient(180deg,#5dade2,#3498db);
  color:white;
  padding:20px;
}

.sidebar h2 {
  margin-bottom:20px;
}

.menu-item {
  padding:12px;
  margin-top:8px;
  cursor:pointer;
  display:flex;
  justify-content:space-between;
  align-items:center;
  border-radius:8px;
  transition:0.3s;
}

.menu-item:hover {
  background:rgba(255,255,255,0.2);
}

.dropdown {
  display:none;
  margin-left:10px;
}

.dropdown div {
  padding:10px;
  margin-top:5px;
  background:rgba(255,255,255,0.2);
  border-radius:6px;
  font-size:14px;
}

/* MAIN */
.main {
  flex:1;
  padding:20px;
}

/* HEADER */
.header {
  background:white;
  color:#333;
  padding:15px 20px;
  border-radius:12px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  box-shadow:0 2px 8px rgba(0,0,0,0.1);
  margin-bottom:20px;
}

/* CONTENT */
.content {
  max-width:1200px;
  margin:auto;
}

/* CARD GRID */
.cards {
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:20px;
}

/* CARD */
.card {
  padding:20px;
  border-radius:12px;
  color:white;
  font-weight:bold;
  display:flex;
  justify-content:space-between;
  align-items:center;
  transition:0.3s;
}

.card:hover {
  transform:translateY(-5px);
}

/* WARNA CARD */
.card:nth-child(1){background:linear-gradient(45deg,#4facfe,#00f2fe);}
.card:nth-child(2){background:linear-gradient(45deg,#43e97b,#38f9d7);}
.card:nth-child(3){background:linear-gradient(45deg,#fa709a,#fee140);}
.card:nth-child(4){background:linear-gradient(45deg,#30cfd0,#330867);}
.card:nth-child(5){background:linear-gradient(45deg,#667eea,#764ba2);}
.card:nth-child(6){background:linear-gradient(45deg,#00c6ff,#0072ff);}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2><i class="fa fa-school"></i> e-Rapor</h2>

  <div class="menu-item" onclick="toggleDropdown('d1')">
    Dashboard <i class="fa fa-chevron-down"></i>
  </div>
  <div id="d1" class="dropdown">
    <div>Overview</div>
  </div>

  <div class="menu-item" onclick="toggleDropdown('d2')">
    Data Siswa <i class="fa fa-chevron-down"></i>
  </div>
  <div id="d2" class="dropdown">
    <div>Tambah Siswa</div>
    <div>List Siswa</div>
  </div>

  <div class="menu-item" onclick="toggleDropdown('d3')">
    Data Guru <i class="fa fa-chevron-down"></i>
  </div>
  <div id="d3" class="dropdown">
    <div>Tambah Guru</div>
    <div>List Guru</div>
  </div>

  <div class="menu-item" onclick="toggleDropdown('d4')">
    Mata Pelajaran <i class="fa fa-chevron-down"></i>
  </div>
  <div id="d4" class="dropdown">
    <div>Tambah Mapel</div>
    <div>List Mapel</div>
  </div>

  <div class="menu-item" onclick="toggleDropdown('d5')">
    Tahun Ajaran <i class="fa fa-chevron-down"></i>
  </div>
  <div id="d5" class="dropdown">
    <div>Tambah Tahun</div>
    <div>List Tahun</div>
  </div>
</div>

<!-- MAIN -->
<div class="main">

  <div class="header">
    <div><strong>Aplikasi e-Rapor</strong></div>
    <div><i class="fa fa-user"></i> Admin</div>
  </div>

  <div class="content">
    @yield('content')
  </div>

</div>

<script>
function toggleDropdown(id){
  let el = document.getElementById(id);
  el.style.display = el.style.display === 'block' ? 'none' : 'block';
}
</script>

</body>
</html>