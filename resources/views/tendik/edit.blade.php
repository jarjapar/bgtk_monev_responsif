@extends('layouts.app')

@section('title', 'Edit Hasil Penilaian TENDIK')
@section('page-title', 'Edit Hasil Penilaian TENDIK')

@section('content')
@php
    $pertanyaan = [
        1 => 'Materi pelatihan sesuai dengan tugas dan kebutuhan saya sebagai tenaga kependidikan.',
        2 => 'Cakupan materi lengkap dan disusun secara runtut sehingga mudah diikuti.',
        3 => 'Materi yang disampaikan sesuai dengan ketentuan dan perkembangan terbaru.',
        4 => 'Materi dilengkapi contoh kasus dan praktik sehingga dapat saya terapkan langsung di sekolah.',
        5 => 'Bahan pendukung (modul, tayangan, contoh dokumen) lengkap, jelas, dan bermanfaat.',
        6 => 'Narasumber/fasilitator menguasai materi dan menjawab pertanyaan dengan tepat.',
        7 => 'Narasumber/fasilitator menyampaikan materi dengan jelas, sistematis, dan mudah dipahami.',
        8 => 'Metode dan media pembelajaran membuat saya tertarik dan terlibat aktif.',
        9 => 'Narasumber/fasilitator terbuka terhadap pertanyaan, mendorong diskusi, dan memberikan umpan balik.',
        10 => 'Narasumber/fasilitator bersikap ramah dan santun serta mengelola waktu dengan baik.',
        11 => 'Informasi kegiatan (undangan, jadwal, dan bahan) disampaikan dengan jelas dan tepat waktu.',
        12 => 'Alokasi waktu dan jadwal pelatihan memadai dan dijalankan sesuai rencana.',
        13 => 'Tempat, sarana prasarana, dan konsumsi mendukung kelancaran kegiatan.',
        14 => 'Panitia melayani peserta dengan ramah, cepat tanggap, dan membantu.',
        15 => 'Secara keseluruhan, saya puas dengan penyelenggaraan pelatihan ini.',
        16 => 'Saya memahami jenis data sekolah yang harus dikelola serta alur pengelolaannya.',
        17 => 'Saya mampu mempraktikkan pengelolaan data sekolah sesuai ketentuan.',
        18 => 'Saya menjadi lebih teliti dan bertanggung jawab dalam menjaga keakuratan data sekolah.',
        19 => 'Saya memahami prosedur layanan administrasi sekolah yang benar.',
        20 => 'Saya mampu menyusun dokumen persuratan, mengelola arsip, dan melayani warga sekolah sesuai prosedur.',
        21 => 'Saya menjadi lebih ramah, tertib, dan responsif dalam melayani kebutuhan warga sekolah.',
        22 => 'Saya memahami ketentuan administrasi keuangan dan pelaporan yang berlaku di sekolah.',
        23 => 'Saya mampu menyusun pembukuan, bukti transaksi, dan laporan keuangan sesuai format yang ditetapkan.',
        24 => 'Saya menjadi lebih jujur, transparan, dan akuntabel dalam mengelola administrasi keuangan.',
        25 => 'Saya memahami peran dan manfaat kolaborasi serta jejaring dengan berbagai pihak.',
        26 => 'Saya mampu berkomunikasi, berkoordinasi, dan membangun jejaring kerja dengan berbagai pihak.',
        27 => 'Saya menjadi lebih terbuka, menghargai pendapat orang lain, dan mau bekerja sama.',
        28 => 'Saya memahami bahwa kemampuan dapat berkembang melalui usaha dan belajar serta perbedaan growth mindset dengan fixed mindset.',
        29 => 'Saya mampu merumuskan tujuan pengembangan diri dan strategi menghadapi tantangan serta umpan balik dalam pekerjaan.',
        30 => 'Saya memandang tantangan dan kesalahan sebagai peluang belajar dan bersemangat mengembangkan diri.',
        31 => 'Saya memahami peran, etika, dan standar kinerja tenaga kependidikan yang profesional.',
        32 => 'Saya mampu mengatur waktu dan prioritas kerja serta memanfaatkan teknologi secara profesional.',
        33 => 'Saya berkomitmen menjaga integritas, disiplin, tanggung jawab, dan kerahasiaan data dalam bekerja.',
        34 => 'Saya menerapkan hasil pelatihan dalam pengelolaan data sekolah dengan memperbarui dan memverifikasi data secara berkala.',
        35 => 'Saya melayani kebutuhan administrasi warga sekolah dengan lebih cepat, tertib, dan ramah.',
        36 => 'Saya menyusun dokumen administrasi dan laporan tepat waktu dan sesuai format.',
        37 => 'Saya berkolaborasi aktif dengan kepala sekolah, guru, rekan tenaga kependidikan, dan pihak luar dalam menjalankan tugas.',
        38 => 'Saya memanfaatkan teknologi dalam bekerja dan menjaga keamanan serta kerahasiaan data sekolah.',
        39 => 'Data sekolah menjadi lebih akurat, lengkap, dan mutakhir dibandingkan sebelum pelatihan.',
        40 => 'Waktu penyelesaian layanan administrasi menjadi lebih singkat dan keluhan layanan berkurang.',
        41 => 'Kesalahan dan temuan pada laporan administrasi maupun keuangan berkurang.',
        42 => 'Kerja sama tim dan koordinasi antarwarga sekolah menjadi lebih baik.',
        43 => 'Pelatihan memberi dampak positif pada mutu layanan dan kinerja sekolah secara keseluruhan.',
    ];

    $levels = [
        1 => ['nama' => 'LEVEL I — REAKSI', 'awal' => 1, 'akhir' => 15],
        2 => ['nama' => 'LEVEL II — BELAJAR', 'awal' => 16, 'akhir' => 33],
        3 => ['nama' => 'LEVEL III — PERILAKU', 'awal' => 34, 'akhir' => 38],
        4 => ['nama' => 'LEVEL IV — HASIL', 'awal' => 39, 'akhir' => 43],
    ];
