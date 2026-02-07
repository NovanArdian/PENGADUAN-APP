<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - LaporKan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .gradient-blue { background: #1e3a8a; }
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">
  <div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
      <a href="{{ route('welcome') }}" class="inline-flex items-center space-x-3 mb-6">
        <div class="w-12 h-12 gradient-blue rounded-2xl flex items-center justify-center shadow-lg">
          <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
          </svg>
        </div>
        <span class="text-2xl font-bold text-gray-900">LaporKan</span>
      </a>
      <h1 class="text-3xl font-black text-gray-900 mb-2">Buat Akun Baru</h1>
      <p class="text-gray-600 font-medium">Daftar dan mulai sampaikan aspirasi Anda</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
      <form action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf
        
        <div class="space-y-2">
          <label for="email" class="block text-sm font-bold text-gray-900">Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
              </svg>
            </div>
            <input type="email" name="email" id="email" required autofocus
              class="block w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition text-gray-900 font-medium"
              placeholder="nama@email.com">
          </div>
        </div>

        <div class="space-y-2">
          <label for="password" class="block text-sm font-bold text-gray-900">Kata Sandi</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <input type="password" name="password" id="password" required
              class="block w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition text-gray-900 font-medium"
              placeholder="••••••••">
          </div>
          <p class="text-xs text-gray-500 font-medium">Minimal 8 karakter dengan kombinasi huruf dan angka</p>
        </div>

        <div class="space-y-2">
          <label for="password_confirmation" class="block text-sm font-bold text-gray-900">Konfirmasi Kata Sandi</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <input type="password" name="password_confirmation" id="password_confirmation" required
              class="block w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition text-gray-900 font-medium"
              placeholder="••••••••">
          </div>
        </div>

        <button type="submit"
          class="w-full py-4 px-4 gradient-blue text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition duration-200">
          Daftar Sekarang
        </button>
      </form>

      <div class="mt-8 text-center">
        <p class="text-sm text-gray-600 font-medium">
          Sudah punya akun? 
          <a href="{{ route('login') }}" class="font-bold text-blue-900 hover:text-blue-700 transition">Masuk di sini</a>
        </p>
      </div>
    </div>

    <div class="mt-6 text-center">
      <a href="{{ route('welcome') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium transition">
        ← Kembali ke Beranda
      </a>
    </div>
  </div>

  <script>
    @if(session('error'))
      Swal.fire({
        icon: 'error',
        title: 'Registrasi Gagal!',
        text: '{{ session('error') }}',
        confirmButtonText: 'Coba Lagi',
        confirmButtonColor: '#1e3a8a',
        backdrop: `rgba(30, 58, 138, 0.4)`,
        customClass: {
          popup: 'rounded-3xl',
          title: 'text-2xl font-bold',
          confirmButton: 'rounded-xl px-8 py-3 font-bold'
        }
      });
    @endif

    @if($errors->any())
      Swal.fire({
        icon: 'error',
        title: 'Registrasi Gagal!',
        html: '@foreach($errors->all() as $error){{ $error }}<br>@endforeach',
        confirmButtonText: 'Coba Lagi',
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
