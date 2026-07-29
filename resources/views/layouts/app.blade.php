<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#F5F5F7]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EVOS Esports &mdash; @yield('title', 'Roster & Payroll System')</title>

    <!-- Google Fonts: Plus Jakarta Sans / Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        apple: {
                            bg: '#F5F5F7',
                            card: '#FFFFFF',
                            input: '#F2F2F7',
                            text: '#1D1D1F',
                            muted: '#86868B',
                        },
                        evos: {
                            blue: '#0052CC',
                            bright: '#0066FF',
                            cyan: '#00D2FF',
                            navy: '#051329',
                            dark: '#030b18',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    },
                    boxShadow: {
                        'apple': '0 4px 20px 0 rgba(0, 0, 0, 0.03)',
                        'apple-hover': '0 8px 30px 0 rgba(0, 0, 0, 0.06)',
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- AlpineJS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        body {
            background-color: #F5F5F7 !important;
            color: #1D1D1F !important;
        }

        /* Hide DataTables default floating dots processing indicator */
        .dataTables_wrapper .dataTables_processing {
            display: none !important;
        }

        /* Apple Clean Input Styling */
        input[type="text"], input[type="number"], input[type="email"], input[type="date"], select, textarea {
            background-color: #F2F2F7 !important;
            border: 1px solid transparent !important;
            border-radius: 0.75rem !important;
            color: #1D1D1F !important;
            font-weight: 500 !important;
            transition: all 0.2s ease-in-out !important;
        }
        input:focus, select:focus, textarea:focus {
            background-color: #FFFFFF !important;
            border-color: #0052CC !important;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.15) !important;
            outline: none !important;
        }

        /* Apple Clean DataTables Styling */
        .dataTables_wrapper .dataTables_length select {
            border-radius: 0.75rem !important;
            background-color: #F2F2F7 !important;
            border: none !important;
            padding: 0.35rem 2rem 0.35rem 0.75rem !important;
            font-size: 0.8125rem !important;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.75rem !important;
            background-color: #F2F2F7 !important;
            border: 1px solid transparent !important;
            padding: 0.4rem 0.85rem !important;
            outline: none !important;
            font-size: 0.8125rem !important;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            background-color: #FFFFFF !important;
            border-color: #0052CC !important;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.15) !important;
        }
        table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0 !important;
            width: 100% !important;
            border: none !important;
        }
        table.dataTable thead th {
            background-color: #F5F5F7 !important;
            color: #86868B !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            font-size: 0.7rem !important;
            letter-spacing: 0.06em !important;
            padding: 0.85rem 1rem !important;
            border-bottom: 1px solid #E5E5EA !important;
            border-top: none !important;
        }
        table.dataTable tbody td {
            padding: 0.85rem 1rem !important;
            border-bottom: 1px solid #F2F2F7 !important;
            font-size: 0.875rem !important;
            color: #1D1D1F !important;
        }
        table.dataTable tbody tr:hover {
            background-color: #FAFAFC !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.75rem !important;
            border: none !important;
            background: #F2F2F7 !important;
            color: #1D1D1F !important;
            font-weight: 600 !important;
            font-size: 0.75rem !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #0052CC !important;
            color: white !important;
            border: none !important;
            box-shadow: 0 2px 8px rgba(0, 82, 204, 0.25) !important;
        }
        
        /* Apple Export Buttons */
        .dt-buttons {
            display: inline-flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            gap: 0.5rem !important;
            margin-bottom: 1rem !important;
        }
        .dt-buttons .btn,
        .dt-buttons .btn-secondary,
        .dt-buttons button {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.375rem !important;
            background: #F2F2F7 !important;
            color: #1D1D1F !important;
            border: none !important;
            border-radius: 0.75rem !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            padding: 0.45rem 0.85rem !important;
            transition: all 0.2s ease-in-out !important;
            cursor: pointer !important;
            text-decoration: none !important;
        }
        .dt-buttons .btn:hover,
        .dt-buttons .btn-secondary:hover,
        .dt-buttons button:hover {
            background: #0052CC !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px 0 rgba(0, 82, 204, 0.25) !important;
            transform: translateY(-1px) !important;
        }
        .dt-buttons .btn:hover svg,
        .dt-buttons button:hover svg {
            color: #ffffff !important;
        }
    </style>
</head>