@endphp

<div class="mx-auto max-w-6xl space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Edit Hasil Penilaian TENDIK</h1>
            <p class="mt-1 text-sm text-slate-500">Perbarui identitas responden dan jawaban instrumen.</p>
        </div>
         <a href="{{ route('tendik.show', $tendik)}}"
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
            <p class="font-semibold">Periksa kembali data berikut:</p>
            <ul class="mt-2 list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tendik.update', $tendik) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="mb-5 border-b border-slate-100 pb-4 text-lg font-bold text-slate-900">
                A. Identitas Petugas Monev
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="nama_petugas_monev" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Petugas Monev *</label>
                    <input id="nama_petugas_monev" name="nama_petugas_monev" required
                           value="{{ old('nama_petugas_monev', $tendik->nama_petugas_monev) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('nama_petugas_monev')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="instansi_petugas" class="mb-1.5 block text-sm font-semibold text-slate-700">Instansi Petugas *</label>
                    <input id="instansi_petugas" name="instansi_petugas" required
                           value="{{ old('instansi_petugas', $tendik->instansi_petugas) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('instansi_petugas')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                
{{-- Lokasi Monev --}}
<div>
    <label for="lokasi_monev"
        class="mb-1.5 block text-sm font-semibold text-slate-700">
        Lokasi Monev <span class="text-red-500">*</span>
    </label>

    <input
        type="text"
        id="lokasi_monev"
        name="lokasi_monev"
        value="{{ old('lokasi_monev', $tendik->lokasi_monev) }}"
        placeholder="Masukkan lokasi Monev"
        required
        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

    @error('lokasi_monev')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Tanggal Pelaksanaan --}}
