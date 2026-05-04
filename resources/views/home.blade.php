<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-RAPOR - Solusi Digital Sekolah Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-8px); }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
                line-height: 1.1;
            }
        }
    </style>
</head>
<body class="bg-white font-sans">

    <!-- Navbar dengan Hamburger Menu -->
    <nav class="bg-blue-600 py-5 border-b border-blue-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white">LOGO</h1>
                
                <div class="hidden md:flex items-center gap-10 text-white font-medium">
                    <a href="#" class="hover:text-blue-200">Beranda</a>
                    <a href="#tentang" class="hover:text-blue-200">Tentang</a>
                    <a href="#kontak" class="hover:text-blue-200">Kontak</a>
                </div>

                <a href="{{ route('login') }}" 
                   class="bg-white hover:bg-blue-100 text-blue-700 px-6 py-3 rounded-2xl transition flex items-center gap-2 text-sm md:text-base">
                    <i class="fas fa-arrow-right"></i> Masuk
                </a>

                <!-- Hamburger Button -->
                <button id="hamburger" class="md:hidden text-3xl text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-6 pt-6 border-t border-blue-700">
                <div class="flex flex-col gap-6 text-lg text-white">
                    <a href="#" class="hover:text-blue-200">Beranda</a>
                    <a href="#tentang" class="hover:text-blue-200">Tentang</a>
                    <a href="#kontak" class="hover:text-blue-200">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Second Section -->
    <div class="bg-gray-50 py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-center md:text-left">
                    <p class="text-gray-500 text-lg mb-4">Sistem Akademik Modern</p>
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight text-gray-900">
                        Kelola Nilai & Rapor Siswa Lebih Profesional
                    </h1>
                    <p class="mt-8 text-gray-600 text-lg">
                        Platform digital terintegrasi untuk manajemen rapor sekolah.
                    </p>
                    <button onclick="document.getElementById('kontak').scrollIntoView({ behavior: 'smooth' })"
                            class="mt-10 border-2 border-gray-800 hover:bg-gray-900 hover:text-white px-8 py-4 rounded-3xl text-lg font-medium transition w-full md:w-auto">
                        Pelajari Lebih
                    </button>
                </div>

                <div class="flex justify-center md:justify-start">
                    <div class="bg-white border border-blue-200 rounded-3xl px-8 py-8 text-center md:text-left shadow-sm">
                        <p class="text-2xl font-semibold mb-4 text-blue-700">Sistem E-RAPOR</p>
                        <div class="flex flex-col md:flex-row gap-4 text-blue-600 text-lg">
                            <span>● Modern</span>
                            <span>● Cepat</span>
                            <span>● Aman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section 1 -->
    <div class="max-w-7xl mx-auto px-6 pt-12 pb-16 text-center">
        <div class="flex justify-center mb-8">
            <button onclick="document.getElementById('tentang').scrollIntoView({ behavior: 'smooth' })"
                    class="border border-gray-400 hover:border-blue-600 px-6 py-3 rounded-full text-sm font-medium transition">
                Tentang Sistem
            </button>
        </div>
        
        <h1 class="hero-title text-4xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
            Solusi Digital untuk Sekolah<br>yang Lebih Modern
        </h1>
        <p class="text-base md:text-lg text-gray-600 max-w-3xl mx-auto mb-16 px-4">
            e-Rapor hadir sebagai jawaban atas kebutuhan sekolah modern — memudahkan pengelolaan nilai 
            dan laporan akademik secara efisien dan transparan.
        </p>

        <!-- 3 Feature Cards -->
        <div id="tentang" class="grid md:grid-cols-3 gap-6 md:gap-8">
            <div class="border border-gray-200 rounded-3xl p-6 md:p-8 card-hover bg-white text-left">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-blue-100 rounded-2xl mb-6 flex items-center justify-center text-4xl">⚡</div>
                <h3 class="text-xl md:text-2xl font-semibold mb-3">Proses Cepat & Efesien</h3>
                <p class="text-gray-600 text-sm md:text-base">Input nilai dan pembuatan laporan rapor menjadi jauh lebih mudah dan hemat waktu.</p>
                <p class="text-xs text-gray-500 mt-6">Hemat waktu hingga 80%</p>
            </div>

            <div class="border border-gray-200 rounded-3xl p-6 md:p-8 card-hover bg-white text-left">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-blue-100 rounded-2xl mb-6 flex items-center justify-center text-4xl">🔒</div>
                <h3 class="text-xl md:text-2xl font-semibold mb-3">Akses Aman Berlapisan</h3>
                <p class="text-gray-600 text-sm md:text-base">Sistem hak akses dibagi menjadi tiga level: Admin, Guru, dan Wali Kelas.</p>
                <p class="text-xs text-gray-500 mt-6">3 Level Keamanan</p>
            </div>

            <div class="border border-gray-200 rounded-3xl p-6 md:p-8 card-hover bg-white text-left">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-blue-100 rounded-2xl mb-6 flex items-center justify-center text-4xl">📊</div>
                <h3 class="text-xl md:text-2xl font-semibold mb-3">Dashboard Modern</h3>
                <p class="text-gray-600 text-sm md:text-base">Tampilan profesional dan intuitif untuk memantau data akademik secara real-time.</p>
                <p class="text-xs text-gray-500 mt-6">Visualisasi Data Lengkap</p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="kontak" class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <button class="border border-gray-300 px-6 py-3 rounded-full text-sm mb-8">Hubungi Kami</button>
                    <h2 class="text-4xl md:text-5xl font-bold leading-tight">Ada Pertanyaan?<br>Kami Siap Membantu</h2>
                    <p class="mt-6 text-gray-600">Tim kami selalu siap membantu Anda kapan saja.</p>
                    
                    <div class="mt-12 space-y-8 text-sm md:text-base">
                        <div><p class="font-medium">Alamat</p><p class="text-gray-500">Jl. Contoh No. 123, Batam, Kepulauan Riau</p></div>
                        <div><p class="font-medium">Telepon</p><p class="text-gray-500">+62 852-1234-5678</p></div>
                        <div><p class="font-medium">Email</p><p class="text-gray-500">info@erapor-sma.sch.id</p></div>
                    </div>
                </div>

                <div class="bg-gray-100 rounded-3xl p-8 md:p-10">
                    <h3 class="text-2xl font-semibold mb-6">Kirim Pesan</h3>
                    <form action="{{ route('contact.kirim') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" name="nama" placeholder="Nama Lengkap" class="bg-white rounded-2xl px-5 py-4 focus:outline-none" required>
                            <input type="email" name="email" placeholder="Alamat Email" class="bg-white rounded-2xl px-5 py-4 focus:outline-none" required>
                        </div>
                        <input type="text" name="subjek" placeholder="Subjek" class="w-full mt-4 bg-white rounded-2xl px-5 py-4 focus:outline-none" required>
                        <textarea name="pesan" placeholder="Pesan Anda..." rows="5" class="w-full mt-4 bg-white rounded-3xl px-5 py-4 focus:outline-none" required></textarea>
                        
                        <button type="submit" 
                                class="w-full mt-8 bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-semibold flex items-center justify-center gap-3">
                            <i class="fas fa-paper-plane"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-10 text-center">
        <p>&copy; 2026 e-RAPOR SMA - Semua Hak Dilindungi</p>
    </footer>

    <script>
        // Hamburger Menu
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            const icon = hamburger.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });
    </script>
</body>
</html>
