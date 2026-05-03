<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- AlpineJS untuk Dropdown Sidebar -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans flex bg-[#f0f6ff]">

    <!-- Panggil Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content Area -->
    <main class="ml-[250px] flex-1 p-6 min-h-screen">
        @yield('content')
    </main>

</body>
</html>