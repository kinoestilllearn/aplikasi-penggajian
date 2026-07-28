<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PayFlow Enterprise &mdash; Modern Payroll & HR Operations</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="h-full antialiased bg-slate-950 text-slate-100 font-sans selection:bg-indigo-500 selection:text-white">

    <!-- Ambient Glow Effects -->
    <div class="fixed top-0 left-1/4 w-[500px] h-[500px] bg-indigo-600/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-0 right-1/4 w-[500px] h-[500px] bg-emerald-500/15 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="min-h-screen flex flex-col justify-between relative z-10">
        <!-- Navigation Header -->
        <header class="max-w-7xl w-full mx-auto px-6 py-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-indigo-600 flex items-center justify-center text-white font-extrabold text-xl shadow-lg">
                    P
                </div>
                <span class="font-bold text-xl tracking-tight text-white">PayFlow <span class="text-xs text-indigo-400 font-medium uppercase px-2 py-0.5 rounded bg-indigo-950 border border-indigo-800">Enterprise</span></span>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl text-xs shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-2">
                            <span>Buka Dashboard</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl text-xs shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-2">
                            <i data-lucide="log-in" class="w-4 h-4"></i>
                            <span>Masuk Akun</span>
                        </a>
                    @endauth
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <main class="max-w-5xl w-full mx-auto px-6 py-12 text-center space-y-8 my-auto">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-xs font-semibold text-emerald-400">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                PT Mau Maju Payroll Operations &mdash; Release v2.0
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-tight">
                Sistem Penggajian & Operations HR <br class="hidden sm:inline" />
                <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-indigo-400 bg-clip-text text-transparent">Cepat, Akurat, & Enterprise Grade</span>
            </h1>

            <p class="text-slate-400 text-base md:text-lg max-w-3xl mx-auto leading-relaxed">
                Kelola data karyawan, perhitungan komponen gaji (Gaji Pokok, Tunjangan, Insentif, Upah Lembur), potongan NWNP/BPJS, serta alur persetujuan Supervisor secara otomatis.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-indigo-600 to-emerald-600 hover:from-indigo-500 hover:to-emerald-500 text-white font-bold rounded-2xl shadow-xl shadow-indigo-600/25 transition-all text-sm flex items-center justify-center gap-2 group">
                    <span>Mulai Akses Aplikasi</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Features Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left pt-12">
                <div class="bg-slate-900/80 p-6 rounded-2xl border border-slate-800 hover:border-slate-700 transition-colors space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center">
                        <i data-lucide="calculator" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-white text-base">Kalkulasi Otomatis</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">
                        Hitung gaji pokok, tunjangan tetap, insentif, lembur, dan potongan BPJS/NWNP secara langsung menggunakan sistem Ajax cepat.
                    </p>
                </div>

                <div class="bg-slate-900/80 p-6 rounded-2xl border border-slate-800 hover:border-slate-700 transition-colors space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-white text-base">Approval Supervisor</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">
                        Fitur persetujuan bertingkat untuk Supervisor Payroll dengan status Draf, Disetujui, dan Dibatalkan secara transparan.
                    </p>
                </div>

                <div class="bg-slate-900/80 p-6 rounded-2xl border border-slate-800 hover:border-slate-700 transition-colors space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-white text-base">Cetak Slip Gaji PDF</h3>
                    <p class="text-slate-400 text-xs leading-relaxed">
                        Ekspor dokumen resmi slip penggajian karyawan langsung dalam format PDF siap cetak.
                    </p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="max-w-7xl w-full mx-auto px-6 py-6 border-t border-slate-900 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} PT Mau Maju. PayFlow Enterprise Payroll System.
        </footer>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>

</html>