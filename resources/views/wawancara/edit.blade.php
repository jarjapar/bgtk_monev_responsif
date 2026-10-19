@extends('layouts.app')

@section('title', 'Edit Wawancara BCKS')
@section('page-title', 'Edit Wawancara BCKS')

@section('content')
    @php
        $pertanyaan = [
            1 => [
                'judul' => 'Dampak Implementasi RPTKS',
                'isi' => 'Dari seluruh RPTKS (Rancangan Projek Integratif dan Transformatif Kepala Sekolah) yang Anda susun setelah pelatihan, apakah berdampak setelah diimplementasikan di sekolah? Apa kunci keberhasilannya?',
            ],
            2 => [
                'judul' => 'Kendala dan Strategi Mitigasi',
                'isi' => 'Kendala (sistem, anggaran, maupun resistensi SDM) apa yang Anda hadapi saat menerapkan Rancangan Projek tersebut? Bagaimana Anda mengatasinya?',
            ],
            3 => [
                'judul' => 'Perubahan Kepemimpinan dan Pengambilan Keputusan',
                'isi' => 'Bagaimana Anda merasakan perubahan pada cara Anda mengambil keputusan strategis dan mengelola konflik di sekolah setelah mengikuti pelatihan BCKS?',
            ],
            4 => [
                'judul' => 'Dukungan Lingkungan Sekolah',
                'isi' => 'Sejauh mana dukungan dari Kepala Sekolah (saat ini), rekan guru, dan pengawas sekolah membantu Anda mengeksekusi ide-ide baru di sekolah?',
            ],
            5 => [
                'judul' => 'Keberlanjutan Program Inovasi',
                'isi' => 'Bagaimana cara Anda memastikan program inovasi yang telah dimulai tetap berjalan berkelanjutan meskipun terjadi pergantian kepemimpinan atau personil?',
            ],
        ];
    @endphp

    <div class="mx-auto max-w-6xl space-y-6 pb-10">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('wawancara.index') }}" class="hover:text-blue-600">
                        Wawancara
                    </a>
                    <span>/</span>
                    <span>Edit BCKS</span>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                    Edit Wawancara BCKS
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Perbarui identitas pelaksanaan, responden, petugas Monev, dan jawaban wawancara.
                </p>
            </div>
            <a href="{{ route('wawancara.show', $wawancara->id) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- Informasi --}}
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-4">
            <div class="flex gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 110-20 10 10 0 010 20z" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-blue-900">Perubahan data wawancara</p>
                    <p class="mt-1 text-sm leading-6 text-blue-800">
                        Perubahan hanya diterapkan setelah tombol Simpan Perubahan dipilih.
                        Periksa kembali jawaban sebelum menyimpan.
                    </p>
                </div>
            </div>
        </div>

        {{-- Validasi --}}
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

        <form action="{{ route('wawancara.update', $wawancara->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Identitas BCKS --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 font-bold text-indigo-700">
                            02
                        </div>
                        <div>
                            <h2 class="font-bold text-slate-800">Identitas BCKS</h2>
                            <p class="mt-1 text-sm text-slate-500">
                                Data peserta bakal calon kepala sekolah.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    @foreach ([
                            'nama_bcks' => 'Nama BCKS',
                            'unit_kerja_bcks' => 'Unit Kerja BCKS',
                            'angkatan_pelatihan_bcks' => 'Angkatan Pelatihan BCKS',
                        ] as $field => $label)
                        <div class="{{ $field === 'angkatan_pelatihan_bcks' ? 'md:col-span-2' : '' }}">
                            <label for="{{ $field }}" class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ $label }} <span class="text-red-500">*</span>
                            </label>

                            <input id="{{ $field }}" name="{{ $field }}" type="text" required maxlength="255"
                                value="{{ old($field, $wawancara->{$field}) }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            @error($field)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Identitas responden --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-100 font-bold text-violet-700">
                            03
                        </div>
                        <div>
                            <h2 class="font-bold text-slate-800">Identitas Responden</h2>
                            <p class="mt-1 text-sm text-slate-500">
                                Data pihak yang memberikan informasi evaluasi.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    @foreach ([
                            'nama_responden' => 'Nama Responden',
                            'unit_kerja_responden' => 'Unit Kerja Responden',
                            'status_responden' => 'Status Responden',
                        ] as $field => $label)
                        <div class="{{ $field === 'status_responden' ? 'md:col-span-2' : '' }}">
                            <label for="{{ $field }}" class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ $label }} <span class="text-red-500">*</span>
                            </label>

                            <input id="{{ $field }}" name="{{ $field }}" type="text" required maxlength="255"
                                value="{{ old($field, $wawancara->{$field} ?: ($field === 'nama_responden' ? $wawancara->nama_narasumber : ($field === 'status_responden' ? $wawancara->jabatan_narasumber : ''))) }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            @error($field)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Petugas Monev --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 font-bold text-emerald-700">
                            04
                        </div>
                        <div>
                            <h2 class="font-bold text-slate-800">Petugas Monitoring dan Evaluasi</h2>
                            <p class="mt-1 text-sm text-slate-500">
                                Identitas petugas yang melaksanakan kegiatan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>

                        <input id="nama_petugas_monev" name="nama_petugas_monev" type="text" required maxlength="255"
                            value="{{ old('nama_petugas_monev', $wawancara->nama_petugas_monev ?: $wawancara->nama_pewawancara) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('nama_petugas_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Monitoring dan Evaluasi --}}
                    <div class="grid grid-cols-1 gap-5 px-6 pb-6 md:grid-cols-2">
                        <div>
                            <label for="tanggal_evaluasi" class="mb-2 block text-sm font-semibold text-slate-700">
                                Tanggal Monitoring dan Evaluasi
                                <span class="text-red-500">*</span>
                            </label>

                            <input id="tanggal_evaluasi" name="tanggal_evaluasi" type="date" required
                                value="{{ old('tanggal_evaluasi', optional($wawancara->tanggal_evaluasi)->format('Y-m-d') ?? optional($wawancara->tanggal_wawancara)->format('Y-m-d')) }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            @error('tanggal_evaluasi')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="unit_kerja_petugas" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja Petugas <span class="text-red-500">*</span>
                        </label>

                        <input id="unit_kerja_petugas" name="unit_kerja_petugas" type="text" required maxlength="255"
                            value="{{ old('unit_kerja_petugas', $wawancara->unit_kerja_petugas) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('unit_kerja_petugas')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </section>

            {{-- Jawaban esai --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 font-bold text-amber-700">
                            05
                        </div>
                        <div>
                            <h2 class="font-bold text-slate-800">Jawaban Wawancara BCKS</h2>
                            <p class="mt-1 text-sm text-slate-500">
                                Periksa dan perbarui jawaban untuk setiap pertanyaan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-7 p-6">
                    @foreach ($pertanyaan as $nomor => $item)
                        <div>
                            <label for="jawaban_{{ $nomor }}" class="block text-base font-bold text-slate-800">
                                {{ $nomor }}. {{ $item['judul'] }}
                            </label>

                            <p class="mt-2 text-sm leading-6 text-slate-600">
                                {{ $item['isi'] }}
                            </p>

                            <textarea id="jawaban_{{ $nomor }}" name="jawaban_{{ $nomor }}" rows="5"
                                class="mt-3 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                placeholder="Tuliskan jawaban wawancara di sini...">{{ old('jawaban_' . $nomor, $wawancara->{'jawaban_' . $nomor}) }}</textarea>

                            @error('jawaban_' . $nomor)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if (!$loop->last)
                            <div class="border-t border-slate-100"></div>
                        @endif
                    @endforeach
                </div>
            </section>

            {{-- Ringkasan dan catatan --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="font-bold text-slate-800">Ringkasan dan Catatan</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi tambahan hasil monitoring dan evaluasi.
                    </p>
                </div>

                <div class="space-y-5 p-6">
                    <div>
                        <label for="hasil_wawancara" class="mb-2 block text-sm font-semibold text-slate-700">
                            Ringkasan Hasil Wawancara
                        </label>

                        <textarea id="hasil_wawancara" name="hasil_wawancara" rows="4"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            placeholder="Tuliskan ringkasan hasil wawancara...">{{ old('hasil_wawancara', $wawancara->hasil_wawancara) }}</textarea>

                        @error('hasil_wawancara')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="catatan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Catatan Tambahan
                        </label>

                        <textarea id="catatan" name="catatan" rows="3"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                            placeholder="Tuliskan catatan tambahan jika ada...">{{ old('catatan', $wawancara->catatan) }}</textarea>

                        @error('catatan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- Tombol aksi --}}
            <div
                class="sticky bottom-0 z-10 -mx-2 flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50/95 p-4 backdrop-blur sm:flex-row sm:justify-end">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection