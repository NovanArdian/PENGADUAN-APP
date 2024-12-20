@extends('layouts.layout')

@section('content')
    <div class="mt-4" id="reportContainer">
        @if ($reports->isEmpty())
            <div class="alert alert-info text-center">
                Anda belum memiliki pengaduan.
            </div>
        @else
            @foreach ($reports as $report)
                <div class="card mb-4 report-card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center" role="button"
                        data-bs-toggle="collapse" data-bs-target="#reportContent-{{ $report->id }}" aria-expanded="true">
                        <h5 class="mb-0">Pengaduan - {{ $report->created_at->format('d F Y') }}</h5>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="collapse show" id="reportContent-{{ $report->id }}">
                        <div class="card-body">
                            <ul class="nav nav-pills mb-3" id="reportTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#data-{{ $report->id }}" type="button" class="btn btn-danger">
                                        <i class="fas fa-file-alt me-2" style="color: tomato"></i>Data Pengaduan
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#image-{{ $report->id }}" type="button" class="btn btn-danger">
                                        <i class="fas fa-image me-2"></i>Gambar
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#status-{{ $report->id }}" type="button" class="btn btn-warning">
                                        <i class="fas fa-info-circle me-2"></i>Detail Status
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="data-{{ $report->id }}">
                                    <div class="report-info p-3 bg-light rounded shadow-sm">
                                        <div class="mb-3">
                                            <h6 class="text-danger"><i class="fas fa-tag me-2"></i>Jenis Pengaduan</h6>
                                            <p class="ms-4">{{ $report->type }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-danger"><i class="fas fa-align-left me-2"></i>Deskripsi</h6>
                                            <p class="ms-4">{{ $report->description }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-danger"><i class="fas fa-map-marker-alt me-2"></i>Lokasi</h6>
                                            <p class="ms-4">{{ $report->village }}, {{ $report->subdistrict }} {{ $report->regency }}, {{ $report->province }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="image-{{ $report->id }}">
                                    @if ($report->image)
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $report->image) }}"
                                                class="img-fluid rounded shadow" alt="Report Image">
                                        </div>
                                    @else
                                        <div class="text-center text-muted py-5">
                                            <i class="fas fa-image fa-3x mb-3"></i>
                                            <p>Tidak ada gambar</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="status-{{ $report->id }}">
                                    <div class="d-flex flex-column align-items-center p-3">
                                        <div class="status-timeline mb-4 d-flex align-items-center">
                                            <div class="status-step {{ $report->responses->isEmpty() ? 'pending' : '' }}">
                                                <i class="fas fa-clock"></i>
                                                <span>Pending</span>
                                            </div>
                                            <div class="status-step {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'ON_PROCESS' ? 'process' : '' }}">
                                                <i class="fas fa-cog"></i>
                                                <span>Diproses</span>
                                            </div>
                                            <div class="status-step {{ !$report->responses->isEmpty() && $report->responses->first()->response_status == 'DONE' ? 'done' : '' }}">
                                                <i class="fas fa-check"></i>
                                                <span>Selesai</span>
                                            </div>
                                        </div>
                                        @if ($report->responses->first() && $report->responses->first()->progress->count() > 0)
                                            <div class="timeline position-relative w-100">
                                                <div class="timeline-line"></div>
                                                @foreach ($report->responses->first()->progress as $progress)
                                                    <div class="timeline-item">
                                                        <div class="timeline-point"></div>
                                                        <div class="timeline-content">
                                                            <div class="timeline-time">
                                                                <i class="fas fa-clock me-1"></i>
                                                                {{ $progress->created_at->format('d/m/Y H:i') }}
                                                            </div>
                                                            <div class="timeline-body">
                                                                {{ $progress->histories }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if ($report->responses->first()->response_status == 'DONE')
                                                    <div class="timeline-item">
                                                        <div class="timeline-point bg-primary"></div>
                                                        <div class="timeline-content">
                                                            <div class="timeline-time">
                                                                <i class="fas fa-check me-1"></i>
                                                                {{ $report->responses->first()->updated_at->format('d/m/Y H:i') }}
                                                            </div>
                                                            <div class="timeline-body">
                                                                Pengaduan selesai
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <button type="button" class="delete-btn" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $report->id }}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $report->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi
                                                                Hapus</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus pengaduan ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <form action="{{ route('report.destroy', $report->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif 
    </div>
    <style>
        body {
    background-color: #3a0d0d; /* Merah tua pekat */
    color: #ff6f00; /* Oranye terang */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Kontainer Utama */
.card {
    background-color: #550000; /* Merah gelap */
    border: 2px solid #ff6f00; /* Border oranye */
    border-radius: 10px;
    padding: 20px;
    margin: 20px auto;
    box-shadow: 0px 4px 8px rgba(255, 111, 0, 0.4); /* Bayangan oranye */
}

/* Header */
.card-header {
    background-color: #7a1e1e; /* Merah sedang */
    color: #ff6f00;
    font-size: 20px;
    text-transform: uppercase;
    padding: 12px;
    border-bottom: 3px solid #ff4500; /* Oranye lebih pekat */
}

/* Tombol Navigasi */
.nav-pills .nav-link {
    background-color: #7a1e1e; /* Merah sedang */
    color: #ff6f00;
    border: 1px solid #ff4500;
    padding: 10px 15px;
    margin-right: 8px;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: bold;
}

.nav-pills .nav-link:hover {
    background-color: #ff4500; /* Oranye lebih pekat */
    color: #3a0d0d; /* Merah tua */
    transform: scale(1.05);
}

.nav-pills .nav-link.active {
    background-color: #ff6f00; /* Oranye terang */
    color: #550000; /* Merah gelap */
    font-weight: bold;
}

/* Status Step */
.status-step {
    display: inline-block;
    background-color: #7a1e1e; /* Merah */
    color: #ff6f00; /* Oranye */
    padding: 8px 15px;
    margin: 8px;
    border-radius: 20px;
    font-size: 14px;
    text-align: center;
    font-weight: bold;
}

.status-step.process {
    background-color: #ff4500; /* Oranye lebih kuat */
    color: #3a0d0d; /* Merah tua */
}

.status-step.done {
    background-color: #e64a19; /* Oranye merah */
    color: #3a0d0d;
}

/* Tanggapan Box */
.alert-box {
    background-color: #7a1e1e; /* Merah */
    color: #ff6f00;
    padding: 12px;
    margin-top: 15px;
    text-align: center;
    border: 2px solid #ff4500; /* Oranye pekat */
    border-radius: 8px;
}

/* Tombol Submit */
button {
    background-color: #ff4500; /* Oranye pekat */
    color: #3a0d0d; /* Merah tua */
    border: none;
    padding: 12px 25px;
    margin-top: 15px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s ease;
}

button:hover {
    background-color: #e64a19; /* Oranye-merah */
    color: #550000; /* Merah tua */
    transform: scale(1.05);
}

    </style>

    </style>
@endsection
