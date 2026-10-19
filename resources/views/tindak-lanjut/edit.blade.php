@extends('layouts.app')

@section('title', 'Edit Tindak Lanjut')

@section('page-title', 'Edit Tindak Lanjut')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Edit Tindak Lanjut
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui informasi tindak lanjut hasil monitoring dan evaluasi.
            </p>
        </div>

        <a
            href="{{ route('tindak-lanjut.show', ['tindakLanjut' => $tindakLanjut->id]) }}"
            class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
        >
            ← Kembali
        </a>
    </div>

    {{-- Error Validasi --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4">
            <h3 class="text-sm font-semibold text-red-800">
                Terdapat kesalahan pada data.
            </h3>

            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form
        action="{{ route('tindak-lanjut.update', ['tindakLanjut' => $tindakLanjut->id]) }}"
        method="POST"
        class="space-y-6"
    >

        @csrf
        @method('PUT')

        {{-- Sumber --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">
                    Sumber Tindak Lanjut
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tentukan sekolah dan wawancara yang berkaitan.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                {{-- Sekolah --}}
                <div>
                    <label
                        for="sekolah_id"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Sekolah <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="sekolah_id"
                        name="sekolah_id"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >
                        <option value="">
                            -- Pilih Sekolah --
                        </option>

                        @foreach ($sekolahs as $sekolah)
                            <option
                                value="{{ $sekolah->id }}"
                                @selected(
                                    old(
                                        'sekolah_id',
                                        $tindakLanjut->sekolah_id
                                    ) == $sekolah->id
                                )
                            >
                                {{ $sekolah->nama_sekolah }}
                                - {{ $sekolah->npsn }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Wawancara --}}
                <div>
                    <label
                        for="wawancara_id"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Sumber Wawancara
                    </label>

                    <select
                        id="wawancara_id"
                        name="wawancara_id"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >
                        <option value="">
                            -- Tidak terkait wawancara tertentu --
                        </option>

                        @foreach ($wawancaras as $wawancara)
                            <option
                                value="{{ $wawancara->id }}"
                                @selected(
                                    old(
                                        'wawancara_id',
                                        $tindakLanjut->wawancara_id
                                    ) == $wawancara->id
                                )
                            >
                                {{ $wawancara->nama_narasumber }}
                                -
                                {{ $wawancara->tanggal_wawancara?->format('d/m/Y') }}

                                @if ($wawancara->sekolah)
                                    - {{ $wawancara->sekolah->nama_sekolah }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        {{-- Detail --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">
                    Detail Tindak Lanjut
                </h2>
            </div>

            <div class="space-y-5 p-6">

                {{-- Judul --}}
                <div>
                    <label
                        for="judul_tindak_lanjut"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Judul Tindak Lanjut
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="judul_tindak_lanjut"
                        name="judul_tindak_lanjut"
                        value="{{ old('judul_tindak_lanjut', $tindakLanjut->judul_tindak_lanjut) }}"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >
                </div>

                {{-- Uraian --}}
                <div>
                    <label
                        for="uraian_tindak_lanjut"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Uraian Tindak Lanjut
                        <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        id="uraian_tindak_lanjut"
                        name="uraian_tindak_lanjut"
                        rows="5"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >{{ old('uraian_tindak_lanjut', $tindakLanjut->uraian_tindak_lanjut) }}</textarea>
                </div>

                {{-- Penanggung Jawab --}}
                <div>
                    <label
                        for="penanggung_jawab"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Penanggung Jawab
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="penanggung_jawab"
                        name="penanggung_jawab"
                        value="{{ old('penanggung_jawab', $tindakLanjut->penanggung_jawab) }}"
                        required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >
                </div>

            </div>
        </div>

        {{-- Jadwal dan Status --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">
                    Jadwal dan Status
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-3">

                {{-- Tanggal Mulai --}}
                <div>
                    <label
                        for="tanggal_mulai"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        id="tanggal_mulai"
                        name="tanggal_mulai"
                        value="{{ old('tanggal_mulai', $tindakLanjut->tanggal_mulai?->format('Y-m-d')) }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >
                </div>

                {{-- Target Selesai --}}
                <div>
                    <label
                        for="target_selesai"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Target Selesai
                    </label>

                    <input
                        type="date"
                        id="target_selesai"
                        name="target_selesai"
                        value="{{ old('target_selesai', $tindakLanjut->target_selesai?->format('Y-m-d')) }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >
                </div>

                {{-- Status --}}
                <div>
                    <label
                        for="status"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Status <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >
                        <option
                            value="Belum Dimulai"
                            @selected(
                                old('status', $tindakLanjut->status) === 'Belum Dimulai'
                            )
                        >
                            Belum Dimulai
                        </option>

                        <option
                            value="Dalam Proses"
                            @selected(
                                old('status', $tindakLanjut->status) === 'Dalam Proses'
                            )
                        >
                            Dalam Proses
                        </option>

                        <option
                            value="Selesai"
                            @selected(
                                old('status', $tindakLanjut->status) === 'Selesai'
                            )
                        >
                            Selesai
                        </option>
                    </select>
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

            <div class="p-6">
                <textarea
                    id="keterangan"
                    name="keterangan"
                    rows="4"
                    placeholder="Tambahkan keterangan jika diperlukan..."
                    class="w-full rounded-lg border border-slate-300 px-4 py-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                >{{ old('keterangan', $tindakLanjut->keterangan) }}</textarea>
            </div>

        </div>

        {{-- Tombol --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('tindak-lanjut.show', ['tindakLanjut' => $tindakLanjut->id]) }}"
                class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection