<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Laporan - LaporKan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .gradient-blue { background: #1e3a8a; }
    .text-gradient { background: linear-gradient(to right, #1e3a8a, #2563eb); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
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
            <div class="text-2xl font-bold text-gray-900">LaporKan</div>
            <div class="text-xs text-gray-500 font-medium">Suara Rakyat Indonesia</div>
          </div>
        </a>
        <div class="flex items-center space-x-4">
          <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-700 hover:text-blue-600 font-bold transition-colors">Masuk</a>
          <a href="{{ route('register') }}" class="px-8 py-3 gradient-blue text-white rounded-xl font-bold hover:opacity-90 transition-opacity">Daftar Sekarang</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Report Detail -->
  <section class="pt-32 pb-24 px-6">
    <div class="max-w-5xl mx-auto">
      <a href="{{ route('welcome') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-blue-600 font-semibold mb-8 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Kembali</span>
      </a>

      <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        @if($report->image)
        <div class="relative overflow-hidden bg-gray-100">
          <img src="{{ asset('storage/' . $report->image) }}" alt="Report" class="w-full h-auto object-contain max-h-96">
          <div class="absolute top-6 left-6">
            <span class="px-5 py-2.5 bg-white/90 backdrop-blur-sm rounded-full text-sm font-bold text-blue-600 shadow-lg">{{ $report->type }}</span>
          </div>
        </div>
        @endif

        <div class="p-10 space-y-8">
          <div>
            <h1 class="text-4xl font-black text-gray-900 mb-6">Detail Laporan</h1>
            <p class="text-xl text-gray-700 leading-relaxed font-medium">{{ $report->description }}</p>
          </div>

          <div class="grid md:grid-cols-2 gap-6 pt-6 border-t border-gray-200">
            <div class="space-y-4">
              <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <div>
                  <div class="text-sm text-gray-500 font-semibold">Lokasi</div>
                  <div class="text-base text-gray-900 font-bold">{{ $report->province }}, {{ $report->regency }}</div>
                  <div class="text-sm text-gray-600">{{ $report->subdistrict }}, {{ $report->village }}</div>
                </div>
              </div>

              <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <div>
                  <div class="text-sm text-gray-500 font-semibold">Tanggal Laporan</div>
                  <div class="text-base text-gray-900 font-bold">{{ $report->created_at->format('d F Y') }}</div>
                  <div class="text-sm text-gray-600">{{ $report->created_at->diffForHumans() }}</div>
                </div>
              </div>
            </div>

            <div class="space-y-4">
              <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                </svg>
                <div>
                  <div class="text-sm text-gray-500 font-semibold">Dilihat</div>
                  <div class="text-base text-gray-900 font-bold">{{ $report->viewers }} kali</div>
                </div>
              </div>

              <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                </svg>
                <div>
                  <div class="text-sm text-gray-500 font-semibold">Dukungan</div>
                  <div class="text-base text-gray-900 font-bold">{{ $report->voting }} vote</div>
                </div>
              </div>
            </div>
          </div>

          <div class="pt-8 border-t border-gray-200">
            <div class="bg-blue-50 rounded-2xl p-6 text-center">
              <p class="text-gray-700 font-semibold mb-4">Ingin memberikan dukungan atau komentar?</p>
              <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="px-8 py-3 gradient-blue text-white rounded-xl font-bold hover:opacity-90 transition-opacity">Login untuk Berinteraksi</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
