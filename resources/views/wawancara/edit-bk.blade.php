
@extends('layouts.app')

@section('title', 'Edit Wawancara BK')
@section('page-title', 'Edit Wawancara BK')

@section('content')
    @php
        $info = json_decode($wawancara->hasil_wawancara ?? '{}', true);

        if (!is_array($info)) {
            $info = [];
        }

        $pertanyaan = [
            1 => 'Apa saja hambatan yang Anda hadapi selama mengikuti pelatihan ini?',
            2 => 'Hal baik apa saja yang harus dipertahankan dalam pelaksanaan pelatihan ini?',
            3 => 'Saran apa yang dapat Anda berikan untuk peningkatan dan keberlanjutan program ini?',
        ];
    @endphp

    <div class="min-h-screen bg-gray-50 p-6">
        <div class="mx-auto max-w-5xl">

            {{-- Header --}}
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Wawancara BK</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Perbarui informasi, identitas responden, dan hasil wawancara.
                    </p>
                </div>

                <a href="{{ route('wawancara.show', $wawancara->id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- Pesan Validasi --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('wawancara.update', $wawancara->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Informasi Pelaksanaan --}}
                <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="font-semibold text-gray-800">Informasi Pelaksanaan</h2>
                    </div>

                    <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">
                                Jenis Wawancara
                            </label>
                            <input type="text" value="BK" disabled
                                class="w-full rounded-lg border border-gray-200 bg-gray-100 px-3 py-2 text-sm text-gray-600">
                        </div>

                        <div>
                            <label for="tanggal_wawancara" class="mb-2 block text-sm font-medium text-gray-700">
                                Tanggal Wawancara <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggal_wawancara" name="tanggal_wawancara"
                                value="{{ old('tanggal_wawancara', $wawancara->tanggal_wawancara ? \Carbon\Carbon::parse($wawancara->tanggal_wawancara)->format('Y-m-d') : '') }}"
                                required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="lokasi_monev" class="mb-2 block text-sm font-medium text-gray-700">
                                Lokasi Monev
                            </label>
                            <input type="text" id="lokasi_monev" name="lokasi_monev"
                                value="{{ old('lokasi_monev', $info['lokasi_monev'] ?? '') }}"
                                maxlength="255"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <!-- <div>
                            <label for="kab_kota" class="mb-2 block text-sm font-medium text-gray-700">
                                Kabupaten/Kota
                            </label>
                            <input type="text" id="kab_kota" name="kab_kota"
                                value="{{ old('kab_kota', $info['kab_kota'] ?? '') }}"
                                maxlength="255"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div> -->
                    </div>
                </div>

                {{-- Identitas Responden dan Petugas --}}
                <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="font-semibold text-gray-800">
                            Identitas Responden dan Petugas Monev
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2">
                        <div>
                            <label for="nama_responden" class="mb-2 block text-sm font-medium text-gray-700">
                                Nama Responden <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_responden" name="nama_responden"
                                value="{{ old('nama_responden', $wawancara->nama_responden ?: $wawancara->nama_narasumber) }}"
                                maxlength="255" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="instansi_responden" class="mb-2 block text-sm font-medium text-gray-700">
                                Instansi Responden
                            </label>
                            <input type="text" id="instansi_responden" name="instansi_responden"
                                value="{{ old('instansi_responden', $wawancara->unit_kerja_responden ?: $wawancara->jabatan_narasumber) }}"
                                maxlength="255"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="jabatan" class="mb-2 block text-sm font-medium text-gray-700">
                                Jabatan
                            </label>
                            <input type="text" id="jabatan" name="jabatan"
                                value="{{ old('jabatan', $info['jabatan'] ?? '') }}"
                                maxlength="255"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="satuan_pendidikan" class="mb-2 block text-sm font-medium text-gray-700">
                                Satuan Pendidikan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="satuan_pendidikan" name="satuan_pendidikan"
                                value="{{ old('satuan_pendidikan', $info['satuan_pendidikan'] ?? '') }}"
                                maxlength="255" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="masa_kerja" class="mb-2 block text-sm font-medium text-gray-700">
                                Masa Kerja (Tahun) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="masa_kerja" name="masa_kerja"
                                value="{{ old('masa_kerja', $info['masa_kerja'] ?? '') }}"
                                min="0" step="1" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="nama_kegiatan" class="mb-2 block text-sm font-medium text-gray-700">
                                Nama Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                                value="{{ old('nama_kegiatan', $info['nama_kegiatan'] ?? '') }}"
                                maxlength="255" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="tanggal_pengisian" class="mb-2 block text-sm font-medium text-gray-700">
                                Tanggal Pengisian <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggal_pengisian" name="tanggal_pengisian"
                                value="{{ old('tanggal_pengisian', $info['tanggal_pengisian'] ?? '') }}"
                                required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="nama_petugas_monev" class="mb-2 block text-sm font-medium text-gray-700">
                                Nama Petugas Monev <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_petugas_monev" name="nama_petugas_monev"
                                value="{{ old('nama_petugas_monev', $wawancara->nama_petugas_monev ?: $wawancara->nama_pewawancara) }}"
                                maxlength="255" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="instansi_petugas" class="mb-2 block text-sm font-medium text-gray-700">
                                Instansi Petugas
                            </label>
                            <input type="text" id="instansi_petugas" name="instansi_petugas"
                                value="{{ old('instansi_petugas', $info['instansi_petugas'] ?? $wawancara->unit_kerja_petugas) }}"
                                maxlength="255"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        </div>
                    </div>
                </div>

                {{-- Jawaban Esai --}}
                <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="font-semibold text-gray-800">Jawaban Esai Wawancara BK</h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Pastikan setiap pertanyaan memiliki jawaban.
                        </p>
                    </div>

                    <div class="space-y-6 p-6">
                        @foreach ($pertanyaan as $nomor => $teks)
                            <div>
                                <label for="jawaban_{{ $nomor }}"
                                    class="mb-2 block text-sm font-medium leading-6 text-gray-800">
                                    {{ $nomor }}. {{ $teks }}
                                    <span class="text-red-500">*</span>
                                </label>

                                <textarea id="jawaban_{{ $nomor }}"
                                    name="jawaban_wawancara[{{ $nomor }}]"
                                    rows="5" required
                                    class="w-full rounded-lg border border-gray-300 px-3 py-3 text-sm leading-6 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('jawaban_wawancara.' . $nomor, $wawancara->{'jawaban_' . $nomor}) }}</textarea>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex flex-wrap justify-end gap-3">
                    

                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
