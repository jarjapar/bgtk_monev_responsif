@extends('layouts.app')

@section('title', 'Hasil Penilaian BCKS')

@section('page-title', 'Hasil Penilaian BCKS')

@section('content')
    @php
        /*
        |--------------------------------------------------------------------------
        | Konfigurasi dan data indikator
        |--------------------------------------------------------------------------
        */

        $levelsConfig = config('bcks.instrumen.levels', []);

        $indikatorConfig = [];
        $nomorUrut = 0;

        foreach ($levelsConfig as $level => $levelData) {
            foreach ($levelData['indikator'] ?? [] as $indikator) {
                $nomorUrut++;

                $indikatorConfig[] = [
                    'nomor' => $nomorUrut,
                    'kode' => $indikator['kode'] ?? '',
                    'pertanyaan' => $indikator['pertanyaan'] ?? '-',
                    'level' => $level,
                ];
            }
        }

        $jawaban = $bcksPengisian->jawaban ?? collect();

        // Mendukung nomor_indikator berupa nomor urut 1-27
        // maupun kode indikator seperti 1.1, 1.2, dan seterusnya.
        $jawabanByNomor = $jawaban->keyBy(
            fn($item) => (string) $item->nomor_indikator
        );

        $jawabanByKode = $jawaban->keyBy(
            fn($item) => (string) $item->nomor_indikator
        );

        $levelConfig = [
            'Reaction' => [
                'label' => 'Level 1 — Reaction',
                'deskripsi' => 'Reaksi peserta terhadap pelaksanaan pelatihan.',
            ],
            'Learning' => [
                'label' => 'Level 2 — Learning',
                'deskripsi' => 'Perubahan pemahaman dan kesiapan peserta setelah pelatihan.',
            ],
            'Behavior' => [
                'label' => 'Level 3 — Behavior',
                'deskripsi' => 'Perubahan perilaku dan penerapan hasil pelatihan di sekolah.',
            ],
            'Results' => [
                'label' => 'Level 4 — Results',
                'deskripsi' => 'Dampak penerapan hasil pelatihan terhadap sekolah.',
            ],
        ];

        $levelScores = array_fill_keys(array_keys($levelConfig), 0);
        $levelCounts = array_fill_keys(array_keys($levelConfig), 0);

        foreach ($jawaban as $item) {
            $level = $item->level;

            if (array_key_exists($level, $levelScores)) {
                $levelScores[$level] += (int) $item->skor;
                $levelCounts[$level]++;
            }
        }
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
                    <span>Hasil Penilaian BCKS</span>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Hasil Penilaian BCKS
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Detail lengkap hasil pengisian instrumen monitoring dan evaluasi BCKS.
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
               <a href="{{ route('bcks.cetak', $bcksPengisian) }}" target="_blank"
                    class="inline-flex h-12 items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Cetak Hasil
                </a>

                {{-- Edit Data --}}
                <a href="{{ route('bcks.edit', $bcksPengisian) }}"
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
                        {{ $bcksPengisian->total_skor }}
                    </span>
                    <span class="pb-1 text-sm text-slate-500">/ 108</span>
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    Akumulasi skor dari 27 indikator.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Nilai Akhir</p>

                <div class="mt-2">
                    <span class="text-3xl font-bold text-blue-600">
                        {{ number_format((float) $bcksPengisian->nilai_akhir, 2, ',', '.') }}
                    </span>
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    Persentase capaian berdasarkan skor maksimum.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Predikat</p>

                <div class="mt-2">
                    @php
                        $predikatClass = match ($bcksPengisian->predikat) {
                            'Sangat Baik' => 'bg-emerald-100 text-emerald-700',
                            'Baik' => 'bg-blue-100 text-blue-700',
                            'Cukup' => 'bg-amber-100 text-amber-700',
                            default => 'bg-red-100 text-red-700',
                        };
                    @endphp

                    <span class="inline-flex rounded-full px-3 py-1.5 text-sm font-bold {{ $predikatClass }}">
                        {{ $bcksPengisian->predikat }}
                    </span>
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    Kategori hasil penilaian BCKS.
                </p>
            </div>

        </div>

        {{-- Identitas pengisian --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Identitas Pengisian</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Informasi BCKS, responden, dan petugas Monev.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama BCKS</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $bcksPengisian->nama_bcks }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Unit Kerja</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $bcksPengisian->unit_kerja ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Angkatan Pelatihan BCKS</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $bcksPengisian->angkatan_pelatihan ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $bcksPengisian->nama_responden }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Unit Kerja Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $bcksPengisian->unit_kerja_responden ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $bcksPengisian->status_responden }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Petugas Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $bcksPengisian->nama_petugas_monev }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Unit Kerja Petugas</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $bcksPengisian->unit_kerja_petugas ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Evaluasi</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $bcksPengisian->tanggal_evaluasi?->format('d/m/Y') ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status Pengisian</p>
                    <div class="mt-1">
                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">
                            {{ $bcksPengisian->status_pengisian }}
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
                @foreach ($levelConfig as $level => $config)
                    @php
                        $jumlahIndikator = $levelCounts[$level] ?? 0;
                        $skorLevel = $levelScores[$level] ?? 0;
                        $maksimalLevel = $jumlahIndikator * 4;
                        $persentaseLevel = $maksimalLevel > 0
                            ? ($skorLevel / $maksimalLevel) * 100
                            : 0;
                    @endphp

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-bold text-slate-800">{{ $config['label'] }}</p>
                        <p class="mt-1 text-xs leading-5 text-slate-500">{{ $config['deskripsi'] }}</p>

                        <div class="mt-4 flex items-end justify-between gap-3">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">{{ $skorLevel }}</span>
                                <span class="text-xs text-slate-500">/ {{ $maksimalLevel }}</span>
                            </div>

                            <span class="text-sm font-bold text-slate-700">
                                {{ number_format($persentaseLevel, 2, ',', '.') }}%
                            </span>
                        </div>

                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200">
                            <div class="h-full rounded-full bg-blue-600" style="width: {{ min($persentaseLevel, 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Detail indikator --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Detail Penilaian 27 Indikator</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Nilai setiap indikator berdasarkan hasil pengisian instrumen.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-6 py-4 font-bold">No.</th>
                            <th class="px-6 py-4 font-bold">Level</th>
                            <th class="px-6 py-4 font-bold">Indikator</th>
                            <th class="px-6 py-4 text-center font-bold">Skor</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($indikatorConfig as $indikator)
                            @php
                                $nomor = $indikator['nomor'];
                                $kode = (string) $indikator['kode'];

                                // Cari berdasarkan nomor urut terlebih dahulu,
                                // lalu coba berdasarkan kode indikator.
                                $jawabanItem = $jawabanByNomor->get((string) $nomor)
                                    ?? $jawabanByKode->get($kode);
                            @endphp

                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-500">
                                    {{ $nomor }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">
                                        {{ $levelConfig[$indikator['level']]['label'] ?? $indikator['level'] }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 leading-6 text-slate-700">
                                    {{ $indikator['pertanyaan'] }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($jawabanItem)
                                        <span
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 font-bold text-white">
                                            {{ $jawabanItem->skor }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-500">
                                    Konfigurasi 27 indikator belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection