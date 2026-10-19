@extends('layouts.app')

@section('title', 'Detail Sekolah')
@section('page-title', 'Detail Sekolah')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('sekolah.index') }}"
                   class="transition hover:text-blue-600">
                    Data Sekolah
                </a>

                <span>/</span>

                <span class="text-slate-700">Detail Sekolah</span>
            </div>

            <h2 class="mt-2 text-2xl font-bold text-slate-800">
                {{ $sekolah->nama_sekolah }}
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap data sekolah dan status monitoring.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('sekolah.index') }}"
               class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                ← Kembali
            </a>

            <a href="{{ route('sekolah.edit', $sekolah) }}"
               class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                ✎ Edit Data
            </a>
        </div>
    </div>

    {{-- Status --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-slate-500">
                    Status Monitoring
                </p>

                <div class="mt-2">
                    @if ($sekolah->status_monitoring === 'Sudah Dimonitor')
                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1.5 text-sm font-semibold text-emerald-700">
                            ● Sudah Dimonitor
                        </span>
                    @else
                        <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1.5 text-sm font-semibold text-amber-700">
                            ● Belum Dimonitor
                        </span>
                    @endif
                </div>
            </div>

            @if ($sekolah->tahun_monitoring)
                <div class="rounded-xl bg-slate-50 px-5 py-3">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Tahun Monitoring
                    </p>

                    <p class="mt-1 text-lg font-bold text-slate-800">
                        {{ $sekolah->tahun_monitoring }}
                    </p>
                </div>
            @endif

        </div>
    </div>

    {{-- Informasi Sekolah --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">
            <h3 class="text-lg font-bold text-slate-800">
                Informasi Sekolah
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                Data identitas dan lokasi sekolah.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 md:grid-cols-2">

            {{-- NPSN --}}
            <div>
                <p class="text-sm font-medium text-slate-500">
                    NPSN
                </p>

                <p class="mt-1 text-base font-semibold text-slate-800">
                    {{ $sekolah->npsn }}
                </p>
            </div>

            {{-- Nama Sekolah --}}
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Nama Sekolah
                </p>

                <p class="mt-1 text-base font-semibold text-slate-800">
                    {{ $sekolah->nama_sekolah }}
                </p>
            </div>

            {{-- Jenjang --}}
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Jenjang
                </p>

                <p class="mt-1 text-base font-semibold text-slate-800">
                    {{ $sekolah->jenjang }}
                </p>
            </div>

            {{-- Kabupaten/Kota --}}
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Kabupaten/Kota
                </p>

                <p class="mt-1 text-base font-semibold text-slate-800">
                    {{ $sekolah->kabupaten_kota }}
                </p>
            </div>

            {{-- Kecamatan --}}
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Kecamatan
                </p>

                <p class="mt-1 text-base font-semibold text-slate-800">
                    {{ $sekolah->kecamatan ?: '-' }}
                </p>
            </div>

            {{-- Tahun Monitoring --}}
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Tahun Monitoring
                </p>

                <p class="mt-1 text-base font-semibold text-slate-800">
                    {{ $sekolah->tahun_monitoring ?: '-' }}
                </p>
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <p class="text-sm font-medium text-slate-500">
                    Alamat
                </p>

                <p class="mt-1 text-base font-semibold leading-relaxed text-slate-800">
                    {{ $sekolah->alamat ?: '-' }}
                </p>
            </div>

        </div>
    </div>

    {{-- Informasi Sistem --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <h3 class="text-lg font-bold text-slate-800">
            Informasi Data
        </h3>

        <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2">

            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Data Dibuat
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-700">
                    {{ $sekolah->created_at?->format('d F Y, H:i') ?? '-' }}
                </p>
            </div>

            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Terakhir Diperbarui
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-700">
                    {{ $sekolah->updated_at?->format('d F Y, H:i') ?? '-' }}
                </p>
            </div>

        </div>
    </div>

    {{-- Tombol Bawah --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

        <a href="{{ route('sekolah.index') }}"
           class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Kembali ke Data Sekolah
        </a>

        <a href="{{ route('sekolah.edit', $sekolah) }}"
           class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
            Edit Data Sekolah
        </a>

    </div>

</div>
@endsection