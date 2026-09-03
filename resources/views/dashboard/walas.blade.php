@extends('layouts.app')

@section('title', 'Dashboard Wali Kelas / Dosen - PermitID')

@section('content')
<div class="max-w-md md:max-w-4xl mx-auto px-4 py-6">

    <!-- Walas Header -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6 shadow-sm">
        <span class="text-xs font-semibold uppercase text-blue-600 tracking-wider">Panel Wali Kelas / Dosen Wali</span>
        <h1 class="text-lg font-bold text-slate-900 mt-0.5">{{ Auth::user()->name }}</h1>
        <p class="text-xs text-slate-500 font-mono">Kelas Pengampu: {{ Auth::user()->class_name ?? 'XII RPL 1' }}</p>
    </div>

    <!-- Pending Walas Approval Section -->
    <div class="mb-8">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-3">
            Persetujuan Surat Masuk ({{ $pendingSubmissions->count() }})
        </h2>

        @if($pendingSubmissions->isEmpty())
            <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center">
                <p class="text-xs text-slate-500">Tidak ada pengajuan surat yang membutuhkan persetujuan Wali Kelas saat ini.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($pendingSubmissions as $sub)
                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm border-l-4 border-l-sky-500">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="px-2.5 py-1 text-[11px] font-semibold text-blue-700 bg-blue-50 rounded">
                                    {{ $sub->letter_type }}
                                </span>
                                <h3 class="text-sm font-bold text-slate-900 mt-1">{{ $sub->event_name }}</h3>
                                <p class="text-xs text-slate-600 mt-0.5">Siswa: <strong>{{ $sub->student->name }}</strong> (NIS: {{ $sub->student->nis_nip }})</p>
                            </div>
                            <span class="px-2.5 py-1 text-[10px] font-semibold text-sky-700 bg-sky-50 rounded-full border border-sky-200">
                                Disetujui Admin
                            </span>
                        </div>

                        <div class="mt-3 p-3 bg-slate-50 rounded-xl text-xs space-y-1">
                            <p class="text-slate-700"><strong>Alasan / Pengajuan:</strong> "{{ $sub->reason }}"</p>
                            <p class="text-slate-500">Periode Izin: {{ date('d M Y', strtotime($sub->start_date)) }} s/d {{ date('d M Y', strtotime($sub->end_date)) }}</p>
                            @if($sub->attachment_path)
                                <a href="{{ asset('storage/' . $sub->attachment_path) }}" target="_blank" class="inline-block text-blue-600 font-semibold hover:underline mt-1">
                                    &rarr; Periksa Berkas Bukti Lampiran
                                </a>
                            @endif
                        </div>

                        <!-- Walas Actions -->
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-end space-x-2">
                            <!-- Reject Form -->
                            <details class="inline-block relative">
                                <summary class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold rounded-lg cursor-pointer transition-colors">
                                    Tolak Surat
                                </summary>
                                <div class="absolute right-0 bottom-full mb-2 w-72 bg-white border border-slate-200 rounded-xl p-3 shadow-lg z-50">
                                    <form action="{{ route('permit.walas_approve', $sub->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="reject">
                                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Alasan Penolakan Wali Kelas:</label>
                                        <textarea name="rejection_reason" rows="2" required placeholder="Tuliskan alasan kenapa tidak disetujui..."
                                            class="w-full p-2 text-xs border border-slate-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-rose-500"></textarea>
                                        <div class="mt-2 text-right">
                                            <button type="submit" class="px-3 py-1 bg-rose-600 text-white text-xs font-medium rounded-lg">Tolak Pengajuan</button>
                                        </div>
                                    </form>
                                </div>
                            </details>

                            <!-- Approve Walas -->
                            <form action="{{ route('permit.walas_approve', $sub->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg transition-colors">
                                    Setujui & Terbitkan Surat
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
