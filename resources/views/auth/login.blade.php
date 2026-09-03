@extends('layouts.app')

@section('title', 'Login Portal - PermitID')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center p-4">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
        
        <!-- Header Branding with Official Logo Image -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-white border border-slate-200 p-1 mb-3 shadow-sm shadow-blue-500/10">
                <img src="{{ asset('logo.png') }}" alt="PermitID Emblem" class="w-full h-full object-cover rounded-xl">
            </div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">PERMIT<span class="text-blue-600">ID</span></h1>
            <p class="text-xs text-slate-500 mt-1">Sistem Perizinan Surat Digital Siswa & Wali Kelas</p>
        </div>

        @if($errors->has('login_error'))
            <div class="mb-5 p-3 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-xs font-medium text-center">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username_or_nis" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    NIS / NIP / Nama Lengkap
                </label>
                <input type="text" id="username_or_nis" name="username_or_nis" value="{{ old('username_or_nis') }}" 
                    placeholder="Masukkan NIS / NIP atau Nama Anda" required
                    class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
                @error('username_or_nis')
                    <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">
                    Kata Sandi (Password)
                </label>
                <input type="password" id="password" name="password" required
                    placeholder="Masukkan kata sandi akun anda"
                    class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600">
                @error('password')
                    <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

          <button type="submit" class="w-full py-3 px-4 bg-[#3c6ca8] hover:bg-[#2e5382] text-white font-medium text-sm rounded-xl shadow-sm transition-colors mt-2"> 
        Masuk ke Sistem 
          </button>

    </div>
</div>
@endsection
