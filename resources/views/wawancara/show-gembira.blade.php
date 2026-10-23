@extends('layouts.app')

@section('title', 'Detail Wawancara Matematika GEMBIRA')
@section('page-title', 'Detail Wawancara Matematika GEMBIRA')

@section('content')
    @php
        $metadata = is_array($metadata ?? null) ? $metadata : [];
        $jawaban = $metadata['jawaban_terbuka'] ?? [];

        if (!is_array($jawaban)) {
            $jawaban = [];
        }

        // Jawaban nomor 5 berupa sub-jawaban a-e (bisa tersimpan sebagai JSON string)
        $jawaban5 = $jawaban['5'] ?? [];

        if (is_string($jawaban5)) {
            $decoded = json_decode($jawaban5, true);
            $jawaban5 = is_array($decoded) ? $decoded : [];
        }

        if (!is_array($jawaban5)) {
            $jawaban5 = [];
        }

        // Tanggal monev: utamakan metadata, lalu tanggal wawancara
        $tanggalMonevRaw = $metadata['tanggal_monev'] ?? $wawancara->tanggal_wawancara ?? null;

        try {
            $tanggalMonev = $tanggalMonevRaw
                ? \Illuminate\Support\Carbon::parse($tanggalMonevRaw)->format('d-m-Y')
                : '-';
        } catch (\Throwable $e) {
            $tanggalMonev = $tanggalMonevRaw ?: '-';
        }

        $statusWawancara = $wawancara->status ?: 'Belum Dilaksanakan';

        $pertanyaanTerbuka = [
            '1' => 'Bagaimana pengalaman Anda selama mengikuti Pelatihan Matematika Gembira?',
            '2' => 'Kendala apa yang Anda alami selama mengikuti pelatihan?',
            '3' => 'Bagaimana pemahaman Anda tentang pembelajaran matematika berubah setelah mengikuti pelatihan?',
            '4' => 'Ceritakan contoh konkret kegiatan pembelajaran matematika yang telah Anda lakukan dengan menerapkan hasil pelatihan!',
        ];

        $subPertanyaan5 = [
            'a' => 'Keterlibatan dan keaktifan peserta didik',
            'b' => 'Motivasi dan rasa percaya diri',
            'c' => 'Pemahaman konsep',
            'd' => 'Kemampuan pemecahan masalah',
            'e' => 'Komunikasi dan kolaborasi',
        ];
    @endphp

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('wawancara.index') }}" class="transition hover:text-blue-600">
                        Lembar Wawancara
                    </a>
                    <span>/</span>
                    <span>Hasil Wawancara Matematika GEMBIRA</span>
                </div>

                <h1 class="mt-1 text-2xl font-bold text-slate-800">
                    Detail Wawancara Matematika GEMBIRA
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi pelaksanaan dan hasil wawancara Matematika GEMBIRA.
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('wawancara.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>

                <a href="{{ route('wawancara.cetak', $wawancara->id) }}"
                    class="inline-flex h-12 items-center justify-center rounded-xl px-6 text-sm font-semibold text-white shadow-sm transition"
                    style="background-color: #f97316;" onmouseover="this.style.backgroundColor='#ea580c'"
                    onmouseout="this.style.backgroundColor='#f97316'">
                    Cetak Hasil</a>

                <a href="{{ route('wawancara.edit', $wawancara->id) }}"
                    class="inline-flex h-12 items-center justify-center rounded-xl px-6 text-sm font-semibold text-white shadow-sm transition"
                    style="background-color: #141be8;" onmouseover="this.style.backgroundColor='#0d13cb'"
                    onmouseout="this.style.backgroundColor='#141be8'">
                    Edit Data</a>
            </div>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- A. Identitas Guru dan Sekolah --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">A. Identitas Guru dan Sekolah</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi guru dan konteks pembelajaran yang diwawancarai.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Guru</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $metadata['nama_guru'] ?? $wawancara->nama_responden ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Sekolah</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $metadata['nama_sekolah'] ?? $wawancara->unit_kerja_responden ?? $wawancara->sekolah?->nama_sekolah ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kelas / Fase</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $metadata['kelas_fase'] ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Topik / Materi</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $metadata['topik_materi'] ?? '-' }}</p>
                </div>
            </div>
        </section>

        {{-- B. Identitas Responden dan Petugas Monev --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden dan Petugas Monev</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi penilai dan petugas pelaksana monitoring dan evaluasi.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Petugas Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->nama_petugas_monev ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jabatan Penilai</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $metadata['jabatan_penilai'] ?? $wawancara->status_responden ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $tanggalMonev }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status</p>
                    <p
                        class="mt-1 font-semibold {{ $statusWawancara === 'Selesai' ? 'text-emerald-700' : 'text-amber-700' }}">
                        {{ $statusWawancara }}
                    </p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Sumber Data / Bukti</p>
                    <p class="mt-1 whitespace-pre-line font-semibold text-slate-800">
                        {{ $metadata['sumber_data_bukti'] ?? '-' }}</p>
                </div>
            </div>
        </section>

        {{-- C. Hasil Wawancara Terbuka --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">C. Hasil Wawancara Terbuka</h2>
                <p class="mt-1 text-sm text-slate-500">Jawaban wawancara dengan responden.</p>
            </div>

            <div class="space-y-6 p-6">

                {{-- Pertanyaan 1-4 --}}
                @foreach ($pertanyaanTerbuka as $nomor => $teks)
                    @php $isi = $jawaban[$nomor] ?? $wawancara->{'jawaban_' . $nomor} ?? null; @endphp

                    <div>
                        <h4 class="font-semibold text-slate-800">{{ $nomor }}. {{ $teks }}</h4>

                        <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                            @if (filled($isi))
                                <p class="whitespace-pre-line text-sm leading-7 text-slate-700">{{ $isi }}</p>
                            @else
                                <p class="text-sm italic text-slate-400">Belum ada jawaban.</p>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-slate-100"></div>
                @endforeach

                {{-- Pertanyaan 5 (sub-jawaban a-e) --}}
                <div>
                    <h4 class="font-semibold text-slate-800">
                        5. Perubahan yang diamati setelah penerapan Matematika GEMBIRA
                    </h4>

                    <div class="mt-3 space-y-4">
                        @foreach ($subPertanyaan5 as $huruf => $teks)
                            @php $isi = $jawaban5[$huruf] ?? null; @endphp

                            <div>
                                <p class="text-sm font-medium text-slate-700">{{ $huruf }}. {{ $teks }}</p>

                                <div class="mt-2 rounded-xl border border-slate-200 bg-slate-50 p-4">
                                    @if (filled($isi))
                                        <p class="whitespace-pre-line text-sm leading-7 text-slate-700">{{ $isi }}</p>
                                    @else
                                        <p class="text-sm italic text-slate-400">Belum ada jawaban.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-slate-100"></div>

                {{-- Pertanyaan 6 --}}
                <div>
                    <h4 class="font-semibold text-slate-800">
                        6. Apakah ada peningkatan kemampuan numerasi murid setelah penerapan Matematika GEMBIRA? Jika ada,
                        jelaskan!
                    </h4>

                    <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                        @if (filled($jawaban['6'] ?? null))
                            <p class="whitespace-pre-line text-sm leading-7 text-slate-700">{{ $jawaban['6'] }}</p>
                        @else
                            <p class="text-sm italic text-slate-400">Belum ada jawaban.</p>
                        @endif
                    </div>
                </div>

                <div class="border-t border-slate-100"></div>

                {{-- Pertanyaan 7 --}}
                <div>
                    <h4 class="font-semibold text-slate-800">
                        7. Berikan saran dan masukan untuk pelatihan Matematika GEMBIRA?
                    </h4>

                    <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                        @if (filled($jawaban['7'] ?? null))
                            <p class="whitespace-pre-line text-sm leading-7 text-slate-700">{{ $jawaban['7'] }}</p>
                        @else
                            <p class="text-sm italic text-slate-400">Belum ada jawaban.</p>
                        @endif
                    </div>
                </div>

            </div>
        </section>

        {{-- D. Catatan Tambahan --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">D. Catatan Tambahan</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi lain yang relevan dengan wawancara.</p>
            </div>

            <div class="p-6">
                <h4 class="font-semibold text-slate-800">Catatan Tambahan</h4>

                <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                    @if (filled($wawancara->catatan))
                        <p class="whitespace-pre-line text-sm leading-7 text-slate-700">{{ $wawancara->catatan }}</p>
                    @else
                        <p class="text-sm italic text-slate-400">Tidak ada catatan tambahan.</p>
                    @endif
                </div>
            </div>
        </section>

        {{-- Tindak lanjut terkait --}}
        @if ($wawancara->tindakLanjut)
            <section class="rounded-2xl border border-blue-200 bg-blue-50 p-6">
                <h2 class="font-bold text-blue-900">Tindak Lanjut Terkait</h2>
                <p class="mt-2 text-sm text-blue-800">{{ $wawancara->tindakLanjut->judul_tindak_lanjut }}</p>
                <p class="mt-1 text-sm text-blue-700">{{ $wawancara->tindakLanjut->status }}</p>
            </section>
        @endif

    </div>
@endsection