<div>
    <label for="tanggal_pengisian"
        class="mb-1.5 block text-sm font-semibold text-slate-700">
        Tanggal Pelaksanaan <span class="text-red-500">*</span>
    </label>

    <input
        type="date"
        id="tanggal_pengisian"
        name="tanggal_pengisian"
        value="{{ old('tanggal_pengisian', $tendik->tanggal_pengisian
            ? \Carbon\Carbon::parse($tendik->tanggal_pengisian)->format('Y-m-d')
            : '') }}"
        required
        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

    @error('tanggal_pengisian')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

            </div>
        </section>

        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="mb-5 border-b border-slate-100 pb-4 text-lg font-bold text-slate-900">
                B. Identitas Responden
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="nama_responden" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Responden *</label>
                    <input id="nama_responden" name="nama_responden" required
                           value="{{ old('nama_responden', $tendik->nama_responden) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('nama_responden')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="jabatan_responden" class="mb-1.5 block text-sm font-semibold text-slate-700">Jabatan *</label>
                    <select id="jabatan_responden" name="jabatan_responden" required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">Pilih jabatan</option>
                        @foreach (['Operator Sekolah', 'Bendahara Sekolah', 'Lainnya'] as $jabatan)
                            <option value="{{ $jabatan }}" @selected(old('jabatan_responden', $tendik->jabatan_responden) === $jabatan)>
                                {{ $jabatan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jabatan_responden')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div id="jabatan-lainnya-wrap">
                    <label for="jabatan_lainnya" class="mb-1.5 block text-sm font-semibold text-slate-700">Jabatan Lainnya</label>
                    <input id="jabatan_lainnya" name="jabatan_lainnya"
                           value="{{ old('jabatan_lainnya', $tendik->jabatan_lainnya) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('jabatan_lainnya')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="satuan_pendidikan" class="mb-1.5 block text-sm font-semibold text-slate-700">Satuan Pendidikan *</label>
                    <input id="satuan_pendidikan" name="satuan_pendidikan" required
                           value="{{ old('satuan_pendidikan', $tendik->satuan_pendidikan) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('satuan_pendidikan')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="masa_kerja" class="mb-1.5 block text-sm font-semibold text-slate-700">Masa Kerja (tahun) *</label>
                    <input id="masa_kerja" type="number" min="0" max="100" name="masa_kerja" required
                           value="{{ old('masa_kerja', $tendik->masa_kerja) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('masa_kerja')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="nama_pelatihan" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Kegiatan/Pelatihan *</label>
                    <input id="nama_pelatihan" name="nama_pelatihan" required
                           value="{{ old('nama_pelatihan', $tendik->nama_pelatihan) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('nama_pelatihan')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="tanggal_pengisian" class="mb-1.5 block text-sm font-semibold text-slate-700">Tanggal Pengisian *</label>
                    <input id="tanggal_pengisian" type="date" name="tanggal_pengisian" required
                           value="{{ old('tanggal_pengisian', $tendik->tanggal_pengisian?->format('Y-m-d')) }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('tanggal_pengisian')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        @foreach ($levels as $nomorLevel => $level)
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 bg-slate-50 px-5 py-4 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-900">{{ $level['nama'] }}</h2>
                    <p class="mt-1 text-sm text-slate-500">Pilih satu skor untuk setiap pernyataan.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200">
                                <th class="w-14 px-4 py-3 text-xs font-bold uppercase text-slate-500">No.</th>
                                <th class="px-4 py-3 text-xs font-bold uppercase text-slate-500">Pernyataan</th>
                                @foreach ([1, 2, 3, 4] as $skor)
                                    <th class="w-14 px-3 py-3 text-center text-xs font-bold uppercase text-slate-500">{{ $skor }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @for ($i = $level['awal']; $i <= $level['akhir']; $i++)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-4 align-top text-sm font-semibold text-slate-600">{{ $i }}</td>
                                    <td class="px-4 py-4 align-top text-sm leading-6 text-slate-700">
                                        {{ $pertanyaan[$i] }}
                                        @error('jawaban_'.$i)
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    @foreach ([1, 2, 3, 4] as $skor)
                                        <td class="px-3 py-4 text-center align-top">
                                            <input
                                                type="radio"
                                                name="jawaban_{{ $i }}"
                                                value="{{ $skor }}"
                                                @checked((string) old('jawaban_'.$i, $tendik->{'jawaban_'.$i}) === (string) $skor)
                                                required
                                                class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"
                                            >
                                        </td>
                                    @endforeach
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </section>
        @endforeach

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jabatan = document.getElementById('jabatan_responden');
    const wrap = document.getElementById('jabatan-lainnya-wrap');
    const input = document.getElementById('jabatan_lainnya');

    function toggleJabatanLainnya() {
        const tampil = jabatan.value === 'Lainnya';
        wrap.style.display = tampil ? 'block' : 'none';
        input.required = tampil;
        if (!tampil) input.value = '';
    }

    jabatan.addEventListener('change', toggleJabatanLainnya);
    toggleJabatanLainnya();
});
</script>
@endsection
