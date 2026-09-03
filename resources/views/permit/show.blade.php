@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat - PermitID')

@section('content')
<div class="max-w-md md:max-w-2xl mx-auto px-4 py-6">

    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="text-xs text-slate-500 hover:text-slate-800 font-medium">&larr; Kembali ke Dashboard</a>
        <h1 class="text-lg font-bold text-slate-900 mt-1">Detail Pengajuan Surat</h1>
        <p class="text-xs text-slate-500">Nomor Referensi: <span class="font-mono font-semibold">{{ $submission->reference_number }}</span></p>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-sm space-y-4">
        
        <!-- Status Indicator -->
        <div class="p-3.5 rounded-xl border flex items-center justify-between
            @if($submission->status === 'pending_admin') bg-amber-50 border-amber-200 text-amber-800
            @elseif($submission->status === 'pending_walas') bg-sky-50 border-sky-200 text-sky-800
            @elseif($submission->status === 'approved') bg-emerald-50 border-emerald-200 text-emerald-800
            @elseif($submission->status === 'rejected') bg-rose-50 border-rose-200 text-rose-800 @endif">
            <span class="text-xs font-semibold">Status Pengajuan</span>
            <span class="text-xs font-bold uppercase tracking-wider">
                @if($submission->status === 'pending_admin') Verifikasi Admin
                @elseif($submission->status === 'pending_walas') Menunggu Persetujuan Walas
                @elseif($submission->status === 'approved') Disetujui (Surat Terbit)
                @elseif($submission->status === 'rejected') Ditolak @endif
            </span>
        </div>

        <!-- TRANSPARENCY REJECTION BOX -->
        @if($submission->status === 'rejected')
            <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl space-y-1">
                <div class="flex items-center justify-between text-xs font-bold text-rose-900">
                    <span>Pengajuan Tidak Disetujui</span>
                    <span>Oleh: {{ $submission->rejector ? $submission->rejector->name : 'Sistem' }} ({{ $submission->rejector ? strtoupper($submission->rejector->role) : 'ADMIN' }})</span>
                </div>
                <p class="text-xs text-rose-800 pt-1">
                    <span class="font-semibold">Catatan / Alasan Penolakan:</span><br>
                    "{{ $submission->rejection_reason }}"
                </p>
            </div>
        @endif

        <!-- Details Grid -->
        <div class="space-y-3 text-xs border-t border-slate-100 pt-3">
            <div class="grid grid-cols-3 gap-2">
                <span class="text-slate-500">Nama Siswa:</span>
                <span class="col-span-2 font-semibold text-slate-800">{{ $submission->student->name }}</span>
            </div>

            <div class="grid grid-cols-3 gap-2">
                <span class="text-slate-500">NIS / Kelas:</span>
                <span class="col-span-2 text-slate-800">{{ $submission->student->nis_nip }} ({{ $submission->student->class_name }})</span>
            </div>

            <div class="grid grid-cols-3 gap-2">
                <span class="text-slate-500">Jenis Surat:</span>
                <span class="col-span-2 font-semibold text-blue-600">{{ $submission->letter_type }}</span>
            </div>

            <div class="grid grid-cols-3 gap-2">
                <span class="text-slate-500">Nama Lomba/Event:</span>
                <span class="col-span-2 font-semibold text-slate-800">{{ $submission->event_name }}</span>
            </div>

            <div class="grid grid-cols-3 gap-2">
                <span class="text-slate-500">Tanggal Izin:</span>
                <span class="col-span-2 text-slate-800">{{ date('d M Y', strtotime($submission->start_date)) }} s/d {{ date('d M Y', strtotime($submission->end_date)) }}</span>
            </div>

            <div class="grid grid-cols-3 gap-2">
                <span class="text-slate-500">Penjelasan:</span>
                <span class="col-span-2 text-slate-800 leading-relaxed">{{ $submission->reason }}</span>
            </div>

            @if($submission->attachment_path)
                <div class="grid grid-cols-3 gap-2 pt-2 border-t border-slate-100">
                    <span class="text-slate-500">File Bukti Lampiran:</span>
                    <span class="col-span-2">
                        <a href="{{ asset('storage/' . $submission->attachment_path) }}" target="_blank" class="text-blue-600 font-semibold hover:underline">
                            Lihat Dokumen Lampiran &rarr;
                        </a>
                    </span>
                </div>
            @endif
        </div>

        @if($submission->status === 'approved')
            <div class="pt-4 border-t border-slate-100">
                <a href="{{ route('permit.print', $submission->id) }}" target="_blank" 
                    class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-xs rounded-xl shadow-sm transition-colors flex items-center justify-center space-x-2">
                    <span>Cetak / Undah Surat Digital Ber-QR Code</span>
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
