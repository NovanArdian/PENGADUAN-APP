@extends('layouts.layout')

@section('content')
    <h1 class="mb-4 text-center text-orange-gradient">Kelola Staff</h1>

    <!-- Form Tambah Staff -->
    <div class="card mb-4 shadow-lg border-orange">
        <div class="card-header gradient-orange text-white">
            <h5 class="card-title mb-0">Tambah Staff</h5>
        </div>
        <div class="card-body bg-light-orange">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('staff.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label text-dark-orange">Email</label>
                        <input type="email" name="email" class="form-control rounded-pill border-orange" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="password" class="form-label text-dark-orange">Password</label>
                        <input type="password" name="password" class="form-control rounded-pill border-orange" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="province" class="form-label text-dark-orange">Province</label>
                        <select name="province" id="province" class="form-select rounded-pill border-orange" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-orange rounded-pill px-4">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Staff -->
    <div class="card shadow-lg border-red">
        <div class="card-header gradient-red text-white">
            <h5 class="card-title mb-0">Daftar Staff</h5>
        </div>
        <div class="card-body bg-light-red">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light text-red">
                        <tr>
                            <th>Email</th>
                            <th>Province</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $staff)
                            <tr>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->staffProvinces->first()->province ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- Tombol Reset Password -->
                                        <form action="{{ route('staff.resetPassword', $staff) }}" method="POST" class="me-2">
                                            @csrf
                                            <button class="btn btn-warning btn-sm rounded-pill">
                                                <i class="fas fa-key me-1"></i> Reset Password
                                            </button>
                                        </form>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('staff.destroy', $staff) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm rounded-pill"
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                // Fetch provinces from API
                $.ajax({
                    url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                    type: 'GET',
                    success: function(response) {
                        response.forEach(function(province) {
                            $('#province').append(
                                `<option value="${province.name}" data-id="${province.id}">${province.name}</option>`
                            );
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch provinces:', error);
                    }
                });
            });
        </script>
    @endpush
@endsection
