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

    $jabatanResponden = $tendik->jabatan_responden
        ?? $tendik->jabatan
        ?? '-';

    $isTendik = $jabatanResponden === 'Tendik';

    // Jabatan selain Tendik hanya menggunakan Level III dan IV.
    if (!$isTendik) {
        $levels = array_filter(
            $levels,
            fn($level, $nomorLevel) => in_array($nomorLevel, [3, 4], true),
            ARRAY_FILTER_USE_BOTH
        );
    }

    $jumlahButir = array_sum(array_map(
        fn($level) => count($level['rentang']),
        $levels
    ));

    $skorMaksimal = $jumlahButir * 4;
    $totalSkor = 0;
    $jumlahTerisi = 0;
    $levelScores = [];
    $levelCounts = [];
    $levelMaxScores = [];
    $levelPersentase = [];
    $rataRataLevel = [];

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

        $jumlahButirLevel = count($level['rentang']);
        $levelScores[$nomorLevel] = $skorLevel;
        $levelCounts[$nomorLevel] = $terisiLevel;
        $levelMaxScores[$nomorLevel] = $jumlahButirLevel * 4;

        $levelPersentase[$nomorLevel] = $levelMaxScores[$nomorLevel] > 0
            ? ($skorLevel / $levelMaxScores[$nomorLevel]) * 100
            : 0;

        // Rata-rata setiap level dihitung secara terpisah.
        if ($terisiLevel > 0) {
            $rataRataLevel[$nomorLevel] = $skorLevel / $terisiLevel;
        }

        $totalSkor += $skorLevel;
        $jumlahTerisi += $terisiLevel;
    }

    // Nilai akhir memberikan bobot yang sama untuk setiap level
    // yang memiliki jawaban, bukan berdasarkan jumlah butirnya.
    $rataRata = count($rataRataLevel) > 0
        ? array_sum($rataRataLevel) / count($rataRataLevel)
        : 0;

    $persentaseTotal = ($rataRata / 4) * 100;

    $predikat = match (true) {
        $jumlahTerisi === 0 => 'Belum Dinilai',
        $rataRata >= 3.26 => 'Sangat Baik',
        $rataRata >= 2.51 => 'Baik',
        $rataRata >= 1.76 => 'Cukup',
        default => 'Kurang',
    };

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

    $jabatanLainnya = $tendik->jabatan_lainnya ?? null;

    if ($jabatanLainnya && $jabatanResponden === 'Lainnya') {
        $jabatanResponden .= ' - ' . $jabatanLainnya;
    }

    $lokasiMonev = $tendik->lokasi_monev ?? '-';

    $tanggalPelaksanaan = $tendik->tanggal_pelaksanaan
        ?? $tendik->tanggal_pengisian
        ?? null;

    $satuanPendidikan = $tendik->satuan_pendidikan
        ?? $tendik->nama_sekolah
        ?? '-';

    $masaKerja = $tendik->masa_kerja ?? null;

    $namaKegiatan = $tendik->nama_pelatihan
        ?? $tendik->nama_kegiatan
        ?? $tendik->nama_kegiatan_pelatihan
        ?? $tendik->kegiatan
        ?? '-';

    $statusPengisianLabel = $jumlahTerisi === $jumlahButir
        ? 'Selesai'
        : 'Belum Lengkap';

