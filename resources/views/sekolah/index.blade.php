@extends('layouts.app')

@section('title', 'Data Sekolah')
@section('page-title', 'Data Sekolah')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Data Sekolah</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola data sekolah yang menjadi objek monitoring dan evaluasi.
                </p>
            </div>

            <a href="{{ route('sekolah.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Sekolah
            </a>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Statistik --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Sekolah</p>
                        <p class="mt-2 text-3xl font-bold text-slate-800">{{ $totalSekolah }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2m-2 4h2m2-4h2m-2 4h2" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Sudah Dimonitor</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-600">{{ $sudahDimonitor }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Belum Dimonitor</p>
                        <p class="mt-2 text-3xl font-bold text-amber-600">{{ $belumDimonitor }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3m0 4h.01M10.3 3.9L1.8 18a2 2 0 001.7 3h17a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Kabupaten/Kota</p>
                        <p class="mt-2 text-3xl font-bold text-purple-600">{{ $wilayah }}</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 10a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- Filter --}}
        <form action="{{ route('sekolah.index') }}" method="GET"
            class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-800">Filter Data Sekolah</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Cari sekolah berdasarkan jenjang, wilayah, atau status monitoring.
                    </p>
                </div>

                @if(request()->hasAny(['jenjang', 'kabupaten_kota', 'status_monitoring', 'cari']))
                    <a href="{{ route('sekolah.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                        Reset filter
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                <div>
                    <label for="jenjang" class="mb-2 block text-sm font-medium text-slate-700">
                        Jenjang
                    </label>
                    <select id="jenjang" name="jenjang"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Jenjang</option>
                        @foreach(['SD', 'SMP', 'SMA', 'SMK'] as $jenjang)
                            <option value="{{ $jenjang }}" @selected(request('jenjang') === $jenjang)>
                                {{ $jenjang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="kabupaten_kota" class="mb-2 block text-sm font-medium text-slate-700">
                        Kabupaten/Kota
                    </label>
                    <select id="kabupaten_kota" name="kabupaten_kota"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Wilayah</option>
                        @foreach($daftarWilayah ?? [] as $namaWilayah)
                            <option value="{{ $namaWilayah }}" @selected(request('kabupaten_kota') === $namaWilayah)>
                                {{ $namaWilayah }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status_monitoring" class="mb-2 block text-sm font-medium text-slate-700">
                        Status Monitoring
                    </label>
                    <select id="status_monitoring" name="status_monitoring"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Status</option>
                        <option value="Sudah Dimonitor" @selected(request('status_monitoring') === 'Sudah Dimonitor')>
                            Sudah Dimonitor
                        </option>
                        <option value="Belum Dimonitor" @selected(request('status_monitoring') === 'Belum Dimonitor')>
                            Belum Dimonitor
                        </option>
                    </select>
                </div>

                <div>
                    <label for="cari" class="mb-2 block text-sm font-medium text-slate-700">
                        Pencarian
                    </label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                        </svg>
                        <input id="cari" type="text" name="cari" value="{{ request('cari') }}"
                            placeholder="Cari nama atau NPSN..."
                            class="w-full rounded-lg border border-slate-300 py-2.5 pl-10 pr-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>

            </div>

            <div class="mt-4 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                    </svg>
                    Terapkan Filter
                </button>
            </div>

        </form>

        {{-- Tabel Sekolah --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div
                class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-800">Daftar Sekolah</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Data sekolah beserta rekap aktivitas monitoring dan evaluasi.
                    </p>
                </div>
                <span class="text-sm text-slate-500">
                    Menampilkan {{ $sekolahs->count() }} dari {{ $sekolahs->total() }} sekolah
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">
                        <tr>
                            <th
                                class="whitespace-nowrap px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                No</th>
                            <th
                                class="whitespace-nowrap px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                NPSN</th>
                            <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">Nama
                                Sekolah</th>
                            <th
                                class="whitespace-nowrap px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Jenjang</th>
                            <th
                                class="whitespace-nowrap px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Kabupaten/Kota</th>
                            <th
                                class="whitespace-nowrap px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Status</th>
                            <th
                                class="whitespace-nowrap px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Data Monev</th>
                            <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                Keterangan</th>
                            <th
                                class="whitespace-nowrap px-4 py-3 text-right text-xs font-bold uppercase tracking-wide text-slate-500">
                                Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">

                        @forelse($sekolahs as $index => $sekolah)

                            @php
                                $jumlahInstrumen =
                                    (int) ($sekolah->bcks_pengisians_count ?? 0) +
                                    (int) ($sekolah->bk_submissions_count ?? 0) +
                                    (int) ($sekolah->tendiks_count ?? 0) +
                                    (int) ($sekolah->gembira_pengisians_count ?? 0);

                                $jumlahWawancara = (int) ($sekolah->wawancaras_count ?? 0);


                                $kategoriMonev = [];

                                if (
                                    ($sekolah->bcks_pengisians_count ?? 0) > 0 ||
                                    ($sekolah->wawancaras ?? collect())->contains(function ($wawancara) {
                                        return strtoupper(trim($wawancara->jenis_wawancara ?? '')) === 'BCKS';
                                    })
                                ) {
                                    $kategoriMonev[] = 'BCKS';
                                }

                                if (($sekolah->bk_submissions_count ?? 0) > 0) {
                                    $kategoriMonev[] = 'BK';
                                }

                                if (($sekolah->tendiks_count ?? 0) > 0) {
                                    $kategoriMonev[] = 'TENDIK';
                                }

                                if (($sekolah->gembira_pengisians_count ?? 0) > 0) {
                                    $kategoriMonev[] = 'GEMBIRA';
                                }

                                $kategoriWawancara = ($sekolah->wawancaras ?? collect())
                                    ->pluck('jenis_wawancara')
                                    ->filter()
                                    ->map(fn($jenis) => strtoupper(trim($jenis)))
                                    ->unique()
                                    ->values()
                                    ->all();

                                $kategoriMonev = array_values(array_unique(
                                    array_merge($kategoriMonev  , $kategoriWawancara)
                                ));

                            @endphp

                            <tr class="transition hover:bg-slate-50">

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-600">
                                    {{ $sekolahs->firstItem() + $index }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-700">
                                    {{ $sekolah->npsn ?: '—' }}
                                </td>

                                <td class="min-w-48 px-4 py-4">
                                    <div class="font-semibold text-slate-800">
                                        {{ $sekolah->nama_sekolah }}
                                    </div>
                                    @if($sekolah->kecamatan)
                                        <div class="mt-1 text-xs text-slate-500">
                                            Kec. {{ $sekolah->kecamatan }}
                                        </div>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-4 py-4">
                                    @if($sekolah->jenjang)
                                        <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                            {{ $sekolah->jenjang }}
                                        </span>
                                    @else
                                        <span class="text-sm text-slate-400">—</span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-600">
                                    {{ $sekolah->kabupaten_kota ?: '—' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4">
                                    @if($sekolah->status_monitoring === 'Sudah Dimonitor')
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Sudah Dimonitor
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                            Belum Dimonitor
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-700">
                                    <div class="font-semibold">{{ $jumlahInstrumen }} instrumen</div>
                                    <div class="mt-1 text-xs text-slate-500">{{ $jumlahWawancara }} wawancara</div>
                                </td>

                                <td class="min-w-36 px-4 py-4">
                                    @if(count($kategoriMonev))
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($kategoriMonev as $kategori)
                                                <span class="rounded-md bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-700">
                                                    {{ $kategori }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400">Belum ada aktivitas</span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        {{-- DETAIL --}}
                                        <a href="{{ route('sekolah.show', $sekolah) }}" title="Lihat Detail"
                                            class="text-slate-600 transition hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('sekolah.edit', $sekolah) }}" title="Edit"
                                            class="text-blue-400 transition hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L9.37 18.02l-4.136 1.166 1.166-4.136 10.462-10.563Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m15.232 5.232 3.536 3.536" />
                                            </svg>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('sekolah.destroy', $sekolah) }}" method="POST"
                                            class="inline-flex"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sekolah ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="Hapus data" aria-label="Hapus data"
                                                class="text-red-500 transition hover:text-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4h8v2" />
                                                    <path d="m19 6-1 14H6L5 6" />
                                                    <path d="M10 11v5M14 11v5" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="p-0">
                                    <div
                                        class="flex min-h-[320px] w-full flex-col items-center justify-center px-6 py-12 text-center">

                                        <div
                                            class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16" />
                                            </svg>
                                        </div>

                                        <h3 class="mt-5 text-base font-bold text-slate-800">
                                            @if(request()->hasAny(['jenjang', 'kabupaten_kota', 'status_monitoring', 'cari']))
                                                Data sekolah tidak ditemukan
                                            @else
                                                Belum ada data sekolah
                                            @endif
                                        </h3>

                                        <p class="mt-2 max-w-md text-sm leading-relaxed text-slate-500">
                                            @if(request()->hasAny(['jenjang', 'kabupaten_kota', 'status_monitoring', 'cari']))
                                                Tidak ada sekolah yang sesuai dengan filter pencarian. Coba ubah atau reset filter.
                                            @else
                                                Belum terdapat data sekolah di dalam database. Tambahkan data sekolah untuk mulai
                                                mengelola monitoring dan evaluasi.
                                            @endif
                                        </p>

                                        @if(request()->hasAny(['jenjang', 'kabupaten_kota', 'status_monitoring', 'cari']))
                                            <a href="{{ route('sekolah.index') }}"
                                                class="mt-6 inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                                Reset Filter
                                            </a>
                                        @else
                                            <a href="{{ route('sekolah.create') }}"
                                                class="mt-6 inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Sekolah
                                            </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($sekolahs->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">
                    {{ $sekolahs->appends(request()->query())->links() }}
                </div>
            @endif

        </div>

    </div>

@endsection