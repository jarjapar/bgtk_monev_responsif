
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cetak Wawancara BCKS - {{ $wawancara->nama_responden }}</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            background: #eef2f7;
            color: #1e293b;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        .no-print { display: block; }

        .print-toolbar {
            width: 210mm;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            gap: 12px;
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
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid #cbd5e1;
        }

        .btn-back {
            background: #fff;
            color: #334155;
        }

        .btn-print {
            background: #2563eb;
            border-color: #2563eb;
            color: #fff;
        }

        .document {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 30px;
            padding: 18mm 16mm;
            background: #fff;
            box-shadow: 0 5px 25px rgba(15, 23, 42, .10);
        }

        .document-header {
            text-align: center;
            padding-bottom: 14px;
            border-bottom: 2px solid #1e40af;
            margin-bottom: 20px;
        }

        .institution {
            font-size: 12px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 4px;
        }

        .document-title {
            margin: 0;
            color: #0f172a;
            font-size: 19px;
            line-height: 1.4;
            font-weight: 700;
        }

        .document-subtitle {
            margin-top: 5px;
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
            font-weight: 700;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

        .identity-table,
        .answer-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .identity-table td,
        .answer-table th,
        .answer-table td {
            border: 1px solid #cbd5e1;
            padding: 7px 9px;
            vertical-align: top;
            overflow-wrap: anywhere;
        }

        .identity-table .label {
            width: 23%;
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
        }

        .identity-table .value {
            width: 27%;
            color: #0f172a;
        }

        .answer-table th {
            background: #f1f5f9;
            color: #334155;
            text-align: center;
            font-size: 11px;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

        .answer-table .number {
            width: 8%;
            text-align: center;
        }

        .answer-table .question {
            width: 44%;
        }

        .answer-table .answer {
            width: 48%;
            white-space: pre-line;
        }

        .answer-row {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .signature-section {
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .signature-box { text-align: center; }

        .signature-title {
            margin-bottom: 60px;
            font-size: 11px;
        }

        .signature-line {
            width: 80%;
            margin: 0 auto;
            border-bottom: 1px solid #334155;
        }

        .signature-name {
            margin-top: 5px;
            font-size: 11px;
            font-weight: 700;
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
            }

            .document {
                margin: 0;
                padding: 16px;
            }

            .identity-table,
            .identity-table tbody,
            .identity-table tr,
            .identity-table td {
                display: block;
                width: 100%;
            }

            .identity-table td {
                width: 100%;
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
            html, body {
                width: 100%;
                background: #fff;
            }

            body { font-size: 10.5px; }

            .no-print { display: none !important; }

            .document {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .section { break-inside: auto; }

            .answer-table thead {
                display: table-header-group;
            }

            .answer-row {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="print-toolbar no-print">
        <a href="{{ route('wawancara.show', $wawancara->id) }}" class="btn btn-back">
            ← Kembali ke Detail
        </a>

        <button type="button" onclick="window.print()" class="btn btn-print">
            Cetak Wawancara
        </button>
    </div>

    <main class="document">
        <header class="document-header">
            <div class="institution">
                Balai Guru dan Tenaga Kependidikan
            </div>

            <h1 class="document-title">
                HASIL WAWANCARA BCKS
            </h1>

            <div class="document-subtitle">
                Instrumen Monitoring dan Evaluasi Program BCKS
            </div>
        </header>

        <section class="section">
            <h2 class="section-title">A. Identitas Wawancara</h2>

            <table class="identity-table">
                <tbody>
                    <tr>
                        <td class="label">Nama Responden</td>
                        <td class="value">
                            {{ $wawancara->nama_responden ?: '-' }}
                        </td>

                        <td class="label">Jabatan/Status</td>
                        <td class="value">
                            {{ $wawancara->status_responden ?: $wawancara->jabatan_narasumber ?: '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Unit Kerja Responden</td>
                        <td class="value">
                            {{ $wawancara->unit_kerja_responden ?: '-' }}
                        </td>

                        <td class="label">Nama BCKS</td>
                        <td class="value">
                            {{ $wawancara->nama_bcks ?: '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Unit Kerja BCKS</td>
                        <td class="value">
                            {{ $wawancara->unit_kerja_bcks ?: '-' }}
                        </td>

                        <td class="label">Angkatan Pelatihan</td>
                        <td class="value">
                            {{ $wawancara->angkatan_pelatihan_bcks ?: '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Nama Petugas Monev</td>
                        <td class="value">
                            {{ $wawancara->nama_petugas_monev ?: $wawancara->nama_pewawancara ?: '-' }}
                        </td>

                        <td class="label">Unit Kerja Petugas</td>
                        <td class="value">
                            {{ $wawancara->unit_kerja_petugas ?: '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Tanggal Wawancara</td>
                        <td class="value" colspan="3">
                            @php
                                $tanggal = $wawancara->tanggal_wawancara
                                    ?? $wawancara->tanggal_evaluasi;
                            @endphp

                            {{ $tanggal ? \Illuminate\Support\Carbon::parse($tanggal)->format('d/m/Y') : '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="section">
            <h2 class="section-title">B. Pertanyaan dan Jawaban Wawancara</h2>

            @php
                $pertanyaan = [
                    1 => 'Apa hal paling bermanfaat atau berkesan yang Anda peroleh dari program pelatihan BCKS?',
                    2 => 'Pengetahuan, keterampilan, atau sikap baru apa yang Anda peroleh setelah mengikuti pelatihan?',
                    3 => 'Bagaimana Anda menerapkan hasil pelatihan dalam pelaksanaan tugas atau pengembangan sekolah?',
                    4 => 'Apa kendala yang Anda hadapi dalam menerapkan hasil pelatihan dan dukungan apa yang diperlukan?',
                    5 => 'Perubahan atau dampak apa yang terlihat setelah pelatihan, dan apa saran Anda untuk perbaikan program berikutnya?',
                ];
            @endphp

            <table class="answer-table">
                <thead>
                    <tr>
                        <th class="number">No.</th>
                        <th class="question">Pertanyaan</th>
                        <th class="answer">Jawaban Responden</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pertanyaan as $nomor => $teks)
                        <tr class="answer-row">
                            <td class="number">{{ $nomor }}</td>
                            <td class="question">{{ $teks }}</td>
                            <td class="answer">{{ $wawancara->{'jawaban_' . $nomor} ?: '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="signature-section">
            <div class="signature-box">
                <div class="signature-title">Responden</div>
                <div class="signature-line"></div>
                <div class="signature-name">
                    {{ $wawancara->nama_responden ?: '-' }}
                </div>
            </div>

            <div class="signature-box">
                <div class="signature-title">Petugas Monev</div>
                <div class="signature-line"></div>
                <div class="signature-name">
                    {{ $wawancara->nama_petugas_monev ?: $wawancara->nama_pewawancara ?: '-' }}
                </div>
            </div>
        </section>

        <footer class="document-footer">
            Dokumen hasil wawancara Monitoring dan Evaluasi BCKS
        </footer>
    </main>
</body>
</html>
