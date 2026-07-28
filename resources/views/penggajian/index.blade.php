@extends('layouts.app')

@role ('supervisor-payroll')
@php $pageTitle = 'Approval & Daftar Penggajian Pegawai'; @endphp
@else
@php $pageTitle = 'Daftar Penggajian Pegawai'; @endphp
@endrole

@section('title', $pageTitle)

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <i data-lucide="banknote" class="w-6 h-6 text-emerald-600"></i>
                {{ $pageTitle }}
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                @role('supervisor-payroll')
                Tinjau, setujui (approve), atau batalkan draf slip penggajian pegawai.
                @else
                Kelola data slip gaji pegawai dan cetak PDF penggajian.
                @endrole
            </p>
        </div>

        @can('penggajian-create')
        <a href="{{ route('penggajian.create') }}" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-emerald-600/30 transition-all text-xs flex items-center gap-2 shrink-0">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Buat Penggajian Baru
        </a>
        @endcan
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