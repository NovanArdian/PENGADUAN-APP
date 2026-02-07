<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporKan - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-blue { background: #1e3a8a; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .sidebar.active { transform: translateX(0); }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <button onclick="toggleSidebar()" class="md:hidden fixed top-6 left-6 z-50 p-3 bg-white rounded-xl shadow-lg border border-gray-200">
        <i class="fas fa-bars text-gray-700"></i>
    </button>

    <div id="overlay" onclick="toggleSidebar()" class="hidden md:hidden fixed inset-0 bg-black/20 z-40"></div>

    <aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-80 gradient-blue shadow-2xl z-50">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="px-8 py-8 border-b border-white/10">
                <a href="{{ route('welcome') }}" class="flex items-center gap-4 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white rounded-2xl blur-md opacity-20 group-hover:opacity-30 transition-all"></div>
                        <div class="relative w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all">
                            <i class="fas fa-bullhorn text-blue-900 text-2xl"></i>
                        </div>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-white block leading-tight">LaporKan</span>
                        <span class="text-xs text-blue-200 font-semibold tracking-wide">Sistem Pengaduan</span>
                    </div>
                </a>
                <button onclick="toggleSidebar()" class="md:hidden absolute top-8 right-8 text-white/60 hover:text-white transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-6 py-8 space-y-2 overflow-y-auto">
                @if(Auth::user()->role === 'GUEST')
                    <a href="{{ route('report.data-report') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-xl font-bold text-sm transition-all {{ Route::is('report.data-report') ? 'bg-white text-blue-900 shadow-xl' : 'text-white hover:bg-white/10' }}">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ Route::is('report.data-report') ? 'bg-blue-100' : 'bg-white/10' }} transition-all">
                            <i class="fas fa-newspaper text-lg"></i>
                        </div>
                        <span>Semua Laporan</span>
                        @if(Route::is('report.data-report'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-blue-900 rounded-r-full"></div>
                        @endif
                    </a>
                    <a href="{{ route('report.myReports') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-xl font-bold text-sm transition-all {{ Route::is('report.myReports') ? 'bg-white text-blue-900 shadow-xl' : 'text-white hover:bg-white/10' }}">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ Route::is('report.myReports') ? 'bg-blue-100' : 'bg-white/10' }} transition-all">
                            <i class="fas fa-user text-lg"></i>
                        </div>
                        <span>Laporan Saya</span>
                        @if(Route::is('report.myReports'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-blue-900 rounded-r-full"></div>
                        @endif
                    </a>
                @elseif(Auth::user()->role === 'STAFF')
                    <a href="{{ route('responses.index') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-xl font-bold text-sm transition-all {{ Route::is('responses.index') ? 'bg-white text-blue-900 shadow-xl' : 'text-white hover:bg-white/10' }}">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ Route::is('responses.index') ? 'bg-blue-100' : 'bg-white/10' }} transition-all">
                            <i class="fas fa-clipboard-list text-lg"></i>
                        </div>
                        <span>Data Laporan</span>
                        @if(Route::is('responses.index'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-blue-900 rounded-r-full"></div>
                        @endif
                    </a>
                @elseif(Auth::user()->role === 'HEAD_STAFF')
                    <a href="{{ route('staff.index') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-xl font-bold text-sm transition-all {{ Route::is('staff.index') ? 'bg-white text-blue-900 shadow-xl' : 'text-white hover:bg-white/10' }}">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ Route::is('staff.index') ? 'bg-blue-100' : 'bg-white/10' }} transition-all">
                            <i class="fas fa-users-cog text-lg"></i>
                        </div>
                        <span>Kelola Staff</span>
                        @if(Route::is('staff.index'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-blue-900 rounded-r-full"></div>
                        @endif
                    </a>
                    <a href="{{ route('staff.chart') }}" class="group relative flex items-center gap-4 px-5 py-4 rounded-xl font-bold text-sm transition-all {{ Route::is('staff.chart') ? 'bg-white text-blue-900 shadow-xl' : 'text-white hover:bg-white/10' }}">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ Route::is('staff.chart') ? 'bg-blue-100' : 'bg-white/10' }} transition-all">
                            <i class="fas fa-chart-pie text-lg"></i>
                        </div>
                        <span>Statistik</span>
                        @if(Route::is('staff.chart'))
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-blue-900 rounded-r-full"></div>
                        @endif
                    </a>
                @endif
            </nav>

            <!-- User Section -->
            <div class="p-6 border-t border-white/10 space-y-4">
                <div class="flex items-center gap-4 px-5 py-4 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-blue-900 font-black text-base">{{ strtoupper(substr(Auth::user()->email, 0, 2)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->email }}</p>
                        <p class="text-xs text-blue-200 font-semibold uppercase tracking-wide">{{ Auth::user()->role }}</p>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center justify-center gap-3 w-full px-6 py-4 text-sm font-bold text-blue-900 bg-white rounded-xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
        </div>
    </aside>

    <main class="md:ml-80 min-h-screen">
        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('hidden');
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                backdrop: `rgba(0,0,0,0.4)`,
                customClass: {
                    popup: 'rounded-3xl',
                    title: 'text-2xl font-bold',
                    htmlContainer: 'text-base'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                confirmButtonColor: '#1e3a8a',
                backdrop: `rgba(0,0,0,0.4)`,
                customClass: {
                    popup: 'rounded-3xl',
                    title: 'text-2xl font-bold',
                    confirmButton: 'rounded-xl px-8 py-3 font-bold'
                }
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                backdrop: `rgba(0,0,0,0.4)`,
                customClass: {
                    popup: 'rounded-3xl',
                    title: 'text-2xl font-bold'
                }
            });
        @endif
    </script>
    @stack('script')
</body>
</html>
