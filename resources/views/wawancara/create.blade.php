@extends('layouts.app')

@section('title', 'Tambah Wawancara')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6 pb-8">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('wawancara.index') }}" class="hover:text-blue-600">
                        Wawancara
                    </a>
                    <span>/</span>
                    <span>Wawancara BCKS</span>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                   Instrumen Wawancara BCKS
                </h1>

                <p class="mt-2 text-sm text-slate-500">
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

        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold">Data belum dapat disimpan.</p>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('wawancara.store') }}" method="POST" class="space-y-6">
            @csrf


            {{-- A. IDENTITAS BCKS --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-6 py-5">
                    
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">
                            A. Identitas PesertaBCKS</h2>
                        <p class="text-sm text-slate-500">Lengkapi informasi mengenai peserta wawancara BCKS.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_bcks" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Peserta BCKS <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_bcks" name="nama_bcks" type="text" value="{{ old('nama_bcks') }}" required
                            maxlength="255" placeholder="Masukkan nama peserta BCKS"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_bcks')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_kerja_bcks" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja <span class="text-red-500">*</span>
                        </label>
                        <input id="unit_kerja_bcks" name="unit_kerja_bcks" type="text" value="{{ old('unit_kerja_bcks') }}"
                            required maxlength="255" placeholder="Masukkan unit kerja BCKS"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('unit_kerja_bcks')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="angkatan_pelatihan_bcks" class="mb-2 block text-sm font-semibold text-slate-700">
                            Angkatan Pelatihan BCKS <span class="text-red-500">*</span>
                        </label>
                        <input id="angkatan_pelatihan_bcks" name="angkatan_pelatihan_bcks" type="text"
                            value="{{ old('angkatan_pelatihan_bcks') }}" required maxlength="255"
                            placeholder="Contoh: Angkatan 1 Tahun 2025"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('angkatan_pelatihan_bcks')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- B. IDENTITAS RESPONDEN --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-6 py-5">
                   
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden</h2>
                        <p class="text-sm text-slate-500">Informasi pihak yang memberikan jawaban wawancara.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Responden <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_responden" name="nama_responden" type="text"
                            value="{{ old('nama_responden', old('nama_narasumber')) }}" required maxlength="255"
                            placeholder="Masukkan nama responden"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_responden')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_kerja_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja Responden <span class="text-red-500">*</span>
                        </label>
                        <input id="unit_kerja_responden" name="unit_kerja_responden" type="text"
                            value="{{ old('unit_kerja_responden') }}" required maxlength="255"
                            placeholder="Masukkan unit kerja responden"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('unit_kerja_responden')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="status_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Status Responden <span class="text-red-500">*</span>
                        </label>
                        <input id="status_responden" name="status_responden" type="text"
                            value="{{ old('status_responden', old('jabatan_narasumber')) }}" required maxlength="255"
                            placeholder="Contoh: Kepala Sekolah"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('status_responden')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- C. PETUGAS MONEV --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-6 py-5">
                   
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">C. Petugas Monev</h2>
                        <p class="text-sm text-slate-500">Identitas petugas dan tanggal evaluasi.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_petugas_monev" name="nama_petugas_monev" type="text"
                            value="{{ old('nama_petugas_monev', old('nama_pewawancara')) }}" required maxlength="255"
                            placeholder="Masukkan nama petugas"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_petugas_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_kerja_petugas" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja Petugas <span class="text-red-500">*</span>
                        </label>
                        <input id="unit_kerja_petugas" name="unit_kerja_petugas" type="text"
                            value="{{ old('unit_kerja_petugas') }}" required maxlength="255"
                            placeholder="Masukkan unit kerja petugas"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('unit_kerja_petugas')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="tanggal_evaluasi" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Evaluasi <span class="text-red-500">*</span>
                        </label>
                        <input id="tanggal_evaluasi" name="tanggal_evaluasi" type="date"
                            value="{{ old('tanggal_evaluasi') }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 md:max-w-md">
                        @error('tanggal_evaluasi')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- D. PERTANYAAN ESAI BCKS --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-slate-800">Hasil Wawancara BCKS</h2>
                            <p class="text-sm text-slate-500">
                                Lima pertanyaan esai untuk menggali pengalaman dan implementasi hasil pelatihan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 p-6">
                    @php
                        $pertanyaan = [
                            1 => [
                                'judul' => 'Dampak Implementasi RPTKS',
                                'isi' => 'Dari seluruh RPTKS (Rancangan Projek Integratif dan Transformatif Kepala Sekolah) yang Anda susun setelah pelatihan, apakah berdampak setelah diimplementasikan di sekolah? Apa kunci keberhasilannya?',
                                'placeholder' => 'Tuliskan jawaban narasumber secara lengkap...',
                            ],
                            2 => [
                                'judul' => 'Kendala dan Strategi Mitigasi',
                                'isi' => 'Kendala (sistem, anggaran, maupun resistensi SDM) apa yang Anda hadapi saat menerapkan Rancangan Projek tersebut? Bagaimana Anda mengatasinya?',
                                'placeholder' => 'Tuliskan kendala dan strategi penyelesaiannya...',
                            ],
                            3 => [
                                'judul' => 'Perubahan Kepemimpinan dan Pengambilan Keputusan',
                                'isi' => 'Bagaimana Anda merasakan perubahan pada cara Anda mengambil keputusan strategis dan mengelola konflik di sekolah setelah mengikuti pelatihan BCKS?',
                                'placeholder' => 'Tuliskan perubahan yang dirasakan narasumber...',
                            ],
                            4 => [
                                'judul' => 'Dukungan Lingkungan Sekolah',
                                'isi' => 'Sejauh mana dukungan dari Kepala Sekolah (saat ini), rekan guru, dan pengawas sekolah membantu Anda mengeksekusi ide-ide baru di sekolah?',
                                'placeholder' => 'Tuliskan bentuk dukungan dan pengaruhnya...',
                            ],
                            5 => [
                                'judul' => 'Keberlanjutan Program Inovasi',
                                'isi' => 'Bagaimana cara Anda memastikan program inovasi yang telah dimulai tetap berjalan berkelanjutan meskipun terjadi pergantian kepemimpinan atau personil?',
                                'placeholder' => 'Tuliskan strategi menjaga keberlanjutan program...',
                            ],
                        ];
                    @endphp

                    @foreach ($pertanyaan as $nomor => $item)
                        <div>
                            <div class="mb-3 flex items-start gap-3">
                                <span
                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-sm font-bold text-blue-700">
                                    {{ $nomor }}
                                </span>
                                <div>
                                    <h3 class="font-semibold text-slate-800">{{ $item['judul'] }}</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">{{ $item['isi'] }}</p>
                                </div>
                            </div>

                            <textarea name="jawaban_{{ $nomor }}" id="jawaban_{{ $nomor }}" rows="5"
                                placeholder="{{ $item['placeholder'] }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('jawaban_' . $nomor) }}</textarea>
                            @error('jawaban_' . $nomor)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if ($nomor < 5)
                            <div class="border-t border-slate-100"></div>
                        @endif
                    @endforeach
                </div>
            </section>

            {{-- E. CATATAN TAMBAHAN --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-bold text-slate-800">Catatan Tambahan</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Catat ringkasan dan informasi lain yang relevan dengan wawancara.
                    </p>
                </div>

                <div class="space-y-5 p-6">
                    <div>
                        <label for="hasil_wawancara" class="mb-2 block text-sm font-semibold text-slate-700">
                            Ringkasan Hasil Wawancara
                        </label>
                        <textarea id="hasil_wawancara" name="hasil_wawancara" rows="4"
                            placeholder="Masukkan ringkasan umum hasil wawancara..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('hasil_wawancara') }}</textarea>
                        @error('hasil_wawancara')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="catatan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Catatan Pewawancara
                        </label>
                        <textarea id="catatan" name="catatan" rows="3" placeholder="Masukkan catatan tambahan..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- TOMBOL AKSI --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
                    Simpan Wawancara
                </button>
            </div>
        </form>
    </div>
@endsection