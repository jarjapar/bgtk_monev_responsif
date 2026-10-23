@extends('layouts.app')

@section('title', 'Edit Pengisian BCKS')
@section('page-title', 'Edit Pengisian BCKS')

@section('content')

    @php
        $levels = config('bcks.instrumen.levels', []);

        $statusAwal = old('status_responden', $bcksPengisian->status_responden);

        $jawabanByNomor = $bcksPengisian->jawaban->keyBy('nomor_indikator');

        /*
         * Rubrik penilaian per level (sumber: Instrumen Monev BCKS - Rev update).
         * Kunci array = urutan level pada $levels (1 sampai 4).
         */
        $rubrik = [
            1 => [
                'judul' => 'Level 1 Reaksi (Reaction)',
                'deskripsi' => 'Mengukur tingkat kepuasan dan persepsi peserta terhadap penyelenggaraan pelatihan.',
                'skor' => [
                    1 => ['kategori' => 'Sangat Kurang', 'kriteria' => 'Peserta menilai materi tidak relevan, metode membosankan/tidak jelas, fasilitator kurang menguasai materi, dan fasilitas/layanan pelatihan sangat menghambat.'],
                    2 => ['kategori' => 'Kurang', 'kriteria' => 'Materi kurang teoretis/aplikatif, metode kurang variatif, penyampaian fasilitator sebatas ceramah, serta fasilitas hanya memenuhi kebutuhan minimal.'],
                    3 => ['kategori' => 'Baik', 'kriteria' => 'Materi relevan dengan kebutuhan sekolah, metode interaktif (simulasi/studi kasus berjalan baik), fasilitator menguasai materi, dan fasilitas memadai.'],
                    4 => ['kategori' => 'Sangat Baik', 'kriteria' => 'Materi sangat kontekstual dengan masalah nyata sekolah, metode sangat kontekstual dan komunikatif, fasilitator highly inspiring, serta fasilitas/LMS sangat mendukung.'],
                ],
            ],
            2 => [
                'judul' => 'Level 2 Pembelajaran (Learning)',
                'deskripsi' => 'Mengukur tingkat pemahaman konseptual, kesiapan mental, dan perubahan growth mindset.',
                'skor' => [
                    1 => ['kategori' => 'Sangat Kurang', 'kriteria' => 'Tidak ada peningkatan pemahaman konseptual, tidak percaya diri memimpin, ragu terhadap perubahan, dan tidak menunjukkan peningkatan disiplin.'],
                    2 => ['kategori' => 'Kurang', 'kriteria' => 'Memahami konsep dasar tetapi masih bingung dalam penerapannya, rasa percaya diri masih rendah, serta growth mindset hanya tampak saat didorong.'],
                    3 => ['kategori' => 'Baik', 'kriteria' => 'Mampu memahami konsep kepemimpinan dengan baik, memiliki kepercayaan diri memimpin perubahan, memiliki growth mindset cukup kuat serta menunjukkan komitmen kedisiplinan yang konsisten.'],
                    4 => ['kategori' => 'Sangat Baik', 'kriteria' => 'Menguasai pemahaman konseptual secara mendalam, sangat siap dan percaya diri menjadi agen perubahan, memiliki growth mindset kuat, serta menjadi teladan kedisiplinan.'],
                ],
            ],
            3 => [
                'judul' => 'Level 3 Perubahan Perilaku dan Penerapan Kompetensi (Behavior)',
                'deskripsi' => 'Mengukur penerapan kompetensi pelatihan dalam praktik kepemimpinan sehari-hari di sekolah.',
                'skor' => [
                    1 => ['kategori' => 'Belum Tampak', 'kriteria' => 'BCKS belum menerapkan materi/kompetensi pelatihan sama sekali dalam praktik kerja sehari-hari di sekolah.'],
                    2 => ['kategori' => 'Mulai Tampak', 'kriteria' => 'Menerapkan kompetensi secara terbatas, belum konsisten, dan masih memerlukan arahan atau bimbingan intensif dari pengawas/kepala sekolah.'],
                    3 => ['kategori' => 'Konsisten', 'kriteria' => 'Menerapkan kompetensi kepemimpinan, perencanaan berbasis data, dan coaching secara mandiri, rutin, serta sesuai standar operasional.'],
                    4 => ['kategori' => 'Membudaya / Inovatif', 'kriteria' => 'Menerapkan kompetensi hingga menjadi budaya kerja, menciptakan inovasi program baru, dan mampu membimbing (mentoring) guru atau sejawat lain.'],
                ],
            ],
            4 => [
                'judul' => 'Level 4 Hasil atau Dampak Organisasi (Results)',
                'deskripsi' => 'Mengukur perubahan nyata pada mutu sekolah, budaya kerja, dan kepuasan layanan.',
                'skor' => [
                    1 => ['kategori' => 'Belum Terlihat', 'kriteria' => 'Belum ada perubahan positif pada mutu pembelajaran, budaya kerja guru, maupun tata kelola sekolah pascapelatihan.'],
                    2 => ['kategori' => 'Terlihat Sebagian', 'kriteria' => 'Terjadi perubahan kecil pada unit kerja tertentu, namun belum berdampak pada peningkatan mutu sekolah secara menyeluruh.'],
                    3 => ['kategori' => 'Terlihat Jelas', 'kriteria' => 'Perubahan positif terbukti pada indikator utama sekolah (seperti skor Rapor Pendidikan naik, efisiensi operasional meningkat, kolaborasi guru terbangun).'],
                    4 => ['kategori' => 'Terdampak luas dan berkelanjutan', 'kriteria' => 'Perubahan berdampak luas pada seluruh warga sekolah, tercipta jejaring kemitraan kuat, kepuasan pemangku kepentingan tinggi, dan program inovasi berjalan secara berkelanjutan.'],
                ],
            ],
        ];
    @endphp

    <div class="space-y-6">

        {{-- HEADER HALAMAN --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <nav class="flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('instrumen.index') }}" class="transition hover:text-blue-600">Instrumen</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-medium text-slate-700">Edit BCKS Instrumen</span>
                </nav>

                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Instrumen Monev BCKS
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Perbarui identitas responden dan jawaban instrumen sesuai status responden.
                </p>
            </div>

            <a href="{{ route('bcks.show', $bcksPengisian) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- INFORMASI INSTRUMEN & PROGRESS --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_280px]">

                {{-- INFORMASI INSTRUMEN --}}
                <div class="border-l-4 border-blue-600 p-5 sm:p-6">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <div class="min-w-0">
                            <h2 class="text-lg font-bold text-slate-900">
                                Instrumen Monitoring dan Evaluasi BCKS
                            </h2>

                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Instrumen ini digunakan untuk mengevaluasi efektivitas
                                pelatihan dan dampak penerapan kompetensi
                                Bakal Calon Kepala Sekolah (BCKS).
                            </p>
                        </div>
                    </div>

                    {{-- PETUNJUK --}}
                    <div class="mt-5 rounded-xl border border-dashed border-blue-200 bg-blue-50/50 px-4 py-3">
                        <div class="flex items-start gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-blue-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                            </svg>

                            <div class="min-w-0 text-xs leading-5 text-slate-600">
                                <p class="font-semibold text-blue-700">
                                    Petunjuk pengisian
                                </p>

                                <p class="mt-0.5">
                                    Bacalah setiap indikator dan rubrik penilaian,
                                    kemudian tentukan skor
                                    <strong>1, 2, 3, atau 4</strong>
                                    sesuai dengan kondisi riil di lapangan.
                                    Pastikan seluruh butir penilaian yang berlaku sesuai status responden telah diisi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PROGRESS PENGISIAN --}}
                <div class="border-t border-slate-200 bg-slate-50/70 p-5 sm:p-6 lg:border-l lg:border-t-0">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">
                            Progres pengisian
                        </span>

                        <span id="bcks-progress-percent" class="text-xs font-bold text-blue-600">
                            0%
                        </span>
                    </div>

                    <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-200">
                        <div id="bcks-progress-bar" class="h-full rounded-full bg-blue-600 transition-all duration-300"
                            style="width: 0%"></div>
                    </div>

                    <div class="mt-2 flex items-center justify-between">
                        <span id="bcks-progress-text" class="text-sm font-bold text-slate-900">
                            0 / 27 butir
                        </span>

                        <span class="text-xs text-slate-400">
                            Penilaian
                        </span>
                    </div>

                    <div class="mt-5 border-t border-slate-200 pt-4">
                        <p class="text-xs font-medium text-slate-500">
                            Skor sementara
                        </p>

                        <p id="bcks-score-text" class="mt-1 text-sm font-bold text-slate-900">
                            Belum ada penilaian
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- VALIDATION ERROR --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">
                <p class="text-sm font-bold text-red-800">
                    Terdapat kesalahan pada pengisian:
                </p>

                <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM UTAMA --}}
        <form action="{{ route('bcks.update', $bcksPengisian) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- A. IDENTITAS PESERTA BCKS --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">A. Identitas Peserta BCKS</h2>
                        <p class="text-sm text-slate-500">Lengkapi informasi mengenai peserta BCKS yang dievaluasi.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_bcks" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Peserta BCKS <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_bcks" name="nama_bcks" type="text"
                            value="{{ old('nama_bcks', $bcksPengisian->nama_bcks) }}" required
                            placeholder="Masukkan nama peserta BCKS"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_bcks')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_kerja" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja
                        </label>
                        <input id="unit_kerja" name="unit_kerja" type="text"
                            value="{{ old('unit_kerja', $bcksPengisian->unit_kerja) }}"
                            placeholder="Masukkan unit kerja BCKS"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('unit_kerja')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="angkatan_pelatihan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Angkatan Pelatihan BCKS
                        </label>
                        <input id="angkatan_pelatihan" name="angkatan_pelatihan" type="text"
                            value="{{ old('angkatan_pelatihan', $bcksPengisian->angkatan_pelatihan) }}"
                            placeholder="Contoh: Angkatan 1 Tahun 2025"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('angkatan_pelatihan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- B. IDENTITAS RESPONDEN --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden</h2>
                        <p class="text-sm text-slate-500">Informasi pihak yang memberikan jawaban.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Responden <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_responden" name="nama_responden" type="text"
                            value="{{ old('nama_responden', $bcksPengisian->nama_responden) }}" required
                            placeholder="Masukkan nama responden"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_responden')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_kerja_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja Responden
                        </label>
                        <input id="unit_kerja_responden" name="unit_kerja_responden" type="text"
                            value="{{ old('unit_kerja_responden', $bcksPengisian->unit_kerja_responden) }}"
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

                        <select id="status_responden" name="status_responden" required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <option value="">Pilih status responden</option>

                            <option value="BCKS" @selected($statusAwal === 'BCKS')>
                                BCKS
                            </option>

                            <option value="Atasan Langsung / Pengawas Sekolah" @selected($statusAwal === 'Atasan Langsung / Pengawas Sekolah')>
                                Atasan Langsung / Kepala Sekolah
                            </option>

                            <option value="Perwakilan Guru / Tenaga Kependidikan" @selected($statusAwal === 'Perwakilan Guru / Tenaga Kependidikan')>
                                Guru / Tenaga Kependidikan
                            </option>
                        </select>

                        @error('status_responden')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- C. PETUGAS MONEV --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">C. Petugas Monev</h2>
                        <p class="text-sm text-slate-500">Identitas petugas dan tanggal evaluasi.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-3">
                    <div>
                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_petugas_monev" name="nama_petugas_monev" type="text"
                            value="{{ old('nama_petugas_monev', $bcksPengisian->nama_petugas_monev) }}" required
                            placeholder="Masukkan nama petugas"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_petugas_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_kerja_petugas" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja Petugas
                        </label>
                        <input id="unit_kerja_petugas" name="unit_kerja_petugas" type="text"
                            value="{{ old('unit_kerja_petugas', $bcksPengisian->unit_kerja_petugas) }}"
                            placeholder="Masukkan unit kerja petugas"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('unit_kerja_petugas')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_evaluasi" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Evaluasi <span class="text-red-500">*</span>
                        </label>
                        <input id="tanggal_evaluasi" name="tanggal_evaluasi" type="date"
                            value="{{ old('tanggal_evaluasi', $bcksPengisian->tanggal_evaluasi?->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('tanggal_evaluasi')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- D. PENILAIAN --}}
            <div class="space-y-6">

                @foreach ($levels as $levelKey => $level)

                    <div data-bcks-level="{{ $loop->iteration }}"
                        class="bcks-level-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-opacity duration-200">

                        {{-- HEADER LEVEL --}}
                        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                            <h2 class="text-lg font-bold text-slate-800">
                                {{ $level['label'] }}
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Pilih satu skor untuk setiap indikator.
                            </p>
                        </div>

                        {{-- TABLE --}}
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[900px] border-collapse">
                                <thead>
                                    <tr class="bg-slate-100">
                                        <th
                                            class="w-20 border-b border-slate-200 px-4 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                            No
                                        </th>

                                        <th
                                            class="border-b border-slate-200 px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                            Pertanyaan / Indikator
                                        </th>

                                        @for ($nilai = 1; $nilai <= 4; $nilai++)
                                            <th
                                                class="w-20 border-b border-slate-200 px-3 py-3 text-center text-xs font-bold text-slate-500">
                                                {{ $nilai }}
                                            </th>
                                        @endfor
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-100">
                                    @foreach (($level['indikator'] ?? []) as $indikator)

                                        @php
                                            $kodeForm = str_replace('.', '_', $indikator['kode']);

                                            [$levelNumber, $nomor] = explode('.', $indikator['kode']);

                                            $nomorIndikator = match ($levelNumber) {
                                                '1' => (int) $nomor,
                                                '2' => 4 + (int) $nomor,
                                                '3' => 8 + (int) $nomor,
                                                '4' => 20 + (int) $nomor,
                                                default => null,
                                            };

                                            $skorLama = $nomorIndikator !== null
                                                ? ($jawabanByNomor[$nomorIndikator]->skor ?? null)
                                                : null;

                                            $skorSekarang = old('skor.' . $kodeForm, $skorLama);
                                        @endphp

                                        <tr class="transition hover:bg-slate-50">
                                            <td class="px-4 py-4 text-center text-sm font-semibold text-slate-600">
                                                {{ $indikator['kode'] }}
                                            </td>

                                            <td class="px-5 py-4 text-sm leading-6 text-slate-700">
                                                {{ $indikator['pertanyaan'] }}
                                            </td>

                                            @for ($nilai = 1; $nilai <= 4; $nilai++)
                                                <td class="px-3 py-4 text-center">
                                                    <label class="inline-flex cursor-pointer items-center justify-center">
                                                        <input type="radio" name="skor[{{ $kodeForm }}]" value="{{ $nilai }}"
                                                            @checked((string) $skorSekarang === (string) $nilai)
                                                            class="h-5 w-5 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-200">
                                                    </label>
                                                </td>
                                            @endfor
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- RUBRIK PENILAIAN LEVEL --}}
                        @if (isset($rubrik[$loop->iteration]))

                            @php
                                $rubrikLevel = $rubrik[$loop->iteration];
                            @endphp

                            <div class="border-t border-slate-200 bg-slate-50/70 px-6 py-5">

                                <div class="flex items-start gap-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                                    </svg>

                                    <div class="min-w-0">
                                        <h3 class="text-sm font-bold text-slate-800">
                                            Rubrik {{ $rubrikLevel['judul'] }}
                                        </h3>

                                        <p class="mt-0.5 text-xs leading-5 text-slate-500">
                                            {{ $rubrikLevel['deskripsi'] }}
                                            Gunakan kriteria berikut sebagai acuan menentukan skor 1 sampai 4.
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 overflow-x-auto rounded-xl border border-slate-200 bg-white">
                                    <table class="w-full min-w-[640px] border-collapse">
                                        <thead>
                                            <tr class="bg-slate-100">
                                                <th
                                                    class="w-20 border-b border-slate-200 px-4 py-2.5 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                                    Skor
                                                </th>

                                                <th
                                                    class="w-48 border-b border-slate-200 px-4 py-2.5 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                                    Kategori
                                                </th>

                                                <th
                                                    class="border-b border-slate-200 px-4 py-2.5 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                                    Kriteria Penilaian
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-slate-100">
                                            @foreach ($rubrikLevel['skor'] as $skor => $itemRubrik)
                                                <tr class="align-top">
                                                    <td class="px-4 py-3 text-center">
                                                        <span
                                                            class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-blue-50 text-xs font-bold text-blue-700">
                                                            {{ $skor }}
                                                        </span>
                                                    </td>

                                                    <td class="px-4 py-3 text-sm font-semibold text-slate-700">
                                                        {{ $itemRubrik['kategori'] }}
                                                    </td>

                                                    <td class="px-4 py-3 text-sm leading-6 text-slate-600">
                                                        {{ $itemRubrik['kriteria'] }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

            {{-- BUTTON --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

    {{-- JAVASCRIPT PROGRESS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.getElementById('status_responden');

            const progressBar = document.getElementById('bcks-progress-bar');
            const progressPercent = document.getElementById('bcks-progress-percent');
            const progressText = document.getElementById('bcks-progress-text');
            const scoreText = document.getElementById('bcks-score-text');

            const levelCards = document.querySelectorAll('[data-bcks-level]');

            function updateBcksForm() {
                const status = statusSelect.value;
                const isBcks = status === 'BCKS';

                let totalIndikator = 0;
                let jumlahDiisi = 0;
                let totalSkor = 0;

                levelCards.forEach(function (card) {
                    const level = Number(card.dataset.bcksLevel);

                    const aktif = isBcks || level >= 3;

                    card.hidden = !aktif;

                    const radios = card.querySelectorAll(
                        'input[type="radio"][name^="skor["]'
                    );

                    radios.forEach(function (radio) {
                        radio.disabled = !aktif;
                        radio.required = aktif;
                    });

                    if (aktif) {
                        const indikatorUnik = new Set();

                        radios.forEach(function (radio) {
                            indikatorUnik.add(radio.name);
                        });

                        totalIndikator += indikatorUnik.size;
                    }
                });

                const checked = document.querySelectorAll(
                    'input[type="radio"][name^="skor["]:checked:not(:disabled)'
                );

                checked.forEach(function (radio) {
                    jumlahDiisi++;
                    totalSkor += Number(radio.value);
                });

                const persen = totalIndikator > 0
                    ? Math.round((jumlahDiisi / totalIndikator) * 100)
                    : 0;

                if (progressBar) {
                    progressBar.style.width = persen + '%';
                }

                if (progressPercent) {
                    progressPercent.textContent = persen + '%';
                }

                if (progressText) {
                    progressText.textContent =
                        jumlahDiisi + ' / ' + totalIndikator + ' butir';
                }

                if (scoreText) {
                    if (jumlahDiisi === 0) {
                        scoreText.textContent = 'Belum ada penilaian';
                    } else {
                        scoreText.textContent =
                            totalSkor + ' / ' + (totalIndikator * 4) + ' poin';
                    }
                }
            }

            statusSelect.addEventListener('change', updateBcksForm);

            document.querySelectorAll(
                'input[type="radio"][name^="skor["]'
            ).forEach(function (radio) {
                radio.addEventListener('change', updateBcksForm);
            });

            updateBcksForm();
        });
    </script>

@endsection