@extends('layouts.app')

@section('title', 'Dashboard Admin Operator - PermitID')

@section('content')
<div class="max-w-md md:max-w-4xl mx-auto px-4 py-6">

    <!-- Admin Banner -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6 shadow-sm">
        <span class="text-xs font-semibold uppercase text-blue-600 tracking-wider">Panel Admin Operator</span>
        <h1 class="text-lg font-bold text-slate-900 mt-0.5">Verifikasi Pengajuan Masuk</h1>
        <p class="text-xs text-slate-500 mt-0.5">Memeriksa kebenaran data & keabsahan berkas bukti sebelum diteruskan ke Wali Kelas.</p>
    </div>

    <!-- Pending Verification Section -->
    <div class="mb-8">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-3">
            Menunggu Verifikasi Admin ({{ $pendingSubmissions->count() }})
        </h2>

        @if($pendingSubmissions->isEmpty())
            <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center">
                <p class="text-xs text-slate-500">Tidak ada pengajuan yang membutuhkan verifikasi Admin saat ini.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($pendingSubmissions as $sub)
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="px-2 py-0.5 text-[11px] font-semibold text-blue-700 bg-blue-50 rounded">
                                    {{ $sub->letter_type }}
                                </span>
                                <h3 class="text-sm font-bold text-slate-900 mt-1">{{ $sub->event_name }}</h3>
                                <p class="text-xs text-slate-600 mt-0.5">Pemohon: <strong>{{ $sub->student->name }}</strong> (NIS: {{ $sub->student->nis_nip }})</p>
                                <p class="text-xs text-slate-500 font-mono">Ref: {{ $sub->reference_number }}</p>
                            </div>
                            <span class="px-2 py-1 text-[10px] font-semibold text-amber-700 bg-amber-50 rounded-full border border-amber-200">
                                Perlunya Verifikasi
                            </span>
                        </div>

                        <div class="mt-3 p-3 bg-slate-50 rounded-xl text-xs space-y-1">
                            <p class="text-slate-700"><strong>Alasan/Penjelasan:</strong> "{{ $sub->reason }}"</p>
                            <p class="text-slate-500">Tanggal: {{ date('d M Y', strtotime($sub->start_date)) }} s/d {{ date('d M Y', strtotime($sub->end_date)) }}</p>
                            @if($sub->attachment_path)
                                <a href="{{ asset('storage/' . $sub->attachment_path) }}" target="_blank" class="inline-block text-blue-600 font-semibold hover:underline mt-1">
                                    &rarr; Lihat Berkas Bukti (Surat Atlet / Lomba)
                                </a>
                            @endif
                        </div>

                        <!-- Action Buttons & Modal Form -->
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-end space-x-2">
                            <!-- Reject Modal Toggle -->
                            <details class="inline-block relative">
                                <summary class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold rounded-lg cursor-pointer transition-colors">
                                    Tolak Pengajuan
                                </summary>
                                <div class="absolute right-0 bottom-full mb-2 w-72 bg-white border border-slate-200 rounded-xl p-3 shadow-lg z-50">
                                    <form action="{{ route('permit.admin_verify', $sub->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="reject">
                                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Alasan Penolakan:</label>
                                        <textarea name="rejection_reason" rows="2" required placeholder="Tuliskan alasan penolakan..."
                                            class="w-full p-2 text-xs border border-slate-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-rose-500"></textarea>
                                        <div class="mt-2 text-right">
                                            <button type="submit" class="px-3 py-1 bg-rose-600 text-white text-xs font-medium rounded-lg">Konfirmasi Tolak</button>
                                        </div>
                                    </form>
                                </div>
                            </details>

                            <!-- Approve Admin -->
                            <form action="{{ route('permit.admin_verify', $sub->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors">
                                    Verifikasi & Teruskan ke Walas
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
