@extends('layouts.app')

@section('title', 'Tambah Sekolah')
@section('page-title', 'Tambah Sekolah')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Tambah Sekolah
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Tambahkan data sekolah baru ke dalam sistem monitoring dan evaluasi.
            </p>
        </div>

        <a
            href="{{ route('sekolah.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            Kembali
        </a>
    </div>


    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4">
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
                        d="M12 9v3.75m0 3.75h.008v.008H12V16.5zM10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                    />
                </svg>

                <div>
                    <p class="font-semibold text-red-800">
                        Terdapat kesalahan pada data.
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif


    {{-- Form --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Form Header --}}
        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-800">
                Informasi Sekolah
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Lengkapi informasi sekolah pada kolom yang tersedia.
            </p>
        </div>


        <form
            action="{{ route('sekolah.store') }}"
            method="POST"
            class="space-y-6 p-6"
        >
            @csrf

            {{-- Identitas Sekolah --}}
            <div>
                <h3 class="mb-4 text-sm font-bold uppercase tracking-wide text-slate-700">
                    Identitas Sekolah
                </h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- NPSN --}}
                    <div>
                        <label
                            for="npsn"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            NPSN <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="npsn"
                            name="npsn"
                            value="{{ old('npsn') }}"
                            placeholder="Contoh: 50201001"
                            maxlength="20"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                        <p class="mt-1.5 text-xs text-slate-500">
                            Nomor Pokok Sekolah Nasional.
                        </p>
                    </div>


                    {{-- Nama Sekolah --}}
                    <div>
                        <label
                            for="nama_sekolah"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Nama Sekolah <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="nama_sekolah"
                            name="nama_sekolah"
                            value="{{ old('nama_sekolah') }}"
                            placeholder="Contoh: SMP Negeri 1 Mataram"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                    </div>


                    {{-- Jenjang --}}
                    <div>
                        <label
                            for="jenjang"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Jenjang <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="jenjang"
                            name="jenjang"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                            <option value="">Pilih Jenjang</option>
                            <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>
                                SD
                            </option>
                            <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>
                                SMP
                            </option>
                            <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>
                                SMA
                            </option>
                            <option value="SMK" {{ old('jenjang') == 'SMK' ? 'selected' : '' }}>
                                SMK
                            </option>
                        </select>
                    </div>


                    {{-- Kabupaten/Kota --}}
                    <div>
                        <label
                            for="kabupaten_kota"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Kabupaten/Kota <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="kabupaten_kota"
                            name="kabupaten_kota"
                            value="{{ old('kabupaten_kota') }}"
                            placeholder="Contoh: Kota Mataram"
                            required
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                    </div>


                    {{-- Kecamatan --}}
                    <div>
                        <label
                            for="kecamatan"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Kecamatan
                        </label>

                        <input
                            type="text"
                            id="kecamatan"
                            name="kecamatan"
                            value="{{ old('kecamatan') }}"
                            placeholder="Contoh: Selaparang"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                    </div>


                    {{-- Tahun Monitoring --}}
                    <div>
                        <label
                            for="tahun_monitoring"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Tahun Monitoring
                        </label>

                        <input
                            type="number"
                            id="tahun_monitoring"
                            name="tahun_monitoring"
                            value="{{ old('tahun_monitoring') }}"
                            placeholder="Contoh: 2026"
                            min="2000"
                            max="2100"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                    </div>

                </div>
            </div>


            {{-- Alamat --}}
            <div class="border-t border-slate-200 pt-6">
                <h3 class="mb-4 text-sm font-bold uppercase tracking-wide text-slate-700">
                    Alamat Sekolah
                </h3>

                <div>
                    <label
                        for="alamat"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Alamat
                    </label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="4"
                        placeholder="Masukkan alamat lengkap sekolah..."
                        class="w-full resize-none rounded-lg border border-slate-300 px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >{{ old('alamat') }}</textarea>
                </div>
            </div>


            {{-- Monitoring --}}
            <div class="border-t border-slate-200 pt-6">
                <h3 class="mb-4 text-sm font-bold uppercase tracking-wide text-slate-700">
                    Status Monitoring
                </h3>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Status --}}
                    <div>
                        <label
                            for="status_monitoring"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Status Monitoring <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="status_monitoring"
                            name="status_monitoring"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                            <option value="">Pilih Status</option>

                            <option
                                value="Belum Dimonitor"
                                {{ old('status_monitoring', 'Belum Dimonitor') == 'Belum Dimonitor' ? 'selected' : '' }}
                            >
                                Belum Dimonitor
                            </option>

                            <option
                                value="Sudah Dimonitor"
                                {{ old('status_monitoring') == 'Sudah Dimonitor' ? 'selected' : '' }}
                            >
                                Sudah Dimonitor
                            </option>
                        </select>
                    </div>

                </div>
            </div>


            {{-- Tombol --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('sekolah.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Simpan Data Sekolah
                </button>

            </div>

        </form>
    </div>

</div>

@endsection