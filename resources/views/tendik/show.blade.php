@extends('layouts.app')



@section('title', 'Hasil Penilaian TENDIK')

@section('page-title', 'Hasil Penilaian TENDIK')



@section('content')

    @php

        /*

        |--------------------------------------------------------------------------

        | DATA PERTANYAAN ASLI INSTRUMEN TENDIK

        |--------------------------------------------------------------------------

        */

        $pertanyaan = [

            1 => 'Materi pelatihan sesuai dengan tugas dan kebutuhan saya sebagai tenaga kependidikan.',

            2 => 'Cakupan materi lengkap dan disusun secara runtut sehingga mudah diikuti.',

            3 => 'Materi yang disampaikan sesuai dengan ketentuan dan perkembangan terbaru.',

            4 => 'Materi dilengkapi contoh kasus dan praktik sehingga dapat saya terapkan langsung di sekolah.',

            5 => 'Bahan pendukung (modul, tayangan, contoh dokumen) lengkap, jelas, dan bermanfaat.',

            6 => 'Narasumber/fasilitator menguasai materi dan menjawab pertanyaan dengan tepat.',

            7 => 'Narasumber/fasilitator menyampaikan materi dengan jelas, sistematis, dan mudah dipahami.',

            8 => 'Metode dan media pembelajaran (contoh kasus, praktik, tayangan) membuat saya tertarik dan terlibat aktif.',

            9 => 'Narasumber/fasilitator terbuka terhadap pertanyaan, mendorong diskusi, dan memberikan umpan balik.',

            10 => 'Narasumber/fasilitator bersikap ramah dan santun serta mengelola waktu dengan baik.',

            11 => 'Informasi kegiatan (undangan, jadwal, dan bahan) disampaikan dengan jelas dan tepat waktu.',

            12 => 'Alokasi waktu dan jadwal pelatihan memadai dan dijalankan sesuai rencana.',

            13 => 'Tempat, sarana prasarana, dan konsumsi mendukung kelancaran kegiatan.',

            14 => 'Panitia melayani peserta dengan ramah, cepat tanggap, dan membantu.',

            15 => 'Secara keseluruhan, saya puas dengan penyelenggaraan pelatihan ini.',



            16 => 'Saya memahami jenis data sekolah yang harus dikelola serta alur pengelolaannya (pengumpulan, verifikasi, dan pemutakhiran).',

            17 => 'Saya mampu mempraktikkan pengelolaan data sekolah (input, verifikasi, dan pemutakhiran) sesuai ketentuan.',

            18 => 'Saya menjadi lebih teliti dan bertanggung jawab dalam menjaga keakuratan data sekolah.',

            19 => 'Saya memahami prosedur layanan administrasi sekolah (persuratan, pengarsipan, dan pelayanan warga sekolah) yang benar.',

            20 => 'Saya mampu menyusun dokumen persuratan, mengelola arsip, dan melayani warga sekolah sesuai prosedur.',

            21 => 'Saya menjadi lebih ramah, tertib, dan responsif dalam melayani kebutuhan warga sekolah.',

            22 => 'Saya memahami ketentuan administrasi keuangan dan pelaporan yang berlaku di sekolah.',

            23 => 'Saya mampu menyusun pembukuan, bukti transaksi, dan laporan keuangan sesuai format yang ditetapkan.',

            24 => 'Saya menjadi lebih jujur, transparan, dan akuntabel dalam mengelola administrasi keuangan.',

            25 => 'Saya memahami peran dan manfaat kolaborasi serta jejaring dengan kepala sekolah, guru, rekan sejawat, dinas, dan mitra.',

            26 => 'Saya mampu berkomunikasi, berkoordinasi, dan membangun jejaring kerja dengan berbagai pihak.',

            27 => 'Saya menjadi lebih terbuka, menghargai pendapat orang lain, dan mau bekerja sama.',

            28 => 'Saya memahami bahwa kemampuan dapat berkembang melalui usaha dan belajar, serta perbedaan growth mindset dengan fixed mindset.',

            29 => 'Saya mampu merumuskan tujuan pengembangan diri dan strategi menghadapi tantangan serta umpan balik dalam pekerjaan.',

            30 => 'Saya memandang tantangan dan kesalahan sebagai peluang belajar dan bersemangat mengembangkan diri.',

            31 => 'Saya memahami peran, etika, dan standar kinerja yang dituntut dari tenaga kependidikan yang profesional.',

            32 => 'Saya mampu mengatur waktu dan prioritas kerja serta memanfaatkan teknologi secara profesional.',

            33 => 'Saya berkomitmen menjaga integritas, disiplin, tanggung jawab, dan kerahasiaan data dalam bekerja.',



            34 => 'Saya menerapkan hasil pelatihan dalam pengelolaan data sekolah, yaitu memperbarui dan memverifikasi data secara berkala.',

            35 => 'Saya melayani kebutuhan administrasi warga sekolah dengan lebih cepat, tertib, dan ramah.',

            36 => 'Saya menyusun dokumen administrasi dan laporan (termasuk laporan keuangan) tepat waktu dan sesuai format.',

            37 => 'Saya berkolaborasi aktif dengan kepala sekolah, guru, rekan tenaga kependidikan, dan pihak luar (dinas, mitra jejaring) dalam menjalankan tugas.',

            38 => 'Saya memanfaatkan teknologi dalam bekerja dan menjaga keamanan serta kerahasiaan data sekolah.',



            39 => 'Data sekolah menjadi lebih akurat, lengkap, dan mutakhir dibandingkan sebelum pelatihan.',

            40 => 'Waktu penyelesaian layanan administrasi menjadi lebih singkat dan keluhan layanan berkurang.',

            41 => 'Kesalahan dan temuan pada laporan administrasi maupun keuangan berkurang.',

            42 => 'Kerja sama tim dan koordinasi antarwarga sekolah menjadi lebih baik.',

            43 => 'Pelatihan memberi dampak positif pada mutu layanan dan kinerja sekolah secara keseluruhan.',

        ];



        /*

        |--------------------------------------------------------------------------

        | LEVEL DAN RENTANG BUTIR

        |--------------------------------------------------------------------------

        */

        $levels = [

            1 => [

                'label' => 'Level I — Reaksi',

                'nama' => 'Reaksi (Reaction)',

                'deskripsi' => 'Kepuasan peserta terhadap pelaksanaan pelatihan.',

                'rentang' => range(1, 15),

            ],

            2 => [

                'label' => 'Level II — Belajar',

                'nama' => 'Belajar (Learning)',

                'deskripsi' => 'Pengetahuan, keterampilan, dan sikap setelah pelatihan.',

                'rentang' => range(16, 33),

            ],

            3 => [

                'label' => 'Level III — Perilaku',

                'nama' => 'Perilaku (Behavior)',

                'deskripsi' => 'Penerapan hasil pelatihan di tempat kerja.',

                'rentang' => range(34, 38),

            ],

            4 => [

                'label' => 'Level IV — Hasil',

                'nama' => 'Hasil (Results)',

                'deskripsi' => 'Dampak penerapan hasil pelatihan bagi sekolah.',

                'rentang' => range(39, 43),

            ],

        ];



        /*

        |--------------------------------------------------------------------------

        | PERHITUNGAN SKOR

        |--------------------------------------------------------------------------

        */

        $jumlahButir = 43;

        $skorMaksimal = $jumlahButir * 4;

        $totalSkor = 0;

        $jumlahTerisi = 0;

        $levelScores = [];

        $levelCounts = [];

        $levelMaxScores = [];

        $levelPersentase = [];



        foreach ($levels as $nomorLevel => $level) {

            $skorLevel = 0;

            $terisiLevel = 0;



            foreach ($level['rentang'] as $nomor) {

                $nilai = $tendik->{'jawaban_' . $nomor};



                if ($nilai !== null && $nilai !== '') {

                    $skorLevel += (int) $nilai;

                    $terisiLevel++;

                }

            }



            $levelScores[$nomorLevel] = $skorLevel;

            $levelCounts[$nomorLevel] = $terisiLevel;

            $levelMaxScores[$nomorLevel] = count($level['rentang']) * 4;

            $levelPersentase[$nomorLevel] = $levelMaxScores[$nomorLevel] > 0

                ? ($skorLevel / $levelMaxScores[$nomorLevel]) * 100

                : 0;



            $totalSkor += $skorLevel;

            $jumlahTerisi += $terisiLevel;

        }



        $persentaseTotal = $skorMaksimal > 0

            ? ($totalSkor / $skorMaksimal) * 100

            : 0;



        $rataRata = $jumlahTerisi > 0

            ? $totalSkor / $jumlahTerisi

            : 0;



        /*

         * Predikat mengikuti rentang rata-rata pada instrumen TENDIK:

         * 3,26–4,00 = Sangat Baik

         * 2,51–3,25 = Baik

         * 1,76–2,50 = Cukup

         * 1,00–1,75 = Kurang

         */

        $predikatHitung = match (true) {

            $jumlahTerisi === 0 => 'Belum Dinilai',

            $rataRata >= 3.26 => 'Sangat Baik',

            $rataRata >= 2.51 => 'Baik',

            $rataRata >= 1.76 => 'Cukup',

            default => 'Kurang',

        };



        $predikat = $tendik->predikat ?: $predikatHitung;



        $predikatClass = match ($predikat) {

            'Sangat Baik' => 'bg-emerald-100 text-emerald-700',

            'Baik' => 'bg-blue-100 text-blue-700',

            'Cukup' => 'bg-amber-100 text-amber-700',

            'Kurang' => 'bg-red-100 text-red-700',

            default => 'bg-slate-100 text-slate-600',

        };



        $tanggalPengisian = $tendik->tanggal_pengisian

            ?? $tendik->tanggal_evaluasi

            ?? $tendik->created_at;



        $namaPetugas = $tendik->nama_petugas_monev

            ?? $tendik->nama_petugas

            ?? '-';



        $instansiPetugas = $tendik->instansi_petugas

            ?? $tendik->unit_kerja_petugas

            ?? $tendik->instansi

            ?? '-';



        $namaResponden = $tendik->nama_responden

            ?? $tendik->nama

            ?? '-';



        $jabatanResponden = $tendik->jabatan_responden

            ?? $tendik->jabatan

            ?? '-';



        $satuanPendidikan = $tendik->satuan_pendidikan

            ?? $tendik->nama_sekolah

            ?? '-';



        $masaKerja = $tendik->masa_kerja

            ?? null;



        $namaKegiatan = $tendik->nama_pelatihan

            ?? $tendik->nama_kegiatan

            ?? $tendik->nama_kegiatan_pelatihan

            ?? $tendik->kegiatan

            ?? '-';



        $statusPengisianLabel = $jumlahTerisi === $jumlahButir ? 'Selesai' : 'Belum Lengkap';

    @endphp



    <div class="space-y-6">



        {{-- Header --}}

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">

                    <a href="{{ route('instrumen.index') }}" class="transition hover:text-blue-600">

                        Instrumen

                    </a>

                    <span>/</span>

                    <span>Hasil Penilaian TENDIK</span>

                </div>



                <h1 class="text-2xl font-bold tracking-tight text-slate-900">

                    Hasil Penilaian TENDIK

                </h1>



                <p class="mt-1 text-sm text-slate-500">

                    Detail lengkap hasil pengisian instrumen monitoring dan evaluasi TENDIK.

                </p>

            </div>

            <div class="no-print flex flex-wrap items-center gap-3">


                {{-- Kembali (dengan ikon panah) --}}

                <a href="{{ route('instrumen.index') }}"
                    class="inline-flex h-12 items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-6 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>


                {{-- Cetak Hasil (teks saja) --}}

                <a href="{{ route('tendik.cetak', $tendik) }}"
                    class="inline-flex h-12 items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    Cetak Hasil

                </a>



                {{-- Edit Data --}}

                <a href="{{ route('tendik.edit', $tendik) }}"
                    class="inline-flex h-12 items-center justify-center rounded-xl px-6 text-sm font-semibold text-white shadow-sm transition"
                    style="background-color: #f97316;" onmouseover="this.style.backgroundColor='#ea580c'"
                    onmouseout="this.style.backgroundColor='#f97316'">

                    Edit Data

                </a>



            </div>



        </div>



        {{-- Informasi status --}}

        @if (session('success'))

            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">

                {{ session('success') }}

            </div>

        @endif



        {{-- Ringkasan hasil --}}

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">



            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-sm font-medium text-slate-500">Total Skor</p>



                <div class="mt-2 flex items-end gap-2">

                    <span class="text-3xl font-bold text-slate-900">

                        {{ $totalSkor }}

                    </span>

                    <span class="pb-1 text-sm text-slate-500">/ {{ $skorMaksimal }}</span>

                </div>



                <p class="mt-2 text-xs text-slate-500">

                    Akumulasi skor dari {{ $jumlahButir }} indikator.

                </p>

            </div>



            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-sm font-medium text-slate-500">Nilai Akhir</p>



                <div class="mt-2">

                    <span class="text-3xl font-bold text-blue-600">

                        {{ number_format($persentaseTotal, 2, ',', '.') }}

                    </span>

                </div>



                <p class="mt-2 text-xs text-slate-500">

                    Persentase capaian berdasarkan skor maksimum.

                </p>

            </div>



            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-sm font-medium text-slate-500">Predikat</p>



                <div class="mt-2">

                    <span class="inline-flex rounded-full px-3 py-1.5 text-sm font-bold {{ $predikatClass }}">

                        {{ $predikat }}

                    </span>

                </div>



                <p class="mt-2 text-xs text-slate-500">

                    Kategori hasil penilaian TENDIK.

                </p>

            </div>



        </div>



        {{-- Identitas pengisian --}}

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-bold text-slate-900">Identitas Pengisian</h2>

                <p class="mt-1 text-sm text-slate-500">

                    Informasi responden dan petugas Monev.

                </p>

            </div>



            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">



                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Petugas Monev</p>

                    <p class="mt-1 font-semibold text-slate-800">{{ $namaPetugas }}</p>

                </div>



                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Instansi Petugas</p>

                    <p class="mt-1 font-semibold text-slate-800">{{ $instansiPetugas }}</p>

                </div>


                {{-- Lokasi Monev --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Lokasi Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $tendik->lokasi_monev ?: '-' }}
                    </p>
                </div>

                {{-- Tanggal Pelaksanaan --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Pelaksanaan</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $tendik->tanggal_pengisian
                             ? \Carbon\Carbon::parse($tendik->tanggal_pengisian)->format('d/m/Y')
                             : '-' }}
                    </p>
                </div>

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Responden</p>

                    <p class="mt-1 font-semibold text-slate-800">{{ $namaResponden }}</p>

                </div>

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jabatan Responden</p>

                    <p class="mt-1 font-semibold text-slate-800">{{ $jabatanResponden }}</p>

                </div>
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Satuan Pendidikan</p>

                    <p class="mt-1 font-semibold text-slate-800">{{ $satuanPendidikan }}</p>

                </div>

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Masa Kerja</p>

                    <p class="mt-1 font-semibold text-slate-800">

                        {{ is_numeric($masaKerja) ? $masaKerja . ' tahun' : ($masaKerja ?: '-') }}

                    </p>

                </div>

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Kegiatan/Pelatihan</p>

                    <p class="mt-1 font-semibold text-slate-800">{{ $namaKegiatan }}</p>

                </div>



                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Pengisian</p>

                    <p class="mt-1 font-semibold text-slate-800">

                        {{ $tanggalPengisian ? \Illuminate\Support\Carbon::parse($tanggalPengisian)->format('d/m/Y') : '-' }}

                    </p>

                </div>



                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status Pengisian</p>

                    <div class="mt-1">

                        <span
                            class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $jumlahTerisi === $jumlahButir ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">

                            {{ $statusPengisianLabel }} ({{ $jumlahTerisi }}/{{ $jumlahButir }} butir)

                        </span>

                    </div>

                </div>



            </div>

        </div>

        {{-- Rekap per level --}}

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Rekapitulasi Berdasarkan Level</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Ringkasan skor pada masing-masing level evaluasi.
                </p>
            </div>
            <div class="grid grid-cols-1 gap-4 p-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($levels as $nomorLevel => $level)
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-bold text-slate-800">{{ $level['label'] }}</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">{{ $level['deskripsi'] }}</p>

                        <div class="mt-4 flex items-end justify-between gap-3">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">{{ $levelScores[$nomorLevel] }}</span>
                                <span class="text-xs text-slate-500">/ {{ $levelMaxScores[$nomorLevel] }}</span>
                            </div>



                            <span class="text-sm font-bold text-slate-700">

                                {{ number_format($levelPersentase[$nomorLevel], 2, ',', '.') }}%

                            </span>

                        </div>



                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200">

                            <div class="h-full rounded-full bg-blue-600"
                                style="width: {{ min($levelPersentase[$nomorLevel], 100) }}%"></div>

                        </div>



                        <p class="mt-2 text-xs text-slate-500">

                            {{ $levelCounts[$nomorLevel] }} dari {{ count($level['rentang']) }} butir terisi

                        </p>

                    </div>

                @endforeach

            </div>

        </div>



        {{-- Detail indikator --}}

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-bold text-slate-900">Detail Penilaian {{ $jumlahButir }} Butir</h2>

                <p class="mt-1 text-sm text-slate-500">

                    Pernyataan ditampilkan sesuai redaksi instrumen Monitoring dan Evaluasi TENDIK.

                </p>

            </div>



            <div class="overflow-x-auto">

                <table class="w-full min-w-[800px] text-left text-sm">

                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">

                        <tr>

                            <th class="px-6 py-4 font-bold">No.</th>

                            <th class="px-6 py-4 font-bold">Level</th>

                            <th class="px-6 py-4 font-bold">Pernyataan</th>

                            <th class="px-6 py-4 text-center font-bold">Skor</th>

                        </tr>

                    </thead>



                    <tbody class="divide-y divide-slate-100">

                        @foreach ($levels as $nomorLevel => $level)

                            @foreach ($level['rentang'] as $nomor)

                                @php

                                    $jawabanButir = $tendik->{'jawaban_' . $nomor};

                                @endphp



                                <tr class="transition hover:bg-slate-50">

                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-500">

                                        {{ $nomor }}

                                    </td>



                                    <td class="whitespace-nowrap px-6 py-4">

                                        <span
                                            class="inline-flex rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">

                                            {{ $level['label'] }}

                                        </span>

                                    </td>



                                    <td class="px-6 py-4 leading-6 text-slate-700">

                                        {{ $pertanyaan[$nomor] }}

                                    </td>



                                    <td class="px-6 py-4 text-center">

                                        @if ($jawabanButir !== null && $jawabanButir !== '')

                                            <span
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 font-bold text-white">

                                                {{ $jawabanButir }}

                                            </span>

                                        @else

                                            <span class="text-slate-400">-</span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
        {{-- CETAK: sembunyikan navigasi dan tombol aplikasi saat dicetak --}}

        <style>
            @media print {

                body {

                    background: white !important;

                }



                aside,

                nav,

                header,

                .no-print {

                    display: none !important;

                }



                body * {

                    visibility: visible;

                }



                .space-y-6 {

                    gap: 16px !important;

                }



                section,

                .rounded-2xl {

                    break-inside: avoid;

                    box-shadow: none !important;

                }



                table {

                    width: 100% !important;

                    min-width: 0 !important;

                    font-size: 10px !important;

                }



                th,

                td {

                    padding: 6px !important;

                }



                @page {

                    size: A4;

                    margin: 12mm;

                }

            }
        </style>

@endsection