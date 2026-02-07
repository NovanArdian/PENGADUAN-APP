@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-black text-gray-900 mb-2">Data Laporan</h1>
                <p class="text-gray-600 font-medium">Kelola dan tindak lanjuti pengaduan masyarakat</p>
            </div>
            <div class="relative">
                <button onclick="toggleExport()" class="inline-flex items-center px-6 py-3 gradient-blue text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all">
                    <i class="fas fa-file-excel mr-2"></i>
                    Export Excel
                </button>
                <div id="exportMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-10">
                    <a href="{{ route('responses.export') }}" class="block px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-download mr-2 text-blue-600"></i>Seluruh Data
                    </a>
                    <button onclick="openDateModal()" class="w-full text-left px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-calendar mr-2 text-blue-600"></i>Berdasarkan Tanggal
                    </button>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if (Session::get('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-800 font-medium">{{ Session::get('success') }}</p>
                </div>
            </div>
        @endif

        @if (Session::get('failed'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <p class="text-red-800 font-medium">{{ Session::get('failed') }}</p>
                </div>
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="gradient-blue px-8 py-6">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-list-alt mr-3 text-2xl"></i>
                    Daftar Pengaduan ({{ $reports->count() }})
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pengirim</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Lokasi & Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Vote</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($reports as $report)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if ($report->image)
                                            <img onclick="openImageModal('{{ asset('storage/' . $report->image) }}')" src="{{ asset('storage/' . $report->image) }}" class="w-14 h-14 rounded-xl object-cover border-2 border-gray-200 cursor-pointer hover:border-blue-500 transition" alt="Report">
                                        @else
                                            <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-gray-200">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ $report->user->email }}</p>
                                            <p class="text-xs text-gray-500">Pengirim</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-gray-900 mb-1">
                                        <i class="fas fa-map-marker-alt text-blue-600 mr-1"></i>{{ $report->village }}
                                    </p>
                                    <p class="text-xs text-gray-600 mb-1">{{ $report->subdistrict }}, {{ $report->regency }}</p>
                                    <p class="text-xs text-gray-500">
                                        <i class="far fa-calendar mr-1"></i>{{ $report->created_at->format('d M Y') }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700">{{ Str::limit($report->description, 60) }}</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fas fa-thumbs-up mr-1"></i>{{ $report->voting }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($report->responses && $report->responses->first())
                                        <a href="{{ route('responses.show', $report->responses->first()->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-lg shadow-md transition-all">
                                            <i class="fas fa-eye mr-2"></i>Lihat Progress
                                        </a>
                                    @else
                                        <button onclick="openResponseModal({{ $report->id }})" class="inline-flex items-center px-4 py-2 gradient-blue text-white text-sm font-bold rounded-lg shadow-md hover:shadow-lg transition-all">
                                            <i class="fas fa-reply mr-2"></i>Tindak Lanjut
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <i class="fas fa-inbox text-gray-400 text-4xl mb-3"></i>
                                    <p class="text-gray-500 font-medium">Belum ada pengaduan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Image Preview -->
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
    <div class="bg-white rounded-2xl max-w-4xl w-full p-4" onclick="event.stopPropagation()">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Preview Gambar</h3>
            <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <img id="modalImage" src="" class="w-full rounded-xl" alt="Preview">
    </div>
</div>

<!-- Modal Export by Date -->
<div id="dateModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-900">Export Berdasarkan Tanggal</h3>
            <button onclick="closeDateModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form action="{{ route('responses.export') }}" method="GET">
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Tanggal</label>
                <input type="date" name="date" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeDateModal()" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-3 gradient-blue text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition">
                    Export
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Response -->
@foreach ($reports as $report)
<div id="responseModal{{ $report->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-900">Tindak Lanjut Pengaduan</h3>
            <button onclick="closeResponseModal({{ $report->id }})" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form action="{{ route('responses.store', $report->id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Status Tanggapan</label>
                <select name="response_status" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="REJECT">REJECT</option>
                    <option value="ON_PROCESS">ON PROCESS</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeResponseModal({{ $report->id }})" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-3 gradient-blue text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
function toggleExport() {
    document.getElementById('exportMenu').classList.toggle('hidden');
}

function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

function openDateModal() {
    document.getElementById('dateModal').classList.remove('hidden');
    toggleExport();
}

function closeDateModal() {
    document.getElementById('dateModal').classList.add('hidden');
}

function openResponseModal(id) {
    document.getElementById('responseModal' + id).classList.remove('hidden');
}

function closeResponseModal(id) {
    document.getElementById('responseModal' + id).classList.add('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const exportMenu = document.getElementById('exportMenu');
    if (!event.target.closest('button') && !exportMenu.classList.contains('hidden')) {
        exportMenu.classList.add('hidden');
    }
});
</script>

@endsection
