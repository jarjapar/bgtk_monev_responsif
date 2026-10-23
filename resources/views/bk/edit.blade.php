@extends('layouts.app')

@section('title', 'Edit Instrumen BK')

@section('page-title', 'Edit Instrumen BK')

@section('content')

    <div class="mx-auto max-w-7xl space-y-6">

        {{-- =========================================================

        HEADER

        ========================================================== --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div>

                    <nav class="flex items-center gap-2 text-sm text-slate-500">

                        <a href="{{ route('instrumen.index') }}" class="transition hover:text-blue-600">Instrumen</a>

                        <span class="text-slate-300">/</span>

                        <span class="font-medium text-slate-700">Edit BK Instrumen</span>

                    </nav>

                    <h1 class="text-2xl font-bold text-slate-800">

                        Edit Instrumen Monev BK

                    </h1>

                    <p class="mt-1 text-sm text-slate-500">

                        Perbarui data identitas, lokasi, dan jawaban BK.

                    </p>

                </div>

            </div>

            <a href="{{ route('bk.show', $submission) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />

                </svg>

                Kembali

            </a>

        </div>

        {{-- =========================================================

        PETUNJUK + PROGRESS (satu kartu)

        ========================================================== --}}

        <style>
            .instr-card {
                display: flex;
                flex-direction: column;
            }

            .instr-side {
                width: 100%;
                border-top: 1px solid #e2e8f0;
            }

            @media (min-width: 1024px) {

                .instr-card {
                    flex-direction: row;
                }

                .instr-side {
                    width: 20rem;
                    flex: 0 0 20rem;
                    border-top: 0;
                    border-left: 1px solid #e2e8f0;
                }

            }
        </style>

        <div class="instr-card overflow-hidden rounded-2xl bg-white shadow-sm"
            style="border: 1px solid #e2e8f0; border-left: 4px solid #2563eb;">

            {{-- ===================== KIRI: PETUNJUK ===================== --}}

            <div style="flex: 1 1 0%; min-width: 0; padding: 24px;">

                <div style="display: flex; align-items: flex-start; gap: 16px;">

                    <div
                        style="display: flex; align-items: center; justify-content: center; flex: 0 0 44px; width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; color: #2563eb;">

                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">

                            Instrumen Monitoring dan Evaluasi BK

                        </h2>

                        <p class="mt-1 text-sm leading-6 text-slate-500">

                            Monitoring dan Evaluasi Diseminasi Implementasi 7 Jurus BK Hebat.

                        </p>

                    </div>

                </div>

                <div
                    style="margin-top: 20px; padding: 16px 20px; border: 1px dashed #bfdbfe; border-radius: 12px; background: #f5f9ff;">

                    <div
                        style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #1d4ed8;">

                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                        Petunjuk pengisian

                    </div>

                    <ol
                        style="margin: 8px 0 0; padding-left: 22px; list-style: decimal; font-size: 13px; line-height: 1.7; color: #1e3a8a;">

                        <li>

                            Isilah instrumen sesuai dengan fakta yang diketahui,

                            dialami, dilakukan, dan dirasakan.

                        </li>

                        <li>

                            Bacalah setiap pernyataan pada Bagian A dengan cermat,

                            kemudian pilih jawaban

                            <strong>Ya</strong> atau

                            <strong>Tidak</strong>.

                        </li>

                        <li>

                            Bacalah setiap pertanyaan pada Bagian B dan tuliskan

                            jawaban secara singkat, padat, dan jelas.

                        </li>

                    </ol>

                </div>

            </div>

            {{-- ===================== KANAN: PROGRES ===================== --}}

            <div class="instr-side" style="padding: 24px; background: #f8fafc;">

                <div
                    style="display: flex; align-items: center; justify-content: space-between; font-size: 12px; font-weight: 500; color: #64748b;">

                    <span>Progres pengisian</span>

                    <span id="progressPercent" style="font-weight: 700; color: #2563eb;">0%</span>

                </div>

                <div style="margin-top: 8px; height: 8px; overflow: hidden; border-radius: 9999px; background: #e2e8f0;">

                    <div id="progressBar"
                        style="width: 0%; height: 100%; border-radius: 9999px; background: #2563eb; transition: width 0.3s;">
                    </div>

                </div>

                <div style="display: flex; align-items: baseline; justify-content: space-between; margin-top: 12px;">

                    <span style="font-size: 14px; font-weight: 700; color: #0f172a;">

                        <span id="answeredCount">0</span> / {{ $questions->count() }} butir

                    </span>

                    <span style="font-size: 12px; color: #94a3b8;">Terjawab</span>

                </div>

                <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e2e8f0;">

                    <p style="font-size: 12px; color: #64748b;">Skor sementara</p>

                    <p id="jawabanSummary" style="margin-top: 4px; font-size: 14px; font-weight: 700; color: #0f172a;">

                        Belum ada jawaban

                    </p>

                </div>

            </div>

        </div>

        {{-- =========================================================

        ERROR VALIDATION

        ========================================================== --}}

        @if ($errors->any())

            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="font-semibold text-red-800">

                    Pengisian belum dapat disimpan.

                </div>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                        <li>

                            {{ $error }}

                        </li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- =========================================================

        FORM

        ========================================================== --}}

        <form id="bkEditForm" action="{{ route('bk.update', $submission) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')

            {{-- =====================================================

            1. IDENTITAS PETUGAS MONEV

            ====================================================== --}}

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                    <div class="flex items-center gap-3">

                        <div>

                            <h2 class="text-lg font-bold text-slate-800">

                                A. Identitas Petugas Monev

                            </h2>

                            <p class="mt-1 text-sm text-slate-500">

                                Informasi petugas pelaksana monitoring dan evaluasi.

                            </p>

                        </div>

                    </div>

                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">

                    {{-- Nama Petugas --}}

                    <div>

                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">

                            Nama Petugas Monev

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="nama_petugas_monev" name="nama_petugas_monev"
                            value="{{ old('nama_petugas_monev', $submission->nama_petugas_monev) }}" required
                            placeholder="Masukkan nama petugas"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

                    {{-- Instansi --}}

                    <div>

                        <label for="instansi_petugas" class="mb-2 block text-sm font-semibold text-slate-700">

                            Instansi

                        </label>

                        <input type="text" id="instansi_petugas" name="instansi_petugas"
                            value="{{ old('instansi_petugas', $submission->instansi_petugas) }}"
                            placeholder="Masukkan instansi"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

                    {{-- Lokasi --}}

                    <div>

                        <label for="lokasi_monev" class="mb-2 block text-sm font-semibold text-slate-700">

                            Lokasi Monev

                        </label>

                        <input type="text" id="lokasi_monev" name="lokasi_monev"
                            value="{{ old('lokasi_monev', $submission->lokasi_monev) }}" placeholder="Masukkan lokasi Monev"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

                    {{-- Tanggal --}}

                    <div>

                        <label for="tanggal_pelaksanaan" class="mb-2 block text-sm font-semibold text-slate-700">

                            Tanggal Pelaksanaan

                        </label>

                        <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan"
                            value="{{ old('tanggal_pelaksanaan', optional($submission->tanggal_pelaksanaan)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

                </div>

            </section>

            {{-- =====================================================
            2. IDENTITAS RESPONDEN
            ====================================================== --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden</h2>
                    <p class="mt-1 text-sm text-slate-500">Identitas responden yang mengisi instrumen BK.</p>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_responden" class="mb-2 block text-sm font-semibold text-slate-700">Nama Responden
                            <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_responden" name="nama_responden"
                            value="{{ old('nama_responden', $submission->nama_responden) }}" required maxlength="255"
                            placeholder="Masukkan nama responden"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="jabatan_responden" class="mb-2 block text-sm font-semibold text-slate-700">Jabatan
                            Responden <span class="text-red-500">*</span></label>
                        <select id="jabatan_responden" name="jabatan_responden" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            <option value="">Pilih jabatan</option>
                            <option value="BK" @selected(old('jabatan_responden', $submission->jabatan_responden) === 'BK')>BK
                            </option>
                            <option value="Kepala Sekolah" @selected(old('jabatan_responden', $submission->jabatan_responden) === 'Kepala Sekolah')>Kepala Sekolah</option>
                            <option value="Rekan Sejawat" @selected(old('jabatan_responden', $submission->jabatan_responden) === 'Rekan Sejawat')>Rekan Sejawat</option>
                            <option value="Peserta Didik" @selected(old('jabatan_responden', $submission->jabatan_responden) === 'Peserta Didik')>Peserta Didik</option>
                        </select>
                    </div>

                    <div id="jabatanLainnyaWrapper"
                        class="{{ old('jabatan_responden', $submission->jabatan_responden) === 'Lainnya' ? '' : 'hidden' }}">
                        <label for="jabatan_lainnya" class="mb-2 block text-sm font-semibold text-slate-700">Jabatan Lainnya
                            <span class="text-red-500">*</span></label>
                        <input type="text" id="jabatan_lainnya" name="jabatan_lainnya"
                            value="{{ old('jabatan_lainnya', $submission->jabatan_lainnya) }}" maxlength="255"
                            placeholder="Tuliskan jabatan responden"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="satuan_pendidikan" class="mb-2 block text-sm font-semibold text-slate-700">Satuan
                            Pendidikan <span class="text-red-500">*</span></label>
                        <input type="text" id="satuan_pendidikan" name="satuan_pendidikan"
                            value="{{ old('satuan_pendidikan', $submission->satuan_pendidikan) }}" required maxlength="255"
                            placeholder="Masukkan nama satuan pendidikan"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="masa_kerja" class="mb-2 block text-sm font-semibold text-slate-700">Masa Kerja (tahun)
                            <span class="text-red-500">*</span></label>
                        <input type="number" id="masa_kerja" name="masa_kerja"
                            value="{{ old('masa_kerja', $submission->masa_kerja) }}" required min="0" max="100" step="1"
                            placeholder="Contoh: 5"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="nama_pelatihan" class="mb-2 block text-sm font-semibold text-slate-700">Nama Pelatihan
                            <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_pelatihan" name="nama_pelatihan"
                            value="{{ old('nama_pelatihan', $submission->nama_pelatihan) }}" required maxlength="255"
                            placeholder="Masukkan nama pelatihan"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="tanggal_pengisian" class="mb-2 block text-sm font-semibold text-slate-700">Tanggal
                            Pengisian <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_pengisian" name="tanggal_pengisian"
                            value="{{ old('tanggal_pengisian', optional($submission->tanggal_pengisian)->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>
            </section>

            {{-- =====================================================

            3. BAGIAN A

            ====================================================== --}}

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- =====================================================

                TABEL PERTANYAAN

                ====================================================== --}}

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[850px] border-collapse">

                        {{-- LEBAR KOLOM --}}

                        <colgroup>

                            <col style="width: 80px;">

                            <col>

                            <col style="width: 110px;">

                            <col style="width: 110px;">

                        </colgroup>

                        {{-- =================================================

                        ISI

                        ================================================== --}}

                        <tbody>

                            @php

                                $currentLevel = null;

                                $currentBagian = null;

                            @endphp

                            @forelse ($questions as $question)

                                @php
                                    $existingAnswer = $answers->get($question->id);
                                    $currentAnswer = old(
                                        "jawaban.{$question->id}",
                                        $existingAnswer
                                        ? ($existingAnswer->jawaban ? '1' : '0')
                                        : null
                                    );
                                @endphp

                                {{-- =========================================

                                HEADER LEVEL

                                ========================================== --}}

                                @if ($currentLevel !== $question->level)

                                    @php

                                        $currentLevel = $question->level;

                                        $currentBagian = null;

                                    @endphp

                                    <tr class="level-header" data-level="{{ $question->level }}">

                                        <td colspan="4" class="border-b border-slate-200 bg-blue-50 px-6 py-5">

                                            <div class="text-base font-bold text-slate-800">

                                                Level {{ $question->level }}

                                                — {{ $question->level_nama }}

                                            </div>

                                            <div class="mt-1 text-sm text-slate-500">

                                                Pilih satu jawaban untuk setiap indikator.

                                            </div>

                                        </td>

                                    </tr>

                                @endif

                                {{-- =========================================

                                HEADER BAGIAN

                                ========================================== --}}

                                @if ($currentBagian !== $question->bagian)

                                    @php

                                        $currentBagian = $question->bagian;

                                    @endphp

                                    <tr class="bagian-header" data-level="{{ $question->level }}">

                                        <td colspan="4" class="border-b border-slate-200  px-6 py-3">

                                            <div class="text-sm font-bold text-slate-800">

                                                {{ $question->bagian }}

                                                @if ($question->judul_bagian)

                                                    — {{ $question->judul_bagian }}

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @endif

                                {{-- =========================================

                                PERTANYAAN

                                ========================================== --}}

                                <tr class="question-item transition hover:bg-slate-50" data-question-id="{{ $question->id }}"
                                    data-level="{{ $question->level }}">

                                    {{-- NO --}}

                                    <td class="border-b border-slate-100 px-5 py-5 align-middle">

                                        <span class="text-sm font-semibold text-slate-600">

                                            {{ $question->nomor }}

                                        </span>

                                    </td>

                                    {{-- PERNYATAAN --}}

                                    <td class="border-b border-l border-slate-100 px-5 py-5 align-middle">

                                        <p class="text-sm leading-6 text-slate-700">

                                            {{ $question->pernyataan }}

                                        </p>

                                    </td>

                                    {{-- YA --}}

                                    <td class="border-b border-l border-slate-100 px-5 py-5 text-center align-middle">

                                        <label class="inline-flex cursor-pointer items-center justify-center" title="Ya">

                                            <input type="radio" name="jawaban[{{ $question->id }}]" value="1"
                                                class="h-5 w-5 cursor-pointer accent-emerald-600" {{ (string) $currentAnswer === '1' ? 'checked' : '' }}>

                                        </label>

                                    </td>

                                    {{-- TIDAK --}}

                                    <td class="border-b border-l border-slate-100 px-5 py-5 text-center align-middle">

                                        <label class="inline-flex cursor-pointer items-center justify-center" title="Tidak">

                                            <input type="radio" name="jawaban[{{ $question->id }}]" value="0"
                                                class="h-5 w-5 cursor-pointer accent-red-600" {{ (string) $currentAnswer === '0' ? 'checked' : '' }}>

                                        </label>

                                    </td>

                                </tr>

                            @empty

                                {{-- =========================================

                                DATA KOSONG

                                ========================================== --}}

                                <tr>

                                    <td colspan="4" class="px-6 py-12 text-center">

                                        <div class="text-lg font-bold text-slate-700">

                                            Data instrumen belum tersedia

                                        </div>

                                        <p class="mt-2 text-sm text-slate-500">

                                            Pertanyaan BK belum tersedia.

                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

            {{-- =====================================================

            PERTANYAAN URAIAN

            ====================================================== --}}

            @if ($essayAnswers->count() > 0)

                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                        <h2 class="text-lg font-bold text-slate-800">Pertanyaan Uraian</h2>

                        <p class="mt-1 text-sm text-slate-500">Perbarui jawaban uraian jika diperlukan.</p>

                    </div>

                    <div class="space-y-5 p-6">

                        @foreach ($essayAnswers as $essay)

                                    <div>

                                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                                            {{ $essay->nomor }}.
                                            {{ $essay->pertanyaan }}
                                        </label>

                                        <textarea name="essay[{{ $essay->nomor }}][pertanyaan]"
                                            class="hidden">{{ $essay->pertanyaan }}</textarea>

                                        <textarea name="essay[{{ $essay->nomor }}][jawaban]" rows="5"
                                            class="w-full resize-y rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old(
                                "essay.{$essay->nomor}.jawaban",
                                $essay->jawaban
                            ) }}</textarea>

                                    </div>

                        @endforeach

                    </div>

                </section>

            @endif

            {{-- =====================================================

            TOMBOL

            ====================================================== --}}

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <button id="submitButton" type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

    {{-- =========================================================

    JAVASCRIPT

    ========================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('bkEditForm');
            const jabatanSelect = document.getElementById('jabatan_responden');

            const questions = Array.from(
                document.querySelectorAll('.question-item')
            );

            const levelHeaders = document.querySelectorAll('.level-header');
            const bagianHeaders = document.querySelectorAll('.bagian-header');

            const answeredCount = document.getElementById('answeredCount');
            const progressBar = document.getElementById('progressBar');
            const progressPercent = document.getElementById('progressPercent');
            const jawabanSummary = document.getElementById('jawabanSummary');
            const submitButton = document.getElementById('submitButton');

            function getAllowedLevels() {
                const jabatan = jabatanSelect.value;

                if (jabatan === 'BK') {
                    return [1, 2, 3, 4];
                }

                if (jabatan !== '') {
                    return [3, 4];
                }

                // Sebelum jabatan dipilih, pertahankan tampilan awal.
                return [1, 2, 3, 4];
            }

            function updateVisibleLevels() {
                const allowedLevels = getAllowedLevels();

                function levelIsAllowed(element) {
                    return allowedLevels.includes(
                        Number(element.dataset.level)
                    );
                }

                levelHeaders.forEach(function (row) {
                    row.hidden = !levelIsAllowed(row);
                });

                bagianHeaders.forEach(function (row) {
                    row.hidden = !levelIsAllowed(row);
                });

                questions.forEach(function (row) {
                    const visible = levelIsAllowed(row);
                    row.hidden = !visible;

                    row.querySelectorAll('input[type="radio"]').forEach(function (radio) {
                        radio.disabled = !visible;
                    });
                });

                updateProgress();
            }

            function updateProgress() {
                let answered = 0;
                let yes = 0;
                let no = 0;

                const visibleQuestions = questions.filter(function (question) {
                    return !question.hidden;
                });

                visibleQuestions.forEach(function (question) {
                    const checked = question.querySelector(
                        'input[type="radio"]:checked'
                    );

                    if (checked) {
                        answered++;

                        if (checked.value === '1') {
                            yes++;
                        } else {
                            no++;
                        }
                    }
                });

                const total = visibleQuestions.length;
                const percentage = total > 0
                    ? Math.round((answered / total) * 100)
                    : 0;

                answeredCount.textContent = answered;

                // Perbarui jumlah butir pada tampilan progres yang sudah ada.
                const totalLabel = answeredCount.parentElement;
                if (totalLabel) {
                    const textNodes = Array.from(totalLabel.childNodes);
                    textNodes.forEach(function (node) {
                        if (
                            node.nodeType === Node.TEXT_NODE &&
                            node.textContent.includes('/ ')
                        ) {
                            node.textContent = ' / ' + total + ' butir';
                        }
                    });
                }

                progressBar.style.width = percentage + '%';
                progressPercent.textContent = percentage + '%';

                jawabanSummary.textContent = answered > 0
                    ? yes + ' Ya · ' + no + ' Tidak'
                    : 'Belum ada jawaban';
            }

            form.addEventListener('change', function (event) {
                if (
                    event.target.matches('input[type="radio"]') ||
                    event.target === jabatanSelect
                ) {
                    updateVisibleLevels();
                }
            });

            jabatanSelect.addEventListener('change', updateVisibleLevels);

            form.addEventListener('submit', function (event) {
                updateVisibleLevels();

                const unanswered = questions.filter(function (question) {
                    if (question.hidden) {
                        return false;
                    }

                    return !question.querySelector(
                        'input[type="radio"]:checked'
                    );
                });

                if (!jabatanSelect.value) {
                    event.preventDefault();
                    alert('Silakan pilih jabatan responden terlebih dahulu.');
                    jabatanSelect.focus();
                    return;
                }

                if (unanswered.length > 0) {
                    event.preventDefault();

                    const firstQuestion = unanswered[0];

                    firstQuestion.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    firstQuestion.classList.add('bg-red-50');

                    setTimeout(function () {
                        firstQuestion.classList.remove('bg-red-50');
                    }, 2500);

                    alert(
                        'Masih ada ' +
                        unanswered.length +
                        ' pernyataan yang belum dijawab.'
                    );

                    return;
                }

                submitButton.disabled = true;
                submitButton.textContent = 'Menyimpan...';
            });

            updateVisibleLevels();
        });
    </script>

@endsection