@extends('layouts.app')

@php $pageTitle = 'Master Divisi Game EVOS'; @endphp

@section('title', $pageTitle)

@section('content')
<div class="space-y-6" x-data="{ openCreateModal: false, openEditModal: false, editId: null, editNama: '' }">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#151D2A] p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] transition-colors duration-300">
        <div>
            <h1 class="text-xl font-extrabold text-[#0F172A] dark:text-[#F5F5F7] tracking-tight flex items-center gap-2">
                <i data-lucide="shield" class="w-6 h-6 text-[#0052CC] dark:text-[#00D2FF]"></i>
                {{ $pageTitle }}
            </h1>
            <p class="text-xs text-slate-600 dark:text-[#94A3B8] font-medium mt-1">Kelola data divisi game (MLBB, PUBGM, Valorant, Content Creator) secara dinamis.</p>
        </div>

        <button @click="openCreateModal = true"
            class="px-4 py-2.5 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-xl shadow-md shadow-blue-600/20 transition-all text-xs flex items-center gap-2 shrink-0">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Divisi Game
        </button>
    </div>

    <!-- Flash Messages -->
    @if (session('status'))
    <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/60 dark:border-emerald-800/40 text-emerald-800 dark:text-emerald-300 text-sm flex items-center gap-2 font-medium">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0"></i>
        <span>{{ session('status') }}</span>
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200/60 dark:border-rose-800/40 text-rose-800 dark:text-rose-300 text-sm space-y-1">
        <div class="font-bold flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 dark:text-rose-400"></i>
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
    <div class="bg-white dark:bg-[#151D2A] rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden p-6 transition-colors duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 dark:bg-[#1C2536] border-b-2 border-slate-200 dark:border-slate-700 text-[#0F172A] dark:text-[#94A3B8] text-xs uppercase font-extrabold tracking-wider">
                        <th class="py-3.5 px-4 w-16 text-center">No</th>
                        <th class="py-3.5 px-4">Nama Divisi Game</th>
                        <th class="py-3.5 px-4 text-center">Jumlah Role</th>
                        <th class="py-3.5 px-4 text-center">Jumlah Player & Staff</th>
                        <th class="py-3.5 px-4 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-sm text-[#0F172A] dark:text-[#F5F5F7]">
                    @forelse ($departemens as $index => $dep)
                    <tr class="hover:bg-slate-50 dark:hover:bg-[#1E293B] transition-colors">
                        <td class="py-3.5 px-4 text-center font-bold text-slate-700 dark:text-[#94A3B8]">{{ $index + 1 }}</td>
                        <td class="py-3.5 px-4 font-extrabold text-[#0F172A] dark:text-[#F5F5F7] flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-[#0052CC] dark:text-[#00D2FF] flex items-center justify-center font-extrabold text-xs shrink-0 border border-blue-200 dark:border-blue-800">
                                {{ strtoupper(substr($dep->nama, 0, 2)) }}
                            </div>
                            <span>{{ $dep->nama }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 dark:bg-[#1C2536] text-slate-800 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                {{ $dep->posisi_count ?? 0 }} Role
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100/80 dark:bg-blue-900/30 text-[#0052CC] dark:text-[#00D2FF] border border-blue-200 dark:border-blue-800">
                                {{ $dep->pegawai_count ?? 0 }} Member
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="inline-flex items-center gap-1.5">
                                <button type="button" @click="openEditModal = true; editId = '{{ $dep->id }}'; editNama = '{{ addslashes($dep->nama) }}'"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-[#0052CC] hover:bg-[#0066FF] text-white text-xs font-bold transition-all shadow-sm shadow-blue-600/20"
                                    title="Edit Divisi Game">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    <span>Edit</span>
                                </button>

                                {{ html()->form('DELETE', route('departemen.destroy', $dep->id))->id('delete-dep-' . $dep->id)->class('inline')->open() }}
                                <button type="button" onclick="if(confirm('Hapus divisi {{ $dep->nama }}?')) document.getElementById('delete-dep-{{ $dep->id }}').submit()"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-all shadow-sm shadow-rose-600/20"
                                    title="Hapus Divisi Game">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    <span>Hapus</span>
                                </button>
                                {{ html()->form()->close() }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-500 dark:text-[#94A3B8] text-xs font-medium">Belum ada data divisi game.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Apple Modal -->
    <div x-show="openCreateModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-md flex items-center justify-center p-4">
        <div @click.away="openCreateModal = false" class="bg-white dark:bg-[#151D2A] rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800 space-y-5">
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-3">
                <h3 class="font-bold text-[#0F172A] dark:text-[#F5F5F7] text-base flex items-center gap-2">
                    <i data-lucide="plus-circle" class="w-5 h-5 text-[#0052CC] dark:text-[#00D2FF]"></i> Tambah Divisi Game Baru
                </h3>
                <button @click="openCreateModal = false" class="text-slate-500 hover:text-slate-800 dark:hover:text-slate-200">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            {{ html()->form('POST', route('departemen.store'))->class('space-y-4')->open() }}
            <div>
                <label for="nama_create" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1">Nama Divisi Game</label>
                <input type="text" name="nama" id="nama_create" required placeholder="Contoh: MLBB / PUBGM / Valorant"
                    class="w-full px-3.5 py-2.5 bg-white dark:bg-[#1C2536] border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-semibold text-[#0F172A] dark:text-[#F5F5F7] focus:border-[#0052CC] outline-none">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" @click="openCreateModal = false" class="px-4 py-2 bg-slate-100 dark:bg-[#1C2536] hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-[#F5F5F7] font-semibold rounded-xl text-xs border border-slate-200 dark:border-slate-700">
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
    <div x-show="openEditModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-md flex items-center justify-center p-4">
        <div @click.away="openEditModal = false" class="bg-white dark:bg-[#151D2A] rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-800 space-y-5">
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-3">
                <h3 class="font-bold text-[#0F172A] dark:text-[#F5F5F7] text-base flex items-center gap-2">
                    <i data-lucide="edit-3" class="w-5 h-5 text-[#0052CC] dark:text-[#00D2FF]"></i> Ubah Divisi Game
                </h3>
                <button @click="openEditModal = false" class="text-slate-500 hover:text-slate-800 dark:hover:text-slate-200">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form :action="'/departemen/' + editId" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="nama_edit" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1">Nama Divisi Game</label>
                    <input type="text" name="nama" id="nama_edit" required x-model="editNama"
                        class="w-full px-3.5 py-2.5 bg-white dark:bg-[#1C2536] border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-semibold text-[#0F172A] dark:text-[#F5F5F7] focus:border-[#0052CC] outline-none">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="openEditModal = false" class="px-4 py-2 bg-slate-100 dark:bg-[#1C2536] hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-[#F5F5F7] font-semibold rounded-xl text-xs border border-slate-200 dark:border-slate-700">
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
