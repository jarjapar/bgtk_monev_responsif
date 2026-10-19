@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Riwayat Pengisian BK
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Daftar hasil pengisian instrumen Bimbingan dan Konseling.
            </p>
        </div>

        <a
            href="{{ route('bk.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
        >
            + Isi Instrumen BK
        </a>

    </div>
    {{-- =========================================================
         NOTIFIKASI
    ========================================================== --}}
    @if (session('success'))

        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                    ✓
                </div>

                <p class="text-sm font-semibold text-emerald-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- =========================================================
         RINGKASAN
    ========================================================== --}}
    @php
        $totalPengisian = $submissions->total();

        $selesai = $submissions->where('status', 'Selesai')->count();

        $rataRata = $submissions->count() > 0
            ? round(
                $submissions->avg('skor_persentase'),
                2
            )
            : 0;
    @endphp


    <div class="grid gap-5 md:grid-cols-3">

        {{-- TOTAL --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Pengisian
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $totalPengisian }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                    BK
                </div>

            </div>

        </div>


        {{-- SELESAI --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Selesai
                    </p>

                    <p class="mt-2 text-3xl font-bold text-emerald-600">
                        {{ $selesai }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                    ✓
                </div>

            </div>

        </div>


        {{-- RATA-RATA --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Rata-rata Capaian
                    </p>

                    <p class="mt-2 text-3xl font-bold text-violet-600">
                        {{ number_format($rataRata, 2, ',', '.') }}%
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-100 text-violet-600">
                    %
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         TABEL RIWAYAT
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">

            <h2 class="font-bold text-slate-800">
                Riwayat Pengisian
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Data hasil pengisian instrumen BK.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px] border-collapse">

                <thead>

                    <tr class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wide text-slate-500">

                        <th class="border-b border-slate-200 px-5 py-4">
                            No
                        </th>

                        <th class="border-b border-slate-200 px-5 py-4">
                            Responden
                        </th>

                        <th class="border-b border-slate-200 px-5 py-4">
                            Petugas Monev
                        </th>

                        <th class="border-b border-slate-200 px-5 py-4">
                            Tanggal
                        </th>

                        <th class="border-b border-slate-200 px-5 py-4 text-center">
                            Ya
                        </th>

                        <th class="border-b border-slate-200 px-5 py-4 text-center">
                            Tidak
                        </th>

                        <th class="border-b border-slate-200 px-5 py-4 text-center">
                            Capaian
                        </th>

                        <th class="border-b border-slate-200 px-5 py-4 text-center">
                            Kategori
                        </th>

                        <th class="border-b border-slate-200 px-5 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($submissions as $index => $submission)

                        <tr class="transition hover:bg-slate-50">

                            {{-- NO --}}
                            <td class="border-b border-slate-100 px-5 py-4 text-sm text-slate-500">

                                {{ $submissions->firstItem() + $index }}

                            </td>


                            {{-- RESPONDEN --}}
                            <td class="border-b border-slate-100 px-5 py-4">

                                <div class="font-semibold text-slate-700">
                                    {{ $submission->nama_responden }}
                                </div>

                                @if ($submission->instansi_responden)

                                    <div class="mt-1 text-xs text-slate-400">
                                        {{ $submission->instansi_responden }}
                                    </div>

                                @endif

                            </td>


                            {{-- PETUGAS --}}
                            <td class="border-b border-slate-100 px-5 py-4">

                                <div class="text-sm text-slate-700">
                                    {{ $submission->nama_petugas_monev }}
                                </div>

                                @if ($submission->instansi_petugas)

                                    <div class="mt-1 text-xs text-slate-400">
                                        {{ $submission->instansi_petugas }}
                                    </div>

                                @endif

                            </td>


                            {{-- TANGGAL --}}
                            <td class="border-b border-slate-100 px-5 py-4 text-sm text-slate-600">

                                {{ $submission->tanggal_pelaksanaan
                                    ? $submission->tanggal_pelaksanaan->format('d/m/Y')
                                    : '-' }}

                            </td>


                            {{-- YA --}}
                            <td class="border-b border-slate-100 px-5 py-4 text-center">

                                <span class="font-semibold text-emerald-600">
                                    {{ $submission->jumlah_ya }}
                                </span>

                            </td>


                            {{-- TIDAK --}}
                            <td class="border-b border-slate-100 px-5 py-4 text-center">

                                <span class="font-semibold text-red-500">
                                    {{ $submission->jumlah_tidak }}
                                </span>

                            </td>


                            {{-- CAPAIAN --}}
                            <td class="border-b border-slate-100 px-5 py-4 text-center">

                                <span class="font-bold text-slate-700">
                                    {{ number_format(
                                        $submission->skor_persentase,
                                        2,
                                        ',',
                                        '.'
                                    ) }}%
                                </span>

                            </td>


                            {{-- KATEGORI --}}
                            <td class="border-b border-slate-100 px-5 py-4 text-center">

                                @if ($submission->kategori === 'Baik / Kategori Tinggi')

                                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Baik / Tinggi
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Kurang / Rendah
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="border-b border-slate-100 px-5 py-4 text-center">

                                <a
                                    href="{{ route('bk.show', $submission) }}"
                                    class="inline-flex items-center rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100"
                                >
                                    Lihat Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="9"
                                class="px-6 py-14 text-center"
                            >

                                <div class="mx-auto max-w-md">

                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                        BK
                                    </div>

                                    <h3 class="mt-4 font-bold text-slate-700">
                                        Belum ada pengisian BK
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Belum terdapat data hasil pengisian instrumen BK.
                                    </p>

                                    <a
                                        href="{{ route('bk.create') }}"
                                        class="mt-5 inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                                    >
                                        Isi Instrumen BK
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}
        @if ($submissions->hasPages())

            <div class="border-t border-slate-200 px-6 py-4">

                {{ $submissions->links() }}

            </div>

        @endif

    </div>

</div>

@endsection