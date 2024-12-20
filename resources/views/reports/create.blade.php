@extends('layouts.layout')

@section('content')
    <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data" class="p-4 shadow-lg rounded mx-auto" style="max-width: 600px; background-color: #fff;">
        @csrf
        @if (Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }} </div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger p-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="mb-3 text-center">
            <h4 style="color: #e44d26; font-weight: bold;">Formulir Laporan</h4>
        </div>

        <div class="form-group mb-2">
            <label for="province" style="color: #e44d26;">Provinsi</label>
            <select class="form-control" id="province" name="province">
                <option value="">Pilih Provinsi</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="regency" style="color: #e44d26;">Kota/Kabupaten</label>
            <select class="form-control" id="regency" name="regency">
                <option value="">Pilih Kota/Kabupaten</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="district" style="color: #e44d26;">Kecamatan</label>
            <select class="form-control" id="district" name="subdistrict">
                <option value="">Pilih Kecamatan</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="village" style="color: #e44d26;">Desa/Kelurahan</label>
            <select class="form-control" id="village" name="village">
                <option value="">Pilih Desa/Kelurahan</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="report_type" style="color: #e44d26;">Tipe Laporan</label>
            <select class="form-control" id="report_type" name="type">
                <option value="">Pilih Tipe Laporan</option>
                <option value="KEJAHATAN">Kejahatan</option>
                <option value="PEMBANGUNAN">Pembangunan</option>
                <option value="SOSIAL">Sosial</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="image" style="color: #e44d26;">Gambar Pendukung</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group mb-2">
            <label for="description" style="color: #e44d26;">Detail Keluhan</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="form-group form-check mb-3">
            <input class="form-check-input" type="checkbox" id="statement" name="statement" value="1">
            <label class="form-check-label" for="statement" style="color: #e44d26;">
                Saya menyatakan bahwa semua informasi yang saya berikan adalah benar dan akurat.
            </label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn" style="background-color: #ff5722; color: #fff; border-radius: 20px; width: 100px;">Kirim</button>
        </div>
    </form>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load provinces
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

            // Load regencies
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

            // Load districts
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

            // Load villages
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
