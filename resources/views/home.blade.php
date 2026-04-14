<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>e-Rapor SMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-50 scroll-smooth">

<!-- NAVBAR -->
<nav class="bg-blue-600 text-white px-10 py-4 flex justify-between items-center fixed w-full top-0 z-50 shadow">
    
    <div class="font-bold text-lg">E-Rapor</div>

    <div class="flex items-center gap-8">
        <ul class="flex gap-6">
            <li><a href="#hero" class="hover:underline">Beranda</a></li>
            <li><a href="#tentang" class="hover:underline">Tentang</a></li>
            <li><a href="#fitur" class="hover:underline">Fitur</a></li>
            <li><a href="#kontak" class="hover:underline">Kontak</a></li>
        </ul>

        <button onclick="openModal()" class="bg-white text-blue-600 px-4 py-1 rounded-lg hover:bg-blue-100">
            Log In
        </button>
    </div>
</nav>

<!-- HERO -->
<section id="hero" class="min-h-screen flex items-center justify-between px-16 pt-24 bg-gradient-to-br from-blue-700 via-blue-500 to-blue-400 text-white relative overflow-hidden">

    <!-- BACKGROUND -->
    <div class="absolute w-[500px] h-[500px] bg-blue-300 opacity-20 rounded-full blur-3xl top-[-100px] left-[-100px]"></div>
    <div class="absolute w-[400px] h-[400px] bg-white opacity-10 rounded-full blur-3xl bottom-[-100px] right-[-100px]"></div>

    <!-- TEXT -->
    <div class="max-w-xl relative z-10">
        <div class="inline-block bg-white/20 px-4 py-1 rounded-full text-sm mb-4">
            🚀 Sistem Digital Sekolah
        </div>

        <h1 class="text-5xl font-bold leading-tight mb-4">
            Kelola Rapor <br> Lebih Cepat & Modern
        </h1>

        <p class="text-lg mb-4 text-blue-100">
            Platform e-Rapor untuk mempermudah tenaga pendidik dalam mengelola data akademik secara cepat, akurat, dan efisien.
        </p>

        <!-- MINI INFO -->
        <div class="flex gap-6 text-blue-100 text-sm mt-4">
            <span>✔ Mudah Digunakan</span>
            <span>✔ Otomatis</span>
            <span>✔ Efisien</span>
        </div>
    </div>

    <!-- VISUAL -->
    <div class="relative w-[420px] h-[320px] hidden md:block z-10">

        <div class="absolute w-64 h-40 bg-white text-blue-600 rounded-2xl shadow-2xl flex items-center justify-center left-0 top-0
            transition duration-300 hover:-translate-y-4 hover:scale-105">
            📊 Data Nilai
        </div>

        <div class="absolute w-64 h-40 bg-blue-100 text-blue-700 rounded-2xl shadow-2xl flex items-center justify-center right-0 top-20
            transition duration-300 hover:-translate-y-4 hover:scale-105">
            🧾 Rapor Otomatis
        </div>

        <div class="absolute w-52 h-32 bg-blue-300 text-white rounded-2xl shadow-xl flex items-center justify-center left-24 bottom-0
            transition duration-300 hover:-translate-y-4 hover:scale-105">
            📈 Statistik Nilai
        </div>

    </div>

    <!-- SCROLL -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex flex-col items-center text-white animate-bounce">
        <span class="text-sm mb-1">Scroll</span>
        <div class="w-5 h-8 border-2 border-white rounded-full flex justify-center">
            <div class="w-1 h-2 bg-white rounded-full mt-1"></div>
        </div>
    </div>

</section>

