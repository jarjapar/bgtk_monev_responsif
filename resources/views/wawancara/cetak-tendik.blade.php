@php
    use Illuminate\Support\Carbon;

    $pertanyaan = [
        1 => '(Reaksi) Hal apa dari substansi materi, fasilitator, maupun layanan penyelenggaraan yang menurut Anda paling bermanfaat dan berkesan? Mengapa?',
        2 => '(Belajar) Pengetahuan, keterampilan, atau sikap baru apa yang Anda kuasai setelah pelatihan (termasuk growth mindset dan profesionalisme), dan materi apa yang masih perlu diperdalam?',
        3 => '(Perilaku) Berikan contoh nyata penerapan hasil pelatihan dalam pekerjaan Anda sehari-hari.',
        4 => '(Perilaku) Kendala apa yang Anda hadapi dalam menerapkan hasil pelatihan, dan dukungan apa yang Anda perlukan?',
        5 => '(Hasil) Perubahan atau dampak apa yang terlihat di sekolah setelah pelatihan, dan apa saran Anda untuk perbaikan program berikutnya?',
    ];

    $namaPetugas = $wawancara->nama_petugas_monev
        ?? $wawancara->nama_pewawancara ?? '-';

    $instansiPetugas = $metadata['instansi_petugas']
        ?? $wawancara->unit_kerja_petugas ?? '-';

    $namaResponden = $wawancara->nama_responden
        ?? $wawancara->nama_narasumber ?? '-';

    $jabatanResponden = $metadata['jabatan_responden']
        ?? $wawancara->status_responden
        ?? $wawancara->jabatan_narasumber ?? '-';

    if ($jabatanResponden === 'Lainnya' && !empty($metadata['jabatan_lainnya'])) {
        $jabatanResponden .= ' - ' . $metadata['jabatan_lainnya'];
    }

    $lokasiMonev = $metadata['lokasi_monev'] ?? '-';

    $satuanPendidikan = $metadata['satuan_pendidikan']
        ?? $wawancara->unit_kerja_responden
        ?? $wawancara->sekolah?->nama_sekolah ?? '-';

    $masaKerja = $metadata['masa_kerja'] ?? null;

    $namaPelatihan = $metadata['nama_pelatihan']
        ?? $metadata['nama_kegiatan'] ?? '-';

    $tanggalPelaksanaan = $metadata['tanggal_pelaksanaan']
        ?? $wawancara->tanggal_evaluasi ?? null;

    $tanggalPengisian = $metadata['tanggal_pengisian']
        ?? $wawancara->tanggal_wawancara
        ?? $wawancara->created_at ?? null;

    $formatTanggal = static function ($tanggal) {
        if (!$tanggal) {
            return '-';
        }

        try {
            return Carbon::parse($tanggal)->locale('id')->translatedFormat('d F Y');
        } catch (\Throwable $e) {
            return '-';
        }
    };

    $jawabanTerisi = 0;

    foreach (array_keys($pertanyaan) as $nomor) {
        $jawaban = $wawancara->{'jawaban_' . $nomor};

        if (is_string($jawaban) && trim($jawaban) !== '') {
            $jawabanTerisi++;
        }
    }
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Wawancara TENDIK - {{ $namaResponden }}</title>

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
            line-height: 1.6;
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

        .toolbar-actions {
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
            border: 1px solid transparent;
            border-radius: 9px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn svg {
            width: 17px;
            height: 17px;
        }

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
            margin-bottom: 22px;
            padding-bottom: 14px;
            border-bottom: 2px solid #1e40af;
            text-align: center;
        }

        .institution {
            margin-bottom: 5px;
            color: #475569;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .document-title {
            margin: 0;
            color: #0f172a;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.4;
        }

        .document-subtitle {
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
        }

        .section {
            margin-top: 22px;
        }

        .section-title {
            margin: 0 0 10px;
            padding: 8px 10px;
            border-left: 4px solid #2563eb;
            background: #eff6ff;
            color: #1e3a8a;
            font-size: 12px;
            font-weight: 700;
        }

        .identity-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .identity-table td {
            padding: 7px 8px;
            border: 1px solid #dbe2ea;
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

        .status {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 10px;
            font-weight: 700;
        }

        .question {
            display: block;
            width: 100%;
            margin-top: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            page-break-inside: auto;
            break-inside: auto;
        }

        .question-heading {
            display: block;
            width: 100%;
            padding: 9px 10px;
            border-bottom: 1px solid #dbe2ea;
            background: #f8fafc;
            color: #1e293b;
            font-size: 11px;
            font-weight: 700;
            text-align: left;
        }

        .question-number {
            display: inline-block;
            margin-right: 5px;
            color: #1d4ed8;
        }

        .question-text {
            margin-top: 3px;
            font-weight: 400;
            text-align: left;
        }

        /* Perbaikan utama: isi jawaban selalu dimulai dari kiri atas. */
        .question .answer {
            display: block !important;
            position: static !important;
            width: 100% !important;
            height: auto !important;
            min-height: 65px;
            margin: 0 !important;
            padding: 10px !important;

            color: #334155;
            background: #fff;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            font-weight: 400;
            line-height: 1.6;

            text-align: left !important;
            vertical-align: top !important;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .question .answer p,
        .question .answer span {
            margin: 0;
            padding: 0;
            text-align: left !important;
        }

        .empty-answer {
            color: #94a3b8;
            font-style: italic;
        }

        .signature-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 35px;
            margin-top: 40px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .signature-box {
            text-align: center;
        }

        .signature-title {
            min-height: 24px;
            margin-bottom: 65px;
        }

        .signature-line {
            width: 85%;
            margin: 0 auto;
            border-bottom: 1px solid #334155;
        }

        .signature-name {
            margin-top: 6px;
            font-size: 11px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .document-footer {
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #cbd5e1;
            color: #94a3b8;
            font-size: 9px;
            text-align: center;
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
                padding: 24px;
            }
        }

        @media screen and (max-width: 600px) {
            .print-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .toolbar-actions {
                width: 100%;
            }

            .btn {
                flex: 1;
            }

            .document {
                margin: 0;
                padding: 18px;
            }

            .identity-table,
            .identity-table tbody,
            .identity-table tr,
            .identity-table td {
                display: block;
                width: 100%;
            }

            .identity-table .label,
            .identity-table .value {
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

            html,
            body {
                width: 100%;
                background: #fff;
                font-size: 10px;
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

            .section-title,
            .question-heading,
            .identity-table .label {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .question {
                break-inside: auto;
                page-break-inside: auto;
            }

            .question .answer {
                display: block !important;
                position: static !important;
                width: 100% !important;
                height: auto !important;
                margin: 0 !important;
                padding: 10px !important;
                text-align: left !important;
                vertical-align: top !important;
            }

            .signature-section {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .document-footer {
                color: #64748b;
            }
        }
    </style>
</head>

<body>
    <div class="print-toolbar no-print">
        <a href="{{ route('wawancara.show', $wawancara->id) }}" class="btn btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        <div class="toolbar-actions">
            <button type="button" onclick="window.print()" class="btn btn-print">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z" />
                </svg>
                Cetak Hasil
            </button>
        </div>
    </div>

    <main class="document">
        <header class="document-header">
            <div class="institution">Balai Guru dan Tenaga Kependidikan</div>
            <h1 class="document-title">HASIL WAWANCARA TENDIK</h1>
            <div class="document-subtitle">
                Dokumen Monitoring dan Evaluasi Program Tenaga Kependidikan
            </div>
        </header>

        <section class="section">
            <h2 class="section-title">A. Identitas Pengisian</h2>

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
                        <td class="value">{{ $lokasiMonev }}</td>
                        <td class="label">Tanggal Pelaksanaan</td>
                        <td class="value">{{ $formatTanggal($tanggalPelaksanaan) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Satuan Pendidikan</td>
                        <td class="value">{{ $satuanPendidikan }}</td>
                        <td class="label">Masa Kerja</td>
                        <td class="value">
                            {{ $masaKerja !== null && $masaKerja !== '' ? $masaKerja . ' tahun' : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Nama Kegiatan/Pelatihan</td>
                        <td class="value">{{ $namaPelatihan }}</td>
                        <td class="label">Tanggal Pengisian</td>
                        <td class="value">{{ $formatTanggal($tanggalPengisian) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Status Pengisian</td>
                        <td class="value" colspan="3">
                            <span class="status">
                                {{ $jawabanTerisi === count($pertanyaan) ? 'Lengkap' : 'Belum Lengkap' }}
                            </span>
                            &nbsp; {{ $jawabanTerisi }} dari {{ count($pertanyaan) }} pertanyaan terisi
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="section">
            <h2 class="section-title">B. Hasil Wawancara</h2>

            @foreach ($pertanyaan as $nomor => $teks)
                @php
                    $jawaban = $wawancara->{'jawaban_' . $nomor};
                @endphp

                <article class="question">
                    <div class="question-heading">
                        <span class="question-number">Pertanyaan {{ $nomor }}</span>
                        <div class="question-text">{{ $teks }}</div>
                    </div>

                    <div class="answer">@if (is_string($jawaban) && trim($jawaban) !== ''){{ trim($jawaban) }}@else<span
                    class="empty-answer">Belum ada jawaban.</span>@endif</div>
                </article>
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
            Dokumen hasil wawancara Monitoring dan Evaluasi TENDIK
        </footer>
    </main>
</body>

</html>