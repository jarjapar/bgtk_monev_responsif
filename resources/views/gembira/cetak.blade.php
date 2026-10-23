<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Monev Matematika GEMBIRA - {{ $gembira->nama_guru }}</title>

    @php
        $jabatan = $gembira->jabatan_penilai ?? '';

        $levelAktif = $jabatan === 'Peserta Matematika GEMBIRA'
            ? [1, 2, 3, 4]
            : [3, 4];

        /*
        |--------------------------------------------------------------------------
        | Ambil data instrumen dari create.blade.php
        |--------------------------------------------------------------------------
        | Dengan cara ini tidak perlu membuat file JSON terpisah.
        */
        $halamanForm = file_get_contents(resource_path('views/gembira/create.blade.php'));

        $levelData = [];
        if (
            preg_match(
                '~\$levelData\s*=\s*json_decode\(<<<\'GEMBIRA_JSON\'\s*(.*?)\s*GEMBIRA_JSON,\s*true\s*\);~s',
                $halamanForm,
                $cocok
            )
        ) {
            $levelData = json_decode(trim($cocok[1]), true) ?? [];
        }

        if (empty($levelData)) {
            throw new \RuntimeException(
                'Data instrumen tidak ditemukan. Pastikan create.blade.php memiliki blok GEMBIRA_JSON.'
            );
        }

        $levelJawaban = [
            1 => $gembira->level_1_jawaban ?? [],
            2 => $gembira->level_2_jawaban ?? [],
            3 => $gembira->level_3_jawaban ?? [],
            4 => $gembira->level_4_jawaban ?? [],
        ];

        $levelJudul = [
            1 => 'Level 1 — Reaction',
            2 => 'Level 2 — Learning',
            3 => 'Level 3 — Behavior',
            4 => 'Level 4 — Results',
        ];

        // Keterangan singkat default
        $levelDeskripsi = [
            1 => 'Reaksi peserta terhadap pelaksanaan pelatihan.',
            2 => 'Pembelajaran dan pemahaman setelah pelatihan.',
            3 => 'Penerapan hasil pelatihan dalam pekerjaan.',
            4 => 'Hasil dan dampak penerapan di sekolah.',
        ];

        // Keterangan tambahan / petunjuk penilaian per level dari instrumen
        $levelCatatan = [];

        foreach ($levelJudul as $lv => $teks) {
            $judulPanjang = $levelData[(string) $lv]['label'] ?? '';

            // Bagian setelah titik dua pada judul instrumen dipakai sebagai keterangan level
            if (str_contains($judulPanjang, ': ')) {
                $levelDeskripsi[$lv] = \Illuminate\Support\Str::after($judulPanjang, ': ');
            }

            $levelCatatan[$lv] = trim($levelData[(string) $lv]['deskripsi'] ?? '');
        }

        $totalSkor = 0;
        $totalMaksimum = 0;
        $jumlahIndikatorDinilai = 0;
        $rekapLevel = [];

        foreach ($levelAktif as $nomorLevel) {
            $skorLevel = 0;
            $jumlahDinilai = 0;
            $jumlahTD = 0;

            foreach ($levelJawaban[$nomorLevel] as $item) {
                $skor = is_array($item)
                    ? ($item['skor'] ?? $item['jawaban'] ?? null)
                    : $item;

                if ($nomorLevel === 3 && (string) $skor === 'TD') {
                    $jumlahTD++;
                    continue;
                }

                if (is_numeric($skor) && (int) $skor >= 1 && (int) $skor <= 4) {
                    $skorLevel += (int) $skor;
                    $jumlahDinilai++;
                }
            }

            $maksimumLevel = $jumlahDinilai * 4;

            $rekapLevel[$nomorLevel] = [
                'skor' => $skorLevel,
                'maksimum' => $maksimumLevel,
                'jumlah' => $jumlahDinilai,
                'td' => $jumlahTD,
                'persentase' => $maksimumLevel > 0
                    ? ($skorLevel / $maksimumLevel) * 100
                    : 0,
            ];

            $totalSkor += $skorLevel;
            $totalMaksimum += $maksimumLevel;
            $jumlahIndikatorDinilai += $jumlahDinilai;
        }

        $nilaiAkhir = $totalMaksimum > 0
            ? ($totalSkor / $totalMaksimum) * 100
            : 0;

        $rataRata = $jumlahIndikatorDinilai > 0
            ? $totalSkor / $jumlahIndikatorDinilai
            : 0;

        $predikat = match (true) {
            $jumlahIndikatorDinilai === 0 => 'Belum dinilai',
            $rataRata >= 3.50 => 'Sangat Baik',
            $rataRata >= 2.75 => 'Baik',
            $rataRata >= 2.00 => 'Cukup',
            default => 'Perlu pendampingan intensif',
        };
    @endphp

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eef2f7;
            color: #1e293b;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        .toolbar {
            width: 210mm;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            color: #334155;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-print {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .document {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 30px;
            padding: 16mm;
            background: white;
            box-shadow: 0 5px 25px rgba(15, 23, 42, .10);
        }

        .document-header {
            text-align: center;
            padding-bottom: 14px;
            border-bottom: 2px solid #1e40af;
        }

        .institution {
            color: #475569;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .document-title {
            margin: 7px 0 4px;
            font-size: 19px;
            line-height: 1.3;
        }

        .subtitle {
            color: #64748b;
            font-size: 11px;
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
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 7px;
            text-align: left;
            vertical-align: top;
            overflow-wrap: anywhere;
        }

        th {
            background: #f1f5f9;
            color: #334155;
            font-size: 10px;
        }

        td {
            font-size: 10.5px;
        }

        tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .label {
            width: 22%;
            background: #f8fafc;
            font-weight: 600;
            color: #475569;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .summary-card {
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            text-align: center;
        }

        .summary-label {
            color: #64748b;
            font-size: 10px;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 4px;
            font-size: 18px;
            font-weight: bold;
        }

        .level-block {
            margin-top: 16px;
        }

        .level-title {
            padding: 8px 10px;
            background: #1e3a8a;
            color: white;
            font-weight: bold;
            break-after: avoid;
            page-break-after: avoid;
        }

        .level-description {
            padding: 7px 10px;
            border: 1px solid #cbd5e1;
            border-bottom: 0;
            background: #f8fafc;
            color: #475569;
            font-size: 10px;
            break-after: avoid;
            page-break-after: avoid;
        }

        .level-description p {
            margin: 0;
        }

        .level-description .level-note {
            margin-top: 4px;
            padding-top: 4px;
            border-top: 1px dashed #cbd5e1;
            color: #64748b;
        }

        .group-row td {
            background: #eff6ff;
            color: #1e3a8a;
            font-size: 10.5px;
            font-weight: bold;
        }

        .signature {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 40px;
            break-inside: avoid;
        }

        .signature-box {
            text-align: center;
        }

        .signature-space {
            height: 65px;
        }

        .signature-name {
            padding-top: 5px;
            border-top: 1px solid #334155;
            display: inline-block;
            min-width: 150px;
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #cbd5e1;
            color: #94a3b8;
            text-align: center;
            font-size: 9px;
        }

        @page {
            size: A4;
            margin: 10mm;
        }

        @media print {
            body {
                background: white;
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

            .level-title,
            .section-title,
            th,
            .label,
            .level-description,
            .group-row td {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .level-title {
                background: #1e3a8a !important;
                color: white !important;
            }

            .group-row td {
                background: #eff6ff !important;
            }
        }

        @media screen and (max-width: 900px) {

            .toolbar,
            .document {
                width: auto;
                margin: 12px;
            }

            .document {
                padding: 20px;
            }
        }

        @media screen and (max-width: 600px) {
            .toolbar {
                flex-direction: column;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .document {
                margin: 0;
            }

            .signature {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="toolbar no-print">
        <a href="{{ route('gembira.show', $gembira) }}" class="btn">
            ← Kembali ke Detail
        </a>

        <button type="button" onclick="window.print()" class="btn btn-print">
            Cetak Hasil
        </button>
    </div>

    <main class="document">
        <header class="document-header">
            <div class="institution">Balai Guru dan Tenaga Kependidikan</div>
            <h1 class="document-title">HASIL MONITORING DAN EVALUASI</h1>
            <div class="subtitle">Instrumen Matematika GEMBIRA</div>
        </header>

        <section class="section">
            <h2 class="section-title">A. Identitas Pengisian</h2>

            <table>
                <tbody>
                    <tr>
                        <td class="label">Nama Guru</td>
                        <td>{{ $gembira->nama_guru ?: '-' }}</td>
                        <td class="label">Nama Sekolah</td>
                        <td>{{ $gembira->nama_sekolah ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kelas / Fase</td>
                        <td>{{ $gembira->kelas_fase ?: '-' }}</td>
                        <td class="label">Topik / Materi</td>
                        <td>{{ $gembira->topik_materi ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Petugas Monev</td>
                        <td>{{ $gembira->nama_petugas_monev ?: '-' }}</td>
                        <td class="label">Jabatan Penilai</td>
                        <td>{{ $jabatan ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Monev</td>
                        <td>{{ $gembira->tanggal_monev?->format('d/m/Y') ?? '-' }}</td>
                        <td class="label">Status</td>
                        <td>{{ $gembira->status ?? 'Draft' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Sumber Data / Bukti</td>
                        <td colspan="3">{{ $gembira->sumber_data_bukti ?: '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </section>

        @if (
                $gembira->tanggal_observasi ||
                $gembira->durasi_pembelajaran ||
                $gembira->jumlah_murid_hadir !== null ||
                $gembira->observasi_ke !== null
            )
            <section class="section">
                <h2 class="section-title">B. Informasi Observasi</h2>
                <table>
                    <tbody>
                        <tr>
                            <td class="label">Tanggal Observasi</td>
                            <td>{{ $gembira->tanggal_observasi?->format('d/m/Y') ?? '-' }}</td>
                            <td class="label">Durasi Pembelajaran</td>
                            <td>{{ $gembira->durasi_pembelajaran ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Jumlah Murid Hadir</td>
                            <td>{{ $gembira->jumlah_murid_hadir ?? '-' }}</td>
                            <td class="label">Observasi Ke-</td>
                            <td>{{ $gembira->observasi_ke ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        @endif

        <section class="section">
            <h2 class="section-title">C. Ringkasan Hasil Penilaian</h2>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-label">Total Skor</div>
                    <div class="summary-value">{{ $totalSkor }} / {{ $totalMaksimum }}</div>
                    <div class="summary-label">{{ $jumlahIndikatorDinilai }} indikator dinilai</div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Nilai Akhir</div>
                    <div class="summary-value">
                        {{ number_format($nilaiAkhir, 2, ',', '.') }}%
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Predikat</div>
                    <div class="summary-value">{{ $predikat }}</div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="section-title">D. Rekapitulasi Berdasarkan Level</h2>

            <table>
                <thead>
                    <tr>
                        <th style="width:25%">Level</th>
                        <th style="width:40%">Keterangan</th>
                        <th style="width:17%">Skor</th>
                        <th style="width:18%">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($levelAktif as $nomorLevel)
                        @php $rekap = $rekapLevel[$nomorLevel]; @endphp
                        <tr>
                            <td>{{ $levelJudul[$nomorLevel] }}</td>
                            <td>{{ $levelDeskripsi[$nomorLevel] }}</td>
                            <td style="text-align:center">
                                {{ $rekap['skor'] }} / {{ $rekap['maksimum'] }}
                            </td>
                            <td style="text-align:center">
                                {{ number_format($rekap['persentase'], 2, ',', '.') }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="section">
            <h2 class="section-title">E. Detail Hasil Penilaian</h2>

            @foreach ($levelAktif as $nomorLevel)
                @php
                    $jawaban = $levelJawaban[$nomorLevel];
                    $levelInfo = $levelData[(string) $nomorLevel] ?? ['indikator' => [], 'kelompok' => []];
                @endphp

                @if (!empty($jawaban))
                    <div class="level-block">
                        <div class="level-title">{{ $levelJudul[$nomorLevel] }}</div>

                        <div class="level-description">
                            <p>{{ $levelDeskripsi[$nomorLevel] }}</p>

                            @if ($levelCatatan[$nomorLevel] !== '')
                                <p class="level-note">{{ $levelCatatan[$nomorLevel] }}</p>
                            @endif
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th style="width:8%">No.</th>
                                    <th style="width:42%">Indikator</th>
                                    <th style="width:40%">Bukti / Catatan</th>
                                    <th style="width:10%">Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($levelInfo['indikator'] as $ind)
                                    @php
                                        $item = $jawaban[$ind['no']] ?? $jawaban['indikator_' . $ind['no']] ?? null;

                                        $skor = is_array($item)
                                            ? ($item['skor'] ?? $item['jawaban'] ?? '-')
                                            : ($item ?? '-');

                                        $bukti = is_array($item)
                                            ? ($item['bukti'] ?? $item['catatan'] ?? '')
                                            : '';

                                        $alasanTd = is_array($item)
                                            ? ($item['alasan_td'] ?? '')
                                            : '';

                                        $buktiTampil = trim(
                                            $bukti .
                                            ($alasanTd ? "\nAlasan TD: " . $alasanTd : '')
                                        );
                                    @endphp

                                    @if (isset($levelInfo['kelompok'][(string) $ind['no']]))
                                        <tr class="group-row">
                                            <td colspan="4">
                                                {{ $levelInfo['kelompok'][(string) $ind['no']] }}
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td style="text-align:center">{{ $ind['no'] }}</td>
                                        <td>{{ $ind['indikator'] }}</td>
                                        <td style="white-space:pre-line">
                                            {{ $buktiTampil ?: '-' }}
                                        </td>
                                        <td style="text-align:center">{{ $skor }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach
        </section>

        <section class="signature">
            <div class="signature-box">
                <div>Guru / Responden</div>
                <div class="signature-space"></div>
                <div class="signature-name">{{ $gembira->nama_guru ?: '-' }}</div>
            </div>

            <div class="signature-box">
                <div>Petugas Monev</div>
                <div class="signature-space"></div>
                <div class="signature-name">
                    {{ $gembira->nama_petugas_monev ?: '-' }}
                </div>
            </div>
        </section>

        <footer class="footer">
            Dokumen hasil Monitoring dan Evaluasi Matematika GEMBIRA
        </footer>
    </main>
</body>

</html>