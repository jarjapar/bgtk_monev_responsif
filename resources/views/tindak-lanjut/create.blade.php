@extends('layouts.app')

@section('title', 'Tambah Tindak Lanjut')

@section('page-title', 'Tambah Tindak Lanjut')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Tambah Tindak Lanjut
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Tambahkan rencana tindak lanjut hasil monitoring dan evaluasi.
            </p>
        </div>

        <a
            href="{{ route('tindak-lanjut.index') }}"
            class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 19l-7-7 7-7"
                />
            </svg>

            Kembali
        </a>

    </div>


    {{-- Error Validation --}}
    @if ($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-5">

            <div class="flex gap-3">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="mt-0.5 h-5 w-5 shrink-0 text-red-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20.5h15.6a2 2 0 001.73-3.14l-7.82-13.5a2 2 0 00-3.42 0z"
                    />
                </svg>

                <div>
                    <p class="font-semibold text-red-700">
                        Terdapat kesalahan pada data.
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>

    @endif


    {{-- Form --}}
    <form
        action="{{ route('tindak-lanjut.store') }}"
        method="POST"
        class="space-y-6"
    >

        @csrf


        {{-- Sumber Tindak Lanjut --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">

                <h2 class="text-base font-bold text-slate-800">
                    Sumber Tindak Lanjut
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Hubungkan tindak lanjut dengan sekolah dan hasil wawancara.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                {{-- Sekolah --}}
                <div>

                    <label
                        for="sekolah_id"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Sekolah
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="sekolah_id"
                        name="sekolah_id"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option value="">
                            -- Pilih Sekolah --
                        </option>

                        @foreach ($sekolahs as $sekolah)

                            <option
                                value="{{ $sekolah->id }}"
                                {{ old('sekolah_id') == $sekolah->id ? 'selected' : '' }}
                            >
                                {{ $sekolah->npsn }}
                                - {{ $sekolah->nama_sekolah }}
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
                        Wawancara
                    </label>

                    <select
                        id="wawancara_id"
                        name="wawancara_id"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option value="">
                            -- Tidak terkait wawancara tertentu --
                        </option>

                        @foreach ($wawancaras as $wawancara)

                            <option
                                value="{{ $wawancara->id }}"
                                {{ old('wawancara_id') == $wawancara->id ? 'selected' : '' }}
                            >
                                {{ $wawancara->tanggal_wawancara?->format('d/m/Y') }}
                                -
                                {{ $wawancara->sekolah->nama_sekolah ?? 'Sekolah tidak tersedia' }}
                                -
                                {{ $wawancara->nama_narasumber }}
                            </option>

                        @endforeach

                    </select>

                    <p class="mt-2 text-xs text-slate-400">
                        Pilihan ini bersifat opsional.
                    </p>

                </div>

            </div>

        </div>


        {{-- Detail Tindak Lanjut --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">

                <h2 class="text-base font-bold text-slate-800">
                    Detail Tindak Lanjut
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Masukkan rencana tindakan yang akan dilaksanakan.
                </p>

            </div>


            <div class="space-y-6 p-6">

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
                        value="{{ old('judul_tindak_lanjut') }}"
                        required
                        placeholder="Contoh: Peningkatan pelaksanaan pembelajaran"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
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
                        rows="6"
                        required
                        placeholder="Jelaskan tindakan yang perlu dilakukan..."
                        class="w-full resize-y rounded-lg border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >{{ old('uraian_tindak_lanjut') }}</textarea>

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
                        value="{{ old('penanggung_jawab') }}"
                        required
                        placeholder="Contoh: Kepala Sekolah"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>

            </div>

        </div>


        {{-- Jadwal dan Status --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">

                <h2 class="text-base font-bold text-slate-800">
                    Jadwal dan Status
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tentukan waktu pelaksanaan dan status tindak lanjut.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-3">

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
                        value="{{ old('tanggal_mulai') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
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
                        value="{{ old('target_selesai') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>


                {{-- Status --}}
                <div>

                    <label
                        for="status"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Status
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                        <option
                            value="Belum Dimulai"
                            {{ old('status', 'Belum Dimulai') === 'Belum Dimulai' ? 'selected' : '' }}
                        >
                            Belum Dimulai
                        </option>

                        <option
                            value="Dalam Proses"
                            {{ old('status') === 'Dalam Proses' ? 'selected' : '' }}
                        >
                            Dalam Proses
                        </option>

                        <option
                            value="Selesai"
                            {{ old('status') === 'Selesai' ? 'selected' : '' }}
                        >
                            Selesai
                        </option>

                    </select>

                </div>

            </div>

        </div>


        {{-- Keterangan --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">

                <h2 class="text-base font-bold text-slate-800">
                    Keterangan
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tambahkan catatan atau informasi tambahan.
                </p>

            </div>


            <div class="p-6">

                <textarea
                    id="keterangan"
                    name="keterangan"
                    rows="5"
                    placeholder="Masukkan keterangan tambahan..."
                    class="w-full resize-y rounded-lg border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >{{ old('keterangan') }}</textarea>

            </div>

        </div>


        {{-- Tombol --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('tindak-lanjut.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
            >
                Simpan Tindak Lanjut
            </button>

        </div>

    </form>

</div>

@endsection