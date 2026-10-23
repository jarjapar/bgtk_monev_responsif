
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Monev BCKS - {{ $bcksPengisian->nama_bcks }}</title>

    @php
        /*
        |--------------------------------------------------------------------------
        | Konfigurasi dan filter jawaban
        |--------------------------------------------------------------------------
        */

        $levels = config('bcks.instrumen.levels', []);

        $statusResponden = $bcksPengisian->status_responden ?? '';
        $isBcks = $statusResponden === 'BCKS';

        $levelAktif = $isBcks
            ? ['Reaction', 'Learning', 'Behavior', 'Results']
            : ['Behavior', 'Results'];

        $jawabanSemua = $bcksPengisian->jawaban ?? collect();

        $jawabanBerlaku = $jawabanSemua
            ->filter(fn ($item) => in_array($item->level, $levelAktif, true))
            ->values();

        $jumlahIndikatorBerlaku = $isBcks ? 27 : 19;
        $skorMaksimum = $jumlahIndikatorBerlaku * 4;
        $totalSkorAktual = (int) $jawabanBerlaku->sum('skor');

        $nilaiAkhirAktual = $skorMaksimum > 0
            ? round(($totalSkorAktual / $skorMaksimum) * 100, 2)
            : 0;

        $predikat = $bcksPengisian->predikat ?: '-';

        $levelLabel = [
            'Reaction' => 'Level 1 — Reaction',
            'Learning' => 'Level 2 — Learning',
            'Behavior' => 'Level 3 — Behavior',
            'Results' => 'Level 4 — Results',
        ];

        $levelDeskripsi = [
            'Reaction' => 'Reaksi peserta terhadap pelaksanaan pelatihan.',
            'Learning' => 'Perubahan pemahaman dan kesiapan peserta setelah pelatihan.',
            'Behavior' => 'Perubahan perilaku dan penerapan hasil pelatihan di sekolah.',
            'Results' => 'Dampak penerapan hasil pelatihan terhadap sekolah.',
        ];

        $levelMaksimum = [
            'Reaction' => 16,
            'Learning' => 16,
            'Behavior' => 48,
            'Results' => 28,
        ];

        $levelScores = array_fill_keys(array_keys($levelLabel), 0);
        $levelCounts = array_fill_keys(array_keys($levelLabel), 0);

        foreach ($jawabanBerlaku as $item) {
            if (array_key_exists($item->level, $levelScores)) {
                $levelScores[$item->level] += (int) $item->skor;
                $levelCounts[$item->level]++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Indeks jawaban berdasarkan nomor indikator global
        |--------------------------------------------------------------------------
        */

        $jawabanByNomor = $jawabanBerlaku->keyBy(
            fn ($item) => (string) $item->nomor_indikator
        );
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
        }

        .level-description {
            padding: 7px 10px;
            border: 1px solid #cbd5e1;
            border-bottom: 0;
            color: #475569;
            font-size: 10px;
            background: #f8fafc;
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

        .level-block,
        .summary-card,
        .signature-section {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .signature-section {
            margin-top: 35px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
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
            <a href="{{ route('bcks.show', $bcksPengisian) }}" class="btn btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="toolbar-right">
            <button type="button" onclick="window.print()" class="btn btn-print">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z" />
                </svg>
                Cetak Hasil
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
                HASIL MONITORING DAN EVALUASI BCKS
            </h1>

            <div class="document-subtitle">
                Instrumen Monitoring dan Evaluasi Program BCKS
            </div>
        </header>

        {{-- A. Identitas --}}
        <section class="section">
            <h2 class="section-title">A. Identitas Pengisian</h2>

            <table class="identity-table">
                <tbody>
                    <tr>
                        <td class="label">Nama BCKS</td>
                        <td class="value">{{ $bcksPengisian->nama_bcks ?: '-' }}</td>
                        <td class="label">Unit Kerja</td>
                        <td class="value">{{ $bcksPengisian->unit_kerja ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Angkatan Pelatihan BCKS</td>
                        <td class="value">{{ $bcksPengisian->angkatan_pelatihan ?: '-' }}</td>
                        <td class="label">Nama Responden</td>
                        <td class="value">{{ $bcksPengisian->nama_responden ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Unit Kerja Responden</td>
                        <td class="value">{{ $bcksPengisian->unit_kerja_responden ?: '-' }}</td>
                        <td class="label">Status Responden</td>
                        <td class="value">{{ $statusResponden ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Nama Petugas Monev</td>
                        <td class="value">{{ $bcksPengisian->nama_petugas_monev ?: '-' }}</td>
                        <td class="label">Unit Kerja Petugas</td>
                        <td class="value">{{ $bcksPengisian->unit_kerja_petugas ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label">Tanggal Evaluasi</td>
                        <td class="value" colspan="3">
                            {{ $bcksPengisian->tanggal_evaluasi?->format('d/m/Y') ?? '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        {{-- B. Ringkasan --}}
        <section class="section">
            <h2 class="section-title">B. Ringkasan Hasil Evaluasi</h2>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Total Skor</div>
                    <div class="summary-value">
                        {{ $totalSkorAktual }} / {{ $skorMaksimum }}
                    </div>
                    <div class="summary-label" style="margin-top: 5px;">
                        {{ $jumlahIndikatorBerlaku }} indikator
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Nilai Akhir</div>
                    <div class="summary-value">
                        {{ number_format($nilaiAkhirAktual, 2, ',', '.') }}%
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Predikat</div>
                    <div class="summary-value summary-predikat">
                        {{ $predikat }}
                    </div>
                </div>
            </div>
        </section>

        {{-- C. Rekap level --}}
        <section class="section">
            <h2 class="section-title">C. Rekapitulasi Berdasarkan Level</h2>

            <table class="indicator-table">
                <thead>
                    <tr>
                        <th style="width: 25%;">Level</th>
                        <th style="width: 40%;">Deskripsi</th>
                        <th style="width: 15%;">Skor</th>
                        <th style="width: 20%;">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($levelAktif as $level)
                        @php
                            $maksimalLevelAktif = $levelMaksimum[$level] ?? 0;
                            $skorLevel = $levelScores[$level] ?? 0;
                            $persentaseLevel = $maksimalLevelAktif > 0
                                ? ($skorLevel / $maksimalLevelAktif) * 100
                                : 0;
                        @endphp

                        <tr>
                            <td>{{ $levelLabel[$level] }}</td>
                            <td>{{ $levelDeskripsi[$level] }}</td>
                            <td style="text-align: center;">
                                {{ $skorLevel }} / {{ $maksimalLevelAktif }}
                            </td>
                            <td style="text-align: center;">
                                {{ number_format($persentaseLevel, 2, ',', '.') }}%
                            </td>
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

            @php
                /*
                 * Nomor global harus tetap bertambah untuk semua level,
                 * termasuk level yang disembunyikan, agar nomor indikator
                 * yang tampil tetap cocok dengan data database.
                 */
                $nomorGlobal = 0;
            @endphp

            @foreach ($levels as $levelKey => $level)
                @php
                    $namaLevel = $levelKey;

                    if (!in_array($namaLevel, $levelAktif, true)) {
                        $nomorGlobal += count($level['indikator'] ?? []);
                    }
                @endphp

                @if (in_array($namaLevel, $levelAktif, true))
                    <div class="level-block">
                        <div class="level-title">
                            {{ $levelLabel[$namaLevel] ?? ($level['label'] ?? $namaLevel) }}
                        </div>

                        <div class="level-description">
                            {{ $levelDeskripsi[$namaLevel] ?? '' }}
                        </div>

                        <table class="indicator-table">
                            <thead>
                                <tr>
                                    <th class="number">No.</th>
                                    <th class="question">Indikator Penilaian</th>
                                    <th class="score">Skor</th>
                                    <th class="maximum">Maks.</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($level['indikator'] ?? [] as $indikator)
                                    @php
                                        $nomorGlobal++;

                                        $jawabanItem = $jawabanByNomor->get(
                                            (string) $nomorGlobal
                                        );
                                    @endphp

                                    <tr>
                                        <td class="number">
                                            {{ $indikator['kode'] ?? $nomorGlobal }}
                                        </td>

                                        <td class="question">
                                            {{ $indikator['pertanyaan'] ?? '-' }}
                                        </td>

                                        <td class="score">
                                            {{ $jawabanItem ? $jawabanItem->skor : '-' }}
                                        </td>

                                        <td class="maximum">4</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach
        </section>

        {{-- Tanda tangan --}}
        <section class="signature-section">
            <div class="signature-box">
                <div class="signature-title">Responden</div>
                <div class="signature-line"></div>
                <div class="signature-name">
                    {{ $bcksPengisian->nama_responden ?: '-' }}
                </div>
            </div>

            <div class="signature-box">
                <div class="signature-title">Petugas Monev</div>
                <div class="signature-line"></div>
                <div class="signature-name">
                    {{ $bcksPengisian->nama_petugas_monev ?: '-' }}
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="document-footer">
            Dokumen hasil Monitoring dan Evaluasi BCKS
        </footer>

    </main>

</body>
</html>
