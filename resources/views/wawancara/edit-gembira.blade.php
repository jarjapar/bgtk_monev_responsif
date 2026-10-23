@extends('layouts.app')

@section('title', 'Edit Wawancara Matematika GEMBIRA')
@section('page-title', 'Edit Wawancara Matematika GEMBIRA')

@section('content')
    @php
        $metadata = is_array($metadata ?? null) ? $metadata : [];
        $jawaban = $metadata['jawaban_terbuka'] ?? [];

        if (!is_array($jawaban)) {
            $jawaban = [];
        }

        $jawaban5 = $jawaban['5'] ?? [];

        if (is_string($jawaban5)) {
            $decoded = json_decode($jawaban5, true);
            $jawaban5 = is_array($decoded) ? $decoded : [];
        }

        if (!is_array($jawaban5)) {
            $jawaban5 = [];
        }

        $namaGuru = $metadata['nama_guru'] ?? $wawancara->nama_responden ?? '';
        $namaSekolah = $metadata['nama_sekolah'] ?? $wawancara->unit_kerja_responden ?? '';
        $tanggalMonev = $metadata['tanggal_monev']
            ?? ($wawancara->tanggal_wawancara
                ? \Illuminate\Support\Carbon::parse($wawancara->tanggal_wawancara)->format('Y-m-d')
                : now()->format('Y-m-d'));
    @endphp

    <div class="mx-auto max-w-6xl space-y-6 pb-8">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('wawancara.index') }}" class="hover:text-blue-600">
                        Wawancara
                    </a>
                    <span>/</span>
                    <span>Edit Wawancara Matematika GEMBIRA</span>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                    Edit Instrumen Wawancara Matematika GEMBIRA
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Perbarui identitas dan jawaban wawancara. Data sebelumnya telah diisi otomatis.
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

        <form action="{{ route('wawancara.update', $wawancara->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- A. IDENTITAS GURU DAN SEKOLAH --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-6 py-5">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">A. Identitas Guru dan Sekolah</h2>
                        <p class="text-sm text-slate-500">Informasi guru dan sekolah yang menjadi sasaran wawancara.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_guru" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Guru <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_guru" name="nama_guru" type="text" required
                            value="{{ old('nama_guru', $namaGuru) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_guru')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_sekolah" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Sekolah <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_sekolah" name="nama_sekolah" type="text" required
                            value="{{ old('nama_sekolah', $namaSekolah) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_sekolah')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kelas_fase" class="mb-2 block text-sm font-semibold text-slate-700">
                            Kelas / Fase
                        </label>
                        <input id="kelas_fase" name="kelas_fase" type="text"
                            value="{{ old('kelas_fase', $metadata['kelas_fase'] ?? '') }}"
                            placeholder="Contoh: Kelas IV / Fase B"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('kelas_fase')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="topik_materi" class="mb-2 block text-sm font-semibold text-slate-700">
                            Topik / Materi
                        </label>
                        <input id="topik_materi" name="topik_materi" type="text"
                            value="{{ old('topik_materi', $metadata['topik_materi'] ?? '') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('topik_materi')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- B. IDENTITAS RESPONDEN DAN PETUGAS MONEV --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-6 py-5">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden dan Petugas Monev</h2>
                        <p class="text-sm text-slate-500">Identitas penilai, petugas, dan tanggal pelaksanaan monitoring dan evaluasi.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_petugas_monev" name="nama_petugas_monev" type="text" required
                            value="{{ old('nama_petugas_monev', $wawancara->nama_petugas_monev) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_petugas_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="jabatan_penilai" class="mb-2 block text-sm font-semibold text-slate-700">
                            Jabatan Penilai <span class="text-red-500">*</span>
                        </label>
                        <select id="jabatan_penilai" name="jabatan_penilai" required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            <option value="">Pilih jabatan penilai</option>
                            @foreach ([
                                    'Peserta Matematika GEMBIRA',
                                    'Rekan sejawat',
                                    'Atasan langsung/Kepala Sekolah',
                                ] as $jabatan)
                                <option value="{{ $jabatan }}" @selected(old('jabatan_penilai', $metadata['jabatan_penilai'] ?? $wawancara->status_responden) === $jabatan)>
                                    {{ $jabatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan_penilai')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="tanggal_monev" name="tanggal_monev" type="date" required
                            value="{{ old('tanggal_monev', $tanggalMonev) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('tanggal_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="sumber_data_bukti" class="mb-2 block text-sm font-semibold text-slate-700">
                            Sumber Data / Bukti
                        </label>
                        <textarea id="sumber_data_bukti" name="sumber_data_bukti" rows="3"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('sumber_data_bukti', $metadata['sumber_data_bukti'] ?? '') }}</textarea>
                        @error('sumber_data_bukti')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- C. PERTANYAAN WAWANCARA TERBUKA --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 px-6 py-5">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">C. Pertanyaan Wawancara Terbuka</h2>
                        <p class="text-sm text-slate-500">Periksa dan perbarui jawaban wawancara di bawah ini.</p>
                    </div>
                </div>

                <div class="space-y-6 p-6">
                    @foreach ([
                            '1' => 'Bagaimana pengalaman Anda selama mengikuti Pelatihan Matematika Gembira?',
                            '2' => 'Kendala apa yang Anda alami selama mengikuti pelatihan?',
                            '3' => 'Bagaimana pemahaman Anda tentang pembelajaran matematika berubah setelah mengikuti pelatihan?',
                            '4' => 'Ceritakan contoh konkret kegiatan pembelajaran matematika yang telah Anda lakukan dengan menerapkan hasil pelatihan!',
                        ] as $nomor => $pertanyaan)
                        <div>
                            <div class="mb-3 flex items-start gap-3">
                                <span class="text-lg font-bold text-slate-800">{{ $nomor }}</span>
                                <label for="jawaban_{{ $nomor }}" class="font-semibold leading-6 text-slate-800">
                                    {{ $pertanyaan }} <span class="text-red-500">*</span>
                                </label>
                            </div>

                            <textarea id="jawaban_{{ $nomor }}" name="jawaban_{{ $nomor }}" rows="5" required
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('jawaban_' . $nomor, $jawaban[$nomor] ?? $wawancara->{'jawaban_' . $nomor} ?? '') }}</textarea>
                            @error('jawaban_' . $nomor)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="border-t border-slate-100"></div>
                    @endforeach

                    <div class="mb-3 flex items-start gap-3">
                        <span class="text-lg font-bold text-slate-800">5</span>
                        <div>
                            <h3 class="font-semibold text-slate-800">
                                Perubahan yang diamati setelah penerapan Matematika GEMBIRA
                            </h3>
                            <p class="mt-1 text-sm leading-6 text-slate-600">Perbarui setiap aspek berikut.</p>
                        </div>
                    </div>

                    @foreach ([
                            'a' => 'Keterlibatan dan keaktifan peserta didik',
                            'b' => 'Motivasi dan rasa percaya diri',
                            'c' => 'Pemahaman konsep',
                            'd' => 'Kemampuan pemecahan masalah',
                            'e' => 'Komunikasi dan kolaborasi',
                        ] as $huruf => $pertanyaan)
                        <div>
                            <label for="jawaban_5_{{ $huruf }}" class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ $huruf }}. {{ $pertanyaan }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="jawaban_5_{{ $huruf }}" name="jawaban_5_{{ $huruf }}" rows="3" required
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('jawaban_5_' . $huruf, $jawaban5[$huruf] ?? '') }}</textarea>
                            @error('jawaban_5_' . $huruf)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <div class="border-t border-slate-100"></div>

                    <div>
                        <div class="mb-3 flex items-start gap-3">
                            <span class="text-lg font-bold text-slate-800">6</span>
                            <label for="jawaban_6" class="font-semibold leading-6 text-slate-800">
                                Apakah ada peningkatan kemampuan numerasi murid setelah penerapan Matematika GEMBIRA? Jika
                                ada, jelaskan! <span class="text-red-500">*</span>
                            </label>
                        </div>
                        <textarea id="jawaban_6" name="jawaban_6" rows="5" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('jawaban_6', $jawaban['6'] ?? '') }}</textarea>
                        @error('jawaban_6')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-slate-100"></div>

                    <div>
                        <div class="mb-3 flex items-start gap-3">
                            <span class="text-lg font-bold text-slate-800">7</span>
                            <label for="jawaban_7" class="font-semibold leading-6 text-slate-800">
                                Berikan saran dan masukan untuk pelatihan Matematika GEMBIRA?
                                <span class="text-red-500">*</span>
                            </label>
                        </div>
                        <textarea id="jawaban_7" name="jawaban_7" rows="5" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('jawaban_7', $jawaban['7'] ?? '') }}</textarea>
                        @error('jawaban_7')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- D. CATATAN TAMBAHAN --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">D. Catatan Tambahan</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Catat informasi lain yang relevan dengan wawancara.
                    </p>
                </div>

                <div class="space-y-5 p-6">
                    <div>
                        <label for="catatan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Catatan tambahan (opsional)
                        </label>
                        <textarea id="catatan" name="catatan" rows="3" placeholder="Masukkan catatan tambahan..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('catatan', $wawancara->catatan) }}</textarea>
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
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection