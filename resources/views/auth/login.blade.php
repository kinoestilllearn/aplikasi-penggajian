@extends('layouts.app')

@section('title', 'Masuk Akun System')

@section('content')
<div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-slate-800/40">
    <!-- Left Column: Branding Banner -->
    <div class="md:w-1/2 bg-slate-950 p-8 md:p-12 text-white flex flex-col justify-between relative overflow-hidden">
        <!-- Background Accents -->
        <div class="absolute -top-16 -left-16 w-64 h-64 bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-indigo-600 flex items-center justify-center text-white font-extrabold text-xl shadow-lg">
                    P
                </div>
                <span class="font-bold text-xl tracking-tight">PayFlow Enterprise</span>
            </div>

            <h1 class="text-3xl font-extrabold tracking-tight leading-tight mb-4 text-slate-100">
                Sistem Penggajian & HR Operations Terintegrasi
            </h1>
            <p class="text-slate-400 text-sm leading-relaxed mb-6">
                Kelola gaji pegawai, insentif, lembur, serta persetujuan supervisor secara aman, transparan, dan tepat waktu.
            </p>
        </div>

        <!-- Helper Credential Selector -->
        <div class="relative z-10 bg-slate-900/90 border border-slate-800 rounded-xl p-4 text-xs">
            <p class="font-semibold text-emerald-400 mb-2 flex items-center gap-1.5">
                <i data-lucide="sparkles" class="w-4 h-4"></i> Akun Demo Siap Pakai:
            </p>

            <div class="space-y-2">
                <button type="button" onclick="fillAccount('staff@maumaju.com', 'Password')" class="w-full text-left p-2 rounded bg-slate-800 hover:bg-slate-700/80 transition-colors flex justify-between items-center group">
                    <div>
                        <span class="font-bold text-white block">Staff Payroll</span>
                        <span class="text-slate-400">staff@maumaju.com</span>
                    </div>
                    <span class="text-[10px] bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded font-medium group-hover:bg-indigo-600 group-hover:text-white transition-colors">Pilih</span>
                </button>

                <button type="button" onclick="fillAccount('spv@maumaju.com', 'Password')" class="w-full text-left p-2 rounded bg-slate-800 hover:bg-slate-700/80 transition-colors flex justify-between items-center group">
                    <div>
                        <span class="font-bold text-white block">Supervisor Payroll</span>
                        <span class="text-slate-400">spv@maumaju.com</span>
                    </div>
                    <span class="text-[10px] bg-emerald-500/20 text-emerald-300 px-2 py-0.5 rounded font-medium group-hover:bg-emerald-600 group-hover:text-white transition-colors">Pilih</span>
                </button>

                <button type="button" onclick="fillAccount('user@maumaju.com', 'Password')" class="w-full text-left p-2 rounded bg-slate-800 hover:bg-slate-700/80 transition-colors flex justify-between items-center group">
                    <div>
                        <span class="font-bold text-white block">User Biasa</span>
                        <span class="text-slate-400">user@maumaju.com</span>
                    </div>
                    <span class="text-[10px] bg-slate-700 text-slate-300 px-2 py-0.5 rounded font-medium group-hover:bg-slate-600 group-hover:text-white transition-colors">Pilih</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Right Column: Login Form -->
    <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
            <p class="text-slate-500 text-sm mt-1">Masukkan kredensial akun Anda untuk mengakses sistem.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') ? old('email') : 'staff@maumaju.com' }}" required autofocus
                        class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none transition-all"
                        placeholder="nama@perusahaan.com">
                </div>
                @error('email')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1">Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </div>
                    <input id="password" type="password" name="password" required value="Password"
                        class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 text-sm focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none transition-all"
                        placeholder="••••••••">
                </div>
                @error('password')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500 border-slate-300">
                    <span class="text-xs text-slate-600 font-medium">Ingat Saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 transition-all flex items-center justify-center gap-2 group text-sm">
                <span>Masuk ke Dashboard</span>
                <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </button>
        </form>
    </div>
</div>

<script>
    function fillAccount(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>
@endsection