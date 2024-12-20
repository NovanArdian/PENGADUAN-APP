@extends('layouts.layout')

@section('content')
    <div class="card mb-4 border-0 shadow-lg" style="background: linear-gradient(145deg, #ff6b4a, #ff4d4d); border-radius: 20px;">
        <div class="card-body p-5">
            <div class="d-flex align-items-center mb-4">
                <div class="me-4">
                    <div class="rounded-circle p-3" style="background-color: rgba(255,255,255,0.2);">
                        <i class="fas fa-user text-white" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
                <div>
                    <h5 class="card-title text-white mb-1 fw-bold">{{ $response->report->user->email }}</h5>
                    <small class="text-white-50">User Details</small>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="bg-white bg-opacity-10 p-3 rounded-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-event me-2 text-white"></i>
                            <span class="text-white">{{ $response->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white bg-opacity-10 p-3 rounded-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 text-white"></i>
                            <span class="text-white">Status: 
                                <span class="badge bg-{{ $response->response_status == 'DONE' ? 'success' : 'warning' }} ms-1">
                                    {{ $response->response_status }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0" style="background-color: rgba(255,255,255,0.1); border-radius: 15px;">
                <div class="card-body">
                    <p class="card-text text-white lead mb-0">{{ $response->report->description }}</p>
                </div>
            </div>

            @if ($response->response_status != 'DONE')
                <div class="mt-4 text-center">
                    <form action="{{ route('responses.update', $response->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="response_status" value="DONE">
                        <button type="submit" class="btn btn-light px-5 py-2 shadow-lg" style="border-radius: 50px;">
                            <i class="bi bi-check-circle me-2"></i>
                            Nyatakan Selesai
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-lg" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); border-radius: 20px;">
        <div class="card-body p-5">
            <h5 class="card-title text-danger fw-bold mb-4">
                <i class="bi bi-clock-history me-2"></i>Progress History
            </h5>

            @if ($response->progress->count() > 0)
                <div class="timeline position-relative">
                    <div class="timeline-line position-absolute h-100" style="left: 20px; width: 4px; background: linear-gradient(to bottom, #ff6b4a, #ff4d4d);"></div>
                    @foreach ($response->progress as $progress)
                        <div class="timeline-item ps-5 mb-4 position-relative">
                            <div class="timeline-point position-absolute rounded-circle" 
                                style="left: 10px; top: 0; width: 24px; height: 24px; background: linear-gradient(145deg, #ff6b4a, #ff4d4d); 
                                       box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                <div class="bg-white rounded-circle position-absolute" 
                                     style="width: 10px; height: 10px; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div>
                            </div>
                            <div class="card border-0 shadow-sm" style="background-color: #ffffff; border-radius: 15px;">
                                <div class="card-body">
                                    <p class="mb-2 text-danger">{{ $progress->histories }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-clock me-1 text-danger"></i>
                                            {{ $progress->created_at->format('d/m/Y H:i') }}
                                        </small>
                                        @if ($response->response_status != 'DONE')
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $progress->id }}">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Delete Modal (kept similar to previous version) -->
                                    <div class="modal fade" id="deleteModal{{ $progress->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title text-danger" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-danger">Apakah Anda yakin ingin menghapus progress ini?</p>
                                                </div>
                                                <div class="modal-footer border-top-0">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('responses.destroy', $progress->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert text-center" style="background-color: #fff3f0; color: #ff6b4a; border: 2px dashed #ff4d4d; border-radius: 15px;">
                    <i class="bi bi-info-circle me-2"></i>Belum ada progress yang ditambahkan
                </div>
            @endif
        </div>
    </div>

    @if ($response->response_status != 'DONE')
        <div class="card border-0 shadow-lg" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); border-radius: 20px;">
            <div class="card-body p-5">
                <h2 class="mb-4 text-danger fw-bold">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Progress
                </h2>
                <form action="{{ route('responses.storeProgress', $response->id) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <textarea name="histories" id="histories" 
                            class="form-control @error('histories') is-invalid @enderror" 
                            rows="4"
                            placeholder="Deskripsikan progress..." 
                            required 
                            style="resize: none; 
                                   background-color: #ffffff; 
                                   border: 2px solid #ff6b4a; 
                                   border-radius: 15px;">{{ old('histories') }}</textarea>

                        @error('histories')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-danger px-5 py-2" style="background: linear-gradient(145deg, #ff6b4a, #ff4d4d); border: none; border-radius: 50px;">
                            <i class="bi bi-save me-2"></i>Simpan Progress
                        </button>
                        <a href="{{ route('responses.index') }}" class="btn btn-outline-danger px-5 py-2" style="border-radius: 50px;">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection