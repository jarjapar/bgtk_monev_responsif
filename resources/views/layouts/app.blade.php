<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Monev BGTK NTB')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- h-full + overflow-hidden: halaman dikunci, hanya <main> yang scroll --}}

    <body class="overflow-hidden bg-slate-100 text-slate-800 antialiased">

        @php
            $menu = fn(bool $active) => $active
                ? 'bg-blue-600 text-white'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white';

            /*
            |----------------------------------------------------------------------
            | IKON MENU (Heroicons outline, SVG inline)
            |----------------------------------------------------------------------
            | Ukuran diberikan lewat atribut width/height + style agar tetap
            | tampil benar walau CSS Tailwind belum di-build ulang.
            */
            $icons = [
                'dashboard' => 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z',

                'instrumen' => 'M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75',

                'wawancara' => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155',

                'tindak' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z',

                'sekolah' => 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5',

                'manajemen' => 'M16.5 7.5a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM3.75 21a8.25 8.25 0 0116.5 0M19.5 8.25a3 3 0 010 6M21.75 21a6 6 0 00-3.75-5.25',

                'panduan' => 'M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z',

                'profil' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z',

                'keluar' => 'M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9',
            ];

            $icon = fn(string $key) => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" '
                . 'style="width:20px;height:20px;flex-shrink:0;" fill="none" viewBox="0 0 24 24" '
                . 'stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
                . '<path d="' . $icons[$key] . '"/></svg>';
        @endphp

        {{-- style tinggi dipakai agar pasti jalan walau CSS belum di-build ulang --}}
        <div class="flex w-full" style="height: 100vh; height: 100dvh;">

            {{-- =========================================================
            SIDEBAR (tetap)
            ========================================================== --}}
            <aside class="flex w-64 flex-shrink-0 flex-col bg-slate-900 text-white">

                {{-- Brand --}}
                <div class="flex h-20 flex-shrink-0 items-center border-b border-slate-800 px-6">
                    <!-- <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-lg font-bold text-white shadow-lg">
                        M
                    </div> -->
                    <div class="ml-3">
                        <h1 class="text-lg font-bold leading-tight">MANDALIKA</h1>
                        <p class="text-xs text-slate-400">Monitoring-Analisis-Evaluasi BGTK Akurat</p>
                    </div>
                </div>

                {{-- Navigasi (scroll sendiri bila layar pendek) --}}
                <nav class="flex-1 space-y-6 overflow-y-auto p-4" style="min-height: 0;">

                    <div>
                        <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Utama</p>

                        <a href="{{ url('/dashboard') }}"
                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ $menu(request()->is('/') || request()->is('dashboard') || request()->is('dashboard/*')) }}">
                            {!! $icon('dashboard') !!}
                            <span class="text-sm font-medium">Dashboard</span>
                        </a>
                    </div>
                    <div>
                        <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Monitoring &
                            Evaluasi</p>

                        <div class="space-y-1">
                            <a href="{{ url('/instrumen') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ $menu(request()->is('instrumen*')) }}">
                                {!! $icon('instrumen') !!}
                                <span class="text-sm">Instrumen Pemantauan</span>
                            </a>

                            <a href="{{ url('/wawancara') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ $menu(request()->is('wawancara*')) }}">
                                {!! $icon('wawancara') !!}
                                <span class="text-sm">Lembar Wawancara</span>
                            </a>

                            <a href="{{ url('/tindak-lanjut') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ $menu(request()->is('tindak-lanjut*')) }}">
                                {!! $icon('tindak') !!}
                                <span class="text-sm">Rencana Tindak Lanjut</span>
                            </a>

                            <a href="{{ url('/sekolah') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ $menu(request()->is('sekolah*')) }}">
                                {!! $icon('sekolah') !!}
                                <span class="text-sm">Data Sekolah</span>
                            </a>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @if (auth()->user()->isAdmin())
                            <div>
                                <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Administrator
                                </p>
                                <a href="{{ route('manajemen-akun.index') }}"
                                    class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ $menu(request()->is('manajemen-akun*')) }}">
                                    {!! $icon('manajemen') !!}
                                    <span class="text-sm">Manajemen Akun</span>
                                </a>
                            </div>
                        @endif

                        <div>
                            <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Bantuan
                            </p>

                            <a href="{{ url('/panduan') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ $menu(request()->is('panduan*')) }}">
                                {!! $icon('panduan') !!}
                                <span class="text-sm">Panduan Pengisian</span>
                            </a>
                        </div>

                        <div>
                            <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Akun</p>

                            <a href="{{ url('/profil') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ $menu(request()->is('profil*')) }}">
                                {!! $icon('profil') !!}
                                <span class="text-sm">Profil Saya</span>
                            </a>

                            <form action="{{ route('logout') }}" method="POST" class="mt-1">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-slate-300 transition hover:bg-red-600 hover:text-white">
                                    {!! $icon('keluar') !!}
                                    <span class="text-sm">Keluar</span>
                                </button>
                            </form>
                        </div>

                    </div>
                </nav>

                {{-- Footer sidebar --}}
                <div class="flex-shrink-0 border-t border-slate-800 p-4">
                    <p class="text-xs text-slate-500">Sistem Monitoring & Evaluasi</p>
                    <p class="mt-1 text-xs text-slate-600">BGTK Provinsi NTB</p>
                </div>

            </aside>


            {{-- =========================================================
            KOLOM KANAN: header tetap + konten scroll
            ========================================================== --}}
            <div class="flex min-w-0 flex-1 flex-col">

                {{-- HEADER (tetap) --}}
                <header
                    class="relative z-10 flex h-20 flex-shrink-0 items-center justify-between border-b border-slate-200 bg-white px-8 shadow-sm">

                    <div>
                        <h2 class="text-xl font-bold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="mt-0.5 text-sm text-slate-500">Sistem Monitoring dan Evaluasi BGTK Provinsi NTB</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-slate-700">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ auth()->user()->isAdmin() ? 'Administrator' : 'Petugas Monev' }}
                            </p>
                        </div>

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 font-bold text-white ring-4 ring-blue-100">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>

                </header>

                {{-- KONTEN (satu-satunya area yang scroll) --}}
                <main class="flex-1 overflow-y-auto" style="min-height: 0;">
                    <section class="mx-auto w-full max-w-7xl p-8">
                        @yield('content')
                    </section>
                </main>

            </div>

        </div>

    </body>

</html>