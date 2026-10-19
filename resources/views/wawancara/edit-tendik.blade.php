
@extends('layouts.app')

@section('title', 'Edit Wawancara TENDIK')
@section('page-title', 'Edit Wawancara TENDIK')

@section('content')
    @php
        $metadata = $metadata ?? [];

        $pertanyaan = [
            1 => '(Reaksi) Hal apa dari substansi materi, fasilitator, maupun layanan penyelenggaraan yang menurut Anda paling bermanfaat dan berkesan? Mengapa?',
            2 => '(Belajar) Pengetahuan, keterampilan, atau sikap baru apa yang Anda kuasai setelah pelatihan (termasuk growth mindset dan profesionalisme), dan materi apa yang masih perlu diperdalam?',
            3 => '(Perilaku) Berikan contoh nyata penerapan hasil pelatihan dalam pekerjaan Anda sehari-hari.',
            4 => '(Perilaku) Kendala apa yang Anda hadapi dalam menerapkan hasil pelatihan, dan dukungan apa yang Anda perlukan?',
            5 => '(Hasil) Perubahan atau dampak apa yang terlihat di sekolah setelah pelatihan, dan apa saran Anda untuk perbaikan program berikutnya?',
        ];

        $jabatanSaatIni = old(
            'jabatan_responden',
            data_get($metadata, 'jabatan_responden', $wawancara->status_responden)
        );

        $jabatanLainnya = old(
            'jabatan_lainnya',
            data_get($metadata, 'jabatan_lainnya', '')
        );

        $pilihanJabatan = [
            'Operator Sekolah',
            'Bendahara Sekolah',
            'Lainnya',
        ];

        $jabatanKustom = $jabatanSaatIni
            && !in_array($jabatanSaatIni, $pilihanJabatan, true);

        if ($jabatanKustom) {
            $jabatanLainnya = $jabatanLainnya ?: $jabatanSaatIni;
            $jabatanSaatIni = 'Lainnya';
        }

        $tanggalAwal = old(
            'tanggal_pengisian',
            data_get($metadata, 'tanggal_pengisian', $wawancara->tanggal_wawancara)
        );

        $tanggal = $tanggalAwal
            ? \Illuminate\Support\Carbon::parse($tanggalAwal)->format('Y-m-d')
            : now()->format('Y-m-d');

        $namaPetugas = old(
            'nama_petugas_monev',
            $wawancara->nama_petugas_monev ?? $wawancara->nama_pewawancara
        );

        $instansiPetugas = old(
            'instansi_petugas',
            data_get($metadata, 'instansi_petugas', $wawancara->unit_kerja_petugas)
        );

        $lokasiMonev = old(
            'lokasi_monev',
            data_get($metadata, 'lokasi_monev', '')
        );

        $namaResponden = old(
            'nama_responden',
            $wawancara->nama_responden ?? $wawancara->nama_narasumber
        );

        $satuanPendidikan = old(
            'satuan_pendidikan',
            data_get(
                $metadata,
                'satuan_pendidikan',
                $wawancara->unit_kerja_responden
                    ?? $wawancara->sekolah?->nama_sekolah
            )
        );

        $masaKerja = old(
            'masa_kerja',
            data_get($metadata, 'masa_kerja', '')
        );

        $namaPelatihan = old(
            'nama_pelatihan',
            data_get(
                $metadata,
                'nama_pelatihan',
                data_get($metadata, 'nama_kegiatan', '')
            )
        );
    @endphp

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-blue-600">
                    Lembar Wawancara / TENDIK
                </p>

                <h1 class="mt-1 text-2xl font-bold text-gray-900">
                    Edit Wawancara TENDIK
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Perbarui identitas petugas, responden, pelatihan, dan jawaban wawancara.
                </p>
            </div>

            <a href="{{ route('wawancara.show', $wawancara->id) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- Pesan validasi --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold">Periksa kembali formulir berikut:</p>

                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('wawancara.update', $wawancara->id) }}"
            method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')

            {{-- A. Identitas Petugas Monev --}}
            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-bold text-gray-900">
                        A. Identitas Petugas Monev
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <div>
                        <label for="nama_petugas_monev"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>

                        <input id="nama_petugas_monev"
                            type="text"
                            name="nama_petugas_monev"
                            value="{{ $namaPetugas }}"
                            maxlength="255"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="instansi_petugas"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Instansi Petugas <span class="text-red-500">*</span>
                        </label>

                        <input id="instansi_petugas"
                            type="text"
                            name="instansi_petugas"
                            value="{{ $instansiPetugas }}"
                            maxlength="255"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="lokasi_monev"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Lokasi Monev <span class="text-red-500">*</span>
                        </label>

                        <input id="lokasi_monev"
                            type="text"
                            name="lokasi_monev"
                            value="{{ $lokasiMonev }}"
                            maxlength="255"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="tanggal_pengisian"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Tanggal Pengisian <span class="text-red-500">*</span>
                        </label>

                        <input id="tanggal_pengisian"
                            type="date"
                            name="tanggal_pengisian"
                            value="{{ $tanggal }}"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                </div>
            </section>

            {{-- B. Identitas Responden --}}
            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-bold text-gray-900">
                        B. Identitas Responden
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <div>
                        <label for="nama_responden"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Responden <span class="text-red-500">*</span>
                        </label>

                        <input id="nama_responden"
                            type="text"
                            name="nama_responden"
                            value="{{ $namaResponden }}"
                            maxlength="255"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="jabatan_responden"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Jabatan Responden <span class="text-red-500">*</span>
                        </label>

                        <select id="jabatan_responden"
                            name="jabatan_responden"
                            required
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                            <option value="">Pilih jabatan</option>

                            @foreach (['Operator Sekolah', 'Bendahara Sekolah', 'Lainnya'] as $pilihan)
                                <option value="{{ $pilihan }}" @selected($jabatanSaatIni === $pilihan)>
                                    {{ $pilihan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="jabatan_lainnya_container"
                        class="{{ $jabatanSaatIni === 'Lainnya' ? '' : 'hidden' }}">

                        <label for="jabatan_lainnya"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Jabatan Lainnya <span class="text-red-500">*</span>
                        </label>

                        <input id="jabatan_lainnya"
                            type="text"
                            name="jabatan_lainnya"
                            value="{{ $jabatanLainnya }}"
                            maxlength="255"
                            {{ $jabatanSaatIni === 'Lainnya' ? 'required' : '' }}
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="satuan_pendidikan"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Satuan Pendidikan <span class="text-red-500">*</span>
                        </label>

                        <input id="satuan_pendidikan"
                            type="text"
                            name="satuan_pendidikan"
                            value="{{ $satuanPendidikan }}"
                            maxlength="255"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="masa_kerja"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Masa Kerja (Tahun) <span class="text-red-500">*</span>
                        </label>

                        <input id="masa_kerja"
                            type="number"
                            name="masa_kerja"
                            value="{{ $masaKerja }}"
                            min="0"
                            max="100"
                            step="0.1"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div>
                        <label for="nama_pelatihan"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Kegiatan/Pelatihan <span class="text-red-500">*</span>
                        </label>

                        <input id="nama_pelatihan"
                            type="text"
                            name="nama_pelatihan"
                            value="{{ $namaPelatihan }}"
                            maxlength="255"
                            required
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>

                </div>
            </section>

            {{-- C. Pertanyaan Terbuka --}}
            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-lg font-bold text-gray-900">
                        C. Pertanyaan Terbuka
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Periksa dan perbarui jawaban responden sebelum menyimpan perubahan.
                    </p>
                </div>

                <div class="space-y-6 p-6">
                    @foreach ($pertanyaan as $nomor => $teks)
                        <div>
                            <label for="jawaban_{{ $nomor }}"
                                class="mb-2 block text-sm font-semibold leading-6 text-gray-800">
                                {{ $nomor }}. {{ $teks }}
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea id="jawaban_{{ $nomor }}"
                                name="jawaban_{{ $nomor }}"
                                rows="5"
                                required
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm leading-6 text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('jawaban_' . $nomor, $wawancara->{'jawaban_' . $nomor}) }}</textarea>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col-reverse gap-3 pb-6 sm:flex-row sm:justify-end">
                

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jabatanSelect = document.getElementById('jabatan_responden');
            const containerLainnya = document.getElementById('jabatan_lainnya_container');
            const inputLainnya = document.getElementById('jabatan_lainnya');

            function toggleJabatanLainnya() {
                const isLainnya = jabatanSelect.value === 'Lainnya';

                containerLainnya.classList.toggle('hidden', !isLainnya);
                inputLainnya.required = isLainnya;

                if (!isLainnya) {
                    inputLainnya.value = '';
                }
            }

            jabatanSelect.addEventListener('change', toggleJabatanLainnya);
            toggleJabatanLainnya();
        });
    </script>
@endsection
