@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Card -->
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <i data-lucide="user-plus" class="w-6 h-6 text-indigo-600"></i>
                {{ $pageTitle }}
            </h1>
            <p class="text-xs text-slate-500 mt-1">Tambahkan data pegawai baru beserta jabatan, status kerja, dan nominal gaji dasar.</p>
        </div>

        <a href="{{ route('pegawai.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition-colors flex items-center gap-1.5">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    @if (count($errors) > 0)
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
        <div class="font-bold flex items-center gap-2 mb-1">
            <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600"></i>
            <span>Validasi Gagal:</span>
        </div>
        <ul class="list-disc pl-7 text-xs space-y-0.5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{ html()->form('POST', route('pegawai.store'))->class('space-y-6')->open() }}

    <!-- Section 1: Informasi Pribadi -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <div class="border-b border-slate-100 pb-3 flex items-center gap-2">
            <i data-lucide="user" class="w-5 h-5 text-indigo-600"></i>
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-800">1. Informasi Pribadi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="no_pegawai" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">No. Pegawai (NIP)</label>
                <input type="number" name="no_pegawai" id="no_pegawai" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none"
                    value="{{ old('no_pegawai') }}" placeholder="Contoh: 1001">
                @error('no_pegawai')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="namaLengkap" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                <input type="text" name="nama" id="namaLengkap" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none"
                    value="{{ old('nama') }}" placeholder="Masukkan nama pegawai">
                @error('nama')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tempatLahir" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempatLahir" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none"
                    value="{{ old('tempat_lahir') }}" placeholder="Kota kelahiran">
                @error('tempat_lahir')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggalLahir" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggalLahir" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none"
                    value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Jenis Kelamin</label>
                <div class="flex items-center gap-6 p-3 bg-slate-50 border border-slate-300 rounded-xl">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-800">
                        <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', 'L') == 'L' ? 'checked' : '' }}
                            class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                        <span>Laki-Laki</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-800">
                        <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}
                            class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                        <span>Perempuan</span>
                    </label>
                </div>
                @error('jenis_kelamin')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Section 2: Departemen & Posisi -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <div class="border-b border-slate-100 pb-3 flex items-center gap-2">
            <i data-lucide="swords" class="w-5 h-5 text-blue-600"></i>
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-800">2. Divisi Game & Role Roster</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="departemen" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Divisi Game</label>
                <select id="departemen" name="departemen_id" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none">
                    <option value="">Pilih Divisi Game...</option>
                    @foreach ($data['departemen'] as $dep)
                    <option value="{{ $dep->id }}" {{ old('departemen_id') == $dep->id ? 'selected' : '' }}>
                        {{ $dep->nama }}
                    </option>
                    @endforeach
                </select>
                @error('departemen_id')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="posisi" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Role / Position</label>
                <select id="posisi" name="posisi_id" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none">
                    <option value="">Pilih Role...</option>
                    @foreach ($data['posisi'] as $pos)
                    <option value="{{ $pos->id }}" {{ old('posisi_id') == $pos->id ? 'selected' : '' }}>
                        {{ $pos->nama }}
                    </option>
                    @endforeach
                </select>
                @error('posisi_id')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="statusPegawai" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Status Pegawai</label>
                <select id="statusPegawai" name="status_pegawai" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none">
                    <option value="tetap" {{ old('status_pegawai') == 'tetap' ? 'selected' : '' }}>Tetap</option>
                    <option value="kontrak" {{ old('status_pegawai') == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                    <option value="HL" {{ old('status_pegawai') == 'HL' ? 'selected' : '' }}>Harian Lepas</option>
                </select>
                @error('status_pegawai')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="masaKerja" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Masa Kerja (Tahun)</label>
                <input type="number" name="masa_kerja_tahun" id="masaKerja" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none"
                    value="{{ old('masa_kerja_tahun', 0) }}" min="0" placeholder="0">
                <p class="text-[11px] text-indigo-600 mt-1 font-medium">
                    *Wajib diisi angka (min. 0). Khusus Karyawan Tetap, insentif dihitung: Rp 1.000.000 (0 thn) + Rp 100.000/tahun masa kerja.
                </p>
                @error('masa_kerja_tahun')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Section 3: Gaji & Tunjangan -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <div class="border-b border-slate-100 pb-3 flex items-center gap-2">
            <i data-lucide="coins" class="w-5 h-5 text-emerald-600"></i>
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-800">3. Komponen Gaji Dasar</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="gajiPokok" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Gaji Pokok</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-xs font-bold text-slate-500">Rp</span>
                    <input type="number" name="gaji_pokok" id="gajiPokok" required
                        class="w-full pl-10 pr-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"
                        value="{{ old('gaji_pokok') }}" placeholder="5000000">
                </div>
                @error('gaji_pokok')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tunjanganTetap" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Tunjangan Tetap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-xs font-bold text-slate-500">Rp</span>
                    <input type="number" name="tunjangan_tetap" id="tunjanganTetap" required
                        class="w-full pl-10 pr-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none"
                        value="{{ old('tunjangan_tetap') }}" placeholder="1000000">
                </div>
                @error('tunjangan_tetap')
                <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Submit Bar -->
    <div class="flex items-center justify-end gap-3 pt-2">
        <a href="{{ route('pegawai.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm transition-colors">
            Batal
        </a>
        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-600/30 transition-all text-sm flex items-center gap-2">
            <i data-lucide="user-check" class="w-4 h-4"></i> Simpan Pegawai
        </button>
    </div>
    {{ html()->form()->close() }}
</div>
@endsection
