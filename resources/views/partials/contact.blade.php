<!-- ================================================ -->
<!-- CONTACT SECTION -->
<!-- ================================================ -->
<section id="kontak">
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row g-5 align-items-start">

            <!-- Left: Info -->
            <div class="col-lg-5 contact-info-wrapper">
                <span class="section-badge fade-up">Hubungi Kami</span>

                <h2 class="section-title fade-up fade-up-delay-1 mt-2 mb-3">
                    Ada Pertanyaan? <br>Kami Siap Membantu
                </h2>

                <p class="section-subtitle fade-up fade-up-delay-2 mb-5">
                    Tim kami selalu siap membantu Anda. Jangan ragu untuk menghubungi kami kapan saja.
                </p>

                <div class="contact-info-item fade-up fade-up-delay-2">
                    <div class="contact-icon-wrap">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <div class="info-label">Alamat</div>
                        <div class="info-value">
                            Jl. Pendidikan No. 1, Batam,<br>
                            Kepulauan Riau 29444
                        </div>
                    </div>
                </div>

                <div class="contact-info-item fade-up fade-up-delay-3">
                    <div class="contact-icon-wrap">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div>
                        <div class="info-label">Telepon</div>
                        <div class="info-value">+62 778 123 4567</div>
                    </div>
                </div>

                <div class="contact-info-item fade-up fade-up-delay-4">
                    <div class="contact-icon-wrap">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div>
                        <div class="info-label">Email</div>
                        <div class="info-value">info@erapor.sch.id</div>
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="col-lg-7 fade-up fade-up-delay-2">
                <div class="contact-form-wrapper">
                    <h4 style="color: white; font-weight: 700; margin-bottom: 28px;">
                        Kirim Pesan
                    </h4>

                    <form action="#" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Nama Lengkap</label>
                                <input
                                    type="text"
                                    class="form-control form-control-custom"
                                    placeholder="Masukkan nama Anda"
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Alamat Email</label>
                                <input
                                    type="email"
                                    class="form-control form-control-custom"
                                    placeholder="email@sekolah.com"
                                >
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Subjek</label>
                                <input
                                    type="text"
                                    class="form-control form-control-custom"
                                    placeholder="Perihal pesan Anda"
                                >
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Pesan</label>
                                <textarea
                                    class="form-control form-control-custom"
                                    rows="5"
                                    placeholder="Tulis pesan Anda di sini..."
                                ></textarea>
                            </div>

                            <div class="col-12">
                                <button
                                    type="submit"
                                    class="btn-send d-flex align-items-center justify-content-center gap-2"
                                >
                                    <i class="bi bi-send-fill"></i>
                                    Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>