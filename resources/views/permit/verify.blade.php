<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Keaslian Surat Digital - PermitID</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-sm border border-slate-200 p-6 text-center">
        
        <!-- Status Icon / Header -->
        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4 border border-emerald-200">
            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <span class="inline-block px-3 py-1 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold rounded-full mb-2">
            SURAT RESMI TERVERIFIKASI
        </span>
        <h1 class="text-lg font-bold text-slate-900">Validasi Keaslian Surat Digital</h1>
        <p class="text-xs text-slate-500 mt-1">Dokumen ini diterbitkan secara sah oleh Sekolah</p>

        <!-- Document Metadata -->
        <div class="mt-6 p-4 bg-slate-50 border border-slate-200 rounded-xl text-left text-xs space-y-2">
            <div>
                <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Nomor Referensi Surat</span>
                <span class="font-mono font-bold text-slate-800 text-sm">{{ $submission->reference_number }}</span>
            </div>
            <div>
                <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Jenis Surat</span>
                <span class="font-semibold text-blue-600">{{ $submission->letter_type }}</span>
            </div>
            <div>
                <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Nama Siswa / Pemohon</span>
                <span class="font-bold text-slate-800">{{ $submission->student->name }} (NIS: {{ $submission->student->nis_nip }})</span>
            </div>
            <div>
                <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Kelas & Jurusan</span>
                <span class="text-slate-700">{{ $submission->student->class_name }} - {{ $submission->student->major }}</span>
            </div>
            <div>
                <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Nama Kegiatan / Perizinan</span>
                <span class="text-slate-800 font-semibold">{{ $submission->event_name }}</span>
            </div>
            <div>
                <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Tanggal Berlaku Izin</span>
                <span class="text-slate-800 font-medium">{{ date('d M Y', strtotime($submission->start_date)) }} s/d {{ date('d M Y', strtotime($submission->end_date)) }}</span>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-100 text-slate-400 text-[11px]">
            &copy; {{ date('Y') }} PermitID Verification Engine. Sistem Surat Digital Terotentikasi.
        </div>
    </div>

</body>
</html>
