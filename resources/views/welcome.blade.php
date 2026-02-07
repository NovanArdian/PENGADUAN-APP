<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LaporKan - Platform Pengaduan Masyarakat Indonesia</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
          animation: {
            'float': 'float 6s ease-in-out infinite',
            'slide-up': 'slideUp 0.6s ease-out',
            'fade-in': 'fadeIn 1s ease-out',
            'scale-in': 'scaleIn 0.5s ease-out',
          }
        }
      }
    }
  </script>
  <style>
    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-25px); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes scaleIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
    .gradient-blue { background: #1e3a8a; }
    .text-gradient { background: #1e3a8a; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .card-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .card-hover:hover { transform: translateY(-12px); box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.25); }
    .blob { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; animation: blob 8s ease-in-out infinite; }
    @keyframes blob { 0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; } 50% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; } }
  </style>
</head>
<body class="bg-white text-gray-900 overflow-x-hidden">

  <!-- Navbar -->
  <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100 shadow-sm animate-fade-in">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex items-center space-x-4">
          <div class="relative">
            <div class="absolute inset-0 gradient-blue rounded-2xl blur opacity-40"></div>
            <div class="relative w-12 h-12 gradient-blue rounded-2xl flex items-center justify-center shadow-lg">
              <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
              </svg>
            </div>
          </div>
          <div>
            <div class="text-2xl font-bold text-gradient">LaporKan</div>
            <div class="text-xs text-gray-500 font-medium">Suara Rakyat Indonesia</div>
          </div>
        </div>
        <div class="hidden md:flex items-center space-x-8">
          <a href="#beranda" class="text-gray-700 hover:text-blue-600 font-semibold transition">Beranda</a>
          <a href="#statistik" class="text-gray-700 hover:text-blue-600 font-semibold transition">Statistik</a>
          <a href="#laporan" class="text-gray-700 hover:text-blue-600 font-semibold transition">Laporan</a>
        </div>
        <div class="flex items-center space-x-4">
          <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-700 hover:text-blue-600 font-bold transition-colors">Masuk</a>
          <a href="{{ route('register') }}" class="px-8 py-3 gradient-blue text-white rounded-xl font-bold hover:opacity-90 transition-opacity">Daftar Sekarang</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="beranda" class="relative pt-32 pb-24 px-6 overflow-hidden">
    <div class="absolute top-20 right-0 w-96 h-96 gradient-blue opacity-10 blob"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-400 opacity-10 blob" style="animation-delay: 2s;"></div>
    
    <div class="max-w-7xl mx-auto">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8 animate-slide-up">
          <div class="inline-flex items-center space-x-2 px-5 py-2.5 bg-blue-50 rounded-full border border-blue-100">
            <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
            <span class="text-sm font-bold text-blue-600">Platform Pengaduan Terpercaya</span>
          </div>
          
          <h1 class="text-6xl lg:text-7xl font-black leading-tight text-gray-900">
            Wujudkan<br/>
            <span class="text-gradient">Indonesia Lebih Baik</span>
          </h1>
          
          <p class="text-xl text-gray-600 leading-relaxed font-medium">
            Sampaikan aspirasi dan pengaduan Anda dengan mudah. Pantau progress secara transparan. Bersama kita ciptakan perubahan nyata untuk negeri! 🇮🇩
          </p>
          
          <div class="flex flex-wrap gap-4 pt-4">
          <a href="{{ route('register') }}" class="group inline-flex items-center justify-center space-x-2 px-10 py-4 gradient-blue text-white rounded-xl font-bold text-base hover:opacity-90 transition-opacity">
            <span>Mulai Lapor Gratis</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
            <a href="#laporan" class="inline-flex items-center justify-center space-x-2 px-10 py-4 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-bold text-base hover:border-blue-600 hover:text-blue-600 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
              <span>Lihat Laporan</span>
            </a>
          </div>

          <div class="flex items-center space-x-8 pt-8">
            <div class="text-center">
              <div class="text-4xl font-black text-gradient mb-1">{{ number_format($totalReports) }}+</div>
              <div class="text-sm text-gray-500 font-semibold">Total Laporan</div>
            </div>
            <div class="w-px h-16 bg-gray-200"></div>
            <div class="text-center">
              <div class="text-4xl font-black text-gradient mb-1">{{ number_format($totalDone) }}+</div>
              <div class="text-sm text-gray-500 font-semibold">Terselesaikan</div>
            </div>
            <div class="w-px h-16 bg-gray-200"></div>
            <div class="text-center">
              <div class="text-4xl font-black text-gradient mb-1">99%</div>
              <div class="text-sm text-gray-500 font-semibold">Kepuasan</div>
            </div>
          </div>
        </div>

        <div class="relative ml-auto w-3/4 animate-float">
          <img src="{{ asset('images/cowo.png') }}" alt="Team" class="relative w-full">
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section id="statistik" class="py-24 px-6 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16 animate-scale-in">
        <h2 class="text-5xl font-black text-gray-900 mb-4">Statistik Real-Time</h2>
        <p class="text-xl text-gray-600 font-medium">Data pengaduan masyarakat yang transparan dan akurat</p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <div class="group relative bg-white rounded-3xl p-10 shadow-lg border border-gray-100 card-hover">
          <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 opacity-5 rounded-full -mr-16 -mt-16"></div>
          <div class="relative">
            <div class="w-16 h-16 gradient-blue rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30">
              <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <div class="text-5xl font-black text-gray-900 mb-3">{{ number_format($totalReports) }}</div>
            <div class="text-lg font-bold text-gray-600">Total Laporan Masuk</div>
            <div class="mt-4 text-sm text-blue-600 font-semibold">↑ Terus Bertambah</div>
          </div>
        </div>

        <div class="group relative bg-white rounded-3xl p-10 shadow-lg border border-gray-100 card-hover">
          <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500 opacity-5 rounded-full -mr-16 -mt-16"></div>
          <div class="relative">
            <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-orange-500/30">
              <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <div class="text-5xl font-black text-gray-900 mb-3">{{ number_format($totalProgress) }}</div>
            <div class="text-lg font-bold text-gray-600">Sedang Ditangani</div>
            <div class="mt-4 text-sm text-orange-600 font-semibold">⚡ Dalam Progress</div>
          </div>
        </div>

        <div class="group relative bg-white rounded-3xl p-10 shadow-lg border border-gray-100 card-hover">
          <div class="absolute top-0 right-0 w-32 h-32 bg-green-500 opacity-5 rounded-full -mr-16 -mt-16"></div>
          <div class="relative">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-green-500/30">
              <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div class="text-5xl font-black text-gray-900 mb-3">{{ number_format($totalDone) }}</div>
            <div class="text-lg font-bold text-gray-600">Berhasil Diselesaikan</div>
            <div class="mt-4 text-sm text-green-600 font-semibold">✓ Tuntas</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Top Provinces -->
  <section class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-5xl font-black text-gray-900 mb-4">Provinsi Teratas</h2>
        <p class="text-xl text-gray-600 font-medium">Daerah dengan partisipasi masyarakat terbaik</p>
      </div>

      <div class="grid md:grid-cols-5 gap-6">
        @foreach($reportsByProvince as $index => $item)
        <div class="relative bg-white rounded-3xl p-8 text-center shadow-lg border border-gray-100 card-hover group">
          <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
            <div class="w-12 h-12 gradient-blue rounded-full flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-500/40">
              {{ $index + 1 }}
            </div>
          </div>
          <div class="mt-6">
            <div class="text-4xl font-black text-gradient mb-3">{{ number_format($item->total) }}</div>
            <div class="text-sm font-bold text-gray-600">{{ $item->province }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Recent Reports -->
  <section id="laporan" class="py-24 px-6 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-5xl font-black text-gray-900 mb-4">Laporan Terbaru</h2>
        <p class="text-xl text-gray-600 font-medium">Lihat pengaduan terkini dari seluruh Indonesia</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($recentReports as $report)
        <a href="{{ route('report.show.public', $report->id) }}" class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 card-hover group block">
          <div class="relative h-56 overflow-hidden bg-gray-100">
            @if($report->image)
            <img src="{{ asset('storage/' . $report->image) }}" alt="Report" class="w-full h-full object-contain">
            @else
            <div class="w-full h-full gradient-blue"></div>
            @endif
            <div class="absolute top-4 left-4">
              <span class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-xs font-bold text-blue-600 shadow-lg">{{ $report->type }}</span>
            </div>
          </div>
          
          <div class="p-6 space-y-4">
            <p class="text-gray-700 line-clamp-3 leading-relaxed font-medium">{{ $report->description }}</p>
            
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
              <div class="flex items-center space-x-2 text-blue-600">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-bold">{{ $report->province }}</span>
              </div>
              <div class="flex items-center space-x-4 text-gray-500 text-sm">
                <div class="flex items-center space-x-1">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                  </svg>
                  <span class="font-semibold">{{ $report->viewers ?? 0 }}</span>
                </div>
                <span class="font-medium">{{ $report->created_at->diffForHumans() }}</span>
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>

      <div class="text-center mt-16">
        <a href="{{ route('all-reports') }}" class="inline-flex items-center justify-center space-x-2 px-10 py-4 gradient-blue text-white rounded-xl font-bold text-base hover:opacity-90 transition-opacity">
          <span>Lihat Semua Laporan</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-24 px-6 bg-gradient-to-br from-blue-50 via-white to-blue-50">
    <div class="max-w-7xl mx-auto">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <!-- Left: Card Content -->
        <div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-gray-100 space-y-6">
          <div class="inline-flex items-center space-x-2 px-5 py-2.5 bg-blue-50 rounded-full border border-blue-100">
            <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
            <span class="text-sm font-bold text-blue-600">Bergabung Sekarang</span>
          </div>
          
          <h2 class="text-4xl font-black text-gray-900 leading-tight">
            Jadilah Bagian dari<br/>
            <span class="text-gradient">Perubahan Indonesia</span>
          </h2>
          
          <p class="text-lg text-gray-600 font-medium leading-relaxed">
            Bergabunglah dengan ribuan masyarakat yang telah membuat perbedaan nyata di lingkungan mereka
          </p>

          <div class="space-y-3 pt-2">
            <div class="flex items-start space-x-4">
              <div class="w-11 h-11 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <div>
                <h3 class="font-bold text-gray-900 text-base mb-1">Gratis & Mudah</h3>
                <p class="text-gray-600 font-medium text-sm">Daftar dalam hitungan detik tanpa biaya apapun</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-4">
              <div class="w-11 h-11 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
              </div>
              <div>
                <h3 class="font-bold text-gray-900 text-base mb-1">Aman & Terpercaya</h3>
                <p class="text-gray-600 font-medium text-sm">Data Anda dilindungi dengan enkripsi tingkat tinggi</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-4">
              <div class="w-11 h-11 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <div>
                <h3 class="font-bold text-gray-900 text-base mb-1">Respon Cepat</h3>
                <p class="text-gray-600 font-medium text-sm">Laporan Anda akan segera ditindaklanjuti</p>
              </div>
            </div>
          </div>

          <a href="{{ route('register') }}" class="inline-flex items-center justify-center space-x-2 px-10 py-4 gradient-blue text-white rounded-xl font-bold text-base hover:opacity-90 transition-opacity">
            <span>Daftar Sekarang - GRATIS</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>

        <!-- Right: Image -->
        <div class="relative flex justify-end">
          <img src="{{ asset('images/cewe.png') }}" alt="Join Us" class="w-4/5 h-auto object-contain">
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-16 px-6 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto">
      <div class="grid md:grid-cols-3 gap-12 mb-12 text-center">
        <div class="space-y-4">
          <div class="flex items-center space-x-3 justify-center">
            <div class="w-10 h-10 gradient-blue rounded-xl flex items-center justify-center shadow-lg">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
              </svg>
            </div>
            <span class="text-xl font-bold text-gradient">LaporKan</span>
          </div>
          <p class="text-gray-600 text-sm font-medium">Platform pengaduan masyarakat terpercaya untuk Indonesia yang lebih baik.</p>
        </div>
        <div>
          <h4 class="font-bold text-gray-900 mb-4">Platform</h4>
          <ul class="space-y-3 text-gray-600 text-sm font-medium">
            <li><a href="{{ route('login') }}" class="hover:text-blue-600 transition">Masuk</a></li>
            <li><a href="{{ route('register') }}" class="hover:text-blue-600 transition">Daftar</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold text-gray-900 mb-4">Kontak</h4>
          <ul class="space-y-3 text-gray-600 text-sm font-medium">
            <li>ardiannovan52@gmail.com</li>
            <li>0857-1604-0646</li>
          </ul>
        </div>
      </div>  
      <div class="border-t border-gray-200 pt-8 text-center">
        <p class="text-gray-600 text-sm font-medium">© Novan Ardian 2026 LaporKan. Dibuat untuk Indonesia yang Lebih Baik</p>
      </div>
    </div>
  </footer>

  <script>
    @if(session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        backdrop: `rgba(30, 58, 138, 0.4)`,
        customClass: {
          popup: 'rounded-3xl',
          title: 'text-2xl font-bold',
          htmlContainer: 'text-base font-medium'
        }
      });
    @endif

    @if(session('error'))
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#1e3a8a',
        backdrop: `rgba(30, 58, 138, 0.4)`,
        customClass: {
          popup: 'rounded-3xl',
          title: 'text-2xl font-bold',
          confirmButton: 'rounded-xl px-8 py-3 font-bold'
        }
      });
    @endif
  </script>

</body>
</html>
