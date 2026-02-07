@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4">
    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Deskripsi Kejadian Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                <h3 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Deskripsi Kejadian
                </h3>
            </div>
            <div class="p-6">
                <div class="grid md:grid-cols-{{ $report->image ? '2' : '1' }} gap-6">
                    @if ($report->image)
                        <div>
                            <img src="{{ asset('storage/' . $report->image) }}" 
                                 class="w-full h-auto rounded-xl shadow-lg hover:scale-105 transition duration-300 cursor-pointer" 
                                 alt="Report Image">
                        </div>
                    @endif
                    <div class="space-y-4">
                        <div class="bg-slate-50 rounded-xl p-4">
                            <p class="text-sm font-semibold text-slate-600 mb-1">Tipe Kejadian</p>
                            <p class="text-lg font-medium text-slate-900">{{ $report->type }}</p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <p class="text-sm font-semibold text-slate-600 mb-1">Tanggal Kejadian</p>
                            <p class="text-lg font-medium text-slate-900">{{ $report->created_at->format('d F Y') }}</p>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <p class="text-sm font-semibold text-slate-600 mb-1">Deskripsi</p>
                            <p class="text-slate-900">{{ $report->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Komentar Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-slate-700 to-slate-800 px-6 py-4 cursor-pointer" onclick="toggleComments()">
                <h4 class="text-2xl font-bold text-white flex items-center justify-between">
                    <span class="flex items-center">
                        <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Komentar ({{ $report->comments->count() }})
                    </span>
                    <svg id="commentIcon" class="w-6 h-6 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </h4>
            </div>

            <div id="commentSection" class="p-6 hidden">
                @if ($report->comments->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p class="text-slate-500 text-lg">Belum ada komentar pada laporan ini</p>
                    </div>
                @else
                    <div class="space-y-4 mb-6">
                        @foreach ($report->comments as $comment)
                            <div class="bg-slate-50 rounded-xl p-4 hover:bg-slate-100 transition duration-200">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($comment->user->email, 0, 2)) }}</span>
                                    </div>
                                    <div>
                                        <h6 class="font-semibold text-slate-900">{{ $comment->user->email }}</h6>
                                        <small class="text-slate-500">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <p class="text-slate-700 ml-13">{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Form Tambah Komentar -->
                <div class="border-t border-slate-200 pt-6">
                    <button onclick="toggleCommentForm()" 
                        class="flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Komentar
                    </button>
                    
                    <form method="POST" action="{{ route('report.storeComment', $report->id) }}" id="commentForm" class="hidden">
                        @csrf
                        <div class="space-y-4">
                            <textarea name="comment" rows="4" required
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 resize-none"
                                placeholder="Tulis komentar Anda..."></textarea>
                            <div class="flex gap-3">
                                <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Kirim Komentar
                                </button>
                                <button type="button" onclick="toggleCommentForm()"
                                    class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-xl transition duration-200">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="flex justify-center">
            <a href="{{ route('report.data-report') }}" 
               class="inline-flex items-center px-6 py-3 bg-slate-700 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Pengaduan
            </a>
        </div>
    </div>
</div>

<script>
function toggleComments() {
    const section = document.getElementById('commentSection');
    const icon = document.getElementById('commentIcon');
    section.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}

function toggleCommentForm() {
    const form = document.getElementById('commentForm');
    form.classList.toggle('hidden');
}
</script>
@endsection
