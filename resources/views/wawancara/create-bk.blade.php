@extends('layouts.app')

@section('content')

    <div class="mx-auto max-w-7xl space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('wawancara.index') }}" class="hover:text-blue-600">
                        Wawancara
                    </a>
                    <span>/</span>
                    <span>Wawancara BK</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Instrumen Wawancara BK
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Lengkapi identitas, tanggal evaluasi, dan hasil wawancara.
                </p>
            </div>

            <a href="{{ route('wawancara.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- PETUNJUK --}}
        <section class="overflow-hidden rounded-2xl bg-white shadow-sm"
            style="border: 1px solid #e2e8f0; border-left: 4px solid #2563eb;">

            <div class="p-6">
                <h2 class="text-lg font-bold text-slate-800">
                    Panduan Wawancara BK
                </h2>

                <p class="mt-1 text-sm leading-6 text-slate-500">
                    Isilah identitas dan tuliskan jawaban berdasarkan hasil wawancara
                    dengan responden secara jelas dan sesuai fakta.
                </p>
            </div>
        </section>

        {{-- PESAN VALIDASI --}}
        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">
                <p class="font-semibold text-red-800">
                    Pengisian belum dapat disimpan.
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('wawancara.bk.store') }}" method="POST" class="space-y-6">

            @csrf

            {{-- IDENTITAS PETUGAS --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">
                        A. Identitas Petugas Monev
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Informasi petugas pelaksana monitoring dan evaluasi.
                    </p>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">

                    <div>
                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>

                        <input type="text" id="nama_petugas_monev" name="nama_petugas_monev"
                            placeholder="Masukkan nama petugas" value="{{ old('nama_petugas_monev') }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="instansi_petugas" class="mb-2 block text-sm font-semibold text-slate-700">
                            Instansi
                        </label>

                        <input type="text" id="instansi_petugas" name="instansi_petugas"
                            value="{{ old('instansi_petugas') }}" placeholder="Masukkan instansi"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="lokasi_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Lokasi Monev
                        </label>

                        <input type="text" id="lokasi_monev" name="lokasi_monev" value="{{ old('lokasi_monev') }}"
                            placeholder="Masukkan lokasi Monev"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="tanggal_wawancara" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Wawancara <span class="text-red-500">*</span>
                        </label>

                        <input type="date" id="tanggal_wawancara" name="tanggal_wawancara"
                            value="{{ old('tanggal_wawancara', date('Y-m-d')) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                </div>
            </section>

            {{-- IDENTITAS RESPONDEN --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">
                        B. Identitas Responden
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Tanda bintang (*) menunjukkan kolom wajib diisi.
                    </p>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">

                    <div>
                        <label for="nama_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Responden <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_responden" name="nama_responden" value="{{ old('nama_responden') }}"
                            required placeholder="Masukkan nama responden"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>


                    <div>
                        <label for="jabatan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Jabatan Responden
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="jabatan" name="jabatan" required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            <option value="" disabled @selected(old('jabatan', $wawancara->jabatan ?? '') === '')>
                                Pilih jabatan
                            </option>

                            <option value="BK" @selected(old('jabatan', $wawancara->jabatan ?? '') === 'BK')>
                                BK
                            </option>

                            <option value="Kepala Sekolah" @selected(old('jabatan', $wawancara->jabatan ?? '') === 'Kepala Sekolah')>
                                Kepala Sekolah
                            </option>

                            <option value="Rekan Sejawat" @selected(old('jabatan', $wawancara->jabatan ?? '') === 'Rekan Sejawat')>
                                Rekan Sejawat
                            </option>

                            <option value="Peserta Didik" @selected(old('jabatan', $wawancara->jabatan ?? '') === 'Peserta Didik')>
                                Peserta Didik
                            </option>
                        </select>

                        @error('jabatan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="satuan_pendidikan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Satuan Pendidikan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="satuan_pendidikan" name="satuan_pendidikan"
                            value="{{ old('satuan_pendidikan') }}" required placeholder="Masukkan satuan pendidikan"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="masa_kerja" class="mb-2 block text-sm font-semibold text-slate-700">
                            Masa Kerja (tahun) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="masa_kerja" name="masa_kerja" min="0" step="1"
                            value="{{ old('masa_kerja') }}" required placeholder="Masukkan masa kerja dalam tahun"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="nama_kegiatan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Kegiatan/Pelatihan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}"
                            required placeholder="Masukkan nama kegiatan/pelatihan"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="tanggal_pengisian" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Pengisian <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal_pengisian" name="tanggal_pengisian"
                            value="{{ old('tanggal_pengisian', date('Y-m-d')) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                </div>
            </section>

            {{-- PERTANYAAN WAWANCARA --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">
                        C. Hasil Wawancara BK
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Bagian B — Pertanyaan terbuka.
                    </p>
                </div>

                @php
                    $pertanyaanWawancara = [
                        1 => 'Apa saja hambatan yang Anda hadapi selama mengikuti pelatihan ini?',
                        2 => 'Hal baik apa saja yang harus dipertahankan dalam pelaksanaan pelatihan ini?',
                        3 => 'Saran apa yang dapat Anda berikan untuk peningkatan dan keberlanjutan program ini?',
                    ];
                @endphp

                <div class="space-y-6 p-6">

                    @foreach ($pertanyaanWawancara as $nomor => $pertanyaan)
                        <div>
                            <label for="jawaban_{{ $nomor }}" class="mb-3 block text-sm font-semibold leading-6 text-slate-700">
                                {{ $nomor }}. {{ $pertanyaan }}
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea id="jawaban_{{ $nomor }}" name="jawaban_wawancara[{{ $nomor }}]" rows="5" required
                                placeholder="Tuliskan jawaban responden..."
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old("jawaban_wawancara.{$nomor}") }}</textarea>
                        </div>
                    @endforeach

                </div>
            </section>

            {{-- TOMBOL --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Simpan Wawancara
                </button>

            </div>

        </form>

    </div>

@endsection