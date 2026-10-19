<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Hasil Monev BK -
        {{ $submission->nama_responden }}
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
            width: 9%;
            text-align: center;
            font-weight: 600;
        }

        .indicator-table .question {
            width: 77%;
        }

        .indicator-table .score {
            width: 14%;
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
            .bagian-row td,
            .recap-table th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* =========================
           TAMBAHAN KHUSUS BK
        ========================= */

        .bagian-row td {
            background: #f8fafc;
            color: #475569;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .answer-yes {
            color: #047857;
        }

        .answer-no {
            color: #b91c1c;
        }

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

    @php
        $jumlahTidak = max(($submission->jumlah_soal ?? 0) - ($submission->jumlah_ya ?? 0), 0);

        $levelNames = [1 => 'Reaction', 2 => 'Learning', 3 => 'Behavior', 4 => 'Results'];

        $answers = $submission->answers->filter(fn($a) => $a->question);

        $answersByLevel = $answers
            ->groupBy(fn($a) => (int) $a->question->level)
            ->sortKeys();

        $levelStats = [];
        foreach ($levelNames as $lv => $name) {
            $items = $answers->filter(fn($a) => (int) $a->question->level === $lv);
            $total = $items->count();
            $yes = $items->filter(fn($a) => (bool) $a->jawaban)->count();
            $levelStats[$lv] = [
                'total' => $total,
                'yes' => $yes,
                'pct' => $total > 0 ? round(($yes / $total) * 100, 2) : 0,
            ];
        }
    @endphp

    {{-- =========================================================
         TOOLBAR
    ========================================================== --}}

    <div class="print-toolbar no-print">

        <div class="toolbar-left">

            <a href="{{ route('bk.show', ['submission' => $submission->id]) }}" class="btn btn-back">
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
                        d="M6 9V2h12v7
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
                HASIL MONITORING DAN EVALUASI BK
            </h1>

            <div class="document-subtitle">
                Instrumen Monitoring dan Evaluasi Program BK
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
                        <td class="label">Nama Responden</td>
                        <td class="value">{{ $submission->nama_responden ?: '-' }}</td>

                        <td class="label">Jabatan Responden</td>
                        <td class="value">
                            {{ $submission->jabatan_responden === 'Lainnya'
                                ? ($submission->jabatan_lainnya ?: 'Lainnya')
                                : ($submission->jabatan_responden ?: '-') }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Satuan Pendidikan</td>
                        <td class="value">{{ $submission->satuan_pendidikan ?: '-' }}</td>

                        <td class="label">Masa Kerja</td>
                        <td class="value">
                            {{ $submission->masa_kerja !== null ? $submission->masa_kerja . ' tahun' : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Nama Pelatihan</td>
                        <td class="value">{{ $submission->nama_pelatihan ?: '-' }}</td>

                        <td class="label">Tanggal Pengisian</td>
                        <td class="value">
                            @if ($submission->tanggal_pengisian)
                                {{ $submission->tanggal_pengisian->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Lokasi Monev</td>
                        <td class="value">{{ $submission->lokasi_monev ?: '-' }}</td>

                        <td class="label">Nama Petugas Monev</td>
                        <td class="value">{{ $submission->nama_petugas_monev ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Instansi Petugas</td>
                        <td class="value">{{ $submission->instansi_petugas ?: '-' }}</td>

                        <td class="label">Tanggal Pelaksanaan</td>
                        <td class="value">
                            @if ($submission->tanggal_pelaksanaan)
                                {{ $submission->tanggal_pelaksanaan->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Status</td>
                        <td class="value" colspan="3">{{ $submission->status ?: '-' }}</td>
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
                        {{ $submission->jumlah_ya }} / {{ $submission->jumlah_soal }}
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Nilai Akhir</div>
                    <div class="summary-value">
                        {{ number_format($submission->skor_persentase, 2, ',', '.') }}%
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Predikat</div>
                    <div class="summary-value summary-predikat" style="font-size: 14px;">
                        {{ $submission->kategori ?: '-' }}
                    </div>
                </div>

            </div>

            <table class="recap-table">
                <thead>
                    <tr>
                        <th style="width: 34%; text-align: left;">Level</th>
                        <th>Ya</th>
                        <th>Tidak</th>
                        <th>Total</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($levelNames as $lv => $levelName)
                        @php $st = $levelStats[$lv]; @endphp
                        <tr>
                            <td class="left">Level {{ $lv }} - {{ $levelName }}</td>
                            <td>{{ $st['yes'] }}</td>
                            <td>{{ $st['total'] - $st['yes'] }}</td>
                            <td>{{ $st['total'] }}</td>
                            <td>{{ number_format($st['pct'], 2, ',', '.') }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </section>


        {{-- INDIKATOR --}}

        <section class="section">

            <h2 class="section-title">
                C. Hasil Penilaian {{ $submission->jumlah_soal }} Indikator
            </h2>

            @forelse ($answersByLevel as $level => $items)

                @php
                    $first = $items->first()->question;
                    $currentBagian = null;
                @endphp

                <div class="level-block">

                    <div class="level-title">
                        Level {{ $level }}
                        @if ($first->level_nama)
                            - {{ $first->level_nama }}
                        @elseif (isset($levelNames[$level]))
                            - {{ $levelNames[$level] }}
                        @endif
                    </div>

                    <table class="indicator-table">

                        <thead>
                            <tr>
                                <th class="number">No.</th>
                                <th class="question">Pernyataan / Indikator</th>
                                <th class="score">Jawaban</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($items as $answer)
                                @php $question = $answer->question; @endphp

                                @if ($currentBagian !== $question->bagian)
                                    @php $currentBagian = $question->bagian; @endphp

                                    <tr class="bagian-row">
                                        <td colspan="3">
                                            {{ $question->bagian }}
                                            @if ($question->judul_bagian)
                                                - {{ $question->judul_bagian }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="number">{{ $question->nomor }}</td>

                                    <td class="question">{{ $question->pernyataan }}</td>

                                    <td class="score {{ $answer->jawaban ? 'answer-yes' : 'answer-no' }}">
                                        {{ $answer->jawaban ? 'Ya' : 'Tidak' }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            @empty

                <p style="color: #94a3b8; font-size: 12px;">Data indikator belum tersedia.</p>

            @endforelse

        </section>


        {{-- TANDA TANGAN --}}

        <section class="signature-section">

            <div class="signature-box">
                <div class="signature-title">Responden</div>
                <div class="signature-line"></div>
                <div class="signature-name">{{ $submission->nama_responden ?: '-' }}</div>
            </div>

            <div class="signature-box">
                <div class="signature-title">Petugas Monev</div>
                <div class="signature-line"></div>
                <div class="signature-name">{{ $submission->nama_petugas_monev ?: '-' }}</div>
            </div>

        </section>


        {{-- FOOTER --}}

        <footer class="document-footer">
            Dokumen hasil Monitoring dan Evaluasi BK
        </footer>

    </main>

</body>
</html>