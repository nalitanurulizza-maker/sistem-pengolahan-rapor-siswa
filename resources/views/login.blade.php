<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-RAPOR - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
        }
        .login-card {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .blue-header {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
        }
        .input-label {
            background: #dbeafe;
            color: #1e40af;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="bg-white w-full max-w-md mx-4 rounded-3xl overflow-hidden login-card">
        <div class="blue-header py-10 text-center">
            <h1 class="text-5xl font-bold text-white tracking-tight">e-RAPOR</h1>
            <p class="text-blue-100 mt-1">Sistem Raport SMA</p>
        </div>

        <div class="p-8 space-y-6">
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-xl">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.proses') }}" class="space-y-6">
                @csrf

                <div>
                    <select id="userType" name="user_type"
                            class="w-full bg-blue-700 text-white text-center py-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-300 cursor-pointer text-lg">
                        <option value="">Pilih Jenis Pengguna</option>
                        <option value="admin" {{ old('user_type') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ old('user_type') === 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="wali" {{ old('user_type') === 'wali' ? 'selected' : '' }}>Wali Kelas</option>
                    </select>
                </div>

                <div class="space-y-4">
                    <div class="flex rounded-2xl overflow-hidden border border-blue-200">
                        <div class="input-label w-44 flex items-center px-6 font-semibold text-sm">
                            ID Pengguna
                        </div>
                        <input type="text" name="user_id" id="username"
                               class="flex-1 py-4 px-5 focus:outline-none bg-gray-50 text-gray-800"
                               placeholder="Masukkan ID Anda" value="{{ old('user_id') }}">
                    </div>

                    <div class="flex rounded-2xl overflow-hidden border border-blue-200">
                        <div class="input-label w-44 flex items-center px-6 font-semibold text-sm">
                            Kata Sandi
                        </div>
                        <input type="password" name="password" id="password"
                               class="flex-1 py-4 px-5 focus:outline-none bg-gray-50 text-gray-800"
                               placeholder="••••••••">
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-semibold text-lg transition-all active:scale-95">
                    Masuk
                </button>
            </form>

            <div class="text-center text-xs text-blue-500/70 pt-4">
                © 2026 SMAN - E-RAPOR
            </div>
        </div>
    </div>
</body>
</html>
