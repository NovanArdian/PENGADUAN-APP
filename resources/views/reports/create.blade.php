@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-8 py-6">
                <h2 class="text-3xl font-bold text-white">Formulir Laporan</h2>
                <p class="text-blue-100 mt-2">Sampaikan pengaduan Anda dengan lengkap dan jelas</p>
            </div>

            <div class="p-8">
                @if (Session::get('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-green-800 font-medium">{{ Session::get('success') }}</p>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <ul class="text-sm text-red-800 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="province" class="block text-sm font-semibold text-slate-700">Provinsi</label>
                            <select id="province" name="province" required
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200">
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="regency" class="block text-sm font-semibold text-slate-700">Kota/Kabupaten</label>
                            <select id="regency" name="regency" required
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200">
                                <option value="">Pilih Kota/Kabupaten</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="district" class="block text-sm font-semibold text-slate-700">Kecamatan</label>
                            <select id="district" name="subdistrict" required
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="village" class="block text-sm font-semibold text-slate-700">Desa/Kelurahan</label>
                            <select id="village" name="village" required
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200">
                                <option value="">Pilih Desa/Kelurahan</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="report_type" class="block text-sm font-semibold text-slate-700">Tipe Laporan</label>
                        <select id="report_type" name="type" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200">
                            <option value="">Pilih Tipe Laporan</option>
                            <option value="KEJAHATAN">Kejahatan</option>
                            <option value="PEMBANGUNAN">Pembangunan</option>
                            <option value="SOSIAL">Sosial</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="image" class="block text-sm font-semibold text-slate-700">Gambar Pendukung</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-semibold text-slate-700">Detail Keluhan</label>
                        <textarea id="description" name="description" rows="5" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200 resize-none text-blue-900"
                            placeholder="Jelaskan detail pengaduan Anda..."></textarea>
                    </div>

                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="statement" name="statement" value="1" required
                            class="mt-1 w-4 h-4 text-blue-900 border-slate-300 rounded focus:ring-blue-900">
                        <label for="statement" class="text-sm text-slate-600">
                            Saya menyatakan bahwa semua informasi yang saya berikan adalah benar dan akurat.
                        </label>
                    </div>

                    <div class="flex justify-end gap-4 pt-4">
                        <a href="{{ route('report.data-report') }}"
                            class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-xl transition duration-200">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-blue-900 to-blue-800 hover:from-blue-800 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
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
            type: 'GET',
            success: function(response) {
                response.forEach(function(province) {
                    $('#province').append(
                        `<option value="${province.name}" data-id="${province.id}">${province.name}</option>`
                    );
                });
            }
        });

        $('#province').change(function() {
            const provinceId = $(this).find(':selected').data('id');
            $('#regency').empty().append('<option value="">Pilih Kota/Kabupaten</option>');
            $('#district').empty().append('<option value="">Pilih Kecamatan</option>');
            $('#village').empty().append('<option value="">Pilih Desa/Kelurahan</option>');

            if (provinceId) {
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`,
                    type: 'GET',
                    success: function(response) {
                        response.forEach(function(regency) {
                            $('#regency').append(
                                `<option value="${regency.name}" data-id="${regency.id}">${regency.name}</option>`
                            );
                        });
                    }
                });
            }
        });

        $('#regency').change(function() {
            const regencyId = $(this).find(':selected').data('id');
            $('#district').empty().append('<option value="">Pilih Kecamatan</option>');
            $('#village').empty().append('<option value="">Pilih Desa/Kelurahan</option>');

            if (regencyId) {
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json`,
                    type: 'GET',
                    success: function(response) {
                        response.forEach(function(district) {
                            $('#district').append(
                                `<option value="${district.name}" data-id="${district.id}">${district.name}</option>`
                            );
                        });
                    }
                });
            }
        });

        $('#district').change(function() {
            const districtId = $(this).find(':selected').data('id');
            $('#village').empty().append('<option value="">Pilih Desa/Kelurahan</option>');

            if (districtId) {
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json`,
                    type: 'GET',
                    success: function(response) {
                        response.forEach(function(village) {
                            $('#village').append(
                                `<option value="${village.name}">${village.name}</option>`
                            );
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
