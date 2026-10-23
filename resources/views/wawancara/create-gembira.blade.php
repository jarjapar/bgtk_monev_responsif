@extends('layouts.app')

@section('title', 'Wawancara Matematika GEMBIRA')
@section('page-title', 'Wawancara Matematika GEMBIRA')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6 pb-10">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('wawancara.index') }}" class="hover:text-blue-600">
                        Wawancara
                    </a>
                    <span>/</span>
                    <span>Wawancara Matematika GEMBIRA</span>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                    Wawancara Matematika GEMBIRA
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                   Lengkapi biodata sesuai instrumen Monitoring dan Evaluasi Matematika GEMBIRA.
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
        
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @php
            $routeSimpanSiap = \Illuminate\Support\Facades\Route::has('wawancara.gembira.store');
        @endphp

        <form action="{{ $routeSimpanSiap ? route('wawancara.gembira.store') : '#' }}" method="POST" class="space-y-6">
            @csrf

            {{-- A. Identitas Guru dan Sekolah --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-900">
                        A. Identitas Guru dan Sekolah
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Isikan identitas guru dan sekolah yang dimonitor.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_guru" class="mb-2 block text-sm font-medium text-slate-700">
                            Nama Guru <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_guru" name="nama_guru" type="text" value="{{ old('nama_guru') }}" required
                            class="h-11 w-full rounded-xl border border-slate-300 px-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">
                    </div>

                    <div>
                        <label for="nama_sekolah" class="mb-2 block text-sm font-medium text-slate-700">
                            Nama Sekolah <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_sekolah" name="nama_sekolah" type="text" value="{{ old('nama_sekolah') }}" required
                            class="h-11 w-full rounded-xl border border-slate-300 px-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">
                    </div>

                    <div>
                        <label for="kelas_fase" class="mb-2 block text-sm font-medium text-slate-700">
                            Kelas / Fase
                        </label>
                        <input id="kelas_fase" name="kelas_fase" type="text" value="{{ old('kelas_fase') }}"
                            placeholder="Contoh: Kelas IV / Fase B"
                            class="h-11 w-full rounded-xl border border-slate-300 px-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">
                    </div>

                    <div>
                        <label for="topik_materi" class="mb-2 block text-sm font-medium text-slate-700">
                            Topik / Materi
                        </label>
                        <input id="topik_materi" name="topik_materi" type="text" value="{{ old('topik_materi') }}"
                            class="h-11 w-full rounded-xl border border-slate-300 px-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">
                    </div>
                </div>
            </section>

            {{-- B. Identitas Responden dan Petugas Monev --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-900">
                        B. Identitas Responden dan Petugas Monev
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Tanda bintang (*) menunjukkan kolom wajib diisi.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 p-5 md:grid-cols-2">
                    <div>
                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-medium text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_petugas_monev" name="nama_petugas_monev" type="text"
                            value="{{ old('nama_petugas_monev') }}" required
                            class="h-11 w-full rounded-xl border border-slate-300 px-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">
                    </div>

                    <div>
                        <label for="jabatan_penilai" class="mb-2 block text-sm font-medium text-slate-700">
                            Jabatan Penilai <span class="text-red-500">*</span>
                        </label>
                        <select id="jabatan_penilai" name="jabatan_penilai" required
                            class="h-11 w-full rounded-xl border border-slate-300 bg-white px-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">
                            <option value="">Pilih jabatan penilai</option>
                            <option value="Peserta Matematika GEMBIRA" @selected(old('jabatan_penilai') === 'Peserta Matematika GEMBIRA')>
                                Peserta Matematika GEMBIRA
                            </option>
                            <option value="Rekan sejawat" @selected(old('jabatan_penilai') === 'Rekan sejawat')>
                                Rekan sejawat
                            </option>
                            <option value="Atasan langsung/Kepala Sekolah" @selected(old('jabatan_penilai') === 'Atasan langsung/Kepala Sekolah')>
                                Atasan langsung/Kepala Sekolah
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_monev" class="mb-2 block text-sm font-medium text-slate-700">
                            Tanggal Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="tanggal_monev" name="tanggal_monev" type="date"
                            value="{{ old('tanggal_monev', now()->format('Y-m-d')) }}" required
                            class="h-11 w-full rounded-xl border border-slate-300 px-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">
                    </div>

                    <div>
                        <label for="sumber_data_bukti" class="mb-2 block text-sm font-medium text-slate-700">
                            Sumber Data / Bukti
                        </label>
                        <textarea id="sumber_data_bukti" name="sumber_data_bukti" rows="3"
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('sumber_data_bukti') }}</textarea>
                    </div>
                </div>

            </section>
            {{-- C. Pertanyaan Wawancara Terbuka --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-900">
                        C. Pertanyaan Wawancara Terbuka
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Jawablah pertanyaan berdasarkan pengalaman dan bukti yang tersedia.
                    </p>
                </div>

                <div class="space-y-6 p-6">
                    <div>
                        <label for="jawaban_1" class="mb-2 block text-sm font-medium text-slate-700">
                            1. Bagaimana pengalaman Anda selama mengikuti Pelatihan Matematika Gembira?
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_1" name="jawaban_1" rows="4" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_1') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_2" class="mb-2 block text-sm font-medium text-slate-700">
                            2. Kendala apa yang Anda alami selama mengikuti pelatihan?
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_2" name="jawaban_2" rows="4" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_2') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_3" class="mb-2 block text-sm font-medium text-slate-700">
                            3. Bagaimana pemahaman Anda tentang pembelajaran matematika berubah setelah mengikuti pelatihan?
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_3" name="jawaban_3" rows="4" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_3') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_4" class="mb-2 block text-sm font-medium text-slate-700">
                            4. Ceritakan contoh konkret kegiatan pembelajaran matematika yang telah Anda lakukan dengan
                            menerapkan
                            hasil pelatihan!
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_4" name="jawaban_4" rows="4" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_4') }}</textarea>
                    </div>

                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">
                        <h3 class="font-semibold text-slate-800">
                            5. Perubahan apa yang Anda amati setelah penerapan Matematika Gembira?
                        </h3>
                        <p class="mt-1 text-sm text-slate-600">
                            Jelaskan masing-masing aspek berikut.
                        </p>
                    </div>

                    <div>
                        <label for="jawaban_5_a" class="mb-2 block text-sm font-medium text-slate-700">
                            a. Keterlibatan dan keaktifan peserta didik
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_5_a" name="jawaban_5_a" rows="3" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_5_a') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_5_b" class="mb-2 block text-sm font-medium text-slate-700">
                            b. Motivasi dan rasa percaya diri
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_5_b" name="jawaban_5_b" rows="3" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_5_b') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_5_c" class="mb-2 block text-sm font-medium text-slate-700">
                            c. Pemahaman konsep
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_5_c" name="jawaban_5_c" rows="3" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_5_c') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_5_d" class="mb-2 block text-sm font-medium text-slate-700">
                            d. Kemampuan pemecahan masalah
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_5_d" name="jawaban_5_d" rows="3" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_5_d') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_5_e" class="mb-2 block text-sm font-medium text-slate-700">
                            e. Komunikasi dan kolaborasi
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_5_e" name="jawaban_5_e" rows="3" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_5_e') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_6" class="mb-2 block text-sm font-medium text-slate-700">
                            6. Apakah ada peningkatan kemampuan numerasi murid setelah penerapan Matematika GEMBIRA? Jika
                            ada,
                            jelaskan!
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_6" name="jawaban_6" rows="4" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_6') }}</textarea>
                    </div>

                    <div>
                        <label for="jawaban_7" class="mb-2 block text-sm font-medium text-slate-700">
                            7. Berikan saran dan masukan untuk pelatihan Matematika GEMBIRA?
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea id="jawaban_7" name="jawaban_7" rows="4" required
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('jawaban_7') }}</textarea>
                    </div>

                    <div>
                        <label for="catatan" class="mb-2 block text-sm font-medium text-slate-700">
                            Catatan tambahan (opsional)
                        </label>
                        <textarea id="catatan" name="catatan" rows="3"
                            class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-100">{{ old('catatan') }}</textarea>
                    </div>
                </div>
            </section>
            <div class="flex flex-wrap justify-end gap-3">
                @if ($routeSimpanSiap)
                    <button type="submit"
                        class="inline-flex h-11 items-center justify-center rounded-xl bg-amber-600 px-5 text-sm font-semibold text-white hover:bg-amber-700">
                        Simpan Wawancara
                    </button>
                @else
                    <button type="button" disabled
                        class="inline-flex h-11 cursor-not-allowed items-center justify-center rounded-xl bg-amber-600 px-5 text-sm font-semibold text-white opacity-60">
                        Simpan Wawancara
                    </button>
                @endif
            </div>
        </form>
    </div>
@endsection