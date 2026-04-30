
    <!-- ================================================ -->
    <!-- NAVBAR -->
    <!-- ================================================ -->
    <nav id="mainNavbar" class="at-top">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Brand -->
                <a href="#beranda" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div style="width:38px;height:38px;background:linear-gradient(135deg,#1e6fdc,#00d4ff);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.15rem;box-shadow:0 4px 12px rgba(30,111,220,0.35);">🏫</div>
                    <span class="navbar-brand-text">E-RAPOR</span>
                </a>

                <!-- Desktop Nav -->
                <div class="d-none d-lg-flex align-items-center gap-4">
                    <a href="#beranda" class="nav-link-custom text-decoration-none">Beranda</a>
                    <a href="#tentang" class="nav-link-custom text-decoration-none">Tentang</a>
                    <a href="#kontak" class="nav-link-custom text-decoration-none">Kontak</a>
                </div>

                <!-- Login Button -->
                <div class="d-flex align-items-center gap-3">
                    <button class="btn-login-nav text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                    </button>
                    <!-- Mobile toggle -->
                    <button class="d-lg-none btn btn-sm" id="mobileMenuBtn" style="color:#1e6fdc;background:rgba(30,111,220,0.1);border-radius:10px;padding:6px 10px;">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" style="display:none;padding-top:16px;padding-bottom:8px;" class="d-lg-none">
                <a href="#beranda" class="d-block py-2 text-decoration-none" style="color:#1a2340;font-weight:500;font-size:0.9rem;">Beranda</a>
                <a href="#tentang" class="d-block py-2 text-decoration-none" style="color:#1a2340;font-weight:500;font-size:0.9rem;">Tentang</a>
                <a href="#kontak" class="d-block py-2 text-decoration-none" style="color:#1a2340;font-weight:500;font-size:0.9rem;">Kontak</a>
            </div>
        </div>
    </nav>