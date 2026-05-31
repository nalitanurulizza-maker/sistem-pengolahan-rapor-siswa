@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengolahan Rapor Siswa</title>
</head>
<body class="bg-slate-100 font-sans min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-6">
        <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">E-RAPOR</h2>
        <p class="text-sm text-slate-600 mt-1">Sistem Pengolahan Rapor Siswa</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm border border-slate-100">
        
        @if ($errors->has('login') || $errors->has('username'))
            <div class="bg-rose-50 text-rose-600 text-xs text-center p-3 rounded-lg mb-4 border border-rose-100">
                {{ $errors->first('login') ?? $errors->first('username') }}
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST" class="space-y-4">
            @csrf 

            <div>
                <select name="jenis_pengguna" class="w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                    <option value="" disabled selected>Pilih Jenis Pengguna</option>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                </select>
            </div>

            <div>
                <input 
                    type="text" 
                    name="username"
                    class="w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                    placeholder="username"
                    value="{{ old('username') }}"
                    required
                >
            </div>

            <div>
                <input 
                    type="password" 
                    name="password"
                    class="w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                    placeholder="Password"
                    required
                >
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-2.5 text-white font-semibold text-sm rounded-full bg-gradient-to-r from-blue-600 to-sky-400 hover:from-blue-700 hover:to-sky-500 shadow-md shadow-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-center block">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</body>
</html>