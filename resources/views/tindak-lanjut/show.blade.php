@extends('layouts.app')

@section('title', 'Detail Tindak Lanjut')

@section('page-title', 'Detail Tindak Lanjut')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Detail Tindak Lanjut
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap tindak lanjut hasil monitoring dan evaluasi.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a
                href="{{ route('tindak-lanjut.index') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                ← Kembali
            </a>

            <a
                href="{{ route('tindak-lanjut.edit', ['tindakLanjut' => $tindakLanjut->id]) }}"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                Edit
            </a>
        </div>
    </div>

    {{-- Informasi utama --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                <div>
                    <p class="text-sm font-medium text-blue-600">
                        Tindak Lanjut
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-slate-800">
                        {{ $tindakLanjut->judul_tindak_lanjut }}
                    </h2>
                </div>

                @if($tindakLanjut->status === 'Selesai')

                    <span class="inline-flex w-fit items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                        Selesai
                    </span>

                @elseif($tindakLanjut->status === 'Dalam Proses')

                    <span class="inline-flex w-fit items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                        Dalam Proses
                    </span>

                @else

                    <span class="inline-flex w-fit items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                        Belum Dimulai
                    </span>

                @endif

            </div>
        </div>

        {{-- Detail --}}
        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

            {{-- Sekolah --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Sekolah
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $tindakLanjut->sekolah->nama_sekolah ?? '-' }}
                </p>

                @if($tindakLanjut->sekolah)
                    <p class="mt-1 text-xs text-slate-500">
                        NPSN: {{ $tindakLanjut->sekolah->npsn }}
                    </p>
                @endif
            </div>

            {{-- Wawancara --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Sumber Wawancara
                </p>

                @if($tindakLanjut->wawancara)

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $tindakLanjut->wawancara->nama_narasumber }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        {{ $tindakLanjut->wawancara->tanggal_wawancara?->format('d/m/Y') }}
                    </p>

                @else

                    <p class="mt-1 text-sm text-slate-500">
                        Tidak terkait wawancara tertentu
                    </p>

                @endif
            </div>

            {{-- Penanggung Jawab --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Penanggung Jawab
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $tindakLanjut->penanggung_jawab }}
                </p>
            </div>

            {{-- Tanggal Mulai --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Tanggal Mulai
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $tindakLanjut->tanggal_mulai?->format('d/m/Y') ?? '-' }}
                </p>
            </div>

            {{-- Target Selesai --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Target Selesai
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $tindakLanjut->target_selesai?->format('d/m/Y') ?? '-' }}
                </p>
            </div>

            {{-- Dibuat --}}
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Dibuat
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $tindakLanjut->created_at?->format('d/m/Y H:i') }}
                </p>
            </div>

        </div>

    </div>

    {{-- Uraian --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-800">
                Uraian Tindak Lanjut
            </h2>
        </div>

        <div class="px-6 py-5">
            <div class="whitespace-pre-line text-sm leading-7 text-slate-600">
                {{ $tindakLanjut->uraian_tindak_lanjut }}
            </div>
        </div>

    </div>

    {{-- Keterangan --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-800">
                Keterangan
            </h2>
        </div>

        <div class="px-6 py-5">

            @if($tindakLanjut->keterangan)

                <div class="whitespace-pre-line text-sm leading-7 text-slate-600">
                    {{ $tindakLanjut->keterangan }}
                </div>

            @else

                <p class="text-sm italic text-slate-400">
                    Tidak ada keterangan tambahan.
                </p>

            @endif

        </div>

    </div>

    {{-- Tombol bawah --}}
    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

        <form
            action="{{ route('tindak-lanjut.destroy', ['tindakLanjut' => $tindakLanjut->id]) }}"
            method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data tindak lanjut ini?')"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-100"
            >
                Hapus Data
            </button>
        </form>

        <a
            href="{{ route('tindak-lanjut.edit', ['tindakLanjut' => $tindakLanjut->id]) }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
        >
            Edit Tindak Lanjut
        </a>

    </div>

</div>

@endsection