<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PermitID - Layanan Surat Perizinan Digital')</title>
    <!-- Favicon Logo -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #356BA7; }
        .glass-header { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); border-bottom: 1px solid #e2e8f0; }
        .btn-primary { background-color: #2563eb; color: #ffffff; font-weight: 500; transition: all 0.2s; }
        .btn-primary:hover { background-color: #1d4ed8; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between">
    @auth
    <!-- Mobile-First Responsive Navbar -->
    <header class="sticky top-0 z-50 glass-header">
        <div class="max-w-md md:max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5">
                <!-- Official PermitID Emblem Image -->
                <div class="w-9 h-9 rounded-xl overflow-hidden shadow-sm border border-slate-200/80 bg-white flex items-center justify-center p-0.5">
                    <img src="{{ asset('logo.png') }}" alt="PermitID Logo" class="w-full h-full object-cover rounded-lg">
                </div>
                <div>
                    <span class="font-bold text-slate-900 text-base leading-tight block tracking-tight">PERMIT<span class="text-blue-600">ID</span>
                        @if(Auth::user()->role === 'admin')
                            <span class="text-[10px] font-semibold text-slate-400 ml-1">/ Admin</span>
                        @elseif(Auth::user()->role === 'homeroom_teacher')
                            <span class="text-[10px] font-semibold text-slate-400 ml-1">/ Wali Kelas</span>
                        @else
                            <span class="text-[10px] font-semibold text-slate-400 ml-1">/ Siswa</span>
                        @endif
                    </span>
                    <span class="text-[10px] text-slate-500 tracking-wide uppercase font-medium">Layanan Surat Digital</span>
                </div>
            </a>
            
            <div class="flex items-center space-x-3">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-500 font-mono">{{ Auth::user()->nis_nip }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 hover:text-slate-900 rounded-lg transition-colors">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>
    @endauth

    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-md md:max-w-4xl mx-auto px-4 mt-4">
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 text-xs sm:text-sm font-medium flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="py-6 text-center text-xs text-slate-400 border-t border-slate-200 mt-8 bg-white">
        <div class="max-w-md md:max-w-4xl mx-auto px-4">
            <p>&copy; {{ date('Y') }} Sistem Perizinan Digital Siswa (PermitID). All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
