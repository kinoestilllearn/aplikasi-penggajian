@extends('layouts.app')

@role ('supervisor-payroll')
@php $pageTitle = 'Approval & Daftar Penggajian Roster'; @endphp
@else
@php $pageTitle = 'Daftar Penggajian Roster Team'; @endphp
@endrole

@section('title', $pageTitle)

@section('content')
<div class="space-y-6">
    <!-- Apple Floating Card Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#151D2A] p-6 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] transition-colors duration-300">
        <div>
            <h1 class="text-xl font-extrabold text-[#0F172A] dark:text-[#F5F5F7] tracking-tight flex items-center gap-2">
                <i data-lucide="trophy" class="w-6 h-6 text-[#0052CC] dark:text-[#00D2FF]"></i>
                {{ $pageTitle }}
            </h1>
            <p class="text-xs text-slate-600 dark:text-[#94A3B8] font-medium mt-1">
                @role('supervisor-payroll')
                Tinjau, setujui (approve), atau batalkan draf slip penggajian roster player & staff.
                @else
                Kelola data slip gaji roster dan cetak PDF penggajian.
                @endrole
            </p>
        </div>

        @can('penggajian-create')
        <a href="{{ route('penggajian.create') }}" class="px-5 py-2.5 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-xl shadow-md shadow-blue-600/20 transition-all text-xs flex items-center gap-2 shrink-0">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Buat Penggajian Baru
        </a>
        @endcan
    </div>

    <!-- Main Table Card -->
    <div class="bg-white dark:bg-[#151D2A] rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden p-6 transition-colors duration-300">
        @if (session('status'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/60 dark:border-emerald-800/40 text-emerald-800 dark:text-emerald-300 text-sm flex items-center gap-2 font-medium">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0"></i>
            <span>{{ session('status') }}</span>
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200/60 dark:border-rose-800/40 text-rose-800 dark:text-rose-300 text-sm">
            <div class="font-bold flex items-center gap-2 mb-1">
                <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 dark:text-rose-400"></i>
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