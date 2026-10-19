@extends('layouts.app')

@section('title', 'Tambah Instrumen')
@section('page-title', 'Tambah Instrumen')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="{{ route('instrumen.index') }}"
               class="transition hover:text-blue-600">
                Instrumen Pemantauan
            </a>

            <span>/</span>

            <span class="text-slate-700">
                Tambah Instrumen
            </span>
        </div>

        <h2 class="mt-2 text-2xl font-bold text-slate-800">
            Tambah Instrumen
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Tambahkan instrumen pemantauan atau evaluasi baru ke dalam sistem.
        </p>
    </div>

    {{-- Validation Error --}}
    @if ($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

            <div class="flex gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold text-red-600">
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
    <form action="{{ route('instrumen.store') }}"
          method="POST"
          class="space-y-6">

        @csrf

        {{-- Informasi Instrumen --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h3 class="text-lg font-bold text-slate-800">
                    Informasi Instrumen
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Masukkan informasi dasar instrumen.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                {{-- Kode --}}
                <div>
                    <label for="kode_instrumen"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Kode Instrumen <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="kode_instrumen"
                        name="kode_instrumen"
                        value="{{ old('kode_instrumen') }}"
                        maxlength="50"
                        required
                        placeholder="Contoh: INS-001"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                </div>

                {{-- Nama --}}
                <div>
                    <label for="nama_instrumen"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Nama Instrumen <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_instrumen"
                        name="nama_instrumen"
                        value="{{ old('nama_instrumen') }}"
                        required
                        placeholder="Masukkan nama instrumen"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                </div>

                {{-- Jenis --}}
                <div>
                    <label for="jenis_instrumen"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Jenis Instrumen <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="jenis_instrumen"
                        name="jenis_instrumen"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                        <option value="">Pilih jenis instrumen</option>

                        <option value="Pemantauan"
                            @selected(old('jenis_instrumen') === 'Pemantauan')>
                            Pemantauan
                        </option>

                        <option value="Evaluasi"
                            @selected(old('jenis_instrumen') === 'Evaluasi')>
                            Evaluasi
                        </option>

                        <option value="Monitoring"
                            @selected(old('jenis_instrumen') === 'Monitoring')>
                            Monitoring
                        </option>
                    </select>
                </div>

                {{-- Status --}}
                <div>
                    <label for="status"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Status <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                        <option value="Draft"
                            @selected(old('status', 'Draft') === 'Draft')>
                            Draft
                        </option>

                        <option value="Aktif"
                            @selected(old('status') === 'Aktif')>
                            Aktif
                        </option>

                        <option value="Selesai"
                            @selected(old('status') === 'Selesai')>
                            Selesai
                        </option>
                    </select>
                </div>

                {{-- Jumlah Pertanyaan --}}
                <div>
                    <label for="jumlah_pertanyaan"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Jumlah Pertanyaan <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        id="jumlah_pertanyaan"
                        name="jumlah_pertanyaan"
                        value="{{ old('jumlah_pertanyaan', 0) }}"
                        min="0"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                </div>

                {{-- Capaian --}}
                <div>
                    <label for="capaian"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Capaian (%) <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        id="capaian"
                        name="capaian"
                        value="{{ old('capaian', 0) }}"
                        min="0"
                        max="100"
                        step="0.01"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >

                    <p class="mt-1 text-xs text-slate-400">
                        Masukkan nilai antara 0 sampai 100.
                    </p>
                </div>

                {{-- Tanggal Mulai --}}
                <div>
                    <label for="tanggal_mulai"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        id="tanggal_mulai"
                        name="tanggal_mulai"
                        value="{{ old('tanggal_mulai') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                </div>

                {{-- Tanggal Selesai --}}
                <div>
                    <label for="tanggal_selesai"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Tanggal Selesai
                    </label>

                    <input
                        type="date"
                        id="tanggal_selesai"
                        name="tanggal_selesai"
                        value="{{ old('tanggal_selesai') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2">
                    <label for="deskripsi"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Deskripsi
                    </label>

                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Masukkan deskripsi instrumen..."
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >{{ old('deskripsi') }}</textarea>
                </div>

            </div>
        </div>

        {{-- Tombol --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a href="{{ route('instrumen.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                Simpan Instrumen
            </button>

        </div>

    </form>

</div>
@endsection