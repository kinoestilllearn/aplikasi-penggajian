<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Aplikasi Penggajian')) &mdash; Payroll System</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN with Custom Theme Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f3ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#1e1b4b',
                        },
                        payroll: {
                            green: '#059669',
                            dark: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js & Lucide Icons -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Vite Assets (Bootstrap DataTables integration if needed) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Custom DataTables Tailwind Overrides */
        .dataTables_wrapper {
            padding: 1rem 0;
        }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            outline: none;
            transition: all 0.2s;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }
        .dataTables_wrapper table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        .dataTables_wrapper table.dataTable thead th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.875rem 1rem !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        .dataTables_wrapper table.dataTable tbody td {
            padding: 0.875rem 1rem !important;
            font-size: 0.875rem;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            vertical-align: middle;
        }
        .dataTables_wrapper table.dataTable tbody tr:hover {
            background-color: #f8fafc;
        }
        .dataTables_wrapper .dataTables_info {
            font-size: 0.875rem;
            color: #64748b;
            padding-top: 0.75rem;
        }
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 0.75rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.375rem !important;
            padding: 0.375rem 0.75rem !important;
            font-size: 0.875rem !important;
            margin: 0 0.125rem !important;
            border: 1px solid #e2e8f0 !important;
            background: white !important;
            color: #475569 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5 !important;
            color: white !important;
            border-color: #4f46e5 !important;
            font-weight: 600;
        }
        .dt-buttons .btn-secondary {
            background-color: #f1f5f9 !important;
            color: #334155 !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 0.5rem !important;
            font-size: 0.8125rem !important;
            font-weight: 500 !important;
            padding: 0.375rem 0.75rem !important;
            box-shadow: none !important;
            margin-right: 0.375rem !important;
        }
        .dt-buttons .btn-secondary:hover {
            background-color: #e2e8f0 !important;
        }
    </style>
</head>

<body class="h-full antialiased bg-slate-50 text-slate-800" x-data="{ sidebarOpen: false }">

    @auth
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar Backdrop for Mobile -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm md:hidden"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 flex flex-col justify-between shadow-xl">

            <div>
                <!-- Brand Header -->
                <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-950/40">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-indigo-600 flex items-center justify-center text-white font-extrabold text-lg shadow-md group-hover:scale-105 transition-transform">
                            P
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-white text-base tracking-tight leading-tight">PayFlow</span>
                            <span class="text-[10px] text-slate-400 font-medium tracking-wider uppercase">Enterprise HR</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="px-3 py-6 space-y-1.5">
                    <div class="px-3 pb-2 text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Menu Utama</div>

                    <a href="{{ route('home') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('home') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span>Dashboard</span>
                    </a>

                    @can('pegawai-index')
                    <a href="{{ route('pegawai.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('pegawai.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Data Pegawai</span>
                    </a>
                    @endcan

                    <a href="{{ route('penggajian.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('penggajian.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="banknote" class="w-5 h-5"></i>
                        @role('supervisor-payroll')
                        <span>Approval Penggajian</span>
                        @else
                        <span>Penggajian Pegawai</span>
                        @endrole
                    </a>
                </nav>
            </div>

            <!-- User Info & Logout Footer -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/30">
                <div class="flex items-center gap-3 mb-3 p-2 rounded-lg bg-slate-800/50 border border-slate-700/50">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-emerald-500 text-white flex items-center justify-center font-bold text-xs shadow">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] text-slate-400 truncate">
                            @role('supervisor-payroll')
                            <span class="inline-block px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-medium">Supervisor</span>
                            @elserole('staff-payroll')
                            <span class="inline-block px-1.5 py-0.5 rounded bg-indigo-500/20 text-indigo-300 font-medium">Staff Payroll</span>
                            @else
                            <span class="inline-block px-1.5 py-0.5 rounded bg-slate-700 text-slate-300 font-medium">User</span>
                            @endrole
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-xs font-semibold text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition-colors border border-rose-500/20">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">
            <!-- Topbar Header -->
            <header class="h-16 bg-white border-b border-slate-200/80 px-4 md:px-8 flex items-center justify-between sticky top-0 z-30 shadow-sm">
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger Menu Button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>

                    <!-- Breadcrumbs / Page Context -->
                    <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
                        <span class="hidden sm:inline-block text-slate-400">PayFlow</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 hidden sm:inline-block"></i>
                        <span class="text-slate-900 font-bold tracking-tight">@yield('title', 'Dashboard')</span>
                    </div>
                </div>

                <!-- Right Header Actions -->
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/60 rounded-full text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>System Online</span>
                    </div>

                    <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

                    <!-- User Quick Menu -->
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-600 font-medium hidden md:inline-block">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </header>

            <!-- Main Body -->
            <main class="flex-1 p-4 md:p-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="py-4 px-8 border-t border-slate-200 bg-white text-xs text-slate-500 text-center">
                &copy; {{ date('Y') }} <strong>PayFlow Enterprise</strong> &mdash; Aplikasi Penggajian PT Mau Maju.
            </footer>
        </div>
    </div>
    @else
    <!-- Guest Layout (For Login/Register) -->
    <div class="min-h-screen flex items-center justify-center p-4 bg-slate-900">
        @yield('content')
    </div>
    @endauth

    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>

</html>