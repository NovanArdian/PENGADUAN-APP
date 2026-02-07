@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-slate-50 p-4 md:p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-3 text-slate-800">
                        Pengaduan Saya
                    </h1>
                    <p class="text-lg text-slate-600">Monitor dan kelola semua pengaduan Anda</p>
                </div>
                <a href="{{ route('report.create') }}" 
                   class="inline-flex items-center px-6 py-4 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <i class="fas fa-plus-circle mr-2 text-xl"></i>
                    <span>Buat Pengaduan Baru</span>
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white border-2 border-slate-200 rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-slate-800 rounded-2xl flex items-center justify-center shadow-md">
                            <i class="fas fa-file-alt text-white text-2xl"></i>
                        </div>
                        <span class="text-4xl font-bold text-slate-800">{{ $reports->count() }}</span>
                    </div>
                    <p class="text-slate-600 font-semibold">Total Pengaduan</p>
                </div>
                <div class="bg-white border-2 border-amber-200 rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-amber-500 rounded-2xl flex items-center justify-center shadow-md">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                        <span class="text-4xl font-bold text-slate-800">{{ $reports->filter(fn($r) => $r->responses->isEmpty())->count() }}</span>
                    </div>
                    <p class="text-slate-600 font-semibold">Menunggu Respon</p>
                </div>
                <div class="bg-white border-2 border-green-200 rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-green-600 rounded-2xl flex items-center justify-center shadow-md">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                        <span class="text-4xl font-bold text-slate-800">{{ $reports->filter(fn($r) => !$r->responses->isEmpty())->count() }}</span>
                    </div>
                    <p class="text-slate-600 font-semibold">Sudah Ditanggapi</p>
                </div>
            </div>
        </div>

        @if ($reports->isEmpty())
            <div class="bg-white rounded-3xl p-16 text-center shadow-2xl border border-slate-200">
                <div class="w-32 h-32 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-inbox text-slate-400 text-6xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-slate-800 mb-3">Belum Ada Pengaduan</h3>
                <p class="text-slate-600 text-lg mb-8 max-w-md mx-auto">Mulai sampaikan aspirasi Anda untuk perubahan yang lebih baik</p>
                <a href="{{ route('report.create') }}" 
                   class="inline-flex items-center px-8 py-4 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <i class="fas fa-plus-circle mr-3 text-xl"></i>
                    Buat Pengaduan Pertama
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($reports as $report)
                    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <!-- Card Header -->
                        <div class="bg-white px-6 md:px-8 py-6 border-b-2 border-slate-200 cursor-pointer hover:bg-slate-50 transition-all duration-200" 
                             onclick="toggleSection('report-{{ $report->id }}')">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-slate-700 rounded-2xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-file-alt text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-800">Pengaduan {{ $report->type }}</h3>
                                        <p class="text-sm text-slate-600">{{ $report->created_at->format('d F Y') }} • {{ $report->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    @if($report->responses->isEmpty())
                                        <div class="flex items-center gap-2 px-5 py-2.5 bg-amber-50 border-2 border-amber-200 rounded-xl">
                                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                                            <span class="text-sm font-bold text-amber-700">Menunggu Respon</span>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 px-5 py-2.5 bg-green-50 border-2 border-green-200 rounded-xl">
                                            <i class="fas fa-check-circle text-green-600 text-sm"></i>
                                            <span class="text-sm font-bold text-green-700">Sudah Ditanggapi</span>
                                        </div>
                                    @endif
                                    <svg class="w-6 h-6 text-slate-400 transform transition-transform duration-200" id="icon-{{ $report->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div id="report-{{ $report->id }}" class="hidden">
                            <!-- Tabs -->
                            <div class="flex border-b-2 border-slate-200 px-6 md:px-8 bg-white">
                                <button onclick="showTab('data-{{ $report->id }}')" 
                                    class="tab-btn px-6 py-4 font-bold text-slate-800 border-b-3 border-slate-800 hover:bg-slate-50 transition-all duration-200" 
                                    data-tab="data-{{ $report->id }}">
                                    <i class="fas fa-info-circle mr-2"></i>Informasi
                                </button>
                                <button onclick="showTab('image-{{ $report->id }}')" 
                                    class="tab-btn px-6 py-4 font-semibold text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-all duration-200" 
                                    data-tab="image-{{ $report->id }}">
                                    <i class="fas fa-image mr-2"></i>Gambar
                                </button>
                                <button onclick="showTab('status-{{ $report->id }}')" 
                                    class="tab-btn px-6 py-4 font-semibold text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-all duration-200" 
                                    data-tab="status-{{ $report->id }}">
                                    <i class="fas fa-tasks mr-2"></i>Status & Aksi
                                </button>
                            </div>

                            <div class="p-6 md:p-8">
                                <!-- Data Tab -->
                                <div id="data-{{ $report->id }}" class="tab-pane">
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="bg-white rounded-2xl p-6 border-2 border-slate-200 shadow-sm hover:shadow-md transition-all duration-200">
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center shadow-md">
                                                    <i class="fas fa-tag text-white"></i>
                                                </div>
                                                <h6 class="font-bold text-slate-800">Jenis Pengaduan</h6>
                                            </div>
                                            <p class="text-slate-700 text-lg font-semibold">{{ $report->type }}</p>
                                        </div>
                                        <div class="bg-white rounded-2xl p-6 border-2 border-slate-200 shadow-sm hover:shadow-md transition-all duration-200">
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-10 h-10 bg-slate-700 rounded-xl flex items-center justify-center shadow-md">
                                                    <i class="fas fa-map-marker-alt text-white"></i>
                                                </div>
                                                <h6 class="font-bold text-slate-800">Lokasi</h6>
                                            </div>
                                            <p class="text-slate-700">{{ $report->village }}, {{ $report->subdistrict }}, {{ $report->regency }}, {{ $report->province }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-6 bg-slate-50 rounded-2xl p-6 border-2 border-slate-200 shadow-sm">
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center shadow-md">
                                                <i class="fas fa-align-left text-white"></i>
                                            </div>
                                            <h6 class="font-bold text-slate-800">Deskripsi Lengkap</h6>
                                        </div>
                                        <p class="text-slate-700 leading-relaxed">{{ $report->description }}</p>
                                    </div>
                                </div>

                                <!-- Image Tab -->
                                <div id="image-{{ $report->id }}" class="tab-pane hidden">
                                    @if ($report->image)
                                        <div class="rounded-2xl overflow-hidden border-4 border-slate-100">
                                            <img src="{{ asset('storage/' . $report->image) }}" class="w-full h-auto" alt="Report Image">
                                        </div>
                                    @else
                                        <div class="text-center py-16 bg-slate-50 rounded-2xl">
                                            <div class="w-24 h-24 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-image text-slate-400 text-4xl"></i>
                                            </div>
                                            <p class="text-slate-500 text-lg font-medium">Tidak ada gambar</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Status Tab -->
                                <div id="status-{{ $report->id }}" class="tab-pane hidden">
                                    <!-- Status Timeline -->
                                    <div class="flex justify-center gap-4 mb-10">
                                        <div class="flex flex-col items-center {{ $report->responses->isEmpty() ? 'opacity-100' : 'opacity-40' }}">
                                            <div class="w-16 h-16 rounded-2xl {{ $report->responses->isEmpty() ? 'bg-amber-500' : 'bg-slate-200' }} flex items-center justify-center mb-3 shadow-lg">
                                                <i class="fas fa-clock {{ $report->responses->isEmpty() ? 'text-white' : 'text-slate-400' }} text-2xl"></i>
                                            </div>
                                            <span class="text-sm font-bold {{ $report->responses->isEmpty() ? 'text-amber-600' : 'text-slate-400' }}">Pending</span>
                                        </div>
                                        <div class="flex flex-col items-center {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'ON_PROCESS' ? 'opacity-100' : 'opacity-40' }}">
                                            <div class="w-16 h-16 rounded-2xl {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'ON_PROCESS' ? 'bg-blue-600' : 'bg-slate-200' }} flex items-center justify-center mb-3 shadow-lg">
                                                <i class="fas fa-cog {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'ON_PROCESS' ? 'text-white' : 'text-slate-400' }} text-2xl"></i>
                                            </div>
                                            <span class="text-sm font-bold {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'ON_PROCESS' ? 'text-blue-600' : 'text-slate-400' }}">Diproses</span>
                                        </div>
                                        <div class="flex flex-col items-center {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'DONE' ? 'opacity-100' : 'opacity-40' }}">
                                            <div class="w-16 h-16 rounded-2xl {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'DONE' ? 'bg-green-600' : 'bg-slate-200' }} flex items-center justify-center mb-3 shadow-lg">
                                                <i class="fas fa-check-circle {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'DONE' ? 'text-white' : 'text-slate-400' }} text-2xl"></i>
                                            </div>
                                            <span class="text-sm font-bold {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'DONE' ? 'text-green-600' : 'text-slate-400' }}">Selesai</span>
                                        </div>
                                    </div>

                                    <!-- Progress History -->
                                    @if ($report->responses->first() && $report->responses->first()->progress->count() > 0)
                                        <div class="mb-8">
                                            <h4 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                                                <i class="fas fa-history text-blue-600"></i>
                                                Riwayat Progress
                                            </h4>
                                            <div class="space-y-4">
                                                @foreach ($report->responses->first()->progress as $index => $progress)
                                                    <div class="relative pl-8 pb-4 {{ !$loop->last ? 'border-l-2 border-blue-200' : '' }}">
                                                        <div class="absolute -left-2 top-0 w-4 h-4 bg-blue-600 rounded-full border-4 border-white shadow-md"></div>
                                                        <div class="bg-white rounded-xl p-5 border-2 border-slate-200 shadow-sm hover:shadow-md transition-all">
                                                            <div class="flex items-center justify-between mb-3">
                                                                <span class="inline-flex items-center gap-2 text-sm font-bold text-blue-600">
                                                                    <i class="far fa-clock"></i>
                                                                    {{ $progress->created_at->format('d M Y, H:i') }}
                                                                </span>
                                                                <span class="text-xs font-semibold text-slate-500">Update #{{ $loop->iteration }}</span>
                                                            </div>
                                                            <p class="text-slate-700 leading-relaxed">{{ $progress->histories }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-8 text-center py-8 bg-slate-50 rounded-xl border-2 border-dashed border-slate-300">
                                            <i class="fas fa-inbox text-slate-400 text-3xl mb-3"></i>
                                            <p class="text-slate-500 font-medium">Belum ada riwayat progress</p>
                                        </div>
                                    @endif

                                    <!-- Delete Button -->
                                    <button type="button" onclick="confirmDelete({{ $report->id }})"
                                        class="w-full md:w-auto px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200">
                                        <i class="fas fa-trash-alt mr-2"></i>Hapus Pengaduan
                                    </button>
                                    <form id="delete-form-{{ $report->id }}" action="{{ route('report.destroy', $report->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
function toggleSection(id) {
    const section = document.getElementById(id);
    const icon = document.getElementById('icon-' + id.split('-')[1]);
    section.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}

function showTab(tabId) {
    const reportId = tabId.split('-')[1];
    document.querySelectorAll(`[id^="data-${reportId}"], [id^="image-${reportId}"], [id^="status-${reportId}"]`).forEach(el => {
        el.classList.add('hidden');
    });
    document.getElementById(tabId).classList.remove('hidden');
    
    document.querySelectorAll(`[data-tab^="data-${reportId}"], [data-tab^="image-${reportId}"], [data-tab^="status-${reportId}"]`).forEach(btn => {
        btn.classList.remove('text-slate-800', 'border-b-3', 'border-slate-800', 'font-bold');
        btn.classList.add('text-slate-500', 'font-semibold');
    });
    const activeBtn = document.querySelector(`[data-tab="${tabId}"]`);
    activeBtn.classList.add('text-slate-800', 'border-b-3', 'border-slate-800', 'font-bold');
    activeBtn.classList.remove('text-slate-500', 'font-semibold');
}

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pengaduan ini? Tindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection
