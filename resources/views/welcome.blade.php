<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Anti-FOUC Theme Script -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <title>EVOS Esports &mdash; Roster & Payroll Operations System</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        apple: {
                            bg: '#F5F5F7',
                            darkBg: '#0A0E17',
                            card: '#FFFFFF',
                            darkCard: '#151D2A',
                            input: '#F2F2F7',
                            darkInput: '#1C2536',
                            text: '#1D1D1F',
                            darkText: '#F5F5F7',
                            muted: '#86868B',
                        },
                        evos: {
                            blue: '#0052CC',
                            bright: '#0066FF',
                            cyan: '#00D2FF',
                            navy: '#051329',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="h-full antialiased bg-[#F5F5F7] dark:bg-[#0A0E17] text-[#1D1D1F] dark:text-[#F5F5F7] font-sans selection:bg-[#0052CC] selection:text-white transition-colors duration-300">

    <!-- Soft Ambient Glow Effects -->
    <div class="fixed top-0 left-1/3 w-[600px] h-[600px] bg-blue-500/10 dark:bg-blue-500/20 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="fixed bottom-0 right-1/3 w-[600px] h-[600px] bg-cyan-500/10 dark:bg-cyan-500/20 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="min-h-screen flex flex-col justify-between relative z-10">
        <!-- Apple Glassmorphism Header -->
        <header class="max-w-7xl w-full mx-auto px-6 py-5 flex items-center justify-between sticky top-0 backdrop-blur-md bg-white/70 dark:bg-[#151D2A]/70 border-b border-slate-200/40 dark:border-slate-800/80 rounded-b-2xl transition-colors duration-300">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/evos-logo.png') }}" class="w-10 h-10 object-contain drop-shadow-md" alt="EVOS Logo">
                <div class="flex items-center gap-2">
                    <span class="font-extrabold text-xl tracking-tight text-[#1D1D1F] dark:text-white">EVOS</span>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#0052CC] dark:text-[#00D2FF] px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800/40">ESPORT PAYROLL</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <!-- Apple Dark Mode Toggle Button -->
                <button id="theme-toggle" type="button" class="p-2 rounded-xl bg-[#F2F2F7] dark:bg-[#1C2536] text-slate-700 dark:text-slate-200 hover:text-[#0052CC] dark:hover:text-[#00D2FF] transition-all flex items-center gap-1.5 text-xs font-bold border border-slate-200/60 dark:border-slate-700 shadow-sm" title="Beralih Mode Gelap/Terang">
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:inline text-amber-400"></i>
                    <i data-lucide="moon" class="w-4 h-4 inline dark:hidden text-slate-600"></i>
                    <span class="hidden sm:inline"><span class="dark:hidden">Light</span><span class="hidden dark:inline">Dark</span></span>
                </button>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="px-6 py-2.5 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-xl text-xs shadow-md shadow-blue-600/20 transition-all flex items-center gap-2">
                            <span>Buka Dashboard</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-xl text-xs shadow-md shadow-blue-600/20 transition-all flex items-center gap-2">
                            <i data-lucide="log-in" class="w-4 h-4"></i>
                            <span>Masuk Akun</span>
                        </a>
                    @endauth
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <main class="max-w-4xl w-full mx-auto px-6 py-12 text-center space-y-6 my-auto">
            <!-- Official EVOS Esports Logo Badge Emblem -->
            <div class="flex justify-center mb-2">
                <div class="p-3 hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/evos-logo.png') }}" class="w-28 h-28 sm:w-36 sm:h-36 object-contain drop-shadow-2xl" alt="EVOS Esports Crest Logo">
                </div>
            </div>

            <!-- EVOS Release Pill -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white dark:bg-[#151D2A] border border-slate-200/80 dark:border-slate-800 text-xs font-semibold text-[#0052CC] dark:text-[#00D2FF] shadow-sm">
                <span class="w-2 h-2 rounded-full bg-[#0052CC] dark:bg-[#00D2FF] animate-pulse"></span>
                <span>EVOS Esports HQ &bull; Apple Clean Payroll Operations v2.0</span>
            </div>

            <!-- Apple Clean Title -->
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-[#1D1D1F] dark:text-white tracking-tight leading-tight space-y-2 max-w-3xl mx-auto">
                <span class="block">Sistem Informasi</span>
                <span class="block">Penggajian EVOS</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#0052CC] to-[#00D2FF] pt-1">
                    <span class="block">One Team, One Voice,</span>
                    <span class="block">One Family</span>
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="text-[#86868B] dark:text-[#94A3B8] text-sm sm:text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-normal">
                Kelola data Roster (MLBB, PUBGM, Valorant, Content Creator), kalkulasi komponen penggajian bulanan (Gaji Pokok, Tunjangan, Insentif, Lembur), serta alur persetujuan Supervisor secara otomatis.
            </p>

            <!-- Action Button -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                @auth
                <a href="{{ url('/home') }}" class="w-full sm:w-auto px-8 py-3.5 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-2xl shadow-lg shadow-blue-600/25 transition-all text-sm flex items-center justify-center gap-2 group">
                    <span>Akses Dashboard Roster</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
                @else
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3.5 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-2xl shadow-lg shadow-blue-600/25 transition-all text-sm flex items-center justify-center gap-2 group">
                    <span>Mulai Akses Dashboard</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
                @endauth
            </div>

            <!-- Features Cards Grid (Apple Pure White / Dark Floating Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left pt-10">
                <div class="bg-white dark:bg-[#151D2A] p-6 rounded-2xl border border-slate-200/60 dark:border-slate-800/80 hover:shadow-lg transition-all space-y-3 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-[#0052CC] dark:text-[#00D2FF] flex items-center justify-center">
                        <i data-lucide="gamepad-2" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-[#1D1D1F] dark:text-[#F5F5F7] text-base">Roster Player & Staff</h3>
                    <p class="text-[#86868B] dark:text-[#94A3B8] text-xs leading-relaxed">
                        Pendataan lengkap player, coach, analyst, dan manager per Divisi Game (MLBB, PUBGM, Valorant, Content Creator).
                    </p>
                </div>

                <div class="bg-white dark:bg-[#151D2A] p-6 rounded-2xl border border-slate-200/60 dark:border-slate-800/80 hover:shadow-lg transition-all space-y-3 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-[#0052CC] dark:text-[#00D2FF] flex items-center justify-center">
                        <i data-lucide="calculator" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-[#1D1D1F] dark:text-[#F5F5F7] text-base">Kalkulasi Otomatis</h3>
                    <p class="text-[#86868B] dark:text-[#94A3B8] text-xs leading-relaxed">
                        Hitung Gaji Pokok, Tunjangan, Insentif masa kerja, lembur, dan potongan BPJS secara presisi via AJAX.
                    </p>
                </div>

                <div class="bg-white dark:bg-[#151D2A] p-6 rounded-2xl border border-slate-200/60 dark:border-slate-800/80 hover:shadow-lg transition-all space-y-3 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-[#0052CC] dark:text-[#00D2FF] flex items-center justify-center">
                        <i data-lucide="trophy" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-[#1D1D1F] dark:text-[#F5F5F7] text-base">Cetak Slip Gaji PDF</h3>
                    <p class="text-[#86868B] dark:text-[#94A3B8] text-xs leading-relaxed">
                        Ekspor slip penggajian resmi bertema EVOS Esports Blue langsung dalam format PDF siap cetak.
                    </p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="max-w-7xl w-full mx-auto px-6 py-6 text-center text-xs text-[#86868B] dark:text-[#94A3B8]">
            &copy; {{ date('Y') }} <strong>EVOS Esports Enterprise</strong> &mdash; Apple Clean Payroll System.
        </footer>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            const themeToggleBtn = document.getElementById('theme-toggle');
            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function() {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.theme = 'light';
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.theme = 'dark';
                    }
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                });
            }
        });
    </script>
</body>

</html>