<body class="h-full antialiased bg-[#F5F5F7] text-[#1D1D1F]" x-data="{ sidebarOpen: false }">

    @auth
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar Backdrop for Mobile -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-md md:hidden"></div>

        <!-- Apple Clean Dark Navy Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-[#051329] text-slate-300 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 flex flex-col justify-between shadow-2xl border-r border-slate-800/40">

            <div>
                <!-- EVOS Brand Header -->
                <div class="h-16 flex items-center px-6 border-b border-slate-800/80 bg-[#030b18]/80">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-400 flex items-center justify-center text-white font-extrabold text-lg shadow-md shadow-blue-600/30 group-hover:scale-105 transition-transform">
                            <i data-lucide="gamepad-2" class="w-5 h-5"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-white text-base tracking-tight leading-none flex items-center gap-1">
                                EVOS <span class="text-xs text-cyan-400 font-extrabold">ROSTER</span>
                            </span>
                            <span class="text-[10px] text-slate-400 font-medium tracking-widest uppercase mt-0.5">Payroll Operations</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="px-3 py-6 space-y-1.5">
                    <div class="px-3 pb-2 text-[10px] font-extrabold tracking-widest text-slate-400 uppercase flex items-center gap-1.5">
                        <span>Main Hub</span>
                    </div>

                    <a href="{{ route('home') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('home') ? 'bg-[#0052CC] text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Dashboard Overview</span>
                    </a>

                    @can('pegawai-index')
                    <a href="{{ route('pegawai.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('pegawai.*') ? 'bg-[#0052CC] text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Roster Player & Staff</span>
                    </a>
                    @endcan

                    <a href="{{ route('penggajian.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('penggajian.*') ? 'bg-[#0052CC] text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                        <i data-lucide="trophy" class="w-4 h-4"></i>
                        @role('supervisor-payroll')
                        <span>Approval Gaji Roster</span>
                        @else
                        <span>Penggajian Roster</span>
                        @endrole
                    </a>

                    <div class="px-3 pt-5 pb-2 text-[10px] font-extrabold tracking-widest text-slate-400 uppercase flex items-center gap-1.5">
                        <span>Master Structure</span>
                    </div>

                    <a href="{{ route('departemen.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('departemen.*') ? 'bg-[#0052CC] text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                        <i data-lucide="shield" class="w-4 h-4"></i>
                        <span>Divisi Game</span>
                    </a>

                    <a href="{{ route('posisi.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('posisi.*') ? 'bg-[#0052CC] text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:bg-slate-800/60 hover:text-white' }}">
                        <i data-lucide="swords" class="w-4 h-4"></i>
                        <span>Role & Position</span>
                    </a>
                </nav>
            </div>

            <!-- User Profile & Logout Section -->
            <div class="p-4 border-t border-slate-800/80 bg-[#030b18]/60">
                <div class="flex items-center gap-3 mb-3 p-2.5 rounded-xl bg-slate-900/80 border border-slate-800">
                    <img src="https://ui-avatars.com/api/?background=0052CC&color=ffffff&bold=true&name={{ urlencode(Auth::user()->name) }}" class="w-8 h-8 rounded-lg shadow-sm border border-cyan-400/40" alt="{{ Auth::user()->name }}">
                    <div class="flex flex-col truncate">
                        <span class="font-bold text-white text-xs truncate">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-cyan-400 font-semibold uppercase tracking-wider">
                            {{ Auth::user()->roles->pluck('name')->first() ?? 'User' }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="w-full py-2 px-3 bg-rose-950/30 hover:bg-rose-600 text-rose-300 hover:text-white border border-rose-900/40 rounded-xl text-xs font-semibold transition-all flex items-center justify-center gap-2">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Keluar Akun</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#F5F5F7]">
            <!-- Apple Glassmorphism Header Bar -->
            <header class="h-16 sticky top-0 z-30 backdrop-blur-md bg-white/80 border-b border-slate-200/50 px-6 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-slate-600 hover:text-slate-900 md:hidden">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#0052CC] animate-pulse"></span>
                        <h2 class="font-bold text-[#1D1D1F] text-sm tracking-tight">EVOS Esports Operational Payroll</h2>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-[#F2F2F7] text-[#0052CC] text-xs font-bold rounded-full flex items-center gap-1.5 border border-blue-100">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-[#0052CC]"></i>
                        <span>EVOS HQ Verified</span>
                    </span>
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="flex-1 p-6 md:p-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>

            <!-- Apple Clean Footer -->
            <footer class="bg-white/60 border-t border-slate-200/50 py-4 px-6 text-center text-xs font-medium text-[#86868B]">
                &copy; {{ date('Y') }} <strong>EVOS Esports Enterprise</strong> &bull; Apple Clean Payroll System.
            </footer>
        </div>
    </div>
    @else
    @yield('content')
    @endauth

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>

    @stack('scripts')
</body>

</html>