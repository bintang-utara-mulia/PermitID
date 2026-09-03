@extends('layouts.app')

@section('title', 'Dashboard Admin Operator - PermitID')

@section('content')
<div class="max-w-md md:max-w-5xl mx-auto px-4 py-6">

    <!-- Admin Header Banner -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <span class="text-xs font-semibold uppercase text-[#356BA7] tracking-wider">Panel Admin Operator</span>
            <h1 class="text-lg font-bold text-slate-900 mt-0.5">Dashboard Manajemen & Verifikasi Surat</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola verifikasi pengajuan, arsip draft surat per kelas, serta data siswa & guru.</p>
        </div>

        <div class="flex items-center space-x-2">
            <!-- Add Teacher Modal Toggle -->
            <details class="relative">
                <summary class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white font-medium text-xs rounded-xl shadow-sm cursor-pointer transition-colors inline-flex items-center space-x-1">
                    <span>+ Tambah Guru/Walas</span>
                </summary>
                <div class="absolute right-0 top-full mt-2 w-80 sm:w-96 bg-white border border-slate-200 rounded-2xl p-5 shadow-xl z-50">
                    <h3 class="text-sm font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Form Tambah Guru / Wali Kelas</h3>
                    <form action="{{ route('admin.add_teacher') }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">NIP / ID Guru</label>
                            <input type="text" name="nip" placeholder="Contoh: 10002" required
                                class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">Nama Lengkap Guru</label>
                            <input type="text" name="name" placeholder="Contoh: Siti Rahmawati, S.Pd" required
                                class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">Kelas Diampu</label>
                                <input type="text" name="class_name" placeholder="Contoh: XI RPL 2" required
                                    class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">Jurusan</label>
                                <input type="text" name="major" placeholder="Contoh: RPL" required
                                    class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">Kata Sandi Akun</label>
                            <input type="password" name="password" placeholder="Minimal 4 karakter" required
                                class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div class="pt-2 text-right">
                            <button type="submit" class="w-full py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold rounded-xl">
                                Simpan Data Guru
                            </button>
                        </div>
                    </form>
                </div>
            </details>

            <!-- Add Student Modal Toggle -->
            <details class="relative">
                <summary class="px-3.5 py-2 bg-[#356BA7] hover:bg-blue-700 text-white font-medium text-xs rounded-xl shadow-sm cursor-pointer transition-colors inline-flex items-center space-x-1">
                    <span>+ Tambah Siswa</span>
                </summary>
                <div class="absolute right-0 top-full mt-2 w-80 sm:w-96 bg-white border border-slate-200 rounded-2xl p-5 shadow-xl z-50">
                    <h3 class="text-sm font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Form Tambah Siswa Baru</h3>
                    <form action="{{ route('admin.add_student') }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">NIS Siswa</label>
                            <input type="text" name="nis" placeholder="Contoh: 20261003" required
                                class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="name" placeholder="Masukkan nama siswa" required
                                class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">Kelas</label>
                                <input type="text" name="class_name" placeholder="Contoh: XI RPL 3"
                                    class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">Jurusan</label>
                                <input type="text" name="major" placeholder="Contoh: RPL"
                                    class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 uppercase mb-1">Kata Sandi Akun</label>
                            <input type="password" name="password" placeholder="Minimal 4 karakter" required
                                class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                        </div>
                        <div class="pt-2 text-right">
                            <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-xl">
                                Simpan Data Siswa
                            </button>
                        </div>
                    </form>
                </div>
            </details>
        </div>
    </div>

    <!-- CLEAN TAB SYSTEM NAVIGATION -->
    <div class="border-b border-slate-200 mb-6" x-data="{ activeTab: 'verifikasi' }">
        <nav class="flex space-x-2 sm:space-x-4 overflow-x-auto pb-1" aria-label="Tabs">
            <button @click="activeTab = 'verifikasi'" 
               :class="activeTab === 'verifikasi' ? 'bg-[#356BA7] text-white shadow-sm' : 'text-slate-600 bg-white border border-slate-200 hover:bg-slate-50'"
                    class="px-4 py-2.5 rounded-xl font-medium text-xs sm:text-sm flex items-center space-x-2 transition-all whitespace-nowrap"
                <span>Verifikasi</span>
                @if($pendingSubmissions->count() > 0)
                    <span class="px-1.5 py-0.5 text-[10px] font-bold rounded-full" 
                        :class="activeTab === 'verifikasi' ? 'bg-white text-blue-700' : 'bg-amber-100 text-amber-800'">
                        {{ $pendingSubmissions->count() }}
                    </span>
                @endif
            </button>

            <button @click="activeTab = 'arsip'" 
                :class="activeTab === 'arsip' ? 'bg-[#356BA7] text-white shadow-sm' : 'text-slate-600 bg-white border border-slate-200 hover:bg-slate-50'"
                class="px-4 py-2.5 rounded-xl font-medium text-xs sm:text-sm flex items-center space-x-2 transition-all whitespace-nowrap">
                <span>Arsip Surat</span>
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded-full" 
                    :class="activeTab === 'arsip' ? 'bg-white text-blue-700' : 'bg-slate-100 text-slate-600'">
                    {{ $processedSubmissions->count() }}
                </span>
            </button>

            <button @click="activeTab = 'siswa'" 
                :class="activeTab === 'siswa' ? 'bg-[#356BA7] text-white shadow-sm' : 'text-slate-600 bg-white border border-slate-200 hover:bg-slate-50'"
                class="px-4 py-2.5 rounded-xl font-medium text-xs sm:text-sm flex items-center space-x-2 transition-all whitespace-nowrap">
                <span>Data Siswa</span>
            </button>

            <button @click="activeTab = 'guru'" 
                :class="activeTab === 'guru' ? 'bg-[#356BA7] text-white shadow-sm' : 'text-slate-600 bg-white border border-slate-200 hover:bg-slate-50'"
                class="px-4 py-2.5 rounded-xl font-medium text-xs sm:text-sm flex items-center space-x-2 transition-all whitespace-nowrap">
                <span> Data Guru</span>
            </button>
        </nav>

        <!-- TAB CONTENT 1: VERIFIKASI -->
        <div x-show="activeTab === 'verifikasi'" class="pt-6">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-3">
                Menunggu Verifikasi Admin ({{ $pendingSubmissions->count() }})
            </h2>

            @if($pendingSubmissions->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center">
                    <p class="text-xs text-slate-500">Tidak ada pengajuan yang memerlukan verifikasi saat ini.</p>
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
                                <span class="px-2.5 py-1 text-[10px] font-semibold text-amber-700 bg-amber-50 rounded-full border border-amber-200">
                                    Perlunya Verifikasi
                                </span>
                            </div>

                            <div class="mt-3 p-3 bg-slate-50 rounded-xl text-xs space-y-1">
                                <p class="text-slate-700"><strong>Alasan/Penjelasan:</strong> "{{ $sub->reason }}"</p>
                                <p class="text-slate-500">Tanggal Kegiatan: {{ date('d M Y', strtotime($sub->start_date)) }} s/d {{ date('d M Y', strtotime($sub->end_date)) }}</p>
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

        <!-- TAB CONTENT 2: ARSIP SURAT -->
        <div x-show="activeTab === 'arsip'" class="pt-6" x-cloak>
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">
                Arsip Draft Surat Per Kelas & Siswa ({{ $processedSubmissions->count() }} Surat)
            </h2>

            @php
                $draftsByClass = $processedSubmissions->groupBy(function($sub) {
                    return $sub->student->class_name ?? 'Tanpa Kelas';
                });

                $draftJurusanConfig = [
                    'RPL' => [
                        'label'  => 'Rekayasa Perangkat Lunak', 
                        'bg'     => 'bg-indigo-500', 
                        'light'  => 'bg-indigo-50/60', 
                        'text'   => 'text-indigo-900', 
                        'border' => 'border-indigo-100'
                    ],
                    'TKJ' => [
                        'label'  => 'Teknik Komputer & Jaringan', 
                        'bg'     => 'bg-teal-600', 
                        'light'  => 'bg-teal-50/70', 
                        'text'   => 'text-teal-900', 
                        'border' => 'border-teal-100'
                    ],
                    'TM' => [
                        'label'  => 'Teknik Mekatronika', 
                        'bg'     => 'bg-amber-500', 
                        'light'  => 'bg-amber-50/60', 
                        'text'   => 'text-amber-900', 
                        'border' => 'border-amber-100'
                    ],
                ];
                $draftTingkatan = ['XI'];
                $draftKelasNomor = [1, 2, 3];
                
                $bulanIndoMap = ['Jan' => 'Januari', 'Feb' => 'Februari', 'Mar' => 'Maret', 'Apr' => 'April', 'May' => 'Mei', 'Jun' => 'Juni', 'Jul' => 'Juli', 'Aug' => 'Agustus', 'Sep' => 'September', 'Oct' => 'Oktober', 'Nov' => 'November', 'Dec' => 'Desember'];
            @endphp

            @if($processedSubmissions->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center">
                    <p class="text-xs text-slate-500">Belum ada arsip surat yang diproses.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($draftJurusanConfig as $jCode => $jCfg)
                        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                            <!-- Jurusan Header -->
                            <div class="{{ $jCfg['bg'] }} px-4 py-3 text-center">
                                <h3 class="text-sm font-bold text-white uppercase tracking-wide">{{ $jCode }}</h3>
                                <p class="text-[10px] text-white/80 mt-0.5">{{ $jCfg['label'] }}</p>
                            </div>

                            <div class="p-3 space-y-2">
                                @foreach($draftTingkatan as $tingkat)
                                    @foreach($draftKelasNomor as $noKelas)
                                        @php
                                            $namaKelas = $tingkat . ' ' . $jCode . ' ' . $noKelas;
                                            $kelasSubmissions = $draftsByClass->get($namaKelas, collect());
                                            $kelasStudents = $kelasSubmissions->groupBy(function($sub) {
                                                return $sub->student->id;
                                            });
                                            $totalSuratKelas = $kelasSubmissions->count();
                                        @endphp
                                        <details class="bg-slate-50 border border-slate-200 rounded-xl overflow-hidden group">
                                            <summary class="px-3 py-2.5 hover:bg-slate-100 cursor-pointer flex items-center justify-between transition-colors select-none">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs font-bold text-slate-800">{{ $namaKelas }}</span>
                                                    <span class="px-1.5 py-0.5 {{ $jCfg['light'] }} {{ $jCfg['text'] }} font-semibold text-[10px] rounded-full {{ $jCfg['border'] }}">
                                                        {{ $totalSuratKelas }} Surat
                                                    </span>
                                                </div>
                                                <span class="text-[10px] font-semibold text-slate-400 group-open:rotate-180 transition-transform">&#9660;</span>
                                            </summary>

                                            <div class="border-t border-slate-200 bg-white">
                                                @if($kelasStudents->isEmpty())
                                                    <div class="px-3 py-3 text-center">
                                                        <p class="text-[11px] text-slate-400 italic">Belum ada siswa yang mengajukan surat.</p>
                                                    </div>
                                                @else
                                                    <div class="divide-y divide-slate-100">
                                                        @foreach($kelasStudents as $studentId => $studentDrafts)
                                                            @php $student = $studentDrafts->first()->student; @endphp
                                                            <details class="group/student">
                                                                <summary class="px-3 py-2.5 hover:bg-slate-50 cursor-pointer flex items-center justify-between transition-colors select-none">
                                                                    <div>
                                                                        <p class="text-xs font-semibold text-slate-900">{{ $student->name }}</p>
                                                                        <p class="text-[10px] font-mono text-slate-500">NIS: {{ $student->nis_nip }}</p>
                                                                    </div>
                                                                    <span class="px-1.5 py-0.5 {{ $jCfg['light'] }} {{ $jCfg['text'] }} font-semibold text-[10px] rounded-full {{ $jCfg['border'] }}">
                                                                        {{ $studentDrafts->count() }} Surat
                                                                    </span>
                                                                </summary>
                                                                <div class="px-3 pb-3 space-y-1.5">
                                                                    @foreach($studentDrafts as $draft)
                                                                        <div class="flex flex-col p-2.5 bg-slate-50 rounded-lg text-[11px] space-y-1">
                                                                            <div class="flex items-center justify-between">
                                                                                <span class="font-mono font-bold text-slate-800">{{ $draft->reference_number }}</span>
                                                                                @if($draft->status === 'approved')
                                                                                    <span class="px-1.5 py-0.5 text-[9px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-full">Disetujui</span>
                                                                                @elseif($draft->status === 'rejected')
                                                                                    <span class="px-1.5 py-0.5 text-[9px] font-semibold text-rose-700 bg-rose-50 border border-rose-200 rounded-full">Ditolak</span>
                                                                                @elseif($draft->status === 'pending_walas')
                                                                                    <span class="px-1.5 py-0.5 text-[9px] font-semibold text-sky-700 bg-sky-50 border border-sky-200 rounded-full">Menunggu Walas</span>
                                                                                @endif
                                                                            </div>
                                                                            
                                                                            <div>
                                                                                <span class="font-semibold {{ $jCfg['text'] }}">{{ $draft->letter_type }}</span>
                                                                                <span class="text-slate-400 mx-0.5">—</span>
                                                                                <span class="text-slate-600">{{ $draft->event_name }}</span>
                                                                            </div>

                                                                            <div class="flex items-center justify-between pt-1 border-t border-slate-200/60 text-[10px] text-slate-500">
                                                                                <span> Terbit: {{ date('d', strtotime($draft->created_at)) }} {{ $bulanIndoMap[date('M', strtotime($draft->created_at))] ?? date('M', strtotime($draft->created_at)) }} {{ date('Y', strtotime($draft->created_at)) }}</span>
                                                                                @if($draft->status === 'approved')
                                                                                    <a href="{{ route('permit.print', $draft->id) }}" target="_blank" class="px-2 py-0.5 text-[9px] font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded transition-colors">Cetak</a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </details>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </details>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- TAB CONTENT 3: DATA SISWA -->
        <div x-show="activeTab === 'siswa'" class="pt-6" x-cloak>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                    Daftar Siswa Per Jurusan & Kelas (Kelas XI)
                </h2>
            </div>

            @php
                $jurusanConfig = [
                    'RPL' => [
                        'label'  => 'Rekayasa Perangkat Lunak', 
                        'bg'     => 'bg-indigo-500', 
                        'light'  => 'bg-indigo-50/60', 
                        'text'   => 'text-indigo-900', 
                        'border' => 'border-indigo-100'
                    ], 
                    'TKJ' => [
                        'label'  => 'Teknik Komputer & Jaringan', 
                        'bg'     => 'bg-teal-600', 
                        'light'  => 'bg-teal-50/70', 
                        'text'   => 'text-teal-900', 
                        'border' => 'border-teal-100'
                    ], 
                    'TM' => [
                        'label'  => 'Teknik Mekatronika', 
                        'bg'     => 'bg-amber-500', 
                        'light'  => 'bg-amber-50/60', 
                        'text'   => 'text-amber-900', 
                        'border' => 'border-amber-100'
                    ],
                ];

                $tingkatan = ['XI'];
                $kelasPerTingkat = [1, 2, 3];
                $allStudentsByClass = $studentsByClass;
            @endphp

            @if($studentsByClass->isEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center">
                    <p class="text-xs text-slate-500">Belum ada data siswa terdaftar.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($jurusanConfig as $jurusanCode => $cfg)
                        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                            <!-- Jurusan Header -->
                            <div class="{{ $cfg['bg'] }} px-4 py-3 text-center">
                                <h3 class="text-sm font-bold text-white uppercase tracking-wide">{{ $jurusanCode }}</h3>
                                <p class="text-[10px] text-white/80 mt-0.5">{{ $cfg['label'] }}</p>
                            </div>

                            <!-- Classes List -->
                            <div class="p-3 space-y-2">
                                @foreach($tingkatan as $tingkat)
                                    @foreach($kelasPerTingkat as $noKelas)
                                        @php
                                            $namaKelas = $tingkat . ' ' . $jurusanCode . ' ' . $noKelas;
                                            $siswaKelas = $allStudentsByClass->get($namaKelas, collect());
                                        @endphp
                                        <details class="bg-slate-50 border border-slate-200 rounded-xl overflow-hidden group">
                                            <summary class="px-3 py-2.5 hover:bg-slate-100 cursor-pointer flex items-center justify-between transition-colors select-none">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs font-bold text-slate-800">{{ $namaKelas }}</span>
                                                    <span class="px-1.5 py-0.5 {{ $cfg['light'] }} {{ $cfg['text'] }} font-semibold text-[10px] rounded-full {{ $cfg['border'] }}">
                                                        {{ $siswaKelas->count() }} Siswa
                                                    </span>
                                                </div>
                                                <span class="text-[10px] font-semibold text-slate-400 group-open:rotate-180 transition-transform">&#9660;</span>
                                            </summary>

                                            <div class="border-t border-slate-200 bg-white">
                                                @if($siswaKelas->isEmpty())
                                                    <div class="px-3 py-3 text-center">
                                                        <p class="text-[11px] text-slate-400 italic">Belum ada siswa terdaftar.</p>
                                                    </div>
                                                @else
                                                    <div class="divide-y divide-slate-100">
                                                        @foreach($siswaKelas as $st)
                                                            <div class="px-3 py-2 flex items-center justify-between hover:bg-slate-50/60 transition-colors">
                                                                <div>
                                                                    <p class="text-xs font-semibold text-slate-900">{{ $st->name }}</p>
                                                                    <p class="text-[10px] font-mono text-slate-500">NIS: {{ $st->nis_nip }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </details>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- TAB CONTENT 4: DATA GURU -->
        <div x-show="activeTab === 'guru'" class="pt-6" x-cloak>
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                    Daftar Wali Kelas / Guru Terdaftar ({{ $teachers->count() }})
                </h2>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-700 uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3">NIP / ID</th>
                                <th class="px-4 py-3">Nama Guru</th>
                                <th class="px-4 py-3">Kelas Diampu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($teachers as $tc)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-4 py-3 font-mono font-bold text-slate-800">{{ $tc->nis_nip }}</td>
                                    <td class="px-4 py-3 font-semibold text-slate-900">{{ $tc->name }}</td>
                                    <td class="px-4 py-3 text-slate-500">{{ $tc->class_name }} ({{ $tc->major }})</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Alpine.js CDN for interactive tabs -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
