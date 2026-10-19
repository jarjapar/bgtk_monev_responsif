<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Wawancara BK - {{ $wawancara->nama_responden }}</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            background: #eef2f7;
            color: #1e293b;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            line-height: 1.5;
        }

        .no-print { display: block; }

        .print-toolbar {
            width: 210mm;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .toolbar-left, .toolbar-right {
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
        }

        .btn svg { width: 17px; height: 17px; flex-shrink: 0; }

        .btn-back {
            color: #334155;
            background: #fff;
            border-color: #cbd5e1;
        }

        .btn-print {
            color: #fff;
            background: #2563eb;
            border-color: #2563eb;
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
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: .4px;
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

        .section { margin-top: 20px; }

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

        .answer-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .answer-table th,
        .answer-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 9px;
            vertical-align: top;
        }

        .answer-table th {
            background: #f1f5f9;
            color: #334155;
            text-align: center;
            font-size: 11px;
        }

        .answer-table td { font-size: 11px; }

        .answer-table .number {
            width: 8%;
            text-align: center;
            font-weight: 700;
        }

        .answer-table .question { width: 42%; }
        .answer-table .answer { width: 50%; white-space: pre-line; }

        .open-question {
            margin-top: 12px;
            border: 1px solid #dbe2ea;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .open-question-title {
            padding: 8px 10px;
            background: #f8fafc;
            color: #334155;
            font-weight: 700;
            font-size: 11px;
            border-bottom: 1px solid #dbe2ea;
        }

        .open-question-answer {
            min-height: 55px;
            padding: 10px;
            color: #334155;
            font-size: 11px;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .signature-section {
            margin-top: 35px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .signature-box { text-align: center; }

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
            .print-toolbar { width: auto; margin: 12px; }
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

            .toolbar-left, .toolbar-right { width: 100%; }
            .btn { flex: 1; }

            .document { margin: 0; }

            .identity-table,
            .identity-table tbody,
            .identity-table tr,
            .identity-table td {
                display: block;
                width: 100%;
            }

            .identity-table td { width: 100% !important; }

            .answer-table th,
            .answer-table td {
                padding: 6px;
                font-size: 10px;
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
                width: 210mm;
                background: #fff;
            }

            body { font-size: 11px; }
            .no-print { display: none !important; }

            .document {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .document-header { margin-top: 0; }

            .section { break-inside: auto; }

            .open-question,
            .signature-section {
                break-inside: avoid;
            }

            .section-title,
            .identity-table .label,
            .answer-table th,
            .open-question-title {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

@php
    $metadata = json_decode($wawancara->hasil_wawancara ?? '{}', true);

    if (!is_array($metadata)) {
        $metadata = [];
    }

    $tanggalWawancara = $wawancara->tanggal_wawancara
        ? \Illuminate\Support\Carbon::parse($wawancara->tanggal_wawancara)->format('d/m/Y')
        : '-';

    $tanggalPengisian = data_get($metadata, 'tanggal_pengisian');

    $pertanyaan = [
        1 => 'Apa saja hambatan yang Anda hadapi selama mengikuti pelatihan ini?',
        2 => 'Hal baik apa saja yang harus dipertahankan dalam pelaksanaan pelatihan ini?',
        3 => 'Saran apa yang dapat Anda berikan untuk peningkatan dan keberlanjutan program pelatihan ini?',
    ];

    $namaResponden = $wawancara->nama_responden
        ?: $wawancara->nama_narasumber
        ?: '-';

    $namaPetugas = $wawancara->nama_petugas_monev
        ?: $wawancara->nama_pewawancara
        ?: '-';

    $jabatan = data_get($metadata, 'jabatan')
        ?: $wawancara->status_responden
        ?: $wawancara->jabatan_narasumber
        ?: '-';

    $satuanPendidikan = data_get($metadata, 'satuan_pendidikan')
        ?: $wawancara->unit_kerja_responden
        ?: '-';

    $jawaban = [
        1 => $wawancara->jawaban_1,
        2 => $wawancara->jawaban_2,
        3 => $wawancara->jawaban_3,
    ];
@endphp

<div class="print-toolbar no-print">
    <div class="toolbar-left">
        <a href="{{ route('wawancara.show', $wawancara->id) }}" class="btn btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="toolbar-right">
        <button type="button" onclick="window.print()" class="btn btn-print">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 9V2h12v7 M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2 M6 14h12v8H6v-8z" />
            </svg>
            Cetak Hasil
        </button>
    </div>
</div>

<main class="document">

    <header class="document-header">
        <div class="institution">BALAI GURU DAN TENAGA KEPENDIDIKAN</div>
        <h1 class="document-title">HASIL WAWANCARA BK</h1>
        <div class="document-subtitle">
            Lembar Monitoring dan Evaluasi Program BK
        </div>
    </header>

    <section class="section">
        <h2 class="section-title">A. Identitas Pengisian</h2>

        <table class="identity-table">
            <tbody>
                <tr>
                    <td class="label">Nama Responden</td>
                    <td class="value">{{ $namaResponden }}</td>
                    <td class="label">Jabatan</td>
                    <td class="value">{{ $jabatan }}</td>
                </tr>

                <tr>
                    <td class="label">Satuan Pendidikan</td>
                    <td class="value">{{ $satuanPendidikan }}</td>
                    <td class="label">Masa Kerja</td>
                    <td class="value">
                        @if (data_get($metadata, 'masa_kerja') !== null)
                            {{ data_get($metadata, 'masa_kerja') }} tahun
                        @else
                            -
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="label">Nama Kegiatan/Pelatihan</td>
                    <td class="value">{{ data_get($metadata, 'nama_kegiatan', '-') }}</td>
                    <td class="label">Tanggal Wawancara</td>
                    <td class="value">{{ $tanggalWawancara }}</td>
                </tr>

                <tr>
                    <td class="label">Tanggal Pengisian</td>
                    <td class="value">
                        @if ($tanggalPengisian)
                            {{ \Illuminate\Support\Carbon::parse($tanggalPengisian)->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="label">Status</td>
                    <td class="value">{{ $wawancara->status ?: '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Nama Petugas Monev</td>
                    <td class="value">{{ $namaPetugas }}</td>
                    <td class="label">Instansi Petugas</td>
                    <td class="value">{{ data_get($metadata, 'instansi_petugas', $wawancara->unit_kerja_petugas ?: '-') }}</td>
                </tr>

                <tr>
                    <td class="label">Lokasi Monev</td>
                    <td class="value" colspan="3">{{ data_get($metadata, 'lokasi_monev', '-') }}</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="section">
        <h2 class="section-title">B. Pertanyaan dan Jawaban Wawancara</h2>

        @foreach ($pertanyaan as $nomor => $teks)
            <div class="open-question">
                <div class="open-question-title">
                    Pertanyaan {{ $nomor }}. {{ $teks }}
                </div>

                <div class="open-question-answer">{{ $jawaban[$nomor] ?: 'Belum ada jawaban.' }}</div>
            </div>
        @endforeach
    </section>

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

    <footer class="document-footer">
        Dokumen hasil Monitoring dan Evaluasi Wawancara BK
    </footer>

</main>

</body>
</html>