@extends('layouts.app')

@section('title', 'Edit Pengisian BCKS')

@section('page-title', 'Edit Pengisian BCKS')

@section('content')

    @php
        $levels = config('bcks.instrumen.levels');
        $pertanyaanTerbuka = config('bcks.instrumen.pertanyaan_terbuka');

        $jawabanByNomor = $bcksPengisian->jawaban->keyBy('nomor_indikator');
    @endphp

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Pengisian Instrumen BCKS
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Perbarui data identitas, penilaian, dan jawaban BCKS.
                </p>
            </div>
            <a href="{{ route('bcks.show', $bcksPengisian)}}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
        {{-- ERROR --}}
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


        <form action="{{ route('bcks.update', $bcksPengisian) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')


            {{-- A. IDENTITAS BCKS --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">

                    <h2 class="text-lg font-bold text-slate-800">
                        A. Identitas BCKS
                    </h2>

                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <div>

                        <label for="nama_bcks" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama BCKS <span class="text-red-500">*</span>
                        </label>

                        <input type="text" id="nama_bcks" name="nama_bcks"
                            value="{{ old('nama_bcks', $bcksPengisian->nama_bcks) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>


                    <div>

                        <label for="unit_kerja" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja
                        </label>

                        <input type="text" id="unit_kerja" name="unit_kerja"
                            value="{{ old('unit_kerja', $bcksPengisian->unit_kerja) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>


                    <div class="md:col-span-2">

                        <label for="angkatan_pelatihan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Angkatan Pelatihan BCKS
                        </label>

                        <input type="text" id="angkatan_pelatihan" name="angkatan_pelatihan"
                            value="{{ old('angkatan_pelatihan', $bcksPengisian->angkatan_pelatihan) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

                </div>

            </div>


            {{-- B. IDENTITAS RESPONDEN --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">

                    <h2 class="text-lg font-bold text-slate-800">
                        B. Identitas Responden
                    </h2>

                </div>


                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <div>

                        <label for="nama_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Responden <span class="text-red-500">*</span>
                        </label>

                        <input type="text" id="nama_responden" name="nama_responden"
                            value="{{ old('nama_responden', $bcksPengisian->nama_responden) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>


                    <div>

                        <label for="unit_kerja_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja Responden
                        </label>

                        <input type="text" id="unit_kerja_responden" name="unit_kerja_responden"
                            value="{{ old('unit_kerja_responden', $bcksPengisian->unit_kerja_responden) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>


                    <div class="md:col-span-2">

                        <label for="status_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Status Responden <span class="text-red-500">*</span>
                        </label>

                        <select id="status_responden" name="status_responden" required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                Pilih status responden
                            </option>

                            <option value="BCKS" @selected(old('status_responden', $bcksPengisian->status_responden) === 'BCKS')>
                                BCKS
                            </option>

                            <option value="Atasan Langsung / Pengawas Sekolah" @selected(old('status_responden', $bcksPengisian->status_responden) === 'Atasan Langsung / Pengawas Sekolah')>
                                Atasan Langsung / Pengawas Sekolah
                            </option>

                            <option value="Perwakilan Guru / Tenaga Kependidikan" @selected(old('status_responden', $bcksPengisian->status_responden) === 'Perwakilan Guru / Tenaga Kependidikan')>
                                Perwakilan Guru / Tenaga Kependidikan
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- C. PETUGAS MONEV --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">

                    <h2 class="text-lg font-bold text-slate-800">
                        C. Petugas Monev
                    </h2>

                </div>


                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <div>

                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>

                        <input type="text" id="nama_petugas_monev" name="nama_petugas_monev"
                            value="{{ old('nama_petugas_monev', $bcksPengisian->nama_petugas_monev) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>


                    <div>

                        <label for="unit_kerja_petugas" class="mb-2 block text-sm font-semibold text-slate-700">
                            Unit Kerja Petugas
                        </label>

                        <input type="text" id="unit_kerja_petugas" name="unit_kerja_petugas"
                            value="{{ old('unit_kerja_petugas', $bcksPengisian->unit_kerja_petugas) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>


                    <div>

                        <label for="tanggal_evaluasi" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Evaluasi <span class="text-red-500">*</span>
                        </label>

                        <input type="date" id="tanggal_evaluasi" name="tanggal_evaluasi"
                            value="{{ old('tanggal_evaluasi', $bcksPengisian->tanggal_evaluasi?->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

                </div>

            </div>


            {{-- PENILAIAN --}}
            <div class="space-y-6">

                @foreach ($levels as $levelKey => $level)

                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">

                            <h2 class="text-lg font-bold text-slate-800">
                                {{ $level['label'] }}
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Pilih satu skor untuk setiap indikator.
                            </p>

                        </div>


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

                                        <th
                                            class="w-20 border-b border-slate-200 px-3 py-3 text-center text-xs font-bold text-slate-500">
                                            1
                                        </th>

                                        <th
                                            class="w-20 border-b border-slate-200 px-3 py-3 text-center text-xs font-bold text-slate-500">
                                            2
                                        </th>

                                        <th
                                            class="w-20 border-b border-slate-200 px-3 py-3 text-center text-xs font-bold text-slate-500">
                                            3
                                        </th>

                                        <th
                                            class="w-20 border-b border-slate-200 px-3 py-3 text-center text-xs font-bold text-slate-500">
                                            4
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-slate-100">

                                    @foreach ($level['indikator'] as $indikator)

                                        @php

                                            $kodeForm = str_replace('.', '_', $indikator['kode']);

                                            [$levelNumber, $nomor] = explode('.', $indikator['kode']);

                                            $nomorIndikator = match ($levelNumber) {
                                                '1' => (int) $nomor,
                                                '2' => 4 + (int) $nomor,
                                                '3' => 8 + (int) $nomor,
                                                '4' => 20 + (int) $nomor,
                                            };

                                            $skorLama = $jawabanByNomor[$nomorIndikator]->skor ?? null;

                                            $skorSekarang = old(
                                                'skor.' . $kodeForm,
                                                $skorLama
                                            );

                                        @endphp


                                        <tr class="hover:bg-slate-50">

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
@endsection