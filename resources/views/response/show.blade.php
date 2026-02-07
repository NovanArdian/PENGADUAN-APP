@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('responses.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-semibold mb-4 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar
            </a>
            <h1 class="text-4xl font-black text-gray-900 mb-2">Detail Progress</h1>
            <p class="text-gray-600 font-medium">Pantau perkembangan penanganan pengaduan</p>
        </div>

        <!-- Report Info Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 mb-8 overflow-hidden">
            <div class="gradient-blue px-8 py-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $response->report->user->email }}</h2>
                        <p class="text-blue-100 text-sm">Pengirim Laporan</p>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl border border-gray-200">
                        <i class="fas fa-calendar text-blue-600 text-lg"></i>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Tanggal Laporan</p>
                            <p class="text-sm font-bold text-gray-900">{{ $response->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl border border-gray-200">
                        <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Status</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold {{ $response->response_status == 'DONE' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                {{ $response->response_status }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                    <p class="text-sm font-semibold text-gray-500 mb-2">Deskripsi Laporan</p>
                    <p class="text-gray-900 leading-relaxed">{{ $response->report->description }}</p>
                </div>
                @if ($response->response_status != 'DONE')
                    <div class="mt-6 text-center">
                        <form action="{{ route('responses.update', $response->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="response_status" value="DONE">
                            <button type="submit" class="inline-flex items-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all">
                                <i class="fas fa-check-circle mr-2 text-xl"></i>
                                Nyatakan Selesai
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Progress History -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 mb-8 overflow-hidden">
            <div class="gradient-blue px-8 py-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-history mr-3 text-2xl"></i>
                    Riwayat Progress
                </h2>
            </div>
            <div class="p-8">
                @if ($response->progress->count() > 0)
                    <div class="space-y-6">
                        @foreach ($response->progress as $progress)
                            <div class="relative pl-8 pb-6 border-l-2 border-blue-200 last:border-0 last:pb-0">
                                <div class="absolute -left-2 top-0 w-4 h-4 bg-blue-600 rounded-full border-4 border-white"></div>
                                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                    <p class="text-gray-900 mb-4 leading-relaxed">{{ $progress->histories }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500 font-semibold">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $progress->created_at->format('d F Y, H:i') }}
                                        </span>
                                        @if ($response->response_status != 'DONE')
                                            <button onclick="openDeleteModal({{ $progress->id }})" class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-bold rounded-lg border border-red-200 transition">
                                                <i class="fas fa-trash mr-2"></i>Hapus
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-gray-400 text-4xl mb-3"></i>
                        <p class="text-gray-500 font-medium">Belum ada progress yang ditambahkan</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Add Progress Form -->
        @if ($response->response_status != 'DONE')
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="gradient-blue px-8 py-6">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-plus-circle mr-3 text-2xl"></i>
                        Tambah Progress
                    </h2>
                </div>
                <div class="p-8">
                    <form action="{{ route('responses.storeProgress', $response->id) }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Progress</label>
                            <textarea name="histories" rows="5" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none @error('histories') border-red-500 @enderror" placeholder="Deskripsikan progress penanganan...">{{ old('histories') }}</textarea>
                            @error('histories')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 px-6 py-4 gradient-blue text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all">
                                <i class="fas fa-save mr-2"></i>Simpan Progress
                            </button>
                            <a href="{{ route('responses.index') }}" class="px-6 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Delete Modal -->
@foreach ($response->progress as $progress)
<div id="deleteModal{{ $progress->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-900">Konfirmasi Hapus</h3>
            <button onclick="closeDeleteModal({{ $progress->id }})" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus progress ini? Tindakan ini tidak dapat dibatalkan.</p>
        <form action="{{ route('responses.destroy', $progress->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal({{ $progress->id }})" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
function openDeleteModal(id) {
    document.getElementById('deleteModal' + id).classList.remove('hidden');
}

function closeDeleteModal(id) {
    document.getElementById('deleteModal' + id).classList.add('hidden');
}
</script>

@endsection
