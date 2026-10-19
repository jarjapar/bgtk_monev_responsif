@extends('layouts.app')

@section('title', 'Edit Instrumen BK')

@section('page-title', 'Edit Instrumen BK')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Pengisian Instrumen BK
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Perbarui data identitas, lokasi, dan jawaban BK.
                </p>
            </div>
            <a href="{{ route('bk.show', $submission)}}"
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

        <form action="{{ route('bk.update', $submission) }}" method="POST" id="bkEditForm" class="space-y-6">

            @csrf
            @method('PUT')

            {{-- A. IDENTITAS RESPONDEN --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                    <h2 class="text-lg font-bold text-slate-800">A. Identitas Responden</h2>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Responden <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_responden" name="nama_responden"
                            value="{{ old('nama_responden', $submission->nama_responden) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="jabatan_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Jabatan Responden <span class="text-red-500">*</span>
                        </label>
                        <select id="jabatan_responden" name="jabatan_responden" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            <option value="">Pilih jabatan</option>
                            <option value="Operator Sekolah" @selected(old('jabatan_responden', $submission->jabatan_responden) === 'Operator Sekolah')>Operator Sekolah</option>
                            <option value="Bendahara Sekolah" @selected(old('jabatan_responden', $submission->jabatan_responden) === 'Bendahara Sekolah')>Bendahara Sekolah</option>
                            <option value="Lainnya" @selected(old('jabatan_responden', $submission->jabatan_responden) === 'Lainnya')>Lainnya</option>
                        </select>
                    </div>

                    <div id="jabatanLainnyaWrapper"
                        class="{{ old('jabatan_responden', $submission->jabatan_responden) === 'Lainnya' ? '' : 'hidden' }}">
                        <label for="jabatan_lainnya" class="mb-2 block text-sm font-semibold text-slate-700">
                            Jabatan Lainnya <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="jabatan_lainnya" name="jabatan_lainnya"
                            value="{{ old('jabatan_lainnya', $submission->jabatan_lainnya) }}"
                            placeholder="Masukkan jabatan"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="satuan_pendidikan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Satuan Pendidikan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="satuan_pendidikan" name="satuan_pendidikan"
                            value="{{ old('satuan_pendidikan', $submission->satuan_pendidikan) }}" required
                            placeholder="Masukkan nama satuan pendidikan"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="masa_kerja" class="mb-2 block text-sm font-semibold text-slate-700">
                            Masa Kerja (tahun) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="masa_kerja" name="masa_kerja" min="0" max="100" step="1"
                            value="{{ old('masa_kerja', $submission->masa_kerja) }}" required placeholder="Contoh: 5"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="nama_pelatihan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Pelatihan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_pelatihan" name="nama_pelatihan"
                            value="{{ old('nama_pelatihan', $submission->nama_pelatihan) }}" required
                            placeholder="Masukkan nama pelatihan"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="tanggal_pengisian" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Pengisian <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="tanggal_pengisian" name="tanggal_pengisian"
                            value="{{ old('tanggal_pengisian', optional($submission->tanggal_pengisian)->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>
            </div>

            {{-- B. IDENTITAS PETUGAS MONEV --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                    <h2 class="text-lg font-bold text-slate-800">B. Identitas Petugas Monev</h2>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_petugas_monev" name="nama_petugas_monev"
                            value="{{ old('nama_petugas_monev', $submission->nama_petugas_monev) }}" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="instansi_petugas" class="mb-2 block text-sm font-semibold text-slate-700">
                            Instansi Petugas
                        </label>
                        <input type="text" id="instansi_petugas" name="instansi_petugas"
                            value="{{ old('instansi_petugas', $submission->instansi_petugas) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="lokasi_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Lokasi Monev
                        </label>
                        <input type="text" id="lokasi_monev" name="lokasi_monev"
                            value="{{ old('lokasi_monev', $submission->lokasi_monev) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="tanggal_pelaksanaan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Pelaksanaan
                        </label>
                        <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan"
                            value="{{ old('tanggal_pelaksanaan', optional($submission->tanggal_pelaksanaan)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>
            </div>

            {{-- INDIKATOR BK --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">

                    <h2 class="text-lg font-bold text-slate-800">
                        Instrumen BK
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Periksa kembali setiap indikator dan pilih Ya atau Tidak.
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
                                    class="w-24 border-b border-slate-200 px-3 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Ya
                                </th>

                                <th
                                    class="w-24 border-b border-slate-200 px-3 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Tidak
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

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

                                {{-- BARIS LEVEL --}}
                                @if ($currentLevel !== $question->level)

                                    @php
                                        $currentLevel = $question->level;
                                        $currentBagian = null;
                                    @endphp

                                    <tr>

                                        <td colspan="4" class="bg-slate-50 px-5 py-3">

                                            <p class="text-sm font-bold text-slate-800">
                                                Level {{ $question->level }}

                                                <span class="font-medium text-slate-500">
                                                    — {{ $question->level_nama }}
                                                </span>
                                            </p>

                                        </td>

                                    </tr>

                                @endif

                                {{-- BARIS BAGIAN --}}
                                @if ($currentBagian !== $question->bagian)

                                    @php
                                        $currentBagian = $question->bagian;
                                    @endphp

                                    <tr>

                                        <td colspan="4" class="px-5 py-2.5">

                                            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">

                                                {{ $question->bagian }}

                                                @if ($question->judul_bagian)

                                                    <span class="font-medium normal-case tracking-normal text-slate-400">
                                                        — {{ $question->judul_bagian }}
                                                    </span>

                                                @endif

                                            </p>

                                        </td>

                                    </tr>

                                @endif

                                {{-- PERTANYAAN --}}
                                <tr class="hover:bg-slate-50">

                                    <td class="px-4 py-4 text-center text-sm font-semibold text-slate-600">
                                        {{ $question->nomor }}
                                    </td>

                                    <td class="px-5 py-4 text-sm leading-6 text-slate-700">
                                        {{ $question->pernyataan }}
                                    </td>

                                    {{-- YA --}}
                                    <td class="px-3 py-4 text-center">

                                        <label class="inline-flex cursor-pointer items-center justify-center">

                                            <input type="radio" name="jawaban[{{ $question->id }}]" value="1"
                                                class="h-5 w-5 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-200"
                                                {{ (string) $currentAnswer === '1' ? 'checked' : '' }}>

                                        </label>

                                    </td>

                                    {{-- TIDAK --}}
                                    <td class="px-3 py-4 text-center">

                                        <label class="inline-flex cursor-pointer items-center justify-center">

                                            <input type="radio" name="jawaban[{{ $question->id }}]" value="0"
                                                class="h-5 w-5 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-200"
                                                {{ (string) $currentAnswer === '0' ? 'checked' : '' }}>

                                        </label>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="px-6 py-16 text-center">

                                        <p class="text-sm text-slate-400">
                                            Pertanyaan BK belum tersedia.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- PERTANYAAN URAIAN --}}
            @if ($essayAnswers->count() > 0)

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">

                        <h2 class="text-lg font-bold text-slate-800">
                            Pertanyaan Uraian
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Perbarui jawaban uraian jika diperlukan.
                        </p>

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
                                            class="w-full resize-y rounded-xl border border-slate-300 px-4 py-3 text-sm leading-6 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old(
                                "essay.{$essay->nomor}.jawaban",
                                $essay->jawaban
                            ) }}</textarea>

                                    </div>

                        @endforeach

                    </div>

                </div>

            @endif

            {{-- TOMBOL --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jabatanSelect = document.getElementById('jabatan_responden');
            const lainnyaWrapper = document.getElementById('jabatanLainnyaWrapper');
            const jabatanLainnya = document.getElementById('jabatan_lainnya');

            function toggleJabatanLainnya() {
                const isLainnya = jabatanSelect.value === 'Lainnya';
                lainnyaWrapper.classList.toggle('hidden', !isLainnya);
                jabatanLainnya.required = isLainnya;
                if (!isLainnya) jabatanLainnya.value = '';
            }

            jabatanSelect.addEventListener('change', toggleJabatanLainnya);
            toggleJabatanLainnya();
        });
    </script>

@endsection