<!-- TENTANG -->
<section id="tentang" class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6 text-center">

    <h2 class="text-3xl font-bold text-blue-600 mb-4">Tentang Sistem</h2>
    <p class="text-gray-600 mb-12">
      Sistem e-Rapor membantu pengelolaan data akademik secara terintegrasi dan efisien.
    </p>

    <div class="grid md:grid-cols-4 gap-6">

      <div class="bg-blue-50 p-6 rounded-2xl shadow hover:-translate-y-2 hover:shadow-xl transition">
        <div class="text-4xl mb-3">👨‍🎓</div>
        <h4 class="text-blue-600 font-semibold">Data Siswa</h4>
        <p class="text-gray-600 text-sm mt-2">Mengelola informasi siswa secara lengkap.</p>
      </div>

      <div class="bg-blue-50 p-6 rounded-2xl shadow hover:-translate-y-2 hover:shadow-xl transition">
        <div class="text-4xl mb-3">👨‍🏫</div>
        <h4 class="text-blue-600 font-semibold">Data Guru</h4>
        <p class="text-gray-600 text-sm mt-2">Menyimpan data guru dan akses nilai.</p>
      </div>

      <div class="bg-blue-50 p-6 rounded-2xl shadow hover:-translate-y-2 hover:shadow-xl transition">
        <div class="text-4xl mb-3">📚</div>
        <h4 class="text-blue-600 font-semibold">Mata Pelajaran</h4>
        <p class="text-gray-600 text-sm mt-2">Mengatur daftar mapel siswa.</p>
      </div>

      <div class="bg-blue-50 p-6 rounded-2xl shadow hover:-translate-y-2 hover:shadow-xl transition">
        <div class="text-4xl mb-3">🏫</div>
        <h4 class="text-blue-600 font-semibold">Data Kelas</h4>
        <p class="text-gray-600 text-sm mt-2">Mengelompokkan siswa per kelas.</p>
      </div>

    </div>
  </div>
</section>

<!-- FITUR -->
<section id="fitur" class="py-20 bg-blue-50 text-center">
  <h2 class="text-3xl font-bold text-blue-600 mb-10">Fitur Unggulan</h2>

  <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6 px-6">

    <div class="bg-white p-6 rounded-xl shadow hover:-translate-y-2 hover:shadow-xl transition">
      <h5 class="text-blue-600 font-semibold">Input Nilai</h5>
      <p class="text-gray-600 text-sm">Input nilai siswa dengan mudah</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:-translate-y-2 hover:shadow-xl transition">
      <h5 class="text-blue-600 font-semibold">Otomatis</h5>
      <p class="text-gray-600 text-sm">Perhitungan nilai otomatis</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:-translate-y-2 hover:shadow-xl transition">
      <h5 class="text-blue-600 font-semibold">Cetak Rapor</h5>
      <p class="text-gray-600 text-sm">Export PDF rapor</p>
    </div>

  </div>
</section>

<!-- KONTAK -->
<section id="kontak" class="py-20 bg-blue-600 text-white">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10">
    
    <div>
      <h2 class="text-3xl font-bold mb-4">Kontak</h2>
      <p>📍 Jl. Pendidikan No. 123</p>
      <p>📞 0812-3456-7890</p>
      <p>📧 eraporr@gmail.com</p>
    </div>

    <form class="space-y-4">
      <input type="text" placeholder="Nama" class="w-full p-2 rounded text-black">
      <input type="email" placeholder="Email" class="w-full p-2 rounded text-black">
      <textarea placeholder="Pesan" class="w-full p-2 rounded text-black"></textarea>
      <button class="bg-white text-blue-600 px-4 py-2 rounded w-full hover:bg-blue-100">
        Kirim
      </button>
    </form>

  </div>
</section>

<!-- FOOTER -->
<footer class="bg-blue-700 text-white text-center py-4">
    © 2026 ● E-Rapor
</footer>

<!-- MODAL LOGIN -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
  <div class="bg-white p-6 rounded-xl w-80">
    <h2 class="text-xl font-bold text-blue-600 mb-4">Login</h2>
    
    <input type="text" placeholder="Username" class="w-full p-2 mb-3 border rounded">
    <input type="password" placeholder="Password" class="w-full p-2 mb-3 border rounded">

    <button class="bg-blue-600 text-white w-full py-2 rounded mb-2">
      Masuk
    </button>

    <button onclick="closeModal()" class="text-red-500 w-full">
      Batal
    </button>
  </div>
</div>

<!-- SCRIPT -->
<script>
function openModal() {
    document.getElementById("modal").classList.remove("hidden");
    document.getElementById("modal").classList.add("flex");
}

function closeModal() {
    document.getElementById("modal").classList.add("hidden");
}
</script>

</body>
</html>