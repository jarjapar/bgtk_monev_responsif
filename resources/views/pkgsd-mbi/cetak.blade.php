<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Monev PKGSD MBI - {{ $pkgsdMbi->nama_guru }}</title>

    @php
        /*
        |--------------------------------------------------------------------------
        | Data instrumen (label indikator) — mengikuti struktur instrumen PKGSD MBI
        |--------------------------------------------------------------------------
        */
        $levelData = json_decode(<<<'PKGSD_JSON'
        {
          "1":{"indikator":[
            "Kesesuaian tujuan, struktur, dan materi pelatihan dengan kebutuhan guru SD dalam mengajar Bahasa Inggris.",
            "Kesesuain bahan ajar dengan struktur program",
            "Kesesuaian alokasi materi dengan bobot materi",
            "Materi mendukung pengajaran Bahasa Inggris sesuai fase/kelas, kebutuhan murid, dan konteks sekolah",
            "Manfaat materi pelatihan dalam meningkatkan kompetensi peserta",
            "Kesiapan dan ketersediaan sarana kegiatan (audio visual, LCD/laptop, papan putih, pelantang, spidol, penghapus).",
            "Kenyamanan ruang kegiatan (ventilasi udara/AC, pencahayaan).",
            "Kebersihan ruang kelas.",
            "Ketersediaan sarana ibadah.",
            "Ketersediaan akses internet",
            "Fasilitator memfasilitasi dan mendampingi proses pembelajaran peserta.",
            "Fasilitator menggunakan bahasa yang menghargai dan menghormati di dalam berkomunikasi dengan peserta.",
            "Fasilitator memulai dan mengakhiri pembelajaran tepat waktu.",
            "Fasilitator mampu menyampaikan materi dengan jelas dan tepat, sehingga peserta dapat memahami pembelajaran dengan baik.",
            "Kemudahan dalam mengakses LMS Pembelajaran",
            "Kemudahan dalam membaca materi/video yang ada di LMS",
            "Kemudahan dalam mengikuti alur LMS",
            "Kemudahan dalam pembelajaran di LMS",
            "Kemudahan dalam berdiskusi di LMS",
            "Kemudahan dalam mengumpulkan tugas di LMS",
            "Kelengkapan dokumen/kit bahan kegiatan (materi, LMS, ATK)",
            "Kualitas tampilan bahan tayang kegiatan.",
            "Kemudahan penggunaan bahan tayang, modul, dan sumber belajar",
            "Ketersediaan ilustrasi dan contoh pada bahan pembelajaran kegiatan.",
            "Kesesuaian alokasi waktu pelaksanaan kegiatan dengan tujuan dan sasaran program kegiatan.",
            "Ketepatan alokasi waktu untuk menyelesaikan setiap tagihan pembelajaran.",
            "Kecukupan menu yang mendukung pemenuhan gizi.",
            "Variasi hidangan/konsumsi.",
            "Ketepatan waktu penyediaan konsumsi."
          ],"kelompok":{"1":"Program dan Materi","6":"Sarana dan Prasarana Penunjang Kegiatan","11":"Fasilitator","15":"Akses LMS","21":"Bahan Kegiatan","25":"Jangka Waktu Pelaksanaan Kegiatan","27":"Layanan Menu"}},
          "2":{"indikator":[
            "Pemahaman capaian dan tujuan pembelajaran Bahasa Inggris",
            "Pengembangan keterampilan menyimak (listening)",
            "Pengembangan keterampilan berbicara (speaking)",
            "Pengembangan keterampilan membaca (reading)",
            "Pengembangan keterampilan menulis (writing)",
            "Media dan sumber belajar",
            "Pemahaman terkait prinsip pembelajaran Bahasa Inggris yang sesuai untuk siswa SD.",
            "Penggunaan ungkapan Bahasa Inggris sederhana dalam kegiatan wawancara",
            "Penyusunan modul ajar atau rencana pembelajaran Bahasa Inggris.",
            "Merancang aktivitas interaktif, seperti permainan bahasa, lagu, dialog, dan bermain peran."
          ],"kelompok":{}},
          "3":{"indikator":[
            "Guru menyampaikan tujuan dan alur pembelajaran",
            "Guru menggunakan konteks nyata yang dekat dengan kehidupan murid.",
            "Guru mengajukan pertanyaan pemantik yang mendorong murid berpikir.",
            "Guru membangun rasa ingin tahu murid.",
            "Guru membangun konsep secara bertahap dari pengalaman konkret.",
            "Guru menghubungkan konsep baru dengan konsep atau pengalaman sebelumnya.",
            "Guru menggunakan media atau alat bantu untuk membantu murid memahami konsep.",
            "Guru menyisipkan penggunaan bahasa Inggris sederhana.",
            "Pemodelan bahasa dan pelafalan",
            "Siswa terlibat aktif dalam kegiatan menyimak (listening)",
            "Siswa terlibat aktif dalam kegiatan berbicara (speaking)",
            "Siswa terlibat aktif dalam kegiatan membaca (reading)",
            "Siswa diberikan kesempatan untuk menulis (writing)",
            "Aktivitas murid sesuai dengan tujuan pembelajaran.",
            "Suasana belajar terasa menggembirakan bagi murid (tampak dari ekspresi dan perilaku murid).",
            "Guru memberi ruang bagi beragam jawaban dan cara penyelesaian murid.",
            "Guru mengajukan pertanyaan lanjutan (probing) untuk menggali cara berpikir murid.",
            "Guru menanggapi jawaban murid secara membangun.",
            "Guru mengakomodasi perbedaan kemampuan dan kebutuhan murid (diferensiasi).",
            "Murid melakukan refleksi pembelajaran.",
            "Guru mengapresiasi proses belajar murid, bukan hanya hasil.",
            "Guru menutup pembelajaran dengan menyimpulkan bersama murid."
          ],"kelompok":{"1":"Tahap 1: Gali dan Eksplorasi","5":"Tahap 2: Muat Konten","10":"Tahap 3: Buat Aktivitas","16":"Tahap 4: Ikuti Pemikiran Murid","20":"Tahap 5: Rayakan dan Akhiri"}},
          "4":{"indikator":[
            "Guru menerapkan strategi hasil pelatihan",
            "Guru mengembangkan perangkat ajar",
            "Guru berbagi praktik dengan rekan",
            "Keberanian menggunakan Bahasa Inggris",
            "Pemahaman kosakata dan ungkapan",
            "Keterampilan menyimak dan merespons",
            "Keterampilan berbicara/interaksi",
            "Keterampilan membaca/menulis sesuai target",
            "Motivasi dan sikap terhadap Bahasa Inggris",
            "Kolaborasi guru dalam pembelajaran Bahasa Inggris",
            "Dukungan kepala sekolah/komunitas belajar",
            "Pemanfaatan hasil asesmen untuk perbaikan"
          ],"kelompok":{"1":"A. Keberlanjutan Praktik Guru","4":"B. Perubahan pada Murid","10":"C. Perubahan pada Budaya Sekolah"}}
        }
        PKGSD_JSON, true);

        /*
        |--------------------------------------------------------------------------
        | Level yang berlaku berdasarkan jabatan pemonev
        |--------------------------------------------------------------------------
        */
        $jabatan = $pkgsdMbi->jabatan_penilai ?? '';
        $levelAktif = $jabatan === 'Peserta PKGSD MBI' ? [1, 2, 3, 4] : [3, 4];

        $levelLabel = [
            1 => 'Level 1 — Reaction',
            2 => 'Level 2 — Learning',
            3 => 'Level 3 — Behavior',
            4 => 'Level 4 — Results',
        ];

        $levelDeskripsi = [
            1 => 'Respons peserta terhadap program dan pelaksanaan pelatihan.',
            2 => 'Pengetahuan dan keterampilan yang dipelajari guru (wawancara setelah pelatihan).',
            3 => 'Penerapan hasil pelatihan di kelas (observasi pembelajaran). Skor 3–4 disertai bukti.',
            4 => 'Perubahan pada praktik guru, murid, dan budaya sekolah. Skor 3–4 disertai bukti.',
        ];

        $jawabanLevel = [
            1 => $pkgsdMbi->level_1_jawaban ?? [],
            2 => $pkgsdMbi->level_2_jawaban ?? [],
            3 => $pkgsdMbi->level_3_jawaban ?? [],
            4 => $pkgsdMbi->level_4_jawaban ?? [],
        ];

        $kategoriDari = function ($rata) {
            return match (true) {
                $rata === null => 'Belum ada skor',
                $rata >= 3.50 => 'Sangat Baik',
                $rata >= 2.75 => 'Baik',
                $rata >= 2.00 => 'Cukup',
                default => 'Perlu pendampingan intensif',
            };
        };

        /*
        |--------------------------------------------------------------------------
        | Rekap per level dan keseluruhan
        |--------------------------------------------------------------------------
        | Rerata hanya dari skor numerik 1–4. TD tidak dihitung dan
        | indikator yang belum dinilai tidak dianggap bernilai nol.
        */
        $rekap = [];
        $totalSemua = 0;
        $terisiSemua = 0;
        $jumlahIndikatorBerlaku = 0;

        foreach ($levelAktif as $level) {
            $total = 0;
            $terisi = 0;
            $jumlahTD = 0;

            foreach ((array) $jawabanLevel[$level] as $item) {
                $skor = is_array($item) ? ($item['skor'] ?? null) : $item;

                if ($skor === null || $skor === '') {
                    continue;
                }

                if (strtoupper((string) $skor) === 'TD') {
                    $jumlahTD++;
                    continue;
                }

                if (is_numeric($skor) && (int) $skor >= 1 && (int) $skor <= 4) {
                    $total += (int) $skor;
                    $terisi++;
                }
            }

            $rata = $terisi > 0 ? $total / $terisi : null;
            $jumlahLevel = count($levelData[$level]['indikator'] ?? []);

            $rekap[$level] = [
                'total' => $total,
                'terisi' => $terisi,
                'td' => $jumlahTD,
                'rata' => $rata,
                'jumlah' => $jumlahLevel,
                'kategori' => $kategoriDari($rata),
            ];

            $totalSemua += $total;
            $terisiSemua += $terisi;
            $jumlahIndikatorBerlaku += $jumlahLevel;
        }

        $rataSemua = $terisiSemua > 0 ? $totalSemua / $terisiSemua : null;
        $kategoriSemua = $kategoriDari($rataSemua);

        $adaMetadataObservasi = filled($pkgsdMbi->tanggal_observasi ?? null)
            || filled($pkgsdMbi->durasi_pembelajaran ?? null)
            || filled($pkgsdMbi->jumlah_murid_hadir ?? null)
            || filled($pkgsdMbi->observasi_ke ?? null);
    @endphp

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
            background: #fff;
            border-color: #cbd5e1;
        }

        .btn-back:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .btn-print {
            color: #fff;
            background: #2563eb;
            border-color: #2563eb;
        }

        .btn-print:hover {
            background: #1d4ed8;
        }

        .document {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 30px;
            padding: 18mm 16mm;
            background: #fff;
            box-shadow: 0 5px 25px rgba(15, 23, 42, 0.10);
        }

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

        .identity-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .identity-table td {
            border: 1px solid #dbe2ea;
            padding: 7px 9px;
            vertical-align: top;
            overflow-wrap: anywhere;
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
            background: #fff;
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
            font-size: 15px;
        }

        .level-block {
            margin-top: 16px;
        }

        .level-title {
            padding: 8px 10px;
            margin-bottom: 0;
            background: #1e3a8a;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            break-after: avoid;
            page-break-after: avoid;
        }

        .level-description {
            padding: 7px 10px;
            border: 1px solid #cbd5e1;
            border-bottom: 0;
            color: #475569;
            font-size: 10px;
            background: #f8fafc;
            break-after: avoid;
            page-break-after: avoid;
        }

        .indicator-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .indicator-table thead {
            display: table-header-group;
        }

        .indicator-table tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .indicator-table th,
        .indicator-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 7px;
            vertical-align: top;
            overflow-wrap: anywhere;
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
            width: 8%;
            text-align: center;
            font-weight: 600;
        }

        .indicator-table .question {
            width: 76%;
        }

        .indicator-table .score {
            width: 8%;
            text-align: center;
            font-weight: 700;
        }

        .indicator-table .maximum {
            width: 8%;
            text-align: center;
        }

        /* Level 3 dan 4 memiliki kolom bukti */
        .indicator-table.with-evidence .number {
            width: 7%;
        }

        .indicator-table.with-evidence .question {
            width: 38%;
        }

        .indicator-table.with-evidence .evidence {
            width: 38%;
            white-space: pre-line;
        }

        .indicator-table.with-evidence .score {
            width: 9%;
        }

        .indicator-table.with-evidence .maximum {
            width: 8%;
        }

        .indicator-table .group-row td {
            background: #eff6ff;
            color: #1e3a8a;
            font-weight: 700;
            font-size: 10.5px;
        }

        .indicator-table .score-td {
            color: #b45309;
        }

        .reason-label {
            display: block;
            margin-top: 4px;
            color: #92400e;
            font-weight: 700;
            font-size: 9.5px;
            text-transform: uppercase;
        }

        .signature-section {
            break-inside: avoid;
            page-break-inside: avoid;
            margin-top: 35px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .summary-card {
            break-inside: avoid;
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
            overflow-wrap: anywhere;
        }

        .document-footer {
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #cbd5e1;
            text-align: center;
            color: #94a3b8;
            font-size: 9px;
        }

        .note {
            margin-top: 6px;
            color: #64748b;
            font-size: 10px;
        }

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

        @page {
            size: A4;
            margin: 10mm;
        }

        @media print {

            html,
            body {
                width: auto;
                background: #fff;
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

            .level-title,
            .section-title,
            .indicator-table th,
            .indicator-table .group-row td,
            .identity-table .label,
            .level-description {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .level-title {
                background: #1e3a8a !important;
                color: #fff !important;
            }

            .section-title {
                background: #eff6ff !important;
            }

            .indicator-table th {
                background: #f1f5f9 !important;
            }

            .indicator-table .group-row td {
                background: #eff6ff !important;
            }

            .identity-table .label,
            .level-description {
                background: #f8fafc !important;
            }
        }
    </style>
</head>

<body>

    {{-- Toolbar --}}
    <div class="print-toolbar no-print">
        <div class="toolbar-left">
            <a href="{{ route('pkgsd-mbi.show', $pkgsdMbi) }}" class="btn btn-back">
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
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z" />
                </svg>
                Cetak / Simpan PDF
            </button>
        </div>
    </div>

    {{-- Dokumen --}}
    <main class="document">

        {{-- Header --}}
        <header class="document-header">
            <div class="institution">
                Balai Guru dan Tenaga Kependidikan
            </div>

            <h1 class="document-title">
                HASIL MONITORING DAN EVALUASI PKGSD MBI
            </h1>

            <div class="document-subtitle">
                Instrumen Monitoring dan Evaluasi PKGSD MBI — Model Kirkpatrick
            </div>
        </header>

        {{-- A. Identitas --}}
        <section class="section">
            <h2 class="section-title">A. Identitas Pengisian</h2>

            <table class="identity-table">
                <tbody>
                    <tr>
                        <td class="label">Nama Guru</td>
                        <td class="value">{{ $pkgsdMbi->nama_guru ?: '-' }}</td>
                        <td class="label">Nama Sekolah</td>
                        <td class="value">{{ $pkgsdMbi->nama_sekolah ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Kelas / Fase</td>
                        <td class="value">{{ $pkgsdMbi->kelas_fase ?: '-' }}</td>
                        <td class="label">Topik / Materi</td>
                        <td class="value">{{ $pkgsdMbi->topik_materi ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Nama Petugas Monev</td>
                        <td class="value">{{ $pkgsdMbi->nama_petugas_monev ?: '-' }}</td>
                        <td class="label">Jabatan Pemonev</td>
                        <td class="value">{{ $jabatan ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Tanggal Monev</td>
                        <td class="value">{{ $pkgsdMbi->tanggal_monev?->format('d/m/Y') ?? '-' }}</td>
                        <td class="label">Status Pengisian</td>
                        <td class="value">{{ $pkgsdMbi->status ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Sumber Data / Bukti</td>
                        <td class="value" colspan="3">{{ $pkgsdMbi->sumber_data_bukti ?: '-' }}</td>
                    </tr>

                    @if ($adaMetadataObservasi)
                                    <tr>
                                        <td class="label">Tanggal Observasi</td>
                                        <td class="value">
                                            {{ filled($pkgsdMbi->tanggal_observasi ?? null)
                        ? \Illuminate\Support\Carbon::parse($pkgsdMbi->tanggal_observasi)->format('d/m/Y')
                        : '-' }}
                                        </td>
                                        <td class="label">Durasi Pembelajaran</td>
                                        <td class="value">{{ $pkgsdMbi->durasi_pembelajaran ?: '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td class="label">Jumlah Murid Hadir</td>
                                        <td class="value">{{ $pkgsdMbi->jumlah_murid_hadir ?: '-' }}</td>
                                        <td class="label">Observasi Ke-</td>
                                        <td class="value">{{ $pkgsdMbi->observasi_ke ?: '-' }}</td>
                                    </tr>
                    @endif
                </tbody>
            </table>
        </section>

        {{-- B. Ringkasan --}}
        <section class="section">
            <h2 class="section-title">B. Ringkasan Hasil Evaluasi</h2>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Indikator Dinilai</div>
                    <div class="summary-value">
                        {{ $terisiSemua }} / {{ $jumlahIndikatorBerlaku }}
                    </div>
                    <div class="summary-label" style="margin-top: 5px;">
                        Total skor {{ $totalSemua }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Rerata Keseluruhan</div>
                    <div class="summary-value">
                        {{ $rataSemua !== null ? number_format($rataSemua, 2, ',', '.') : '-' }} / 4
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Kategori</div>
                    <div class="summary-value summary-predikat">
                        {{ $kategoriSemua }}
                    </div>
                </div>
            </div>

            <p class="note">
                Kategori rerata: 3,50–4,00 Sangat Baik; 2,75–3,49 Baik; 2,00–2,74 Cukup;
                1,00–1,99 Perlu pendampingan intensif. Rerata hanya menghitung skor numerik 1–4;
                jawaban TD tidak dihitung.
            </p>
        </section>

        {{-- C. Rekap level --}}
        <section class="section">
            <h2 class="section-title">C. Rekapitulasi Berdasarkan Level</h2>

            <table class="indicator-table">
                <thead>
                    <tr>
                        <th style="width: 20%;">Level</th>
                        <th style="width: 31%;">Deskripsi</th>
                        <th style="width: 13%;">Indikator Dinilai</th>
                        <th style="width: 10%;">Jumlah Skor</th>
                        <th style="width: 10%;">Rerata</th>
                        <th style="width: 16%;">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($levelAktif as $level)
                        @php $r = $rekap[$level]; @endphp

                        <tr>
                            <td>{{ $levelLabel[$level] }}</td>
                            <td>{{ $levelDeskripsi[$level] }}</td>
                            <td style="text-align: center;">
                                {{ $r['terisi'] }} / {{ $r['jumlah'] }}
                                @if ($level === 3 && $r['td'] > 0)
                                    <br>(TD: {{ $r['td'] }})
                                @endif
                            </td>
                            <td style="text-align: center;">{{ $r['total'] }}</td>
                            <td style="text-align: center;">
                                {{ $r['rata'] !== null ? number_format($r['rata'], 2, ',', '.') : '-' }}
                            </td>
                            <td>{{ $r['kategori'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        {{-- D. Detail indikator --}}
        <section class="section">
            <h2 class="section-title">
                D. Hasil Penilaian {{ $jumlahIndikatorBerlaku }} Indikator
            </h2>

            @foreach ($levelAktif as $level)
                @php
                    $dataLevel = $levelData[$level] ?? ['indikator' => [], 'kelompok' => []];
                    $jawaban = (array) $jawabanLevel[$level];
                    $punyaBukti = in_array($level, [3, 4], true);
                    $jumlahKolom = $punyaBukti ? 5 : 4;
                @endphp

                <div class="level-block">
                    <div class="level-title">{{ $levelLabel[$level] }}</div>
                    <div class="level-description">{{ $levelDeskripsi[$level] }}</div>

                    <table class="indicator-table {{ $punyaBukti ? 'with-evidence' : '' }}">
                        <thead>
                            <tr>
                                <th class="number">No.</th>
                                <th class="question">Indikator Penilaian</th>
                                @if ($punyaBukti)
                                    <th class="evidence">Bukti / Catatan</th>
                                @endif
                                <th class="score">Skor</th>
                                <th class="maximum">Maks.</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataLevel['indikator'] as $index => $namaIndikator)
                                @php
                                    $nomor = $index + 1;

                                    $item = $jawaban[$nomor] ?? [];
                                    $item = is_array($item) ? $item : ['skor' => $item];

                                    $skor = $item['skor'] ?? null;
                                    $skorAda = $skor !== null && $skor !== '';
                                    $isTD = $skorAda && strtoupper((string) $skor) === 'TD';

                                    $bukti = $item['bukti'] ?? '';
                                    $alasanTd = $item['alasan_td'] ?? '';

                                    $namaKelompok = $dataLevel['kelompok'][$nomor]
                                        ?? ($dataLevel['kelompok'][(string) $nomor] ?? null);
                                @endphp

                                @if ($namaKelompok)
                                    <tr class="group-row">
                                        <td colspan="{{ $jumlahKolom }}">{{ $namaKelompok }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="number">{{ $nomor }}</td>

                                    <td class="question">{{ $namaIndikator }}</td>

                                    @if ($punyaBukti)
                                        <td class="evidence">{{ filled($bukti) ? $bukti : '-' }}@if ($level === 3 && $isTD)
                                            <span class="reason-label">Alasan TD</span>{{ filled($alasanTd) ? $alasanTd : '-' }}
                                        @endif
                                        </td>
                                    @endif

                                    <td class="score {{ $isTD ? 'score-td' : '' }}">
                                        {{ $skorAda ? strtoupper((string) $skor) : '-' }}
                                    </td>

                                    <td class="maximum">{{ $isTD ? '-' : '4' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </section>

        {{-- Tanda tangan --}}
        <section class="signature-section">
            <div class="signature-box">
                <div class="signature-title">Guru / Responden</div>
                <div class="signature-line"></div>
                <div class="signature-name">
                    {{ $pkgsdMbi->nama_guru ?: '-' }}
                </div>
            </div>

            <div class="signature-box">
                <div class="signature-title">Petugas Monev</div>
                <div class="signature-line"></div>
                <div class="signature-name">
                    {{ $pkgsdMbi->nama_petugas_monev ?: '-' }}
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="document-footer">
            Dokumen hasil Monitoring dan Evaluasi PKGSD MBI
        </footer>

    </main>

</body>

</html>