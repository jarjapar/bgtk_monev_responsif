@extends('layouts.app')

@section('title', 'Edit Instrumen')
@section('page-title', 'Edit Instrumen')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="text-sm font-medium text-slate-500">
                Monitoring & Evaluasi
            </p>

            <h1 class="mt-1 text-2xl font-bold text-slate-800">
                Edit Instrumen
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui informasi instrumen pemantauan dan evaluasi.
            </p>
        </div>
        
        <div>
            <a href="{{ route('instrumen.show', ['instrumen' => $instrumen->id]) }}"
               class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                Kembali
            </a>
        </div>

    </div>


    {{-- Form --}}
    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

        {{-- Form Header --}}
        <div class="border-b border-slate-200 px-6 py-5">

            <h2 class="text-lg font-bold text-slate-800">
                Informasi Instrumen
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Silakan ubah data instrumen sesuai kebutuhan.
            </p>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('instrumen.update', ['instrumen' => $instrumen->id]) }}"
            method="POST"
            class="p-6"
        >

            @csrf
            @method('PUT')


            {{-- Error Validation --}}
            @if ($errors->any())

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">

                    <div class="flex gap-3">

                        <div class="flex-1">

                            <p class="text-sm font-semibold text-red-800">
                                Terdapat kesalahan pada data yang dimasukkan.
                            </p>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                {{-- Kode Instrumen --}}
                <div>

                    <label
                        for="kode_instrumen"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Kode Instrumen
                    </label>

                    <input
                        type="text"
                        id="kode_instrumen"
                        name="kode_instrumen"
                        value="{{ old('kode_instrumen', $instrumen->kode_instrumen) }}"
                        placeholder="Contoh: INS-001"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required
                    >

                    @error('kode_instrumen')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Nama Instrumen --}}
                <div>

                    <label
                        for="nama_instrumen"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Nama Instrumen
                    </label>

                    <input
                        type="text"
                        id="nama_instrumen"
                        name="nama_instrumen"
                        value="{{ old('nama_instrumen', $instrumen->nama_instrumen) }}"
                        placeholder="Masukkan nama instrumen"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required
                    >

                    @error('nama_instrumen')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Jenis Instrumen --}}
                <div>

                    <label
                        for="jenis_instrumen"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Jenis Instrumen
                    </label>

                    <select
                        id="jenis_instrumen"
                        name="jenis_instrumen"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required
                    >

                        <option value="">
                            Pilih jenis instrumen
                        </option>

                        <option
                            value="Pemantauan"
                            {{ old('jenis_instrumen', $instrumen->jenis_instrumen) === 'Pemantauan' ? 'selected' : '' }}
                        >
                            Pemantauan
                        </option>

                        <option
                            value="Evaluasi"
                            {{ old('jenis_instrumen', $instrumen->jenis_instrumen) === 'Evaluasi' ? 'selected' : '' }}
                        >
                            Evaluasi
                        </option>

                        <option
                            value="Monitoring"
                            {{ old('jenis_instrumen', $instrumen->jenis_instrumen) === 'Monitoring' ? 'selected' : '' }}
                        >
                            Monitoring
                        </option>

                    </select>

                    @error('jenis_instrumen')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label
                        for="status"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required
                    >

                        <option value="Draft"
                            {{ old('status', $instrumen->status) === 'Draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                        <option value="Aktif"
                            {{ old('status', $instrumen->status) === 'Aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="Selesai"
                            {{ old('status', $instrumen->status) === 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                    </select>

                    @error('status')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Jumlah Pertanyaan --}}
                <div>

                    <label
                        for="jumlah_pertanyaan"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Jumlah Pertanyaan
                    </label>

                    <input
                        type="number"
                        id="jumlah_pertanyaan"
                        name="jumlah_pertanyaan"
                        value="{{ old('jumlah_pertanyaan', $instrumen->jumlah_pertanyaan) }}"
                        min="0"
                        placeholder="Contoh: 40"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required
                    >

                    @error('jumlah_pertanyaan')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Capaian --}}
                <div>

                    <label
                        for="capaian"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Capaian (%)
                    </label>

                    <input
                        type="number"
                        id="capaian"
                        name="capaian"
                        value="{{ old('capaian', $instrumen->capaian) }}"
                        min="0"
                        max="100"
                        step="0.01"
                        placeholder="Contoh: 85.50"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required
                    >

                    @error('capaian')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


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
                        value="{{ old('tanggal_mulai', $instrumen->tanggal_mulai ? $instrumen->tanggal_mulai->format('Y-m-d') : '') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    @error('tanggal_mulai')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Tanggal Selesai --}}
                <div>

                    <label
                        for="tanggal_selesai"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Tanggal Selesai
                    </label>

                    <input
                        type="date"
                        id="tanggal_selesai"
                        name="tanggal_selesai"
                        value="{{ old('tanggal_selesai', $instrumen->tanggal_selesai ? $instrumen->tanggal_selesai->format('Y-m-d') : '') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                    @error('tanggal_selesai')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Deskripsi --}}
                <div class="md:col-span-2">

                    <label
                        for="deskripsi"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="5"
                        placeholder="Masukkan deskripsi instrumen..."
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >{{ old('deskripsi', $instrumen->deskripsi) }}</textarea>

                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Footer Form --}}
            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('instrumen.show', ['instrumen' => $instrumen->id]) }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection