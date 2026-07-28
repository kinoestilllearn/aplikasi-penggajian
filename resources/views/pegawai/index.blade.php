@extends('layouts.app')

@php $pageTitle = 'Daftar Data Pegawai'; @endphp

@section('title', $pageTitle)

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <i data-lucide="users" class="w-6 h-6 text-indigo-600"></i>
                {{ $pageTitle }}
            </h1>
            <p class="text-xs text-slate-500 mt-1">Kelola data seluruh karyawan, jabatan, departemen, dan gaji pokok.</p>
        </div>

        <div class="flex items-center gap-2">
            <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-semibold border border-indigo-100 flex items-center gap-1.5">
                <i data-lucide="database" class="w-3.5 h-3.5"></i> Live Data
            </span>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden p-6">
        @if (session('status'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-2 font-medium">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
            <span>{{ session('status') }}</span>
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
            <div class="font-bold flex items-center gap-2 mb-1">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600"></i>
                <span>Terjadi Kesalahan Validasi:</span>
            </div>
            <ul class="list-disc pl-7 space-y-0.5 text-xs">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="overflow-x-auto">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush