@extends('layouts.app')

@php $pageTitle = 'Master Role & Position EVOS'; @endphp

@section('title', $pageTitle)

@section('content')
<div class="space-y-6" x-data="{ openCreateModal: false, openEditModal: false, editId: null, editNama: '', editDepartemenId: '' }">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
        <div>
            <h1 class="text-xl font-extrabold text-[#1D1D1F] tracking-tight flex items-center gap-2">
                <i data-lucide="swords" class="w-6 h-6 text-[#0052CC]"></i>
                {{ $pageTitle }}
            </h1>
            <p class="text-xs text-[#86868B] mt-1">Kelola posisi dan role pekerjaan roster (Player, Coach, Analyst, Manager) per Divisi Game.</p>
        </div>

        <button @click="openCreateModal = true"
            class="px-4 py-2.5 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-xl shadow-md shadow-blue-600/20 transition-all text-xs flex items-center gap-2 shrink-0">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Role Baru
        </button>
    </div>

    <!-- Flash Messages -->
    @if (session('status'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200/60 text-emerald-800 text-sm flex items-center gap-2 font-medium">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
        <span>{{ session('status') }}</span>
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200/60 text-rose-800 text-sm space-y-1">
        <div class="font-bold flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600"></i>
            <span>Terjadi Kesalahan:</span>
        </div>
        <ul class="list-disc pl-7 text-xs space-y-0.5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Data Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F5F5F7] border-b border-slate-200 text-[#86868B] text-xs uppercase font-bold tracking-wider">
                        <th class="py-3.5 px-4 w-16 text-center">No</th>
                        <th class="py-3.5 px-4">Nama Role / Position</th>
                        <th class="py-3.5 px-4">Divisi Game</th>
                        <th class="py-3.5 px-4 text-center">Jumlah Player & Staff</th>
                        <th class="py-3.5 px-4 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-[#1D1D1F]">
                    @forelse ($posisis as $index => $pos)
                    <tr class="hover:bg-[#FAFAFC] transition-colors">
                        <td class="py-3.5 px-4 text-center font-semibold text-[#86868B]">{{ $index + 1 }}</td>
                        <td class="py-3.5 px-4 font-extrabold text-[#1D1D1F] flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#0052CC] flex items-center justify-center font-extrabold text-xs shrink-0">
                                {{ strtoupper(substr($pos->nama, 0, 2)) }}
                            </div>
                            <span>{{ $pos->nama }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2.5 py-1 rounded-lg bg-[#F2F2F7] text-[#0052CC] text-xs font-bold">
                                {{ $pos->departemen?->nama ?? '-' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-[#0052CC]">
                                {{ $pos->pegawai_count ?? 0 }} Member
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="inline-flex items-center gap-1.5">
                                <button type="button" @click="openEditModal = true; editId = '{{ $pos->id }}'; editNama = '{{ addslashes($pos->nama) }}'; editDepartemenId = '{{ $pos->departemen_id }}'"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-[#0052CC] hover:bg-[#0066FF] text-white text-xs font-bold transition-all shadow-sm shadow-blue-600/20"
                                    title="Edit Role">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    <span>Edit</span>
                                </button>

                                {{ html()->form('DELETE', route('posisi.destroy', $pos->id))->id('delete-pos-' . $pos->id)->class('inline')->open() }}
                                <button type="button" onclick="if(confirm('Hapus role {{ $pos->nama }}?')) document.getElementById('delete-pos-{{ $pos->id }}').submit()"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-all shadow-sm shadow-rose-600/20"
                                    title="Hapus Role">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    <span>Hapus</span>
                                </button>
                                {{ html()->form()->close() }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-[#86868B] text-xs">Belum ada data role / position.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Apple Modal -->
    <div x-show="openCreateModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/40 backdrop-blur-md flex items-center justify-center p-4">
        <div @click.away="openCreateModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200/60 space-y-5">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-[#1D1D1F] text-base flex items-center gap-2">
                    <i data-lucide="plus-circle" class="w-5 h-5 text-[#0052CC]"></i> Tambah Role Baru
                </h3>
                <button @click="openCreateModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            {{ html()->form('POST', route('posisi.store'))->class('space-y-4')->open() }}
            <div>
                <label for="nama_pos_create" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Nama Role / Position</label>
                <input type="text" name="nama" id="nama_pos_create" required placeholder="Contoh: Player / Coach / Analyst / Manager"
                    class="w-full px-3.5 py-2.5 bg-[#F2F2F7] border border-transparent rounded-xl text-sm font-medium text-[#1D1D1F] focus:bg-white focus:border-[#0052CC] outline-none">
            </div>

            <div>
                <label for="dep_pos_create" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Pilih Divisi Game</label>
                <select name="departemen_id" id="dep_pos_create" required
                    class="w-full px-3.5 py-2.5 bg-[#F2F2F7] border border-transparent rounded-xl text-sm font-medium text-[#1D1D1F] focus:bg-white focus:border-[#0052CC] outline-none">
                    <option value="">Pilih Divisi Game...</option>
                    @foreach ($departemens as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="openCreateModal = false" class="px-4 py-2 bg-[#F2F2F7] hover:bg-slate-200 text-[#1D1D1F] font-semibold rounded-xl text-xs">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-xl text-xs shadow-md shadow-blue-600/20">
                    Simpan
                </button>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>

    <!-- Edit Apple Modal -->
    <div x-show="openEditModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/40 backdrop-blur-md flex items-center justify-center p-4">
        <div @click.away="openEditModal = false" class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200/60 space-y-5">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="font-bold text-[#1D1D1F] text-base flex items-center gap-2">
                    <i data-lucide="edit-3" class="w-5 h-5 text-[#0052CC]"></i> Ubah Role / Position
                </h3>
                <button @click="openEditModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form :action="'/posisi/' + editId" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="nama_pos_edit" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Nama Role / Position</label>
                    <input type="text" name="nama" id="nama_pos_edit" required x-model="editNama"
                        class="w-full px-3.5 py-2.5 bg-[#F2F2F7] border border-transparent rounded-xl text-sm font-medium text-[#1D1D1F] focus:bg-white focus:border-[#0052CC] outline-none">
                </div>

                <div>
                    <label for="dep_pos_edit" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Pilih Divisi Game</label>
                    <select name="departemen_id" id="dep_pos_edit" required x-model="editDepartemenId"
                        class="w-full px-3.5 py-2.5 bg-[#F2F2F7] border border-transparent rounded-xl text-sm font-medium text-[#1D1D1F] focus:bg-white focus:border-[#0052CC] outline-none">
                        <option value="">Pilih Divisi Game...</option>
                        @foreach ($departemens as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="openEditModal = false" class="px-4 py-2 bg-[#F2F2F7] hover:bg-slate-200 text-[#1D1D1F] font-semibold rounded-xl text-xs">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-xl text-xs shadow-md shadow-blue-600/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
