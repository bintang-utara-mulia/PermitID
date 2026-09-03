@extends('layouts.app')

@section('title', 'Dashboard Siswa - PermitID')

@section('content')
<div class="max-w-md md:max-w-4xl mx-auto px-4 py-6">

    <!-- Profile Header Card -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold uppercase text-blue-600 tracking-wider">Akun Siswa</span>
                <h1 class="text-lg font-bold text-slate-900 mt-0.5">{{ Auth::user()->name }}</h1>
                <p class="text-xs text-slate-500 font-mono mt-0.5">NIS: {{ Auth::user()->nis_nip }} | Kelas: {{ Auth::user()->class_name }} ({{ Auth::user()->major }})</p>
            </div>
            <a href="{{ route('permit.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-xl shadow-sm transition-colors flex items-center space-x-1">
                <span>+ Buat Pengajuan</span>
            </a>
        </div>
    </div>

    <!-- Surat Terbit (Draft Resmi) -->
    @php
        $suratTerbit = $submissions->where('status', 'approved');
    @endphp
    @if($suratTerbit->count() > 0)
        <div class="mb-6">
            <h2 class="text-sm font-bold text-emerald-800 uppercase tracking-wider mb-3 flex items-center space-x-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span>
                <span>Surat Terbit — Draft Resmi ({{ $suratTerbit->count() }})</span>
            </h2>
            <div class="space-y-2">
                @foreach($suratTerbit as $terbit)
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-3.5 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-mono font-bold text-emerald-900">{{ $terbit->reference_number }}</p>
                            <p class="text-xs text-emerald-700 mt-0.5">
                                <span class="font-semibold">{{ $terbit->letter_type }}</span> — {{ $terbit->event_name }}
                            </p>
                        </div>
                        <a href="{{ route('permit.print', $terbit->id) }}" target="_blank" 
                            class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-[11px] rounded-lg transition-colors">
                            Cetak Surat
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Submissions History List -->
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Riwayat Pengajuan Surat</h2>
        <span class="text-xs text-slate-500 font-medium">{{ $submissions->count() }} Pengajuan</span>
    </div>

    @if($submissions->isEmpty())
        <div class="bg-white border border-dashed border-slate-300 rounded-2xl p-8 text-center">
            <p class="text-sm text-slate-500">Belum ada pengajuan surat perizinan.</p>
            <a href="{{ route('permit.create') }}" class="inline-block mt-3 px-4 py-2 text-xs font-medium text-blue-600 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors">
                Mulai Pengajuan Surat Baru
            </a>
        </div>
    @else
        <div class="space-y-3">
            @foreach($submissions as $sub)
                <div class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 shadow-sm hover:border-slate-300 transition-colors">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="inline-block px-2.5 py-1 text-[11px] font-semibold text-blue-700 bg-blue-50 rounded-md mb-1.5">
                                {{ $sub->letter_type }}
                            </span>
                            <h3 class="text-sm font-bold text-slate-900">{{ $sub->event_name }}</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Ref: <span class="font-mono">{{ $sub->reference_number }}</span></p>
                        </div>
                        
                        <!-- Status Badge -->
                        <div>
                            @if($sub->status === 'pending_admin')
                                <span class="px-2.5 py-1 text-[11px] font-semibold text-amber-700 bg-amber-50 border border-amber-200/60 rounded-full">
                                    Verifikasi Admin
                                </span>
                            @elseif($sub->status === 'pending_walas')
                                <span class="px-2.5 py-1 text-[11px] font-semibold text-sky-700 bg-sky-50 border border-sky-200/60 rounded-full">
                                    Persetujuan Walas
                                </span>
                            @elseif($sub->status === 'approved')
                                <span class="px-2.5 py-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200/60 rounded-full">
                                    Disetujui
                                </span>
                            @elseif($sub->status === 'rejected')
                                <span class="px-2.5 py-1 text-[11px] font-semibold text-rose-700 bg-rose-50 border border-rose-200/60 rounded-full">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span>{{ date('d M Y', strtotime($sub->start_date)) }} s/d {{ date('d M Y', strtotime($sub->end_date)) }}</span>
                        <a href="{{ route('permit.show', $sub->id) }}" class="font-semibold text-blue-600 hover:text-blue-800">
                            Lihat Detail &rarr;
                        </a>
                    </div>

                    <!-- TRANSPARENCY REJECTION BOX (If Rejected) -->
                    @if($sub->status === 'rejected')
                        <div class="mt-3 p-3 bg-rose-50 border border-rose-200 rounded-xl text-xs">
                            <div class="flex items-center justify-between text-rose-900 font-semibold mb-1">
                                <span>Status: Tidak Disetujui</span>
                                <span>Penolak: {{ $sub->rejector ? $sub->rejector->name : 'Sistem' }} ({{ $sub->rejector ? strtoupper($sub->rejector->role) : 'ADMIN' }})</span>
                            </div>
                            <p class="text-rose-700">
                                <span class="font-medium text-rose-800">Alasan Penolakan:</span> "{{ $sub->rejection_reason }}"
                            </p>
                        </div>
                    @endif

                    <!-- APPROVED PRINT DIGITAL LINK -->
                    @if($sub->status === 'approved')
                        <div class="mt-3 text-right">
                            <a href="{{ route('permit.print', $sub->id) }}" target="_blank" class="inline-flex items-center space-x-1 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-xs rounded-lg transition-colors">
                                <span>Cetak Surat Digital (QR Code)</span>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
