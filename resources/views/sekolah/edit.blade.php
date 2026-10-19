@extends('layouts.app')

@section('title', 'Edit Sekolah')
@section('page-title', 'Edit Sekolah')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="{{ route('sekolah.index') }}"
               class="transition hover:text-blue-600">
                Data Sekolah
            </a>

            <span>/</span>

            <a href="{{ route('sekolah.show', $sekolah) }}"
               class="transition hover:text-blue-600">
                Detail
            </a>

            <span>/</span>

            <span class="text-slate-700">Edit</span>
        </div>

        <h2 class="mt-2 text-2xl font-bold text-slate-800">
            Edit Data Sekolah
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Perbarui informasi sekolah yang diperlukan.
        </p>
    </div>

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 p-5">
            <div class="flex gap-3">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                    !
                </div>

                <div>
                    <h3 class="font-semibold text-red-800">
                        Terdapat kesalahan pada data
                    </h3>

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
    <form action="{{ route('sekolah.update', $sekolah) }}"
          method="POST"
          class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Identitas Sekolah --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h3 class="text-lg font-bold text-slate-800">
                    Identitas Sekolah
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi dasar sekolah.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                {{-- NPSN --}}
                <div>
                    <label for="npsn"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        NPSN <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="npsn"
                        name="npsn"
                        value="{{ old('npsn', $sekolah->npsn) }}"
                        maxlength="20"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="Masukkan NPSN"
                    >
                </div>

                {{-- Nama Sekolah --}}
                <div>
                    <label for="nama_sekolah"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Nama Sekolah <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_sekolah"
                        name="nama_sekolah"
                        value="{{ old('nama_sekolah', $sekolah->nama_sekolah) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="Masukkan nama sekolah"
                    >
                </div>

                {{-- Jenjang --}}
                <div>
                    <label for="jenjang"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Jenjang <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="jenjang"
                        name="jenjang"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                        <option value="">Pilih jenjang</option>

                        <option value="SD" @selected(old('jenjang', $sekolah->jenjang) === 'SD')>
                            SD
                        </option>

                        <option value="SMP" @selected(old('jenjang', $sekolah->jenjang) === 'SMP')>
                            SMP
                        </option>

                        <option value="SMA" @selected(old('jenjang', $sekolah->jenjang) === 'SMA')>
                            SMA
                        </option>

                        <option value="SMK" @selected(old('jenjang', $sekolah->jenjang) === 'SMK')>
                            SMK
                        </option>
                    </select>
                </div>

                {{-- Kabupaten/Kota --}}
                <div>
                    <label for="kabupaten_kota"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Kabupaten/Kota <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="kabupaten_kota"
                        name="kabupaten_kota"
                        value="{{ old('kabupaten_kota', $sekolah->kabupaten_kota) }}"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="Contoh: Kota Mataram"
                    >
                </div>

                {{-- Kecamatan --}}
                <div>
                    <label for="kecamatan"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Kecamatan
                    </label>

                    <input
                        type="text"
                        id="kecamatan"
                        name="kecamatan"
                        value="{{ old('kecamatan', $sekolah->kecamatan) }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="Masukkan kecamatan"
                    >
                </div>

                {{-- Tahun Monitoring --}}
                <div>
                    <label for="tahun_monitoring"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Tahun Monitoring
                    </label>

                    <input
                        type="number"
                        id="tahun_monitoring"
                        name="tahun_monitoring"
                        value="{{ old('tahun_monitoring', $sekolah->tahun_monitoring) }}"
                        min="2000"
                        max="2100"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="Contoh: 2026"
                    >
                </div>

                {{-- Alamat --}}
                <div class="md:col-span-2">
                    <label for="alamat"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Alamat
                    </label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="4"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        placeholder="Masukkan alamat lengkap sekolah"
                    >{{ old('alamat', $sekolah->alamat) }}</textarea>
                </div>

            </div>
        </div>

        {{-- Status Monitoring --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h3 class="text-lg font-bold text-slate-800">
                    Status Monitoring
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Tentukan status monitoring sekolah.
                </p>
            </div>

            <div class="p-6">

                <label for="status_monitoring"
                       class="mb-2 block text-sm font-semibold text-slate-700">
                    Status Monitoring <span class="text-red-500">*</span>
                </label>

                <select
                    id="status_monitoring"
                    name="status_monitoring"
                    required
                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100 md:max-w-md"
                >
                    <option value="Belum Dimonitor"
                        @selected(old('status_monitoring', $sekolah->status_monitoring) === 'Belum Dimonitor')>
                        Belum Dimonitor
                    </option>

                    <option value="Sudah Dimonitor"
                        @selected(old('status_monitoring', $sekolah->status_monitoring) === 'Sudah Dimonitor')>
                        Sudah Dimonitor
                    </option>
                </select>

            </div>
        </div>

        {{-- Action --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a href="{{ route('sekolah.show', $sekolah) }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>
@endsection