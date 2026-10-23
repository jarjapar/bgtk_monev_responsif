@extends('layouts.app')

@section('title', 'Instrumen Pemantauan')

@section('page-title', 'Instrumen Pemantauan')

@section('content')

    <div class="mx-auto max-w-7xl space-y-6">

        {{-- =========================================================
        HEADER
        ========================================================== --}}
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-800">
                Instrumen Pemantauan
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Pilih instrumen monitoring dan evaluasi yang akan digunakan.
            </p>
        </div>


        {{-- =========================================================
        3 JENIS INSTRUMEN
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

            {{-- BCKS --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="h-1.5 bg-blue-600"></div>

                <div class="p-5">

                    <span
                        class="inline-flex rounded-full border border-blue-100 bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700">
                        Instrumen 01
                    </span>

                    <h3 class="mt-4 text-lg font-bold text-slate-800">
                        Instrumen BCKS
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-slate-500">
                        Instrumen monitoring dan evaluasi BCKS.
                    </p>

                    <div class="mt-6 grid grid-cols-2 gap-2">

                        <a href="{{ route('bcks.create') }}"
                            class="flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                            <span>+</span>
                            Isi Instrumen
                        </a>

                        <button type="button"
                            class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700">
                            Cetak Blanko
                        </button>

                    </div>

                </div>

            </div>


            {{-- BK --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="h-1.5 bg-violet-600"></div>

                <div class="p-5">

                    <span
                        class="inline-flex rounded-full border border-violet-100 bg-violet-50 px-3 py-1 text-xs font-medium text-violet-700">
                        Instrumen 02
                    </span>

                    <h3 class="mt-4 text-lg font-bold text-slate-800">
                        Instrumen BK
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-slate-500">
                        Instrumen monitoring dan evaluasi BK.
                    </p>

                    <div class="mt-6 grid grid-cols-2 gap-2">

                        <a href="{{ route('bk.create') }}"
                            class="flex items-center justify-center gap-2 rounded-xl bg-violet-600 px-4 py-3 text-sm font-semibold text-white hover:bg-violet-700">
                            <span>+</span>
                            Isi Instrumen
                        </a>

                        <button type="button"
                            class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700">
                            Cetak Blanko
                        </button>

                    </div>

                </div>

            </div>


            {{-- TENDIK --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="h-1.5 bg-emerald-600"></div>

                <div class="p-5">

                    <span
                        class="inline-flex rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700">
                        Instrumen 03
                    </span>

                    <h3 class="mt-4 text-lg font-bold text-slate-800">
                        Instrumen TENDIK
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-slate-500">
                        Instrumen monitoring dan evaluasi TENDIK.
                    </p>

                    <div class="mt-6 grid grid-cols-2 gap-2">

                        <a href="{{ route('tendik.create') }}"
                            class="flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white hover:bg-emerald-700">
                            <span>+</span>
                            Isi Instrumen
                        </a>

                        <button type="button"
                            class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700">
                            Cetak Blanko
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
        {{-- MATEMATIKA GEMBIRA --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="h-1.5 bg-amber-500"></div>

            <div class="p-5">
                <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium"
                    style="background: #fffbeb; border: 1px solid #fde68a; color: #b45309;">
                    Instrumen 04
                </span>

                <h3 class="mt-4 text-lg font-bold text-slate-800">
                    Matematika GEMBIRA
                </h3>

                <p class="mt-1 text-sm leading-6 text-slate-500">
                    Instrumen monitoring dan evaluasi program Matematika GEMBIRA.
                </p>

                <div class="mt-6 grid grid-cols-2 gap-2">
                    <a href="{{ route('gembira.create') }}"
                        class="flex items-center justify-center gap-2 rounded-xl bg-amber-500 px-3 py-3 text-sm font-semibold text-white hover:bg-amber-600">
                        + Isi Instrumen
                    </a>

                    <a href="{{ route('gembira.create') }}"
                        class="flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                        Cetak Blanko
                    </a>
                </div>
            </div>
        </div>
        {{-- PKGSD-MBI --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="h-1.5" style="background: #0891b2;"></div>

            <div class="p-5">
                <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium"
                    style="background: #ecfeff; border: 1px solid #a5f3fc; color: #0e7490;">
                    Instrumen 05
                </span>

                <h3 class="mt-4 text-lg font-bold text-slate-800">
                    PKGSD-MBI
                </h3>

                <p class="mt-1 text-sm leading-6 text-slate-500">
                    Instrumen monitoring dan evaluasi PKGSD-MBI.
                </p>

                <div class="mt-6 grid grid-cols-2 gap-2">
                    <a href="{{ route('pkgsd-mbi.create') }}"
                        class="flex items-center justify-center gap-2 rounded-xl px-3 py-3 text-sm font-semibold text-white"
                        style="background-color: #0891b2;" onmouseover="this.style.backgroundColor='#0e7490'"
                        onmouseout="this.style.backgroundColor='#0891b2'">
                        + Isi Instrumen
                    </a>

                    <a href="{{ route('pkgsd-mbi.create') }}"
                        class="flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                        Cetak Blanko
                    </a>
                </div>
            </div>
        </div>

        </div>

        {{-- =========================================================
        FILTER
        ========================================================== --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <form action="{{ route('instrumen.index') }}" method="GET">
                <div class="grid grid-cols-1 items-end gap-4 md:grid-cols-2 xl:grid-cols-4">

                    <div>
                        <label for="jenis_instrumen" class="mb-2 block text-sm font-medium text-slate-700">
                            Jenis Instrumen
                        </label>
                        <select id="jenis_instrumen" name="jenis_instrumen"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            style="height: 44px">
                            <option value="">Semua jenis</option>
                            <option value="BCKS" @selected(request('jenis_instrumen') === 'BCKS')>BCKS</option>
                            <option value="BK" @selected(request('jenis_instrumen') === 'BK')>BK</option>
                            <option value="TENDIK" @selected(request('jenis_instrumen') === 'TENDIK')>TENDIK</option>
                            <option value="GEMBIRA" @selected(request('jenis_instrumen') === 'GEMBIRA')>
                                Matematika GEMBIRA
                            </option>
                            <option value="PKGSD MBI" @selected(request('jenis_instrumen') === 'PKGSD MBI')>
                                PKGSD MBI
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-sm font-medium text-slate-700">
                            Status
                        </label>
                        <select id="status" name="status"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            style="height: 44px">
                            <option value="">Semua status</option>
                            <option value="Draft" @selected(request('status') === 'Draft')>Draft</option>
                            <option value="Dalam Proses" @selected(request('status') === 'Dalam Proses')>Dalam Proses</option>
                            <option value="Final" @selected(request('status') === 'Final')>Final</option>
                        </select>
                    </div>

                    <div>
                        <label for="search" class="mb-2 block text-sm font-medium text-slate-700">
                            Pencarian
                        </label>
                        <input id="search" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nama BCKS, BK, responden, atau unit kerja"
                            class="w-full rounded-xl border border-slate-200 px-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            style="height: 44px">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="inline-flex flex-1 items-center justify-center rounded-xl px-5 text-sm font-semibold text-white transition hover:opacity-90"
                            style="height: 44px; background: #1457f5">
                            Cari
                        </button>
                        <a href="{{ route('instrumen.index') }}"
                            class="inline-flex flex-1 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-600 transition hover:bg-slate-50"
                            style="height: 44px">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>


        {{-- =========================================================
        RIWAYAT PENGISIAN
        ========================================================== --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <h3 class="text-lg font-bold text-slate-800">
                    Riwayat Pengisian
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Daftar pengisian instrumen monitoring dan evaluasi yang telah dilakukan.
                </p>

            </div>


            <div class="w-full min-w-0 overflow-x-auto">

                <table class="w-full min-w-[1000px] table-auto text-left">

                    <thead class="bg-slate-50">

                        <tr class="border-b border-slate-200">

                            {{-- INSTRUMEN --}}
                            <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase text-slate-500">
                                Instrumen
                            </th>

                            {{-- RESPONDEN --}}
                            <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase text-slate-500">
                                Responden
                            </th>

                            {{-- TANGGAL --}}
                            <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase text-slate-500">
                                Tanggal Evaluasi
                            </th>

                            {{-- NILAI --}}
                            <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase text-slate-500">
                                Nilai
                            </th>

                            {{-- PREDIKAT --}}
                            <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase text-slate-500">
                                Predikat
                            </th>

                            {{-- STATUS --}}
                            <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase text-slate-500">
                                Status
                            </th>

                            {{-- AKSI --}}
                            <th class="whitespace-nowrap px-5 py-4 text-center text-xs font-bold uppercase text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($riwayatPengisian as $riwayat)

                            @php
                                // Satu gaya untuk semua jenis instrumen; hanya warna yang berbeda.
                                $paletInstrumen = [
                                    'BCKS' => ['bg' => '#eff6ff', 'border' => '#bfdbfe', 'text' => '#1d4ed8'],
                                    'BK' => ['bg' => '#f5f3ff', 'border' => '#ddd6fe', 'text' => '#6d28d9'],
                                    'TENDIK' => ['bg' => '#ecfdf5', 'border' => '#a7f3d0', 'text' => '#047857'],
                                    'GEMBIRA' => ['bg' => '#fffbeb', 'border' => '#fde68a', 'text' => '#b45309'],
                                    'PKGSD MBI' => ['bg' => '#ecfeff', 'border' => '#a5f3fc', 'text' => '#0e7490'],
                                ];

                                $warna = $paletInstrumen[strtoupper(trim($riwayat['jenis']))]
                                    ?? ['bg' => '#f8fafc', 'border' => '#e2e8f0', 'text' => '#475569'];

                                $gayaInstrumen = "background: {$warna['bg']}; border: 1px solid {$warna['border']}; color: {$warna['text']};";
                            @endphp

                                            <tr class="cursor-pointer transition hover:bg-blue-50"
                                                onclick="window.location='{{ $riwayat['show_route'] }}'"
                                                title="Klik untuk melihat hasil penilaian">

                                                {{-- =================================================
                                                INSTRUMEN
                                                ================================================== --}}
                                                <td class="min-w-[280px] px-5 py-4 align-middle">
                                    <div class="flex min-w-0 items-start gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                                            style="{{ $gayaInstrumen }}">
                                            📋
                                        </div>

                                        <div class="min-w-0 space-y-1">
                                            <p class="text-sm font-bold leading-5 text-slate-800">
                                                {{ $riwayat['jenis'] }}
                                            </p>
                                            <span class="inline-flex max-w-full items-center whitespace-normal break-words rounded-full px-2.5 py-1 text-xs font-medium leading-4"
                                                style="{{ $gayaInstrumen }}">
                                                {{ $riwayat['instrumen'] }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                {{-- =================================================
                                RESPONDEN
                                ================================================== --}}
                                <td class="min-w-[200px] px-6 py-5">

                                    <p class="text-sm font-medium text-slate-700">
                                        {{ $riwayat['responden'] ?: '-' }}
                                    </p>

                                    @if ($riwayat['status_responden'])

                                        <p class="mt-1 text-xs leading-5 text-slate-500">
                                            {{ $riwayat['status_responden'] }}
                                        </p>

                                    @endif

                                </td>


                                {{-- =================================================
                                TANGGAL
                                ================================================== --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    @if ($riwayat['tanggal'])

                                        <p class="text-sm font-medium text-slate-700">
                                            {{ $riwayat['tanggal']->format('d/m/Y') }}
                                        </p>

                                    @else

                                        <span class="text-sm text-slate-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                NILAI
                                ================================================== --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    <p class="text-base font-bold text-blue-600">
                                        {{ number_format($riwayat['nilai'], 2) }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $riwayat['skor'] }}/{{ $riwayat['skor_maksimal'] }}
                                    </p>

                                </td>


                                {{-- =================================================
                                PREDIKAT
                                ================================================== --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    @if ($riwayat['jenis'] === 'BCKS')

                                        @if ($riwayat['predikat'] === 'Sangat Baik')

                                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                                Sangat Baik
                                            </span>

                                        @elseif ($riwayat['predikat'] === 'Baik')

                                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1.5 text-xs font-semibold text-blue-700">
                                                Baik
                                            </span>

                                        @elseif ($riwayat['predikat'] === 'Cukup')

                                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                                Cukup
                                            </span>

                                        @elseif ($riwayat['predikat'] === 'Perlu Pembinaan')

                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700">
                                                Perlu Pembinaan
                                            </span>

                                        @else

                                            <span class="text-xs text-slate-400">
                                                -
                                            </span>

                                        @endif

                                    @else

                                        @if (str_contains($riwayat['predikat'] ?? '', 'Baik'))

                                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                                Baik / Tinggi
                                            </span>

                                        @else

                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700">
                                                Kurang / Rendah
                                            </span>

                                        @endif

                                    @endif

                                </td>


                                {{-- =================================================
                                STATUS
                                ================================================== --}}
                                <td class="whitespace-nowrap px-6 py-5">

                                    @if ($riwayat['status'] === 'Selesai')

                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                            Selesai

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                            {{ $riwayat['status'] }}

                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                AKSI
                                ================================================== --}}
                                <td class="whitespace-nowrap px-6 py-5" onclick="event.stopPropagation()">

                                    <div class="flex items-center justify-center gap-3">

                                        {{-- DETAIL --}}
                                        <a href="{{ $riwayat['show_route'] }}" title="Lihat Detail"
                                            class="text-slate-600 transition hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>

                                        {{-- EDIT --}}
                                        @if (!empty($riwayat['edit_route']))

                                            <a href="{{ $riwayat['edit_route'] }}" title="Edit"
                                                class="text-blue-400 transition hover:text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L9.37 18.02l-4.136 1.166 1.166-4.136 10.462-10.563Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m15.232 5.232 3.536 3.536" />
                                                </svg>
                                            </a>

                                        @else

                                            <span title="Route edit belum tersedia" class="cursor-not-allowed text-slate-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L9.37 18.02l-4.136 1.166 1.166-4.136 10.462-10.563Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m15.232 5.232 3.536 3.536" />
                                                </svg>
                                            </span>

                                        @endif

                                        {{-- HAPUS --}}
                                        @if (!empty($riwayat['delete_route']))

                                            <form action="{{ $riwayat['delete_route'] }}" method="POST" class="inline-flex"
                                                onsubmit="return confirm('Hapus data pengisian ini? Tindakan ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" title="Hapus data" aria-label="Hapus data"
                                                    class="text-red-500 transition hover:text-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M3 6h18" />
                                                        <path d="M8 6V4h8v2" />
                                                        <path d="m19 6-1 14H6L5 6" />
                                                        <path d="M10 11v5M14 11v5" />
                                                    </svg>
                                                </button>
                                            </form>

                                        @else

                                            <span title="Route hapus belum tersedia" class="cursor-not-allowed text-slate-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4h8v2" />
                                                    <path d="m19 6-1 14H6L5 6" />
                                                    <path d="M10 11v5M14 11v5" />
                                                </svg>
                                            </span>

                                        @endif

                                    </div>

                                </td>

                                </tr>


                        @empty

                <tr>

                    <td colspan="7" class="px-6 py-16 text-center">

                        <div class="flex flex-col items-center">

                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-2xl">
                                📋
                            </div>

                            <h3 class="mt-4 text-base font-bold text-slate-800">
                                Belum Ada Riwayat Pengisian
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Belum ada instrumen yang telah diisi.
                            </p>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

            </table>

        </div>


        {{-- =========================================================
        PAGINATION
        ========================================================== --}}
        @if ($riwayatPengisian->hasPages())

            <div class="border-t border-slate-200 px-6 py-4">

                {{ $riwayatPengisian->links() }}

            </div>

        @endif

    </div>

    </div>

@endsection