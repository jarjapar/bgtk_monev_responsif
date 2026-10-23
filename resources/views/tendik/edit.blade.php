@extends('layouts.app')

@section('title', 'Edit Instrumen TENDIK')

@section('content')
    <div class="mx-auto max-w-6xl space-y-6">

        {{-- =========================================================
        HEADER HALAMAN
        ========================================================== --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <nav class="flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('tendik.show', $tendik->id) }}" class="transition hover:text-blue-600">Instrumen</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-medium text-slate-700">Edit TENDIK</span>
                </nav>
                <h1 class="mt-1 text-2xl font-bold text-slate-800">Edit Instrumen Monev TENDIK</h1>
                <p class="mt-2 text-sm text-slate-500">Perbarui identitas dan hasil Monitoring dan Evaluasi TENDIK
                </p>
            </div>
            <a href="{{ route('tendik.show', $tendik->id) }}"
                class="inline-flex h-12 items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-6 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- =========================================================
        INFORMASI INSTRUMEN & PROGRESS
        ========================================================== --}}
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
                            <h2 class="text-lg font-bold text-slate-900">Instrumen Monitoring dan Evaluasi Tenaga
                                Kependidikan</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-600">
                                Instrumen ini digunakan untuk mengevaluasi efektivitas pelatihan dan dampak penerapan
                                kompetensi Tenaga Kependidikan (TENDIK).
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
                                <p class="font-semibold text-blue-700">Petunjuk pengisian</p>
                                <p class="mt-0.5">
                                    Pilih satu jawaban yang paling sesuai dengan pendapat atau kondisi Anda untuk setiap
                                    pernyataan:
                                    <strong>1</strong> Sangat Tidak Setuju (STS),
                                    <strong>2</strong> Tidak Setuju (TS),
                                    <strong>3</strong> Setuju (S),
                                    <strong>4</strong> Sangat Setuju (SS).
                                    Pastikan seluruh 43 butir pernyataan telah diisi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PROGRESS PENGISIAN --}}
                <div class="border-t border-slate-200 bg-slate-50/70 p-5 sm:p-6 lg:border-l lg:border-t-0">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">Progres pengisian</span>
                        <span id="tendik-progress-percent" class="text-xs font-bold text-blue-600">0%</span>
                    </div>

                    <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-200">
                        <div id="tendik-progress-bar" class="h-full rounded-full bg-blue-600 transition-all duration-300"
                            style="width: 0%"></div>
                    </div>

                    <div class="mt-2 flex items-center justify-between">
                        <span id="tendik-progress-text" class="text-sm font-bold text-slate-900">0 / 43 butir</span>
                        <span class="text-xs text-slate-400">Penilaian</span>
                    </div>

                    <div class="mt-5 border-t border-slate-200 pt-4">
                        <p class="text-xs font-medium text-slate-500">Skor sementara</p>
                        <p id="tendik-score-text" class="mt-1 text-sm font-bold text-slate-900">Belum ada penilaian</p>
                    </div>
                </div>

            </div>
        </div>

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold">Periksa kembali isian berikut:</p>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tendik.update', $tendik->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-5 border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-800">A. Identitas Petugas Monev</h2>
                    <p class="mt-1 text-sm text-slate-500">Masukkan identitas petugas yang melakukan monitoring dan
                        evaluasi.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Nama Petugas Monev --}}
                    <div>
                        <label for="nama_petugas_monev" class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_petugas_monev" name="nama_petugas_monev" value="{{ old('nama_petugas_monev', $tendik->nama_petugas_monev) }}"
                            required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('nama_petugas_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Instansi Petugas --}}
                    <div>
                        <label for="instansi_petugas" class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Instansi Petugas <span class="text-red-500">*</span>
                        </label>
                        <input id="instansi_petugas" name="instansi_petugas" value="{{ old('instansi_petugas', $tendik->instansi_petugas) }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('instansi_petugas')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Lokasi Monev --}}
                    <div>
                        <label for="lokasi_monev" class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Lokasi Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="lokasi_monev" name="lokasi_monev" value="{{ old('lokasi_monev', $tendik->lokasi_monev) }}"
                            placeholder="Masukkan lokasi Monev" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('lokasi_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Pelaksanaan --}}
                    <div>
                        <label for="tanggal_pengisian" class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Tanggal Pelaksanaan <span class="text-red-500">*</span>
                        </label>
                        <input id="tanggal_pengisian" type="date" name="tanggal_pengisian"
                            value="{{ old('tanggal_pengisian', $tendik->tanggal_pengisian ? \Illuminate\Support\Carbon::parse($tendik->tanggal_pengisian)->format('Y-m-d') : now()->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('tanggal_pengisian')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-5 border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden</h2>
                    <p class="mt-1 text-sm text-slate-500">Tanda bintang (*) menunjukkan kolom wajib diisi.</p>
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label for="nama_responden" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Responden
                            <span class="text-red-500">*</span></label>
                        <input id="nama_responden" name="nama_responden" value="{{ old('nama_responden', $tendik->nama_responden) }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('nama_responden')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="jabatan_responden" class="mb-1.5 block text-sm font-semibold text-slate-700">Jabatan
                            <span class="text-red-500">*</span></label>
                        <select id="jabatan_responden" name="jabatan_responden" required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">Pilih jabatan</option>
                            <option value="Tendik" @selected(old('jabatan_responden', $tendik->jabatan_responden) === 'Tendik')>Tendik</option>
                            <option value="Operator" @selected(old('jabatan_responden', $tendik->jabatan_responden) === 'Operator')>Operator</option>
                            <option value="Bendahara" @selected(old('jabatan_responden', $tendik->jabatan_responden) === 'Bendahara')>Bendahara</option>
                            <option value="Kepala Sekolah" @selected(old('jabatan_responden', $tendik->jabatan_responden) === 'Kepala Sekolah')>Kepala
                                Sekolah</option>
                            <option value="Rekan Sejawat/Guru" @selected(old('jabatan_responden', $tendik->jabatan_responden) === 'Rekan Sejawat/Guru')>
                                Rekan Sejawat/Guru</option>
                        </select>
                        @error('jabatan_responden')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div id="jabatan-lainnya-wrap">
                        <label for="jabatan_lainnya" class="mb-1.5 block text-sm font-semibold text-slate-700">Jabatan
                            Lainnya <span class="text-slate-400">(jika memilih Lainnya)</span></label>
                        <input id="jabatan_lainnya" name="jabatan_lainnya" value="{{ old('jabatan_lainnya', $tendik->jabatan_lainnya) }}"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('jabatan_lainnya')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="satuan_pendidikan" class="mb-1.5 block text-sm font-semibold text-slate-700">Satuan
                            Pendidikan <span class="text-red-500">*</span></label>
                        <input id="satuan_pendidikan" name="satuan_pendidikan" value="{{ old('satuan_pendidikan', $tendik->satuan_pendidikan) }}"
                            required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('satuan_pendidikan')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="masa_kerja" class="mb-1.5 block text-sm font-semibold text-slate-700">Masa Kerja (tahun)
                            <span class="text-red-500">*</span></label>
                        <input id="masa_kerja" type="number" min="0" max="100" name="masa_kerja"
                            value="{{ old('masa_kerja', $tendik->masa_kerja) }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('masa_kerja')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="nama_pelatihan" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama
                            Kegiatan/Pelatihan <span class="text-red-500">*</span></label>
                        <input id="nama_pelatihan" name="nama_pelatihan" value="{{ old('nama_pelatihan', $tendik->nama_pelatihan) }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('nama_pelatihan')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="tanggal_pengisian" class="mb-1.5 block text-sm font-semibold text-slate-700">Tanggal
                            Pengisian <span class="text-red-500">*</span></label>
                        <input id="tanggal_pengisian" type="date" name="tanggal_pengisian"
                            value="{{ old('tanggal_pengisian', $tendik->tanggal_pengisian ? \Illuminate\Support\Carbon::parse($tendik->tanggal_pengisian)->format('Y-m-d') : now()->format('Y-m-d')) }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @error('tanggal_pengisian')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm" data-level-section="1">
                <div class="border-b border-slate-100 bg-slate-50 px-5 py-4 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-800">Level I — Reaksi</h2>
                    <p class="mt-1 text-sm text-slate-500">Penilaian terhadap materi, narasumber/fasilitator, layanan, dan
                        kepuasan kegiatan.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200">
                                <th class="whitespace-nowrap px-4 py-3 text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">No</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase text-slate-500">Pertanyaan / Indikator</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">1</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">2</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">3</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">4</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">1
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Materi pelatihan sesuai dengan tugas dan kebutuhan saya sebagai tenaga kependidikan.
                                    <span class="text-red-500">*</span>
                                    @error('jawaban_1')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_1" value="1" @checked((string) old('jawaban_1', $tendik->jawaban_1) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_1" value="2" @checked((string) old('jawaban_1', $tendik->jawaban_1) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_1" value="3" @checked((string) old('jawaban_1', $tendik->jawaban_1) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_1" value="4" @checked((string) old('jawaban_1', $tendik->jawaban_1) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">2
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Cakupan materi lengkap dan disusun secara runtut sehingga mudah diikuti. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_2')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_2" value="1" @checked((string) old('jawaban_2', $tendik->jawaban_2) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_2" value="2" @checked((string) old('jawaban_2', $tendik->jawaban_2) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_2" value="3" @checked((string) old('jawaban_2', $tendik->jawaban_2) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_2" value="4" @checked((string) old('jawaban_2', $tendik->jawaban_2) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">3
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Materi yang disampaikan sesuai dengan ketentuan dan perkembangan terbaru. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_3')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_3" value="1" @checked((string) old('jawaban_3', $tendik->jawaban_3) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_3" value="2" @checked((string) old('jawaban_3', $tendik->jawaban_3) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_3" value="3" @checked((string) old('jawaban_3', $tendik->jawaban_3) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_3" value="4" @checked((string) old('jawaban_3', $tendik->jawaban_3) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">4
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Materi dilengkapi contoh kasus dan praktik sehingga dapat saya terapkan langsung di
                                    sekolah. <span class="text-red-500">*</span>
                                    @error('jawaban_4')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_4" value="1" @checked((string) old('jawaban_4', $tendik->jawaban_4) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_4" value="2" @checked((string) old('jawaban_4', $tendik->jawaban_4) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_4" value="3" @checked((string) old('jawaban_4', $tendik->jawaban_4) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_4" value="4" @checked((string) old('jawaban_4', $tendik->jawaban_4) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">5
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Bahan pendukung (modul, tayangan, contoh dokumen) lengkap, jelas, dan bermanfaat. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_5')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_5" value="1" @checked((string) old('jawaban_5', $tendik->jawaban_5) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_5" value="2" @checked((string) old('jawaban_5', $tendik->jawaban_5) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_5" value="3" @checked((string) old('jawaban_5', $tendik->jawaban_5) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_5" value="4" @checked((string) old('jawaban_5', $tendik->jawaban_5) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">6
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Narasumber/fasilitator menguasai materi dan menjawab pertanyaan dengan tepat. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_6')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_6" value="1" @checked((string) old('jawaban_6', $tendik->jawaban_6) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_6" value="2" @checked((string) old('jawaban_6', $tendik->jawaban_6) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_6" value="3" @checked((string) old('jawaban_6', $tendik->jawaban_6) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_6" value="4" @checked((string) old('jawaban_6', $tendik->jawaban_6) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">7
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Narasumber/fasilitator menyampaikan materi dengan jelas, sistematis, dan mudah dipahami.
                                    <span class="text-red-500">*</span>
                                    @error('jawaban_7')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_7" value="1" @checked((string) old('jawaban_7', $tendik->jawaban_7) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_7" value="2" @checked((string) old('jawaban_7', $tendik->jawaban_7) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_7" value="3" @checked((string) old('jawaban_7', $tendik->jawaban_7) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_7" value="4" @checked((string) old('jawaban_7', $tendik->jawaban_7) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">8
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Metode dan media pembelajaran (contoh kasus, praktik, tayangan) membuat saya tertarik
                                    dan terlibat aktif. <span class="text-red-500">*</span>
                                    @error('jawaban_8')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_8" value="1" @checked((string) old('jawaban_8', $tendik->jawaban_8) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_8" value="2" @checked((string) old('jawaban_8', $tendik->jawaban_8) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_8" value="3" @checked((string) old('jawaban_8', $tendik->jawaban_8) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_8" value="4" @checked((string) old('jawaban_8', $tendik->jawaban_8) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">9
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Narasumber/fasilitator terbuka terhadap pertanyaan, mendorong diskusi, dan memberikan
                                    umpan balik. <span class="text-red-500">*</span>
                                    @error('jawaban_9')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_9" value="1" @checked((string) old('jawaban_9', $tendik->jawaban_9) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_9" value="2" @checked((string) old('jawaban_9', $tendik->jawaban_9) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_9" value="3" @checked((string) old('jawaban_9', $tendik->jawaban_9) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_9" value="4" @checked((string) old('jawaban_9', $tendik->jawaban_9) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">10
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Narasumber/fasilitator bersikap ramah dan santun serta mengelola waktu dengan baik.
                                    <span class="text-red-500">*</span>
                                    @error('jawaban_10')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_10" value="1" @checked((string) old('jawaban_10', $tendik->jawaban_10) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_10" value="2" @checked((string) old('jawaban_10', $tendik->jawaban_10) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_10" value="3" @checked((string) old('jawaban_10', $tendik->jawaban_10) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_10" value="4" @checked((string) old('jawaban_10', $tendik->jawaban_10) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">11
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Informasi kegiatan (undangan, jadwal, dan bahan) disampaikan dengan jelas dan tepat
                                    waktu. <span class="text-red-500">*</span>
                                    @error('jawaban_11')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_11" value="1" @checked((string) old('jawaban_11', $tendik->jawaban_11) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_11" value="2" @checked((string) old('jawaban_11', $tendik->jawaban_11) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_11" value="3" @checked((string) old('jawaban_11', $tendik->jawaban_11) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_11" value="4" @checked((string) old('jawaban_11', $tendik->jawaban_11) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">12
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Alokasi waktu dan jadwal pelatihan memadai dan dijalankan sesuai rencana. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_12')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_12" value="1" @checked((string) old('jawaban_12', $tendik->jawaban_12) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_12" value="2" @checked((string) old('jawaban_12', $tendik->jawaban_12) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_12" value="3" @checked((string) old('jawaban_12', $tendik->jawaban_12) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_12" value="4" @checked((string) old('jawaban_12', $tendik->jawaban_12) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">13
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Tempat, sarana prasarana, dan konsumsi mendukung kelancaran kegiatan. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_13')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_13" value="1" @checked((string) old('jawaban_13', $tendik->jawaban_13) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_13" value="2" @checked((string) old('jawaban_13', $tendik->jawaban_13) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_13" value="3" @checked((string) old('jawaban_13', $tendik->jawaban_13) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_13" value="4" @checked((string) old('jawaban_13', $tendik->jawaban_13) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">14
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Panitia melayani peserta dengan ramah, cepat tanggap, dan membantu. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_14')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_14" value="1" @checked((string) old('jawaban_14', $tendik->jawaban_14) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_14" value="2" @checked((string) old('jawaban_14', $tendik->jawaban_14) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_14" value="3" @checked((string) old('jawaban_14', $tendik->jawaban_14) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_14" value="4" @checked((string) old('jawaban_14', $tendik->jawaban_14) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">15
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Secara keseluruhan, saya puas dengan penyelenggaraan pelatihan ini. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_15')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_15" value="1" @checked((string) old('jawaban_15', $tendik->jawaban_15) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_15" value="2" @checked((string) old('jawaban_15', $tendik->jawaban_15) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_15" value="3" @checked((string) old('jawaban_15', $tendik->jawaban_15) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_15" value="4" @checked((string) old('jawaban_15', $tendik->jawaban_15) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="border-t border-slate-100 px-5 py-3 text-xs text-slate-400">Pilih satu skor untuk setiap
                    indikator.</p>

                <details class="group border-t border-slate-200 bg-slate-50/70">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-5 py-4 sm:px-6">
                        <div class="flex items-start gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-blue-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                            </svg>
                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-slate-800">Rubrik Penilaian Level I — Reaksi</h3>
                                <p class="mt-0.5 text-xs leading-5 text-slate-500">Makna skor 1–4 untuk setiap indikator
                                    pada Level I (Reaksi). Klik untuk melihat atau menyembunyikan.</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 shrink-0 text-slate-400 transition-transform group-open:rotate-180" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="px-5 pb-5 sm:px-6">
                        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
                            <table class="w-full min-w-[960px] border-collapse text-left">
                                <thead class="bg-slate-100">
                                    <tr>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 w-12 text-center">
                                            No</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 w-44">
                                            Indikator</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 4 (Sangat Baik)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 3 (Baik)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 2 (Cukup)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 1 (Kurang)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">1</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Relevansi materi</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Seluruh materi sangat sesuai
                                            dengan tugas dan kebutuhan kerja saya.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sebagian besar materi sesuai
                                            dengan tugas dan kebutuhan kerja saya.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Hanya sebagian kecil materi
                                            yang sesuai dengan tugas saya.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Materi tidak sesuai dengan
                                            tugas dan kebutuhan kerja saya.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">2</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kelengkapan dan
                                            keruntutan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Cakupan materi lengkap,
                                            runtut, dan seluruhnya mudah diikuti.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Cakupan lengkap dan runtut;
                                            sebagian kecil perlu penjelasan tambahan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Cakupan kurang lengkap atau
                                            urutan sering membingungkan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Cakupan tidak lengkap dan
                                            sulit diikuti.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">3</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kemutakhiran materi</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Seluruh materi sesuai
                                            ketentuan dan perkembangan terbaru.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sebagian besar materi sesuai;
                                            sedikit bagian perlu diperbarui.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Banyak bagian materi yang
                                            sudah tidak sesuai ketentuan terbaru.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Materi tidak sesuai ketentuan
                                            dan perkembangan terbaru.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">4</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Keterterapan materi</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Seluruh materi dilengkapi
                                            contoh/praktik dan dapat langsung diterapkan di sekolah.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sebagian besar materi dapat
                                            langsung diterapkan di sekolah.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Hanya sebagian kecil materi
                                            yang dapat diterapkan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Materi tidak dapat diterapkan
                                            di sekolah.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">5</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Bahan pendukung</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Modul, tayangan, dan contoh
                                            dokumen lengkap, jelas, dan sangat membantu.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Bahan pendukung lengkap dan
                                            cukup membantu.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Bahan pendukung kurang
                                            lengkap atau kurang jelas.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Bahan pendukung tidak
                                            tersedia atau tidak membantu.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">6</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Penguasaan materi</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sangat menguasai materi;
                                            jawaban selalu tepat dan disertai contoh nyata.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Menguasai materi; sebagian
                                            besar jawaban tepat.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kurang menguasai materi;
                                            jawaban sering kurang tepat.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Tidak menguasai materi.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">7</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kejelasan penyampaian
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Penyampaian selalu jelas,
                                            sistematis, dan mudah dipahami.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Umumnya jelas; sesekali perlu
                                            pengulangan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering kurang jelas atau
                                            tidak sistematis.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Penyampaian tidak jelas dan
                                            sulit dipahami.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">8</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Metode dan media</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Metode dan media bervariasi
                                            dan membuat saya terlibat aktif sepanjang kegiatan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sebagian besar metode dan
                                            media membuat saya terlibat.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Metode kurang bervariasi;
                                            keterlibatan saya rendah.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Metode monoton dan tidak
                                            melibatkan peserta.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">9</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Interaksi dan umpan balik
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu terbuka terhadap
                                            pertanyaan, mendorong diskusi, dan memberi umpan balik bermakna.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Umumnya terbuka terhadap
                                            pertanyaan dan memberi umpan balik.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kurang responsif terhadap
                                            pertanyaan dan diskusi.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Tidak responsif terhadap
                                            pertanyaan peserta.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">10</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Sikap dan pengelolaan
                                            waktu</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sangat ramah dan santun;
                                            waktu dikelola tepat sesuai porsi materi.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Ramah dan santun; waktu
                                            umumnya terkelola baik.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kurang ramah atau kurang
                                            disiplin waktu.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Tidak ramah dan tidak
                                            disiplin waktu.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">11</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Informasi kegiatan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Informasi (undangan, jadwal,
                                            bahan) lengkap, jelas, dan selalu tepat waktu.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Informasi lengkap dan jelas;
                                            sesekali terlambat.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Informasi kurang lengkap atau
                                            kurang jelas.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Informasi tidak jelas atau
                                            tidak saya terima.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">12</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Alokasi waktu dan jadwal
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Alokasi waktu sangat memadai
                                            dan jadwal selalu ditaati.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Alokasi waktu memadai; ada
                                            sedikit penyesuaian jadwal.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Alokasi waktu kurang memadai;
                                            jadwal sering bergeser.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Alokasi waktu tidak memadai
                                            dan jadwal tidak terkendali.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">13</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Tempat, sarana, dan
                                            konsumsi</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Seluruhnya sangat mendukung
                                            kelancaran kegiatan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mendukung kegiatan dengan
                                            sedikit kekurangan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kurang mendukung kelancaran
                                            kegiatan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Tidak mendukung kegiatan.
                                        </td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">14</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Pelayanan panitia</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Panitia selalu ramah, sigap,
                                            dan membantu kebutuhan peserta.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Panitia umumnya ramah dan
                                            membantu.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Panitia kurang tanggap
                                            terhadap kebutuhan peserta.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Panitia tidak melayani dengan
                                            baik.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">15</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kepuasan umum</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sangat puas dan bersedia
                                            merekomendasikan pelatihan kepada rekan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Puas terhadap penyelenggaraan
                                            pelatihan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kurang puas; banyak hal perlu
                                            diperbaiki.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Tidak puas terhadap
                                            penyelenggaraan pelatihan.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>
            </section>

           <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm" data-level-section="2">
                <div class="border-b border-slate-100 bg-slate-50 px-5 py-4 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-800">Level II — Belajar</h2>
                    <p class="mt-1 text-sm text-slate-500">Pengetahuan, keterampilan, dan sikap yang diperoleh melalui
                        pelatihan.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200">
                                <th class="whitespace-nowrap px-4 py-3 text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">No</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase text-slate-500">Pertanyaan / Indikator</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">1</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">2</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">3</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">4</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">16
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya memahami jenis data sekolah yang harus dikelola serta alur pengelolaannya
                                    (pengumpulan, verifikasi, dan pemutakhiran). <span class="text-red-500">*</span>
                                    @error('jawaban_16')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_16" value="1" @checked((string) old('jawaban_16', $tendik->jawaban_16) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_16" value="2" @checked((string) old('jawaban_16', $tendik->jawaban_16) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_16" value="3" @checked((string) old('jawaban_16', $tendik->jawaban_16) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_16" value="4" @checked((string) old('jawaban_16', $tendik->jawaban_16) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">17
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya mampu mempraktikkan pengelolaan data sekolah (input, verifikasi, dan pemutakhiran)
                                    sesuai ketentuan. <span class="text-red-500">*</span>
                                    @error('jawaban_17')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_17" value="1" @checked((string) old('jawaban_17', $tendik->jawaban_17) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_17" value="2" @checked((string) old('jawaban_17', $tendik->jawaban_17) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_17" value="3" @checked((string) old('jawaban_17', $tendik->jawaban_17) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_17" value="4" @checked((string) old('jawaban_17', $tendik->jawaban_17) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">18
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya menjadi lebih teliti dan bertanggung jawab dalam menjaga keakuratan data sekolah.
                                    <span class="text-red-500">*</span>
                                    @error('jawaban_18')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_18" value="1" @checked((string) old('jawaban_18', $tendik->jawaban_18) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_18" value="2" @checked((string) old('jawaban_18', $tendik->jawaban_18) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_18" value="3" @checked((string) old('jawaban_18', $tendik->jawaban_18) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_18" value="4" @checked((string) old('jawaban_18', $tendik->jawaban_18) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">19
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya memahami prosedur layanan administrasi sekolah (persuratan, pengarsipan, dan
                                    pelayanan warga sekolah) yang benar. <span class="text-red-500">*</span>
                                    @error('jawaban_19')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_19" value="1" @checked((string) old('jawaban_19', $tendik->jawaban_19) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_19" value="2" @checked((string) old('jawaban_19', $tendik->jawaban_19) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_19" value="3" @checked((string) old('jawaban_19', $tendik->jawaban_19) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_19" value="4" @checked((string) old('jawaban_19', $tendik->jawaban_19) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">20
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya mampu menyusun dokumen persuratan, mengelola arsip, dan melayani warga sekolah
                                    sesuai prosedur. <span class="text-red-500">*</span>
                                    @error('jawaban_20')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_20" value="1" @checked((string) old('jawaban_20', $tendik->jawaban_20) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_20" value="2" @checked((string) old('jawaban_20', $tendik->jawaban_20) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_20" value="3" @checked((string) old('jawaban_20', $tendik->jawaban_20) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_20" value="4" @checked((string) old('jawaban_20', $tendik->jawaban_20) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">21
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya menjadi lebih ramah, tertib, dan responsif dalam melayani kebutuhan warga sekolah.
                                    <span class="text-red-500">*</span>
                                    @error('jawaban_21')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_21" value="1" @checked((string) old('jawaban_21', $tendik->jawaban_21) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_21" value="2" @checked((string) old('jawaban_21', $tendik->jawaban_21) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_21" value="3" @checked((string) old('jawaban_21', $tendik->jawaban_21) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_21" value="4" @checked((string) old('jawaban_21', $tendik->jawaban_21) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">22
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya memahami ketentuan administrasi keuangan dan pelaporan yang berlaku di sekolah.
                                    <span class="text-red-500">*</span>
                                    @error('jawaban_22')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_22" value="1" @checked((string) old('jawaban_22', $tendik->jawaban_22) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_22" value="2" @checked((string) old('jawaban_22', $tendik->jawaban_22) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_22" value="3" @checked((string) old('jawaban_22', $tendik->jawaban_22) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_22" value="4" @checked((string) old('jawaban_22', $tendik->jawaban_22) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">23
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya mampu menyusun pembukuan, bukti transaksi, dan laporan keuangan sesuai format yang
                                    ditetapkan. <span class="text-red-500">*</span>
                                    @error('jawaban_23')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_23" value="1" @checked((string) old('jawaban_23', $tendik->jawaban_23) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_23" value="2" @checked((string) old('jawaban_23', $tendik->jawaban_23) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_23" value="3" @checked((string) old('jawaban_23', $tendik->jawaban_23) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_23" value="4" @checked((string) old('jawaban_23', $tendik->jawaban_23) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">24
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya menjadi lebih jujur, transparan, dan akuntabel dalam mengelola administrasi
                                    keuangan. <span class="text-red-500">*</span>
                                    @error('jawaban_24')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_24" value="1" @checked((string) old('jawaban_24', $tendik->jawaban_24) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_24" value="2" @checked((string) old('jawaban_24', $tendik->jawaban_24) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_24" value="3" @checked((string) old('jawaban_24', $tendik->jawaban_24) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_24" value="4" @checked((string) old('jawaban_24', $tendik->jawaban_24) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">25
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya memahami peran dan manfaat kolaborasi serta jejaring dengan kepala sekolah, guru,
                                    rekan sejawat, dinas, dan mitra. <span class="text-red-500">*</span>
                                    @error('jawaban_25')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_25" value="1" @checked((string) old('jawaban_25', $tendik->jawaban_25) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_25" value="2" @checked((string) old('jawaban_25', $tendik->jawaban_25) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_25" value="3" @checked((string) old('jawaban_25', $tendik->jawaban_25) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_25" value="4" @checked((string) old('jawaban_25', $tendik->jawaban_25) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">26
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya mampu berkomunikasi, berkoordinasi, dan membangun jejaring kerja dengan berbagai
                                    pihak. <span class="text-red-500">*</span>
                                    @error('jawaban_26')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_26" value="1" @checked((string) old('jawaban_26', $tendik->jawaban_26) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_26" value="2" @checked((string) old('jawaban_26', $tendik->jawaban_26) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_26" value="3" @checked((string) old('jawaban_26', $tendik->jawaban_26) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_26" value="4" @checked((string) old('jawaban_26', $tendik->jawaban_26) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">27
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya menjadi lebih terbuka, menghargai pendapat orang lain, dan mau bekerja sama. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_27')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_27" value="1" @checked((string) old('jawaban_27', $tendik->jawaban_27) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_27" value="2" @checked((string) old('jawaban_27', $tendik->jawaban_27) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_27" value="3" @checked((string) old('jawaban_27', $tendik->jawaban_27) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_27" value="4" @checked((string) old('jawaban_27', $tendik->jawaban_27) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">28
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya memahami bahwa kemampuan dapat berkembang melalui usaha dan belajar, serta
                                    perbedaan growth mindset dengan fixed mindset. <span class="text-red-500">*</span>
                                    @error('jawaban_28')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_28" value="1" @checked((string) old('jawaban_28', $tendik->jawaban_28) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_28" value="2" @checked((string) old('jawaban_28', $tendik->jawaban_28) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_28" value="3" @checked((string) old('jawaban_28', $tendik->jawaban_28) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_28" value="4" @checked((string) old('jawaban_28', $tendik->jawaban_28) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">29
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya mampu merumuskan tujuan pengembangan diri dan strategi menghadapi tantangan serta
                                    umpan balik dalam pekerjaan. <span class="text-red-500">*</span>
                                    @error('jawaban_29')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_29" value="1" @checked((string) old('jawaban_29', $tendik->jawaban_29) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_29" value="2" @checked((string) old('jawaban_29', $tendik->jawaban_29) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_29" value="3" @checked((string) old('jawaban_29', $tendik->jawaban_29) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_29" value="4" @checked((string) old('jawaban_29', $tendik->jawaban_29) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">30
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya memandang tantangan dan kesalahan sebagai peluang belajar dan bersemangat
                                    mengembangkan diri. <span class="text-red-500">*</span>
                                    @error('jawaban_30')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_30" value="1" @checked((string) old('jawaban_30', $tendik->jawaban_30) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_30" value="2" @checked((string) old('jawaban_30', $tendik->jawaban_30) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_30" value="3" @checked((string) old('jawaban_30', $tendik->jawaban_30) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_30" value="4" @checked((string) old('jawaban_30', $tendik->jawaban_30) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">31
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya memahami peran, etika, dan standar kinerja yang dituntut dari tenaga kependidikan
                                    yang profesional. <span class="text-red-500">*</span>
                                    @error('jawaban_31')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_31" value="1" @checked((string) old('jawaban_31', $tendik->jawaban_31) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_31" value="2" @checked((string) old('jawaban_31', $tendik->jawaban_31) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_31" value="3" @checked((string) old('jawaban_31', $tendik->jawaban_31) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_31" value="4" @checked((string) old('jawaban_31', $tendik->jawaban_31) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">32
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya mampu mengatur waktu dan prioritas kerja serta memanfaatkan teknologi secara
                                    profesional. <span class="text-red-500">*</span>
                                    @error('jawaban_32')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_32" value="1" @checked((string) old('jawaban_32', $tendik->jawaban_32) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_32" value="2" @checked((string) old('jawaban_32', $tendik->jawaban_32) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_32" value="3" @checked((string) old('jawaban_32', $tendik->jawaban_32) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_32" value="4" @checked((string) old('jawaban_32', $tendik->jawaban_32) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">33
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya berkomitmen menjaga integritas, disiplin, tanggung jawab, dan kerahasiaan data
                                    dalam bekerja. <span class="text-red-500">*</span>
                                    @error('jawaban_33')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_33" value="1" @checked((string) old('jawaban_33', $tendik->jawaban_33) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_33" value="2" @checked((string) old('jawaban_33', $tendik->jawaban_33) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_33" value="3" @checked((string) old('jawaban_33', $tendik->jawaban_33) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_33" value="4" @checked((string) old('jawaban_33', $tendik->jawaban_33) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="border-t border-slate-100 px-5 py-3 text-xs text-slate-400">Pilih satu skor untuk setiap
                    indikator.</p>

                <details class="group border-t border-slate-200 bg-slate-50/70">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-5 py-4 sm:px-6">
                        <div class="flex items-start gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-blue-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                            </svg>
                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-slate-800">Rubrik Penilaian Level II — Belajar</h3>
                                <p class="mt-0.5 text-xs leading-5 text-slate-500">Makna skor 1–4 untuk setiap indikator
                                    pada Level II (Belajar). Klik untuk melihat atau menyembunyikan.</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 shrink-0 text-slate-400 transition-transform group-open:rotate-180" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="px-5 pb-5 sm:px-6">
                        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
                            <table class="w-full min-w-[960px] border-collapse text-left">
                                <thead class="bg-slate-100">
                                    <tr>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 w-12 text-center">
                                            No</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 w-44">
                                            Indikator</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 4 (Sangat Baik)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 3 (Baik)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 2 (Cukup)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 1 (Kurang)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">16</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Pengelolaan data –
                                            Pengetahuan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan jenis data
                                            sekolah dan alur pengelolaannya secara lengkap dan benar disertai contoh.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan sebagian
                                            besar jenis data sekolah dan alur pengelolaannya dengan benar.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru memahami sebagian kecil
                                            jenis data sekolah dan alur pengelolaannya; masih memerlukan bimbingan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum memahami jenis data
                                            sekolah dan alur pengelolaannya.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">17</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Pengelolaan data –
                                            Keterampilan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan input,
                                            verifikasi, dan pemutakhiran data sekolah sesuai ketentuan secara mandiri,
                                            tepat, dan sesuai ketentuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan input,
                                            verifikasi, dan pemutakhiran data sekolah sesuai ketentuan sesuai ketentuan
                                            dengan sedikit bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru mampu mempraktikkan
                                            sebagian langkah input, verifikasi, dan pemutakhiran data sekolah sesuai
                                            ketentuan; masih memerlukan bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum mampu mempraktikkan
                                            input, verifikasi, dan pemutakhiran data sekolah sesuai ketentuan.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">18</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Pengelolaan data – Sikap
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu menunjukkan ketelitian
                                            dan tanggung jawab dalam menjaga keakuratan data dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering menunjukkan ketelitian
                                            dan tanggung jawab dalam menjaga keakuratan data dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang menunjukkan
                                            ketelitian dan tanggung jawab dalam menjaga keakuratan data; belum konsisten.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum menunjukkan ketelitian
                                            dan tanggung jawab dalam menjaga keakuratan data.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">19</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Layanan administrasi –
                                            Pengetahuan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan prosedur
                                            persuratan, pengarsipan, dan pelayanan warga sekolah secara lengkap dan benar
                                            disertai contoh.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan sebagian
                                            besar prosedur persuratan, pengarsipan, dan pelayanan warga sekolah dengan
                                            benar.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru memahami sebagian kecil
                                            prosedur persuratan, pengarsipan, dan pelayanan warga sekolah; masih memerlukan
                                            bimbingan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum memahami prosedur
                                            persuratan, pengarsipan, dan pelayanan warga sekolah.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">20</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Layanan administrasi –
                                            Keterampilan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan
                                            penyusunan surat, pengelolaan arsip, dan pelayanan sesuai prosedur secara
                                            mandiri, tepat, dan sesuai ketentuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan
                                            penyusunan surat, pengelolaan arsip, dan pelayanan sesuai prosedur sesuai
                                            ketentuan dengan sedikit bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru mampu mempraktikkan
                                            sebagian langkah penyusunan surat, pengelolaan arsip, dan pelayanan sesuai
                                            prosedur; masih memerlukan bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum mampu mempraktikkan
                                            penyusunan surat, pengelolaan arsip, dan pelayanan sesuai prosedur.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">21</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Layanan administrasi –
                                            Sikap</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu menunjukkan keramahan,
                                            ketertiban, dan ketanggapan dalam melayani dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering menunjukkan keramahan,
                                            ketertiban, dan ketanggapan dalam melayani dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang menunjukkan
                                            keramahan, ketertiban, dan ketanggapan dalam melayani; belum konsisten.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum menunjukkan keramahan,
                                            ketertiban, dan ketanggapan dalam melayani.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">22</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Administrasi keuangan –
                                            Pengetahuan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan ketentuan
                                            administrasi keuangan dan pelaporan sekolah secara lengkap dan benar disertai
                                            contoh.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan sebagian
                                            besar ketentuan administrasi keuangan dan pelaporan sekolah dengan benar.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru memahami sebagian kecil
                                            ketentuan administrasi keuangan dan pelaporan sekolah; masih memerlukan
                                            bimbingan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum memahami ketentuan
                                            administrasi keuangan dan pelaporan sekolah.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">23</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Administrasi keuangan –
                                            Keterampilan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan
                                            penyusunan pembukuan, bukti transaksi, dan laporan keuangan secara mandiri,
                                            tepat, dan sesuai ketentuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan
                                            penyusunan pembukuan, bukti transaksi, dan laporan keuangan sesuai ketentuan
                                            dengan sedikit bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru mampu mempraktikkan
                                            sebagian langkah penyusunan pembukuan, bukti transaksi, dan laporan keuangan;
                                            masih memerlukan bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum mampu mempraktikkan
                                            penyusunan pembukuan, bukti transaksi, dan laporan keuangan.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">24</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Administrasi keuangan –
                                            Sikap</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu menunjukkan kejujuran,
                                            transparansi, dan akuntabilitas dalam administrasi keuangan dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering menunjukkan kejujuran,
                                            transparansi, dan akuntabilitas dalam administrasi keuangan dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang menunjukkan
                                            kejujuran, transparansi, dan akuntabilitas dalam administrasi keuangan; belum
                                            konsisten.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum menunjukkan kejujuran,
                                            transparansi, dan akuntabilitas dalam administrasi keuangan.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">25</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kolaborasi dan jejaring –
                                            Pengetahuan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan peran dan
                                            manfaat kolaborasi serta jejaring kerja secara lengkap dan benar disertai
                                            contoh.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan sebagian
                                            besar peran dan manfaat kolaborasi serta jejaring kerja dengan benar.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru memahami sebagian kecil
                                            peran dan manfaat kolaborasi serta jejaring kerja; masih memerlukan bimbingan.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum memahami peran dan
                                            manfaat kolaborasi serta jejaring kerja.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">26</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kolaborasi dan jejaring –
                                            Keterampilan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan
                                            komunikasi, koordinasi, dan pembangunan jejaring kerja secara mandiri, tepat,
                                            dan sesuai ketentuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan
                                            komunikasi, koordinasi, dan pembangunan jejaring kerja sesuai ketentuan dengan
                                            sedikit bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru mampu mempraktikkan
                                            sebagian langkah komunikasi, koordinasi, dan pembangunan jejaring kerja; masih
                                            memerlukan bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum mampu mempraktikkan
                                            komunikasi, koordinasi, dan pembangunan jejaring kerja.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">27</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kolaborasi dan jejaring –
                                            Sikap</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu menunjukkan
                                            keterbukaan, sikap menghargai, dan kemauan bekerja sama dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering menunjukkan
                                            keterbukaan, sikap menghargai, dan kemauan bekerja sama dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang menunjukkan
                                            keterbukaan, sikap menghargai, dan kemauan bekerja sama; belum konsisten.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum menunjukkan
                                            keterbukaan, sikap menghargai, dan kemauan bekerja sama.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">28</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Growth mindset –
                                            Pengetahuan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan konsep
                                            growth mindset dan perbedaannya dengan fixed mindset secara lengkap dan benar
                                            disertai contoh.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan sebagian
                                            besar konsep growth mindset dan perbedaannya dengan fixed mindset dengan benar.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru memahami sebagian kecil
                                            konsep growth mindset dan perbedaannya dengan fixed mindset; masih memerlukan
                                            bimbingan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum memahami konsep growth
                                            mindset dan perbedaannya dengan fixed mindset.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">29</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Growth mindset –
                                            Keterampilan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan perumusan
                                            tujuan pengembangan diri dan strategi menghadapi tantangan secara mandiri,
                                            tepat, dan sesuai ketentuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan perumusan
                                            tujuan pengembangan diri dan strategi menghadapi tantangan sesuai ketentuan
                                            dengan sedikit bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru mampu mempraktikkan
                                            sebagian langkah perumusan tujuan pengembangan diri dan strategi menghadapi
                                            tantangan; masih memerlukan bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum mampu mempraktikkan
                                            perumusan tujuan pengembangan diri dan strategi menghadapi tantangan.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">30</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Growth mindset – Sikap
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu menunjukkan pandangan
                                            terhadap tantangan dan kesalahan sebagai peluang belajar dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering menunjukkan pandangan
                                            terhadap tantangan dan kesalahan sebagai peluang belajar dalam bekerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang menunjukkan
                                            pandangan terhadap tantangan dan kesalahan sebagai peluang belajar; belum
                                            konsisten.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum menunjukkan pandangan
                                            terhadap tantangan dan kesalahan sebagai peluang belajar.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">31</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Profesionalisme –
                                            Pengetahuan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan peran,
                                            etika, dan standar kinerja tenaga kependidikan secara lengkap dan benar disertai
                                            contoh.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu menjelaskan sebagian
                                            besar peran, etika, dan standar kinerja tenaga kependidikan dengan benar.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru memahami sebagian kecil
                                            peran, etika, dan standar kinerja tenaga kependidikan; masih memerlukan
                                            bimbingan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum memahami peran, etika,
                                            dan standar kinerja tenaga kependidikan.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">32</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Profesionalisme –
                                            Keterampilan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan
                                            pengaturan waktu, prioritas kerja, dan pemanfaatan teknologi secara profesional
                                            secara mandiri, tepat, dan sesuai ketentuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mampu mempraktikkan
                                            pengaturan waktu, prioritas kerja, dan pemanfaatan teknologi secara profesional
                                            sesuai ketentuan dengan sedikit bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Baru mampu mempraktikkan
                                            sebagian langkah pengaturan waktu, prioritas kerja, dan pemanfaatan teknologi
                                            secara profesional; masih memerlukan bantuan.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum mampu mempraktikkan
                                            pengaturan waktu, prioritas kerja, dan pemanfaatan teknologi secara profesional.
                                        </td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">33</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Profesionalisme – Sikap
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu menunjukkan komitmen
                                            pada integritas, disiplin, tanggung jawab, dan kerahasiaan data dalam bekerja.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering menunjukkan komitmen
                                            pada integritas, disiplin, tanggung jawab, dan kerahasiaan data dalam bekerja.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang menunjukkan
                                            komitmen pada integritas, disiplin, tanggung jawab, dan kerahasiaan data; belum
                                            konsisten.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum menunjukkan komitmen
                                            pada integritas, disiplin, tanggung jawab, dan kerahasiaan data.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm" data-level-section="3">
                <div class="border-b border-slate-100 bg-slate-50 px-5 py-4 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-800">Level III — Perilaku</h2>
                    <p class="mt-1 text-sm text-slate-500">Penerapan hasil pelatihan dalam pelaksanaan tugas di sekolah.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200">
                                <th class="whitespace-nowrap px-4 py-3 text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">No</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase text-slate-500">Pertanyaan / Indikator</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">1</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">2</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">3</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">4</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">34
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya menerapkan hasil pelatihan dalam pengelolaan data sekolah, yaitu memperbarui dan
                                    memverifikasi data secara berkala. <span class="text-red-500">*</span>
                                    @error('jawaban_34')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_34" value="1" @checked((string) old('jawaban_34', $tendik->jawaban_34) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_34" value="2" @checked((string) old('jawaban_34', $tendik->jawaban_34) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_34" value="3" @checked((string) old('jawaban_34', $tendik->jawaban_34) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_34" value="4" @checked((string) old('jawaban_34', $tendik->jawaban_34) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">35
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya melayani kebutuhan administrasi warga sekolah dengan lebih cepat, tertib, dan
                                    ramah. <span class="text-red-500">*</span>
                                    @error('jawaban_35')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_35" value="1" @checked((string) old('jawaban_35', $tendik->jawaban_35) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_35" value="2" @checked((string) old('jawaban_35', $tendik->jawaban_35) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_35" value="3" @checked((string) old('jawaban_35', $tendik->jawaban_35) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_35" value="4" @checked((string) old('jawaban_35', $tendik->jawaban_35) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">36
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya menyusun dokumen administrasi dan laporan (termasuk laporan keuangan) tepat waktu
                                    dan sesuai format. <span class="text-red-500">*</span>
                                    @error('jawaban_36')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_36" value="1" @checked((string) old('jawaban_36', $tendik->jawaban_36) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_36" value="2" @checked((string) old('jawaban_36', $tendik->jawaban_36) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_36" value="3" @checked((string) old('jawaban_36', $tendik->jawaban_36) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_36" value="4" @checked((string) old('jawaban_36', $tendik->jawaban_36) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">37
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya berkolaborasi aktif dengan kepala sekolah, guru, rekan tenaga kependidikan, dan
                                    pihak luar (dinas, mitra jejaring) dalam menjalankan tugas. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_37')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_37" value="1" @checked((string) old('jawaban_37', $tendik->jawaban_37) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_37" value="2" @checked((string) old('jawaban_37', $tendik->jawaban_37) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_37" value="3" @checked((string) old('jawaban_37', $tendik->jawaban_37) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_37" value="4" @checked((string) old('jawaban_37', $tendik->jawaban_37) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">38
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Saya memanfaatkan teknologi dalam bekerja dan menjaga keamanan serta kerahasiaan data
                                    sekolah. <span class="text-red-500">*</span>
                                    @error('jawaban_38')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_38" value="1" @checked((string) old('jawaban_38', $tendik->jawaban_38) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_38" value="2" @checked((string) old('jawaban_38', $tendik->jawaban_38) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_38" value="3" @checked((string) old('jawaban_38', $tendik->jawaban_38) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_38" value="4" @checked((string) old('jawaban_38', $tendik->jawaban_38) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="border-t border-slate-100 px-5 py-3 text-xs text-slate-400">Pilih satu skor untuk setiap
                    indikator.</p>

                <details class="group border-t border-slate-200 bg-slate-50/70">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-5 py-4 sm:px-6">
                        <div class="flex items-start gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-blue-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                            </svg>
                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-slate-800">Rubrik Penilaian Level III — Perilaku</h3>
                                <p class="mt-0.5 text-xs leading-5 text-slate-500">Makna skor 1-4 untuk setiap indikator
                                    pada Level III (Perilaku). Klik untuk melihat atau menyembunyikan.</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 shrink-0 text-slate-400 transition-transform group-open:rotate-180" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="px-5 pb-5 sm:px-6">
                        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
                            <table class="w-full min-w-[960px] border-collapse text-left">
                                <thead class="bg-slate-100">
                                    <tr>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 w-12 text-center">
                                            No</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 w-44">
                                            Indikator</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 4 (Sangat Baik)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 3 (Baik)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 2 (Cukup)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 1 (Kurang)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">34</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Pengelolaan data</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu memperbarui dan
                                            memverifikasi data sekolah secara berkala dan telah menjadi kebiasaan kerja.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering memperbarui dan
                                            memverifikasi data sekolah secara berkala; sesekali masih terlewat.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang memperbarui dan
                                            memverifikasi data sekolah secara berkala; belum konsisten.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum memperbarui dan
                                            memverifikasi data sekolah secara berkala setelah mengikuti pelatihan.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">35</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Layanan administrasi</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu melayani kebutuhan
                                            administrasi warga sekolah dengan cepat, tertib, dan ramah dan telah menjadi
                                            kebiasaan kerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering melayani kebutuhan
                                            administrasi warga sekolah dengan cepat, tertib, dan ramah; sesekali masih
                                            terlewat.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang melayani
                                            kebutuhan administrasi warga sekolah dengan cepat, tertib, dan ramah; belum
                                            konsisten.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum melayani kebutuhan
                                            administrasi warga sekolah dengan cepat, tertib, dan ramah setelah mengikuti
                                            pelatihan.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">36</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Dokumen dan laporan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu menyusun dokumen
                                            administrasi dan laporan tepat waktu dan sesuai format dan telah menjadi
                                            kebiasaan kerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering menyusun dokumen
                                            administrasi dan laporan tepat waktu dan sesuai format; sesekali masih terlewat.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang menyusun
                                            dokumen administrasi dan laporan tepat waktu dan sesuai format; belum konsisten.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum menyusun dokumen
                                            administrasi dan laporan tepat waktu dan sesuai format setelah mengikuti
                                            pelatihan.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">37</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kolaborasi</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu berkolaborasi aktif
                                            dengan kepala sekolah, guru, rekan, dan pihak luar dan telah menjadi kebiasaan
                                            kerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering berkolaborasi aktif
                                            dengan kepala sekolah, guru, rekan, dan pihak luar; sesekali masih terlewat.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang berkolaborasi
                                            aktif dengan kepala sekolah, guru, rekan, dan pihak luar; belum konsisten.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum berkolaborasi aktif
                                            dengan kepala sekolah, guru, rekan, dan pihak luar setelah mengikuti pelatihan.
                                        </td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">38</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Teknologi dan keamanan
                                            data</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Selalu memanfaatkan teknologi
                                            dan menjaga keamanan serta kerahasiaan data sekolah dan telah menjadi kebiasaan
                                            kerja.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Sering memanfaatkan teknologi
                                            dan menjaga keamanan serta kerahasiaan data sekolah; sesekali masih terlewat.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kadang-kadang memanfaatkan
                                            teknologi dan menjaga keamanan serta kerahasiaan data sekolah; belum konsisten.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Belum memanfaatkan teknologi
                                            dan menjaga keamanan serta kerahasiaan data sekolah setelah mengikuti pelatihan.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm" data-level-section="4">
                <div class="border-b border-slate-100 bg-slate-50 px-5 py-4 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-800">Level IV — Hasil</h2>
                    <p class="mt-1 text-sm text-slate-500">Dampak pelatihan terhadap layanan dan kinerja sekolah.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200">
                                <th class="whitespace-nowrap px-4 py-3 text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">No</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase text-slate-500">Pertanyaan / Indikator</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">1</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">2</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">3</th>
                                <th class="whitespace-nowrap px-3 py-3 text-center text-xs font-bold uppercase text-slate-500"
                                    style="width: 56px">4</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">39
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Data sekolah menjadi lebih akurat, lengkap, dan mutakhir dibandingkan sebelum pelatihan.
                                    <span class="text-red-500">*</span>
                                    @error('jawaban_39')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_39" value="1" @checked((string) old('jawaban_39', $tendik->jawaban_39) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_39" value="2" @checked((string) old('jawaban_39', $tendik->jawaban_39) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_39" value="3" @checked((string) old('jawaban_39', $tendik->jawaban_39) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_39" value="4" @checked((string) old('jawaban_39', $tendik->jawaban_39) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">40
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Waktu penyelesaian layanan administrasi menjadi lebih singkat dan keluhan layanan
                                    berkurang. <span class="text-red-500">*</span>
                                    @error('jawaban_40')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_40" value="1" @checked((string) old('jawaban_40', $tendik->jawaban_40) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_40" value="2" @checked((string) old('jawaban_40', $tendik->jawaban_40) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_40" value="3" @checked((string) old('jawaban_40', $tendik->jawaban_40) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_40" value="4" @checked((string) old('jawaban_40', $tendik->jawaban_40) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">41
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Kesalahan dan temuan pada laporan administrasi maupun keuangan berkurang. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_41')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_41" value="1" @checked((string) old('jawaban_41', $tendik->jawaban_41) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_41" value="2" @checked((string) old('jawaban_41', $tendik->jawaban_41) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_41" value="3" @checked((string) old('jawaban_41', $tendik->jawaban_41) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_41" value="4" @checked((string) old('jawaban_41', $tendik->jawaban_41) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">42
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Kerja sama tim dan koordinasi antarwarga sekolah menjadi lebih baik. <span
                                        class="text-red-500">*</span>
                                    @error('jawaban_42')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_42" value="1" @checked((string) old('jawaban_42', $tendik->jawaban_42) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_42" value="2" @checked((string) old('jawaban_42', $tendik->jawaban_42) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_42" value="3" @checked((string) old('jawaban_42', $tendik->jawaban_42) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_42" value="4" @checked((string) old('jawaban_42', $tendik->jawaban_42) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>

                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-4 align-top text-sm font-semibold text-slate-600">43
                                </td>
                                <td class="px-4 py-4 align-top text-sm text-slate-700">
                                    Pelatihan memberi dampak positif pada mutu layanan dan kinerja sekolah secara
                                    keseluruhan. <span class="text-red-500">*</span>
                                    @error('jawaban_43')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_43" value="1" @checked((string) old('jawaban_43', $tendik->jawaban_43) === '1') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_43" value="2" @checked((string) old('jawaban_43', $tendik->jawaban_43) === '2') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_43" value="3" @checked((string) old('jawaban_43', $tendik->jawaban_43) === '3') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4 text-center align-middle"><input type="radio"
                                        name="jawaban_43" value="4" @checked((string) old('jawaban_43', $tendik->jawaban_43) === '4') required
                                        class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="border-t border-slate-100 px-5 py-3 text-xs text-slate-400">Pilih satu skor untuk setiap
                    indikator.</p>

                <details class="group border-t border-slate-200 bg-slate-50/70">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-5 py-4 sm:px-6">
                        <div class="flex items-start gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-blue-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                            </svg>
                            <div class="min-w-0">
                                <h3 class="text-sm font-bold text-slate-800">Rubrik Penilaian Level IV — Hasil</h3>
                                <p class="mt-0.5 text-xs leading-5 text-slate-500">Makna skor 1–4 untuk setiap indikator
                                    pada Level IV (Hasil). Klik untuk melihat atau menyembunyikan.</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 shrink-0 text-slate-400 transition-transform group-open:rotate-180" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <div class="px-5 pb-5 sm:px-6">
                        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
                            <table class="w-full min-w-[960px] border-collapse text-left">
                                <thead class="bg-slate-100">
                                    <tr>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 w-12 text-center">
                                            No</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 w-44">
                                            Indikator</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 4 (Sangat Baik)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 3 (Baik)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 2 (Cukup)</th>
                                        <th
                                            class="border-b border-slate-200 px-3 py-2.5 text-xs font-bold uppercase tracking-wide text-slate-500 ">
                                            Skor 1 (Kurang)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">39</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kualitas data</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Keakuratan, kelengkapan, dan
                                            kemutakhiran data sekolah meningkat sangat jelas dan didukung bukti/dokumen.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Keakuratan, kelengkapan, dan
                                            kemutakhiran data sekolah meningkat dan dapat diamati.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Keakuratan, kelengkapan, dan
                                            kemutakhiran data sekolah meningkat sedikit atau belum merata.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Keakuratan, kelengkapan, dan
                                            kemutakhiran data sekolah belum berubah atau justru menurun.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">40</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kecepatan layanan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kecepatan layanan
                                            administrasi dan berkurangnya keluhan layanan meningkat sangat jelas dan
                                            didukung bukti/dokumen.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kecepatan layanan
                                            administrasi dan berkurangnya keluhan layanan meningkat dan dapat diamati.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kecepatan layanan
                                            administrasi dan berkurangnya keluhan layanan meningkat sedikit atau belum
                                            merata.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kecepatan layanan
                                            administrasi dan berkurangnya keluhan layanan belum berubah atau justru menurun.
                                        </td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">41</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Mutu laporan</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mutu laporan administrasi dan
                                            keuangan (berkurangnya kesalahan dan temuan) meningkat sangat jelas dan didukung
                                            bukti/dokumen.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mutu laporan administrasi dan
                                            keuangan (berkurangnya kesalahan dan temuan) meningkat dan dapat diamati.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mutu laporan administrasi dan
                                            keuangan (berkurangnya kesalahan dan temuan) meningkat sedikit atau belum
                                            merata.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mutu laporan administrasi dan
                                            keuangan (berkurangnya kesalahan dan temuan) belum berubah atau justru menurun.
                                        </td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">42</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kerja sama tim</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kerja sama tim dan koordinasi
                                            antarwarga sekolah meningkat sangat jelas dan didukung bukti/dokumen.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kerja sama tim dan koordinasi
                                            antarwarga sekolah meningkat dan dapat diamati.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kerja sama tim dan koordinasi
                                            antarwarga sekolah meningkat sedikit atau belum merata.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Kerja sama tim dan koordinasi
                                            antarwarga sekolah belum berubah atau justru menurun.</td>
                                    </tr>
                                    <tr class="align-top">
                                        <td class="px-3 py-3 text-center text-sm font-semibold text-slate-600">43</td>
                                        <td class="px-3 py-3 text-sm font-semibold text-slate-700">Kinerja sekolah</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mutu layanan dan kinerja
                                            sekolah secara keseluruhan meningkat sangat jelas dan didukung bukti/dokumen.
                                        </td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mutu layanan dan kinerja
                                            sekolah secara keseluruhan meningkat dan dapat diamati.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mutu layanan dan kinerja
                                            sekolah secara keseluruhan meningkat sedikit atau belum merata.</td>
                                        <td class="px-3 py-3 text-sm leading-6 text-slate-600">Mutu layanan dan kinerja
                                            sekolah secara keseluruhan belum berubah atau justru menurun.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>
            </section>

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Simpan Hasil
                </button>
            </div>
        </form>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jabatan = document.getElementById('jabatan_responden');
            const lainnyaWrap = document.getElementById('jabatan-lainnya-wrap');
            const lainnyaInput = document.getElementById('jabatan_lainnya');

            const levelSections = document.querySelectorAll('[data-level-section]');

            function updateLevelJabatan() {
                if (!jabatan) return;

                const isTendik = jabatan.value === 'Tendik';

                levelSections.forEach(function (section) {
                    const level = Number(section.dataset.levelSection);
                    const tampil = isTendik || (level === 3 || level === 4);

                    section.hidden = !tampil;

                    section.querySelectorAll('input[type="radio"]').forEach(function (radio) {
                        radio.disabled = !tampil;

                        if (!tampil) {
                            radio.checked = false;
                        }
                    });
                });

                if (lainnyaWrap) {
                    const tampilLainnya = jabatan.value === 'Lainnya';
                    lainnyaWrap.style.display = tampilLainnya ? '' : 'none';
                    if (lainnyaInput) {
                        lainnyaInput.required = tampilLainnya;
                        if (!tampilLainnya) lainnyaInput.value = '';
                    }
                }

                updateTendikProgress();
            }

            function updateTendikProgress() {
                const radioAktif = Array.from(
                    document.querySelectorAll(
                        'input[type="radio"][name^="jawaban_"]:not(:disabled)'
                    )
                );

                const namaIndikator = new Set(
                    radioAktif.map(function (radio) {
                        return radio.name;
                    })
                );

                const totalIndikator = namaIndikator.size;

                const checked = radioAktif.filter(function (radio) {
                    return radio.checked;
                });

                const jumlahDiisi = checked.length;
                const totalSkor = checked.reduce(function (total, radio) {
                    return total + Number(radio.value);
                }, 0);

                const persen = totalIndikator > 0
                    ? Math.round((jumlahDiisi / totalIndikator) * 100)
                    : 0;

                const progressBar = document.getElementById('tendik-progress-bar');
                const progressPercent = document.getElementById('tendik-progress-percent');
                const progressText = document.getElementById('tendik-progress-text');
                const scoreText = document.getElementById('tendik-score-text');

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

            document.querySelectorAll(
                'input[type="radio"][name^="jawaban_"]'
            ).forEach(function (radio) {
                radio.addEventListener('change', updateTendikProgress);
            });

            if (jabatan) {
                jabatan.addEventListener('change', updateLevelJabatan);
            }

            updateLevelJabatan();
        });
    </script>
@endsection