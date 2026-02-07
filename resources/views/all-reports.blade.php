<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semua Laporan - LaporKan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .gradient-blue { background: #1e3a8a; }
    .text-gradient { background: #1e3a8a; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .card-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .card-hover:hover { transform: translateY(-12px); box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.25); }
  </style>
</head>
<body class="bg-gray-50">

  <!-- Navbar -->
  <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <a href="{{ route('welcome') }}" class="flex items-center space-x-4">
          <div class="w-12 h-12 gradient-blue rounded-2xl flex items-center justify-center shadow-lg">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
          </div>
          <div>
            <div class="text-2xl font-bold text-gradient">LaporKan</div>
            <div class="text-xs text-gray-500 font-medium">Suara Rakyat Indonesia</div>
          </div>
        </a>
        <div class="flex items-center space-x-4">
          <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-700 hover:text-blue-600 font-bold transition">Masuk</a>
          <a href="{{ route('register') }}" class="px-8 py-3 gradient-blue text-white rounded-xl font-bold shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transform hover:scale-105 transition">Daftar Sekarang</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- All Reports Section -->
  <section class="pt-32 pb-24 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <h1 class="text-5xl font-black text-gray-900 mb-4">Semua Laporan</h1>
        <p class="text-xl text-gray-600 font-medium">Lihat semua pengaduan dari seluruh Indonesia</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($allReports as $report)
        <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 card-hover group">
          <div class="relative h-56 overflow-hidden">
            @if($report->image)
            <img src="{{ asset('storage/' . $report->image) }}" alt="Report" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
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
        </div>
        @endforeach
      </div>

      <div class="text-center mt-16">
        <a href="{{ route('welcome') }}" class="inline-flex items-center space-x-3 px-12 py-5 bg-white border-2 border-gray-200 text-gray-700 rounded-2xl font-bold text-lg hover:border-blue-300 hover:bg-blue-50 transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          <span>Kembali ke Beranda</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-16 px-6 bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto">
      <div class="grid md:grid-cols-3 gap-12 mb-12">
        <div class="space-y-4">
          <div class="flex items-center space-x-3">
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
            <li>📧 info@laporkan.id</li>
            <li>📱 (021) 1234-5678</li>
          </ul>
        </div>
      </div>  
      <div class="border-t border-gray-200 pt-8 text-center">
        <p class="text-gray-600 text-sm font-medium">© Novan Ardian 2026 LaporKan. Dibuat untuk Indonesia yang Lebih Baik</p>
      </div>
    </div>
  </footer>

</body>
</html>
