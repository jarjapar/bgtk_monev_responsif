@extends('layouts.app')

@section('title', 'Hasil Pengisian PKGSD MBI')

@section('page-title', 'Hasil Pengisian PKGSD MBI')

@section('content')
    @php
        /*
        |--------------------------------------------------------------------------
        | Konfigurasi instrumen
        |--------------------------------------------------------------------------
        |
        | Teks indikator dan rubrik dibaca dari config/pkgsd_mbi.php.
        | Jika file config belum dibuat, halaman tetap tampil dengan label
        | "Indikator N" dan jumlah indikator bawaan.
        |
        */

        $instrumen = config('pkgsd_mbi.levels', []);

        $levelConfig = [
            1 => [
                'label' => 'Level 1 — Reaction',
                'deskripsi' => 'Respons peserta terhadap program dan pelaksanaan pelatihan.',
                'jumlah' => 29,
            ],
            2 => [
                'label' => 'Level 2 — Learning',
                'deskripsi' => 'Pengetahuan dan keterampilan yang dipelajari guru.',
                'jumlah' => 10,
            ],
            3 => [
                'label' => 'Level 3 — Behavior',
                'deskripsi' => 'Penerapan hasil pelatihan di kelas (observasi pembelajaran).',
                'jumlah' => 22,
            ],
            4 => [
                'label' => 'Level 4 — Results',
                'deskripsi' => 'Perubahan pada guru, murid, dan budaya sekolah.',
                'jumlah' => 12,
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Level yang berlaku berdasarkan jabatan pemonev
        |--------------------------------------------------------------------------
        */

        $jabatan = $pkgsdMbi->jabatan_penilai ?? '';
        $levelAktif = $jabatan === 'Peserta PKGSD MBI' ? [1, 2, 3, 4] : [3, 4];

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

        $kategoriClass = function ($kategori) {
            return match ($kategori) {
                'Sangat Baik' => 'bg-emerald-100 text-emerald-700',
                'Baik' => 'bg-blue-100 text-blue-700',
                'Cukup' => 'bg-amber-100 text-amber-700',
                'Belum ada skor' => 'bg-slate-100 text-slate-700',
                default => 'bg-red-100 text-red-700',
            };
        };

        /*
        |--------------------------------------------------------------------------
        | Rekap per level dan keseluruhan
        |--------------------------------------------------------------------------
        |
        | Rerata hanya dari skor numerik 1–4. TD tidak dihitung,
        | indikator yang belum dinilai tidak dianggap bernilai nol.
        |
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

            $rekap[$level] = [
                'total' => $total,
                'terisi' => $terisi,
                'td' => $jumlahTD,
                'rata' => $rata,
                'persen' => $rata !== null ? ($rata / 4) * 100 : 0,
                'kategori' => $kategoriDari($rata),
            ];

            $totalSemua += $total;
            $terisiSemua += $terisi;
            $jumlahIndikatorBerlaku += $levelConfig[$level]['jumlah'];
        }

        $rataSemua = $terisiSemua > 0 ? $totalSemua / $terisiSemua : null;
        $kategoriSemua = $kategoriDari($rataSemua);

        $adaMetadataObservasi = filled($pkgsdMbi->tanggal_observasi ?? null)
            || filled($pkgsdMbi->durasi_pembelajaran ?? null)
            || filled($pkgsdMbi->jumlah_murid_hadir ?? null)
            || filled($pkgsdMbi->observasi_ke ?? null);
    @endphp

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('pkgsd-mbi.index') }}" class="transition hover:text-blue-600">
                        PKGSD MBI
                    </a>
                    <span>/</span>
                    <span>Hasil Pengisian</span>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Hasil Pengisian PKGSD MBI
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Detail hasil pengisian instrumen monitoring dan evaluasi PKGSD MBI — Model Kirkpatrick.
                </p>
            </div>

            <div class="no-print flex flex-wrap items-center gap-3">
                <a href="{{ route('instrumen.index') }}"
                    class="inline-flex h-12 items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-6 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>

                <a href="{{ route('pkgsd-mbi.cetak', $pkgsdMbi) }}" target="_blank"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                    Cetak / Simpan PDF
                </a>
                <a href="{{ route('pkgsd-mbi.edit', $pkgsdMbi) }}"
                    class="inline-flex h-12 items-center justify-center rounded-xl px-6 text-sm font-semibold text-white shadow-sm transition"
                    style="background-color: #f97316;" onmouseover="this.style.backgroundColor='#ea580c'"
                    onmouseout="this.style.backgroundColor='#f97316'">
                    Edit Data
                </a>
            </div>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Ringkasan hasil --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- Indikator dinilai --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Indikator Dinilai</p>

                <div class="mt-2 flex items-end gap-2">
                    <span class="text-3xl font-bold text-slate-900">{{ $terisiSemua }}</span>
                    <span class="pb-1 text-sm text-slate-500">/ {{ $jumlahIndikatorBerlaku }}</span>
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    Total skor {{ $totalSemua }} dari indikator berskor 1–4 sesuai jabatan pemonev.
                </p>
            </div>

            {{-- Rerata keseluruhan --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Rerata Keseluruhan</p>

                <div class="mt-2">
                    <span class="text-3xl font-bold text-blue-600">
                        {{ $rataSemua !== null ? number_format($rataSemua, 2, ',', '.') : '-' }}
                    </span>
                    <span class="text-sm font-semibold text-slate-500">/ 4</span>
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    TD dan indikator yang belum dinilai tidak dihitung dalam rerata.
                </p>
            </div>

            {{-- Kategori --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Kategori</p>

                <div class="mt-2">
                    <span
                        class="inline-flex rounded-full px-3 py-1.5 text-sm font-bold {{ $kategoriClass($kategoriSemua) }}">
                        {{ $kategoriSemua }}
                    </span>
                </div>
            </div>
        </div>

        {{-- A. BIODATA --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">A. Biodata</h2>
                <p class="text-sm text-slate-500">Informasi guru dan konteks pembelajaran yang dinilai.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Guru</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $pkgsdMbi->nama_guru ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Sekolah</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $pkgsdMbi->nama_sekolah ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kelas / Fase</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $pkgsdMbi->kelas_fase ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Topik / Materi</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $pkgsdMbi->topik_materi ?: '-' }}</p>
                </div>
            </div>
        </section>

        {{-- B. IDENTITAS PEMONEV --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">B. Identitas Pemonev</h2>
                <p class="text-sm text-slate-500">Identitas petugas, jabatan, dan tanggal monitoring.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Petugas Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $pkgsdMbi->nama_petugas_monev ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jabatan Pemonev</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $jabatan ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $pkgsdMbi->tanggal_monev?->format('d/m/Y') ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status Pengisian</p>
                    <div class="mt-1">
                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">
                            {{ $pkgsdMbi->status ?: '-' }}
                        </span>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Sumber Data / Bukti</p>
                    <p class="mt-1 whitespace-pre-line text-sm text-slate-800">
                        {{ $pkgsdMbi->sumber_data_bukti ?: '-' }}
                    </p>
                </div>
            </div>
        </section>

        {{-- C. METADATA OBSERVASI (tampil jika datanya tersimpan) --}}
        @if ($adaMetadataObservasi)
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">C. Metadata Observasi (Level 3)</h2>
                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Observasi</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ filled($pkgsdMbi->tanggal_observasi ?? null)
                ? \Illuminate\Support\Carbon::parse($pkgsdMbi->tanggal_observasi)->format('d/m/Y')
                : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Durasi Pembelajaran</p>
                        <p class="mt-1 font-semibold text-slate-800">{{ $pkgsdMbi->durasi_pembelajaran ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jumlah Murid Hadir</p>
                        <p class="mt-1 font-semibold text-slate-800">{{ $pkgsdMbi->jumlah_murid_hadir ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Observasi Ke-</p>
                        <p class="mt-1 font-semibold text-slate-800">{{ $pkgsdMbi->observasi_ke ?: '-' }}</p>
                    </div>
                </div>
            </section>
        @endif

        {{-- Rekap per level --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Rekapitulasi Berdasarkan Level</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Ringkasan skor untuk level evaluasi yang berlaku bagi pemonev.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 p-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($levelAktif as $level)
                    @php
                        $config = $levelConfig[$level];
                        $r = $rekap[$level];
                    @endphp

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-bold text-slate-800">{{ $config['label'] }}</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">{{ $config['deskripsi'] }}</p>

                        <div class="mt-4 flex items-end justify-between gap-3">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">
                                    {{ $r['rata'] !== null ? number_format($r['rata'], 2, ',', '.') : '-' }}
                                </span>
                                <span class="text-xs text-slate-500">/ 4</span>
                            </div>

                            <span class="text-xs font-semibold text-slate-600">
                                {{ $r['terisi'] }} / {{ $config['jumlah'] }} butir
                            </span>
                        </div>

                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200">
                            <div class="h-full rounded-full bg-blue-600" style="width: {{ min($r['persen'], 100) }}%">
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <span
                                class="inline-flex rounded-full px-2.5 py-1 text-xs font-bold {{ $kategoriClass($r['kategori']) }}">
                                {{ $r['kategori'] }}
                            </span>

                            @if ($level === 3 && $r['td'] > 0)
                                <span class="text-xs text-slate-500">TD: {{ $r['td'] }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Detail indikator per level --}}
        @foreach ($levelAktif as $level)
            @php
                $config = $levelConfig[$level];
                $dataLevel = $instrumen[$level] ?? [];
                $indikatorList = collect($dataLevel['indikator'] ?? [])->keyBy('no');
                $kelompok = $dataLevel['kelompok'] ?? [];
                $jawaban = (array) $jawabanLevel[$level];
                $punyaBukti = in_array($level, [3, 4], true);
                $jumlahKolom = $punyaBukti ? 5 : 4;
            @endphp

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-900">
                        Detail Penilaian {{ $config['label'] }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $config['jumlah'] }} indikator — skor{{ $punyaBukti ? ', bukti, dan catatan' : '' }}
                        setiap indikator.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full {{ $punyaBukti ? 'min-w-[900px]' : 'min-w-[700px]' }} text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                            <tr>
                                <th class="px-6 py-4 font-bold">No.</th>
                                <th class="px-6 py-4 font-bold">Indikator</th>
                                @if ($punyaBukti)
                                    <th class="px-6 py-4 font-bold">Bukti / Catatan</th>
                                @endif
                                <th class="px-6 py-4 text-center font-bold">Skor</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @for ($nomor = 1; $nomor <= $config['jumlah']; $nomor++)
                                @php
                                    $item = $jawaban[$nomor] ?? [];
                                    $item = is_array($item) ? $item : ['skor' => $item];

                                    $skor = $item['skor'] ?? null;
                                    $skorAda = $skor !== null && $skor !== '';
                                    $isTD = $skorAda && strtoupper((string) $skor) === 'TD';

                                    $bukti = $item['bukti'] ?? '';
                                    $alasanTd = $item['alasan_td'] ?? '';

                                    $indikator = $indikatorList->get($nomor);
                                    $teksIndikator = $indikator['indikator'] ?? 'Indikator ' . $nomor;

                                    $deskripsiSkor = null;
                                    if ($indikator && $skorAda && !$isTD && is_numeric($skor)) {
                                        $deskripsiSkor = $indikator['rubrik'][(int) $skor - 1] ?? null;
                                    }

                                    $headerKelompok = $kelompok[$nomor] ?? ($kelompok[(string) $nomor] ?? null);
                                    $bagianKelompok = $headerKelompok ? explode(' | ', $headerKelompok) : [];
                                @endphp

                                @if ($headerKelompok)
                                    <tr class="bg-blue-50">
                                        <td colspan="{{ $jumlahKolom }}" class="px-6 py-3">
                                            <p class="text-sm font-bold text-blue-900">{{ $bagianKelompok[0] }}</p>
                                            @foreach (array_slice($bagianKelompok, 1) as $catatanKelompok)
                                                <p class="mt-0.5 text-xs text-blue-800">{{ $catatanKelompok }}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                                <tr class="align-top transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-500">
                                        {{ $nomor }}
                                    </td>

                                    <td class="px-6 py-4 leading-6 text-slate-700">
                                        {{ $teksIndikator }}

                                        @if ($deskripsiSkor)
                                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                                <span class="font-semibold">Skor {{ $skor }}:</span>
                                                {{ $deskripsiSkor }}
                                            </p>
                                        @endif
                                    </td>

                                    @if ($punyaBukti)
                                        <td class="px-6 py-4">
                                            @if (filled($bukti))
                                                <p class="whitespace-pre-line text-sm leading-6 text-slate-700">{{ $bukti }}</p>
                                            @endif

                                            @if ($level === 3 && $isTD)
                                                <div class="rounded-lg bg-amber-50 p-3">
                                                    <p class="text-xs font-semibold uppercase text-amber-800">Alasan TD</p>
                                                    <p class="mt-1 whitespace-pre-line text-sm text-amber-900">
                                                        {{ filled($alasanTd) ? $alasanTd : '-' }}
                                                    </p>
                                                </div>
                                            @endif

                                            @if (!filled($bukti) && !($level === 3 && $isTD))
                                                <span class="text-slate-400">-</span>
                                            @endif
                                        </td>
                                    @endif

                                    <td class="px-6 py-4 text-center">
                                        @if ($skorAda)
                                            <span
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-full font-bold text-white {{ $isTD ? 'bg-amber-500' : 'bg-blue-600' }}">
                                                {{ strtoupper((string) $skor) }}
                                            </span>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach

    </div>
@endsection