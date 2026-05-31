<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content modal-content-custom">

            <div class="modal-header-custom">
                <h2>E-RAPOR</h2>
                <p>Sistem Pengolahan Rapor Siswa</p>
            </div>

            <div class="modal-body-custom">

                @if ($errors->has('login') || $errors->has('username'))
                    <div class="alert alert-danger p-2 small text-center mb-3" style="font-size: 13px; border-radius: 8px;">
                        {{ $errors->first('login') ?? $errors->first('username') }}
                    </div>
                @endif

                @if ($errors->any())
                    <script>
                        // Buka modal otomatis jika ada error validasi
                        document.addEventListener('DOMContentLoaded', function () {
                            var modal = new bootstrap.Modal(document.getElementById('loginModal'));
                            modal.show();
                        });
                    </script>
                @endif
                
                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <select class="form-select" name="jenis_pengguna" required>
                            <option value="" disabled {{ old('jenis_pengguna') ? '' : 'selected' }}>Pilih Jenis Pengguna</option>
                            <option value="admin" {{ old('jenis_pengguna') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="guru" {{ old('jenis_pengguna') == 'guru' ? 'selected' : '' }}>Guru</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input 
                            type="text" 
                            name="username" 
                            class="form-control" 
                            placeholder="Username" 
                            value="{{ old('username') }}" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Password" 
                            required
                        >
                    </div>

                    <button type="submit" class="btn-login">
                        Masuk
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>