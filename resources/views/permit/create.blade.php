@extends('layouts.app')

@section('title', 'Buat Pengajuan Surat - PermitID')

@section('content')
<div class="max-w-md md:max-w-xl mx-auto px-4 py-6">
    
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="text-xs text-slate-500 hover:text-slate-800 font-medium">&larr; Kembali ke Dashboard</a>
        <h1 class="text-lg font-bold text-slate-900 mt-1">Form Pengajuan Surat Perizinan</h1>
        <p class="text-xs text-slate-500">Lengkapi data kelas saat ini, perizinan, dan unggah berkas bukti.</p>
    </div>

    <form action="{{ route('permit.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-sm space-y-4">
        @csrf

        <!-- Student Info Header -->
        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs">
            <p class="text-slate-500">Pemohon: <strong class="text-slate-800">{{ Auth::user()->name }}</strong> (NIS: {{ Auth::user()->nis_nip }})</p>
        </div>

        <!-- Dynamic Class & Major Input by Student -->
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label for="class_name" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    Kelas Saat Ini
                </label>
                <input type="text" id="class_name" name="class_name" value="{{ old('class_name', Auth::user()->class_name) }}"
                    placeholder="Contoh: XII RPL 1" required
                    class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                @error('class_name') <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="major" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    Jurusan
                </label>
                <input type="text" id="major" name="major" value="{{ old('major', Auth::user()->major) }}"
                    placeholder="Contoh: Rekayasa Perangkat Lunak" required
                    class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                @error('major') <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="letter_type" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                Jenis Surat Pengajuan
            </label>
            <select name="letter_type" id="letter_type" required
                class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value=""> Pilih Jenis Surat</option>
                <option value="Surat Dispensasi" {{ old('letter_type') == 'Surat Dispensasi' ? 'selected' : '' }}>Surat Dispensasi (Latihan / Lomba)</option>
                <option value="Surat Rekomendasi" {{ old('letter_type') == 'Surat Rekomendasi' ? 'selected' : '' }}>Surat Rekomendasi Sekolah/Kampus</option>
                <option value="Surat Pernyataan Sekolah" {{ old('letter_type') == 'Surat Pernyataan Sekolah' ? 'selected' : '' }}>Surat Pernyataan Sekolah</option>
            </select>
            @error('letter_type') <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="event_name" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                Nama Lomba / Kegiatan
            </label>
            <input type="text" id="event_name" name="event_name" value="{{ old('event_name') }}"
                placeholder="Contoh: Kejuaraan Daerah Atletik 2026" required
                class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
            @error('event_name') <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="event_organizer" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                Penyelenggara Kegiatan (Opsional)
            </label>
            <input type="text" id="event_organizer" name="event_organizer" value="{{ old('event_organizer') }}"
                placeholder="Contoh: Pengurus PASI / Dinas Pendidikan"
                class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label for="start_date" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    Tanggal Mulai
                </label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required
                    class="w-full px-3 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                @error('start_date') <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="end_date" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    Tanggal Selesai
                </label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required
                    class="w-full px-3 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:ring-2 focus:ring-blue-600">
                @error('end_date') <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="reason" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                Penjelasan Pengajuan
            </label>
            <textarea id="reason" name="reason" rows="3" placeholder="Tuliskan detail perizinan atau keperluan pengajuan surat..." required
                class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('reason') }}</textarea>
            @error('reason') <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="attachment" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                Unggah Surat Bukti (Surat Atlet / Undangan Lomba)
            </label>
            <input type="file" id="attachment" name="attachment" required
                class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <span class="text-[11px] text-slate-400 mt-1 block">Format: PDF, JPG, PNG. Maksimal 5MB.</span>
            @error('attachment') <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-xl shadow-sm transition-colors mt-2">
            Kirim Pengajuan Surat
        </button>
    </form>
</div>
@endsection