@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Hasil Monev TENDIK -
        {{ $namaResponden }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #eef2f7;
            color: #1e293b;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            line-height: 1.5;
        }

        /* =========================
           TOOLBAR
        ========================= */

        .no-print {
            display: block;
        }

        .print-toolbar {
            width: 210mm;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .toolbar-left,
        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 16px;
            border-radius: 9px;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .btn svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        .btn-back {
            color: #334155;
            background: #ffffff;
            border-color: #cbd5e1;
        }

        .btn-back:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .btn-print {
            color: #ffffff;
            background: #2563eb;
            border-color: #2563eb;
            box-shadow: 0 2px 5px rgba(37, 99, 235, 0.18);
        }

        .btn-print:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        /* =========================
           DOKUMEN A4
        ========================= */

        .document {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 30px;
            padding: 18mm 16mm;
            background: #ffffff;
            box-shadow: 0 5px 25px rgba(15, 23, 42, 0.10);
        }

        /* =========================
           HEADER
        ========================= */

        .document-header {
            text-align: center;
            padding-bottom: 14px;
            border-bottom: 2px solid #1e40af;
            margin-bottom: 20px;
        }

        .institution {
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 4px;
        }

        .document-title {
            margin: 0;
            color: #0f172a;
            font-size: 20px;
            line-height: 1.3;
            font-weight: 700;
        }

        .document-subtitle {
            margin-top: 5px;
            color: #64748b;
            font-size: 12px;
        }

        /* =========================
           SECTION
        ========================= */

        .section {
            margin-top: 20px;
        }

        .section-title {
            margin: 0 0 10px;
            padding: 8px 10px;
            background: #eff6ff;
            border-left: 4px solid #2563eb;
            color: #1e3a8a;
            font-size: 13px;
            font-weight: 700;
        }

        /* =========================
           IDENTITY
        ========================= */

        .identity-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .identity-table td {
            border: 1px solid #dbe2ea;
            padding: 7px 9px;
            vertical-align: top;
        }

        .identity-table .label {
            width: 24%;
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
        }

        .identity-table .value {
            width: 26%;
            color: #0f172a;
        }

        /* =========================
           SUMMARY
        ========================= */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 12px;
        }

        .summary-card {
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            background: #ffffff;
        }

        .summary-label {
            color: #64748b;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 4px;
        }

        .summary-value {
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .summary-predikat {
            color: #2563eb;
        }

        /* =========================
           LEVEL
        ========================= */

        .level-block {
            margin-top: 16px;
            page-break-inside: avoid;
        }

        .level-title {
            padding: 8px 10px;
            margin-bottom: 0;
            background: #1e3a8a;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
        }

        .indicator-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .indicator-table th,
        .indicator-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 7px;
            vertical-align: top;
        }

        .indicator-table th {
            background: #f1f5f9;
            color: #334155;
            font-size: 10px;
            font-weight: 700;
            text-align: center;
        }

        .indicator-table td {
            font-size: 10.5px;
        }

        .indicator-table .number {
            width: 11%;
            text-align: center;
            font-weight: 600;
        }

        .indicator-table .question {
            width: 69%;
        }

        .indicator-table .score {
            width: 10%;
            text-align: center;
            font-weight: 700;
        }

        .indicator-table .maximum {
            width: 10%;
            text-align: center;
        }

        /* =========================
           OPEN QUESTIONS
        ========================= */

        .open-question {
            margin-top: 12px;
            border: 1px solid #dbe2ea;
            page-break-inside: avoid;
        }

        .open-question-title {
            padding: 7px 9px;
            background: #f8fafc;
            color: #334155;
            font-weight: 700;
            font-size: 11px;
            border-bottom: 1px solid #dbe2ea;
        }

        .open-question-answer {
            min-height: 55px;
            padding: 9px;
            color: #475569;
            font-size: 11px;
            white-space: pre-line;
        }

        /* =========================
           TANDA TANGAN
        ========================= */

        .signature-section {
            margin-top: 35px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            page-break-inside: avoid;
        }

        .signature-box {
            text-align: center;
        }

        .signature-title {
            margin-bottom: 55px;
            font-size: 11px;
        }

        .signature-line {
            width: 80%;
            margin: 0 auto;
            border-bottom: 1px solid #334155;
        }

        .signature-name {
            margin-top: 5px;
            font-weight: 700;
            font-size: 11px;
        }

        /* =========================
           FOOTER
        ========================= */

        .document-footer {
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #cbd5e1;
            text-align: center;
            color: #94a3b8;
            font-size: 9px;
        }

        /* =========================
           RESPONSIVE SCREEN
        ========================= */

        @media screen and (max-width: 900px) {
            .print-toolbar {
                width: auto;
                margin: 12px;
            }

            .document {
                width: auto;
                min-height: auto;
                margin: 0 12px 20px;
                padding: 20px;
            }
        }

        @media screen and (max-width: 600px) {
            .print-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .toolbar-left,
            .toolbar-right {
                width: 100%;
            }

            .btn {
                flex: 1;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .document {
                margin: 0;
                border-radius: 0;
            }

            .identity-table,
            .identity-table tbody,
            .identity-table tr,
            .identity-table td {
                display: block;
                width: 100%;
            }

            .identity-table td {
                width: 100% !important;
            }

            .signature-section {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        /* =========================
           PRINT
        ========================= */

        @page {
            size: A4;
            margin: 10mm;
        }

        @media print {

            html,
            body {
                width: 210mm;
                background: #ffffff;
            }

            body {
                font-size: 11px;
            }

            .no-print {
                display: none !important;
            }

            .document {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .document-header {
                margin-top: 0;
            }

            .section {
                break-inside: auto;
            }

            .level-block {
                break-inside: avoid;
            }

            .open-question {
                break-inside: avoid;
            }

            .signature-section {
                break-inside: avoid;
            }

            .level-title {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .section-title {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .indicator-table th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .identity-table .label,
            .recap-table th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* =========================
           REKAP LEVEL
        ========================= */

        .recap-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .recap-table th,
        .recap-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 8px;
            font-size: 11px;
            text-align: center;
        }

        .recap-table th {
            background: #f1f5f9;
            color: #334155;
            font-size: 10px;
        }

        .recap-table td.left {
            text-align: left;
        }
    </style>
</head>

<body>

    {{-- =========================================================
    TOOLBAR
    ========================================================== --}}

    <div class="print-toolbar no-print">

        <div class="toolbar-left">

            <a href="{{ route('tendik.show', $tendik) }}" class="btn btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>

                Kembali
            </a>

        </div>

        <div class="toolbar-right">

            <button type="button" onclick="window.print()" class="btn btn-print">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9V2h12v7
                           M6 18H4a2 2 0 01-2-2v-5
                           a2 2 0 012-2h16a2 2 0 012 2v5
                           a2 2 0 01-2 2h-2
                           M6 14h12v8H6v-8z" />
                </svg>

                Cetak Hasil
            </button>

        </div>

    </div>

    {{-- =========================================================
    DOKUMEN
    ========================================================== --}}

    <main class="document">

        {{-- HEADER --}}

        <header class="document-header">

            <div class="institution">
                BALAI GURU DAN TENAGA KEPENDIDIKAN
            </div>

            <h1 class="document-title">
                HASIL MONITORING DAN EVALUASI TENDIK
            </h1>

            <div class="document-subtitle">
                Instrumen Monitoring dan Evaluasi Program TENDIK
            </div>

        </header>

        {{-- IDENTITAS --}}

        <section class="section">

            <h2 class="section-title">
                A. Identitas Pengisian
            </h2>

            <table class="identity-table">

                <tbody>

                    <tr>
                        <td class="label">Nama Petugas Monev</td>
                        <td class="value">{{ $namaPetugas }}</td>

                        <td class="label">Instansi Petugas</td>
                        <td class="value">{{ $instansiPetugas }}</td>
                    </tr>

                    <tr>
                        <td class="label">Nama Responden</td>
                        <td class="value">{{ $namaResponden }}</td>

                        <td class="label">Jabatan Responden</td>
                        <td class="value">{{ $jabatanResponden }}</td>
                    </tr>

                    <tr>
                        <td class="label">Lokasi Monev</td>
                        <td class="value">{{ $lokasiMonev ?: '-' }}</td>

                        <td class="label">Tanggal Pelaksanaan</td>
                        <td class="value">
                            {{ $tanggalPelaksanaan
    ? \Illuminate\Support\Carbon::parse($tanggalPelaksanaan)->format('d/m/Y')
    : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Satuan Pendidikan</td>
                        <td class="value">{{ $satuanPendidikan }}</td>

                        <td class="label">Masa Kerja</td>
                        <td class="value">
                            {{ is_numeric($masaKerja) ? $masaKerja . ' tahun' : ($masaKerja ?: '-') }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Nama Kegiatan/Pelatihan</td>
                        <td class="value">{{ $namaKegiatan }}</td>

                        <td class="label">Tanggal Pengisian</td>
                        <td class="value">
                            {{ $tanggalPengisian ? \Illuminate\Support\Carbon::parse($tanggalPengisian)->format('d/m/Y') : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Status Pengisian</td>
                        <td class="value" colspan="3">
                            {{ $statusPengisianLabel }} ({{ $jumlahTerisi }}/{{ $jumlahButir }} butir)
                        </td>
                    </tr>

                </tbody>

            </table>

        </section>

        {{-- RINGKASAN NILAI --}}

        <section class="section">

            <h2 class="section-title">
                B. Ringkasan Hasil Evaluasi
            </h2>

            <div class="summary-grid">

                <div class="summary-card">
                    <div class="summary-label">Total Skor</div>
                    <div class="summary-value">
                        {{ $totalSkor }} / {{ $skorMaksimal }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Nilai Akhir</div>
                    <div class="summary-value">
                        {{ number_format($persentaseTotal, 2, ',', '.') }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Predikat</div>
                    <div class="summary-value summary-predikat">
                        {{ $predikat ?: '-' }}
                    </div>
                </div>

            </div>

            <table class="recap-table">
                <thead>
                    <tr>
                        <th style="width: 34%; text-align: left;">Level</th>
                        <th>Skor</th>
                        <th>Maks.</th>
                        <th>Persentase</th>
                        <th>Terisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($levels as $nomorLevel => $level)
                        <tr>
                            <td class="left">{{ $level['label'] }}</td>
                            <td>{{ $levelScores[$nomorLevel] }}</td>
                            <td>{{ $levelMaxScores[$nomorLevel] }}</td>
                            <td>{{ number_format($levelPersentase[$nomorLevel], 2, ',', '.') }}%</td>
                            <td>{{ $levelCounts[$nomorLevel] }}/{{ count($level['rentang']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </section>

        {{-- INDIKATOR --}}

        <section class="section">

            <h2 class="section-title">
                C. Hasil Penilaian {{ $jumlahButir }} Butir
            </h2>

            @foreach ($levels as $nomorLevel => $level)

                <div class="level-block">

                    <div class="level-title">
                        {{ $level['label'] }}
                    </div>

                    <table class="indicator-table">

                        <thead>
                            <tr>
                                <th class="number">No.</th>
                                <th class="question">Pernyataan</th>
                                <th class="score">Skor</th>
                                <th class="maximum">Maks.</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($level['rentang'] as $nomor)

                                @php
                                    $jawabanButir = $tendik->{'jawaban_' . $nomor};
                                @endphp

                                <tr>
                                    <td class="number">{{ $nomor }}</td>

                                    <td class="question">{{ $pertanyaan[$nomor] }}</td>

                                    <td class="score">
                                        @if ($jawabanButir !== null && $jawabanButir !== '')
                                            {{ $jawabanButir }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td class="maximum">4</td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endforeach

        </section>

        {{-- TANDA TANGAN --}}

        <section class="signature-section">

            <div class="signature-box">
                <div class="signature-title">Responden</div>
                <div class="signature-line"></div>
                <div class="signature-name">{{ $namaResponden }}</div>
            </div>

            <div class="signature-box">
                <div class="signature-title">Petugas Monev</div>
                <div class="signature-line"></div>
                <div class="signature-name">{{ $namaPetugas }}</div>
            </div>

        </section>

        {{-- FOOTER --}}

        <footer class="document-footer">
            Dokumen hasil Monitoring dan Evaluasi TENDIK
        </footer>

    </main>

</body>

</html>