@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-white p-4 md:p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Hero Header -->
        <div class="mb-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-900 text-white rounded-full text-sm font-semibold mb-4">
                <i class="fas fa-bullhorn"></i>
                <span>Platform Pengaduan Masyarakat</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
                <span class="text-blue-900">
                    Suara Anda, Perubahan Nyata
                </span>
            </h1>
            <p class="text-lg text-blue-800 max-w-2xl mx-auto">
                Sampaikan aspirasi dan pengaduan Anda untuk Indonesia yang lebih baik
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="space-y-6">
                    <!-- Quick Action Card -->
                    <div class="bg-white rounded-3xl p-8 text-white shadow-2xl">
                        <div class="w-16 h-16 bg-blue-900/20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-plus text-3xl text-blue-900"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-blue-900">Buat Pengaduan</h3>
                        <p class="text-blue-800 mb-6">Laporkan masalah di lingkungan Anda dengan mudah dan cepat</p>
                        <a href="{{ route('report.create') }}" 
                           class="inline-flex items-center justify-center w-full px-6 py-4 bg-blue-900 text-white font-bold rounded-2xl hover:bg-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Mulai Sekarang
                        </a>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-xl border border-blue-200">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-blue-900 rounded-xl flex items-center justify-center">
                                <i class="fas fa-lightbulb text-white text-xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-blue-900">Tips Pengaduan</h4>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-blue-800 text-sm">Jelaskan kronologi kejadian secara detail</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-blue-800 text-sm">Sertakan foto atau bukti pendukung</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-blue-800 text-sm">Cantumkan lokasi yang akurat</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-blue-800 text-sm">Gunakan bahasa yang sopan</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Stats Card -->
                    <div class="bg-blue-900 rounded-3xl p-6 text-white shadow-xl">
                        <h4 class="text-lg font-bold mb-4">Statistik Platform</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-white/80">Total Pengaduan</span>
                                <span class="text-2xl font-bold">{{ $reports->count() }}</span>
                            </div>
                            <div class="h-px bg-blue-700"></div>
                            <div class="flex items-center justify-between">
                                <span class="text-white/80">Hari Ini</span>
                                <span class="text-2xl font-bold">{{ $reports->where('created_at', '>=', now()->startOfDay())->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-8">
                <!-- Filter Section -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-blue-200 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-blue-900 mb-2">
                                <i class="fas fa-filter mr-2 text-blue-900"></i>Filter Berdasarkan Provinsi
                            </label>
                            <select id="provinceDropdown" class="w-full px-4 py-3 border-2 border-blue-200 rounded-2xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition-all duration-200 bg-white text-blue-900 font-medium">
                                <option value="">🌍 Semua Provinsi</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-blue-800">
                            <i class="fas fa-info-circle"></i>
                            <span>{{ $reports->count() }} Pengaduan</span>
                        </div>
                    </div>
                </div>

                <!-- Reports Container -->
                <div id="reportContainer" class="space-y-6">
                    <div id="noDataAlert" class="hidden bg-blue-50 border-l-4 border-blue-900 rounded-2xl p-6">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-exclamation-circle text-blue-900 text-2xl"></i>
                            <div>
                                <p class="font-semibold text-blue-900">Tidak ada pengaduan</p>
                                <p class="text-sm text-blue-800">Belum ada pengaduan untuk provinsi yang dipilih</p>
                            </div>
                        </div>
                    </div>

                    @if ($reports->isEmpty())
                        <div class="bg-white rounded-3xl p-16 text-center shadow-xl border border-blue-200">
                            <div class="w-32 h-32 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-inbox text-blue-900 text-5xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-blue-900 mb-2">Belum Ada Pengaduan</h3>
                            <p class="text-blue-800 mb-6">Jadilah yang pertama membuat pengaduan</p>
                            <a href="{{ route('report.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-900 text-white font-semibold rounded-2xl hover:shadow-lg transition-all duration-200">
                                <i class="fas fa-plus mr-2"></i>Buat Pengaduan
                            </a>
                        </div>
                    @else
                        @foreach ($reports as $report)
                            <div class="report-card group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl border border-blue-200 hover:border-blue-900 transition-all duration-300" 
                                 data-province-name="{{ $report->province }}">
                                <div class="p-6 md:p-8">
                                    <!-- Header -->
                                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div class="w-12 h-12 bg-blue-900 rounded-xl flex items-center justify-center">
                                                    <span class="text-white font-bold text-lg">{{ strtoupper(substr($report->user->email, 0, 2)) }}</span>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-blue-900">{{ $report->user->email }}</p>
                                                    <div class="flex items-center gap-2 text-sm text-blue-700">
                                                        <i class="fas fa-clock"></i>
                                                        <span>{{ $report->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap gap-2">
                                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-900 rounded-full text-sm font-semibold">
                                                    <i class="fas fa-tag"></i>{{ $report->type }}
                                                </span>
                                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-900 text-white rounded-full text-sm font-semibold">
                                                    <i class="fas fa-map-marker-alt"></i>{{ $report->province }}
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('report.show', $report->id) }}" 
                                           class="px-6 py-3 bg-blue-900 hover:bg-blue-800 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 whitespace-nowrap">
                                            <i class="fas fa-arrow-right mr-2"></i>Lihat Detail
                                        </a>
                                    </div>

                                    <!-- Image -->
                                    @if ($report->image)
                                        <div class="mb-6 rounded-2xl overflow-hidden">
                                            <img src="{{ asset('storage/' . $report->image) }}" 
                                                 class="w-full h-auto object-contain max-h-96 bg-gray-100" 
                                                 alt="Report Image">
                                        </div>
                                    @endif

                                    <!-- Description -->
                                    <p class="text-blue-800 text-lg leading-relaxed mb-6">{{ Str::limit($report->description, 200) }}</p>

                                    <!-- Footer -->
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-6 border-t-2 border-blue-100">
                                        <div class="flex items-center gap-6">
                                            <div class="flex items-center gap-2">
                                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                                    <i class="fas fa-eye text-blue-900"></i>
                                                </div>
                                                <span class="font-bold text-blue-900 text-lg">{{ $report->viewers }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                                    <i class="fas fa-thumbs-up text-blue-900"></i>
                                                </div>
                                                <span class="font-bold text-blue-900 text-lg">{{ $report->voting }}</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-3 w-full sm:w-auto">
                                            <form action="{{ route('report.vote', $report->id) }}" method="POST" class="flex-1 sm:flex-none">
                                                @csrf
                                                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-900 hover:bg-blue-800 text-white rounded-2xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                                    <i class="fas fa-thumbs-up mr-2"></i>Dukung
                                                </button>
                                            </form>
                                            <form action="{{ route('report.unvote', $report->id) }}" method="POST" class="flex-1 sm:flex-none">
                                                @csrf
                                                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-white hover:bg-gray-100 text-blue-900 border-2 border-blue-900 rounded-2xl transition-all duration-200 font-semibold">
                                                    <i class="fas fa-thumbs-down mr-2"></i>Batal
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
            method: 'GET',
            success: function(data) {
                let dropdown = $('#provinceDropdown');
                $.each(data, function(key, value) {
                    dropdown.append($('<option></option>').attr('value', value.name).text('📍 ' + value.name));
                });
            }
        });

        $('#provinceDropdown').change(function() {
            var selectedProvinceName = $(this).val();
            var noDataAlert = $('#noDataAlert');
            
            if (selectedProvinceName === '') {
                $('.report-card').show();
                noDataAlert.addClass('hidden');
            } else {
                $('.report-card').hide();
                var filteredCards = $('.report-card[data-province-name="' + selectedProvinceName + '"]');
                
                if (filteredCards.length > 0) {
                    filteredCards.show();
                    noDataAlert.addClass('hidden');
                } else {
                    noDataAlert.removeClass('hidden');
                }
            }
        });
    });
</script>
@endpush
