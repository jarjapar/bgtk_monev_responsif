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

        $pilihanJabatan = [
            'Tendik',
            'Operator',
            'Bendahara',
            'Kepala Sekolah',
            'Rekan Sejawat/Guru',
        ];

        $jabatanSaatIni = old(
            'jabatan_responden',
            data_get($metadata, 'jabatan_responden')
            ?: $wawancara->status_responden
            ?: $wawancara->jabatan_narasumber
        );

        // Normalisasi jabatan dari data lama ke pilihan yang tersedia.
        $normalisasiJabatan = [
            'Operator Sekolah' => 'Operator',
            'Bendahara Sekolah' => 'Bendahara',
            'Rekan Sejawat' => 'Rekan Sejawat/Guru',
            'Guru' => 'Rekan Sejawat/Guru',
        ];

        $jabatanSaatIni = $normalisasiJabatan[$jabatanSaatIni] ?? $jabatanSaatIni;

        if (!in_array($jabatanSaatIni, $pilihanJabatan, true)) {
            $jabatanSaatIni = '';
        }

        $tanggalPelaksanaanAwal = old(
            'tanggal_pelaksanaan',
            data_get($metadata, 'tanggal_pelaksanaan')
            ?: $wawancara->tanggal_evaluasi
            ?: $wawancara->tanggal_wawancara
        );

        $tanggalPelaksanaan = $tanggalPelaksanaanAwal
            ? \Illuminate\Support\Carbon::parse($tanggalPelaksanaanAwal)->format('Y-m-d')
            : now()->format('Y-m-d');

        $tanggalPengisianAwal = old('tanggal_wawancara', $wawancara->tanggal_wawancara);

        $tanggalPengisian = $tanggalPengisianAwal
            ? \Illuminate\Support\Carbon::parse($tanggalPengisianAwal)->format('Y-m-d')
            : now()->format('Y-m-d');

        $namaPetugas = old(
            'nama_petugas_monev',
            $wawancara->nama_petugas_monev ?? $wawancara->nama_pewawancara
        );

        $instansiPetugas = old(
            'instansi_petugas',
            data_get($metadata, 'instansi_petugas')
            ?: $wawancara->unit_kerja_petugas
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
            data_get($metadata, 'satuan_pendidikan')
            ?: $wawancara->unit_kerja_responden
            ?: $wawancara->sekolah?->nama_sekolah
        );

        $masaKerja = old(
            'masa_kerja',
            data_get($metadata, 'masa_kerja', '')
        );

        $namaPelatihan = old(
            'nama_pelatihan',
            data_get($metadata, 'nama_pelatihan')
            ?: data_get($metadata, 'nama_kegiatan', '')
        );
    @endphp

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('wawancara.index') }}" class="hover:text-blue-600">Wawancara</a>
                    <span>/</span>
                    <span>Edit Wawancara TENDIK</span>
                </div>

                <h1 class="text-2xl font-bold text-slate-800">Edit Instrumen Wawancara TENDIK</h1>
                <p class="mt-2 text-sm text-slate-500">
                    Perbarui identitas petugas, identitas responden, dan hasil wawancara.
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

        {{-- Validasi --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold">Periksa kembali isian formulir.</p>
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

            {{-- A. Identitas Petugas Monev --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h2 class="font-bold text-slate-800">A. Identitas Petugas Monev</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi petugas yang melaksanakan monitoring dan evaluasi.
                    </p>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_petugas_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_petugas_monev" name="nama_petugas_monev" value="{{ $namaPetugas }}" required
                            maxlength="255"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_petugas_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="instansi_petugas" class="mb-2 block text-sm font-semibold text-slate-700">
                            Instansi Petugas <span class="text-red-500">*</span>
                        </label>
                        <input id="instansi_petugas" name="instansi_petugas" value="{{ $instansiPetugas }}" required
                            maxlength="255" placeholder="Contoh: BGTK Provinsi NTB"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('instansi_petugas')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lokasi_monev" class="mb-2 block text-sm font-semibold text-slate-700">
                            Lokasi Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="lokasi_monev" name="lokasi_monev" value="{{ $lokasiMonev }}" required maxlength="255"
                            placeholder="Masukkan lokasi Monev"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('lokasi_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_pelaksanaan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Pelaksanaan <span class="text-red-500">*</span>
                        </label>
                        <input id="tanggal_pelaksanaan" type="date" name="tanggal_pelaksanaan"
                            value="{{ $tanggalPelaksanaan }}" required
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('tanggal_pelaksanaan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- B. Identitas Responden --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h2 class="font-bold text-slate-800">B. Identitas Responden</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Tanda bintang (*) menunjukkan kolom wajib diisi.
                    </p>
                </div>

                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="nama_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Responden <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_responden" name="nama_responden" value="{{ $namaResponden }}" required
                            maxlength="255"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_responden')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jabatan_responden" class="mb-2 block text-sm font-semibold text-slate-700">
                            Jabatan Responden <span class="text-red-500">*</span>
                        </label>

                        <select id="jabatan_responden" name="jabatan_responden" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <option value="" disabled @selected($jabatanSaatIni === '')>
                                Pilih jabatan
                            </option>

                            @foreach ($pilihanJabatan as $pilihan)
                                <option value="{{ $pilihan }}" @selected($jabatanSaatIni === $pilihan)>
                                    {{ $pilihan }}
                                </option>
                            @endforeach
                        </select>

                        @error('jabatan_responden')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="satuan_pendidikan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Satuan Pendidikan <span class="text-red-500">*</span>
                        </label>
                        <input id="satuan_pendidikan" name="satuan_pendidikan" value="{{ $satuanPendidikan }}" required
                            maxlength="255" placeholder="Nama sekolah atau satuan pendidikan"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('satuan_pendidikan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="masa_kerja" class="mb-2 block text-sm font-semibold text-slate-700">
                            Masa Kerja (tahun) <span class="text-red-500">*</span>
                        </label>
                        <input id="masa_kerja" name="masa_kerja" type="number" min="0" max="100" step="0.5"
                            value="{{ $masaKerja }}" required placeholder="Contoh: 5 atau 5.5"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('masa_kerja')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_pelatihan" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Kegiatan/Pelatihan <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_pelatihan" name="nama_pelatihan" value="{{ $namaPelatihan }}" required
                            maxlength="255"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_pelatihan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_wawancara" class="mb-2 block text-sm font-semibold text-slate-700">
                            Tanggal Pengisian <span class="text-red-500">*</span>
                        </label>
                        <input id="tanggal_wawancara" name="tanggal_wawancara" type="date"
                            value="{{ $tanggalPengisian }}" required
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('tanggal_wawancara')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- C. Hasil Wawancara --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-6 py-4">
                    <h2 class="font-bold text-slate-800">C. Hasil Wawancara TENDIK</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Jawablah berdasarkan pengalaman Anda setelah mengikuti pelatihan.
                        Seluruh pertanyaan wajib diisi.
                    </p>
                </div>

                <div class="space-y-6 p-6">
                    @foreach ($pertanyaan as $nomor => $teks)
                        <div>
                            <label for="jawaban_{{ $nomor }}" class="mb-2 block text-sm font-semibold leading-6 text-slate-700">
                                {{ $nomor }}. {{ $teks }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="jawaban_{{ $nomor }}" name="jawaban_{{ $nomor }}" rows="4" required
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm leading-6 text-slate-800 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                placeholder="Tuliskan jawaban Anda secara jelas dan lengkap...">{{ old('jawaban_' . $nomor, $wawancara->{'jawaban_' . $nomor}) }}</textarea>
                            @error('jawaban_' . $nomor)
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('wawancara.show', $wawancara->id) }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection