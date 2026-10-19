@extends('layouts.app')

@section('title', 'Riwayat Pengisian BCKS')

@section('page-title', 'Riwayat Pengisian BCKS')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Riwayat Pengisian BCKS
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Daftar hasil pengisian Instrumen Monitoring dan Evaluasi BCKS.
            </p>
        </div>
        <a
            href="{{ route('bcks.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            + Pengisian BCKS Baru
        </a>
    </div>


    {{-- FLASH MESSAGE --}}
    @if (session('success'))

        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- SUMMARY --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

        {{-- Total Pengisian --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Pengisian
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-800">
                        {{ $pengisians->count() }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl text-blue-600">
                    📋
                </div>

            </div>

        </div>


        {{-- Selesai --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Pengisian Selesai
                    </p>

                    <p class="mt-2 text-3xl font-bold text-emerald-600">
                        {{ $pengisians->where('status_pengisian', 'Selesai')->count() }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl text-emerald-600">
                    ✓
                </div>

            </div>

        </div>


        {{-- Rata-rata --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Rata-rata Nilai
                    </p>

                    <p class="mt-2 text-3xl font-bold text-blue-600">
                        {{ $pengisians->count() > 0 ? number_format($pengisians->avg('nilai_akhir'), 2) : '0,00' }}
                    </p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl text-blue-600">
                    %
                </div>

            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">

            <h2 class="text-lg font-bold text-slate-800">
                Data Pengisian
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Pilih data untuk melihat hasil penilaian secara lengkap.
            </p>

        </div>


        @if ($pengisians->count() > 0)

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1050px]">

                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">

                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                No
                            </th>

                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Nama BCKS
                            </th>

                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Unit Kerja
                            </th>

                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Responden
                            </th>

                            <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                Tanggal
                            </th>

                            <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                Total Skor
                            </th>

                            <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                Nilai
                            </th>

                            <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                Predikat
                            </th>

                            <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                Aksi 
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach ($pengisians as $pengisian)

                            <tr class="transition hover:bg-slate-50">

                                {{-- No --}}
                                <td class="px-5 py-4 text-sm font-medium text-slate-600">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- Nama BCKS --}}
                                <td class="px-5 py-4">

                                    <div class="font-semibold text-slate-800">
                                        {{ $pengisian->nama_bcks }}
                                    </div>

                                    @if ($pengisian->angkatan_pelatihan)
                                        <div class="mt-1 text-xs text-slate-500">
                                            {{ $pengisian->angkatan_pelatihan }}
                                        </div>
                                    @endif

                                </td>


                                {{-- Unit Kerja --}}
                                <td class="px-5 py-4 text-sm text-slate-600">
                                    {{ $pengisian->unit_kerja ?: '-' }}
                                </td>


                                {{-- Responden --}}
                                <td class="px-5 py-4">

                                    <div class="text-sm font-medium text-slate-700">
                                        {{ $pengisian->nama_responden }}
                                    </div>

                                    <div class="mt-1 text-xs text-slate-500">
                                        {{ $pengisian->status_responden }}
                                    </div>

                                </td>


                                {{-- Tanggal --}}
                                <td class="px-5 py-4 text-center text-sm text-slate-600">

                                    {{ $pengisian->tanggal_evaluasi?->format('d/m/Y') ?? '-' }}

                                </td>


                                {{-- Total Skor --}}
                                <td class="px-5 py-4 text-center">

                                    <span class="font-bold text-slate-800">
                                        {{ $pengisian->total_skor }}
                                    </span>

                                    <span class="text-xs text-slate-400">
                                        / 108
                                    </span>

                                </td>


                                {{-- Nilai --}}
                                <td class="px-5 py-4 text-center">

                                    <span class="font-bold text-blue-600">
                                        {{ number_format($pengisian->nilai_akhir, 2) }}
                                    </span>

                                </td>


                                {{-- Predikat --}}
                                <td class="px-5 py-4 text-center">

                                    @php
                                        $predikatClass = match ($pengisian->predikat) {
                                            'Sangat Baik' => 'bg-emerald-100 text-emerald-700',
                                            'Baik' => 'bg-blue-100 text-blue-700',
                                            'Cukup' => 'bg-amber-100 text-amber-700',
                                            'Perlu Pembinaan' => 'bg-red-100 text-red-700',
                                            default => 'bg-slate-100 text-slate-600',
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $predikatClass }}"
                                    >
                                        {{ $pengisian->predikat ?: '-' }}
                                    </span>

                                </td>


                                {{-- Aksi --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <a
                                            href="{{ route('bcks.show', $pengisian) }}"
                                            class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-50"
                                        >
                                            Lihat
                                        </a>

                                        <a
                                            href="{{ route('bcks.edit', $pengisian) }}"
                                            class="inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('bcks.destroy', $pengisian) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengisian BCKS ini?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100"
                                            >
                                                Hapus
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-2xl">
                    📋
                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-800">
                    Belum Ada Pengisian BCKS
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                    Belum terdapat data pengisian Instrumen Monev BCKS.
                    Silakan lakukan pengisian instrumen untuk menambahkan data.
                </p>

                <a
                    href="{{ route('bcks.create') }}"
                    class="mt-6 inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    + Mulai Pengisian BCKS
                </a>

            </div>

        @endif

    </div>

</div> -->

@endsection