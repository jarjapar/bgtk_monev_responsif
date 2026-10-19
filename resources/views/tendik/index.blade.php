@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6 px-4 py-6 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-blue-700">
                    Monitoring & Evaluasi
                </p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    Instrumen Monev Tenaga Kependidikan
                </h1>
                <p class="mt-2 text-sm text-slate-500">
                    Daftar pengisian evaluasi pelatihan tenaga kependidikan.
                </p>
            </div>
            <a href="{{ route('tendik.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                </svg>
                Tambah Pengisian
            </a>
        </div>

        {{-- NOTIFIKASI --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800">
                {{ session('info') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        {{-- STATISTIK --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">Total Pengisian</p>
                    <span class="rounded-lg bg-blue-50 p-2 text-blue-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                        </svg>
                    </span>
                </div>
                <p class="mt-3 text-3xl font-bold text-slate-900">
                    {{ number_format($total ?? 0, 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-slate-500">Data responden tersimpan</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">Rata-rata Skor</p>
                    <span class="rounded-lg bg-indigo-50 p-2 text-indigo-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 14l4-4 3 3 6-7" />
                        </svg>
                    </span>
                </div>
                <p class="mt-3 text-3xl font-bold text-slate-900">
                    {{ number_format($rataRata ?? 0, 2, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-slate-500">Skala penilaian 1–4</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">Predikat Sangat Baik</p>
                    <span class="rounded-lg bg-emerald-50 p-2 text-emerald-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m12 3 2.7 5.47 6.03.88-4.36 4.25 1.03 6.01L12 16.77l-5.4 2.84 1.03-6.01L3.27 9.35l6.03-.88L12 3Z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-3 text-3xl font-bold text-slate-900">
                    {{ number_format($sangatBaik ?? 0, 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-slate-500">Skor 3,26–4,00</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-slate-500">Predikat Perlu Perhatian</p>
                    <span class="rounded-lg bg-amber-50 p-2 text-amber-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.3 3.86 1.82 18.5A2 2 0 0 0 3.55 21h16.9a2 2 0 0 0 1.73-2.5L13.7 3.86a2 2 0 0 0-3.4 0Z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-3 text-3xl font-bold text-slate-900">
                    {{ number_format(($cukup ?? 0) + ($kurang ?? 0), 0, ',', '.') }}
                </p>
                <p class="mt-1 text-xs text-slate-500">Predikat Cukup dan Kurang</p>
            </div>

        </div>

        {{-- TABEL DATA TENDIK --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div
                class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">
                        Data Pengisian TENDIK
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Daftar responden dan hasil evaluasi yang telah disimpan.
                    </p>
                </div>

                <span
                    class="inline-flex w-fit items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                    Skala 1–4 · 43 pernyataan
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th
                                class="whitespace-nowrap px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                No.
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Responden
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Satuan Pendidikan
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Tanggal Pengisian
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                Skor
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                Predikat
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($tendiks as $index => $tendik)
                                        <tr class="transition hover:bg-slate-50">

                                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                                {{ $tendiks->firstItem() + $index }}
                                            </td>

                                            <td class="px-5 py-4">
                                                <p class="font-semibold text-slate-900">
                                                    {{ $tendik->nama_responden }}
                                                </p>
                                                <p class="mt-1 text-xs text-slate-500">
                                                    {{ $tendik->jabatan_responden === 'Lainnya'
                            ? ($tendik->jabatan_lainnya ?: 'Lainnya')
                            : $tendik->jabatan_responden }}
                                                </p>
                                            </td>

                                            <td class="px-5 py-4 text-sm text-slate-700">
                                                {{ $tendik->satuan_pendidikan }}
                                            </td>

                                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">
                                                {{ $tendik->tanggal_pengisian
                            ? \Illuminate\Support\Carbon::parse($tendik->tanggal_pengisian)->format('d-m-Y')
                            : '-' }}
                                            </td>

                                            <td class="whitespace-nowrap px-5 py-4 text-center">
                                                <span class="font-bold text-slate-900">
                                                    {{ $tendik->skor_keseluruhan !== null
                            ? number_format((float) $tendik->skor_keseluruhan, 2, ',', '.')
                            : '-' }}
                                                </span>
                                                <span class="text-xs text-slate-400">/ 4,00</span>
                                            </td>

                                            <td class="whitespace-nowrap px-5 py-4 text-center">
                                                @php
                                                    $warnaPredikat = match ($tendik->predikat) {
                                                        'Sangat Baik' => 'bg-emerald-100 text-emerald-800',
                                                        'Baik' => 'bg-blue-100 text-blue-800',
                                                        'Cukup' => 'bg-amber-100 text-amber-800',
                                                        'Kurang' => 'bg-red-100 text-red-800',
                                                        default => 'bg-slate-100 text-slate-600',
                                                    };
                                                @endphp

                                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $warnaPredikat }}">
                                                    {{ $tendik->predikat ?? 'Belum tersedia' }}
                                                </span>
                                            </td>

                                            <td class="px-5 py-4">
                                                <div class="flex items-center justify-center gap-2">

                                                    <a href="{{ route('tendik.show', $tendik) }}" title="Lihat detail"
                                                        class="inline-flex items-center justify-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                                        Detail
                                                    </a>

                                                    <a href="{{ route('tendik.edit', $tendik) }}" title="Edit data"
                                                        class="inline-flex items-center justify-center rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 transition hover:bg-amber-100">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('tendik.destroy', $tendik) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data evaluasi {{ addslashes($tendik->nama_responden) }}?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" title="Hapus data"
                                                            class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                                            Hapus
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <div class="rounded-full bg-slate-100 p-4">
                                            <svg class="h-8 w-8 text-slate-400" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                            </svg>
                                        </div>

                                        <p class="mt-4 font-semibold text-slate-800">
                                            Belum ada data pengisian
                                        </p>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Tambahkan pengisian instrumen TENDIK untuk melihat hasil evaluasi di sini.
                                        </p>
                                        
                                        <a href="{{ route('tendik.create') }}"
                                            class="mt-4 rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">
                                            Tambah Pengisian
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINASI --}}
            @if ($tendiks->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">
                    {{ $tendiks->links() }}
                </div>
            @endif

            <div class="border-t border-slate-100 bg-slate-50 px-5 py-3">
                <p class="text-xs text-slate-500">
                    Menampilkan {{ $tendiks->count() }} data pada halaman ini dari
                    {{ $tendiks->total() }} pengisian.
                </p>
            </div>

        </section>

    </div>
@endsection