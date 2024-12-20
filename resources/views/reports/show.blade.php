@extends('layouts.layout')

@section('content')
    <style>
        /* General Styles */
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(135deg, #ff7f50, #ff4500);
            color: #fff;
        }

        .card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card-title-custom {
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #ff6347;
            border: none;
            color: white;
            transition: background 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #e63946;
        }

        /* Image Styles */
        .image-container img {
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .image-container img:hover {
            transform: scale(1.05);
        }

        /* Comment Section */
        .comment-list-custom {
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            border-radius: 10px;
            padding: 15px;
        }

        .comment-item-custom {
            transition: background 0.3s ease;
        }

        .comment-item-custom:hover {
            background-color: rgba(255, 140, 0, 0.1);
            border-radius: 10px;
        }
    </style>

    <!-- Deskripsi Kejadian Card -->
    <div class="card card-custom mb-4">
        <div class="card-body p-4">
            <h3 class="card-title card-title-custom d-flex align-items-center">
                <i class="fas fa-file-alt me-3"></i> Deskripsi Kejadian
            </h3>
            <div class="row">
                @if ($report->image)
                    <div class="col-md-4 mb-3">
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid shadow"
                                alt="Report Image" data-bs-toggle="modal" data-bs-target="#imageModal">
                        </div>
                    </div>
                @endif
                <div class="col-md-{{ $report->image ? '8' : '12' }}">
                    <div>
                        <p><strong>Tipe Kejadian:</strong> {{ $report->type }}</p>
                        <p><strong>Tanggal Kejadian:</strong> {{ $report->created_at->format('d F Y') }}</p>
                        <p><strong>Deskripsi:</strong> {{ $report->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Komentar Card -->
    <div class="card card-custom mb-4">
        <div class="card-body p-4">
            <h4 class="card-title card-title-custom d-flex align-items-center" style="cursor: pointer"
                onclick="toggleCommentList()">
                <i class="fas fa-comments me-3"></i> Komentar
            </h4>

            <div id="commentList" style="display: none;">
                @if ($report->comments->isEmpty())
                    <div class="text-center py-5">
                        <i class="far fa-comment-dots fa-4x text-white mb-3"></i>
                        <p class="fst-italic text-white-50">Belum ada komentar pada laporan ini</p>
                    </div>
                @else
                    <div class="comment-list-custom">
                        @foreach ($report->comments as $comment)
                            <div class="comment-item-custom mb-3 p-3">
                                <h6 class="mb-1 text-danger">{{ $comment->user->email }}</h6>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                <p class="mt-2">{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Form Tambah Komentar -->
                <div class="mt-4">
                    <h5 class="text-white d-flex align-items-center" style="cursor: pointer"
                        onclick="toggleCommentForm()">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Komentar
                    </h5>
                    <form method="POST" action="{{ route('report.storeComment', $report->id) }}" id="commentForm"
                        style="display: none;">
                        @csrf
                        <div class="mb-3">
                            <textarea name="comment" class="form-control" rows="4" placeholder="Tulis komentar Anda..."
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom px-4 rounded-pill">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Komentar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCommentList() {
            const list = document.getElementById('commentList');
            list.style.display = list.style.display === 'none' ? 'block' : 'none';
        }

        function toggleCommentForm() {
            const form = document.getElementById('commentForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection
