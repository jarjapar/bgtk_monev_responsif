@extends('layouts.app')

@section('title', 'Detail Wawancara TENDIK')
@section('page-title', 'Detail Wawancara TENDIK')

@section('content')
    @php
        $info = json_decode($wawancara->hasil_wawancara ?? '{}', true) ?? [];

        $pertanyaan = [
            1 => '(Reaksi) Hal apa dari substansi materi, fasilitator, maupun layanan penyelenggaraan yang menurut Anda paling bermanfaat dan berkesan? Mengapa?',
            2 => '(Belajar) Pengetahuan, keterampilan, atau sikap baru apa yang Anda kuasai setelah pelatihan (termasuk growth mindset dan profesionalisme), dan materi apa yang masih perlu diperdalam?',
            3 => '(Perilaku) Berikan contoh nyata penerapan hasil pelatihan dalam pekerjaan Anda sehari-hari.',
            4 => '(Perilaku) Kendala apa yang Anda hadapi dalam menerapkan hasil pelatihan, dan dukungan apa yang Anda perlukan?',
            5 => '(Hasil) Perubahan atau dampak apa yang terlihat di sekolah setelah pelatihan, dan apa saran Anda untuk perbaikan program berikutnya?',
        ];

        $status = $wawancara->status ?? 'Selesai';

        $tanggalPelaksanaan = $info['tanggal_pelaksanaan']
            ?? ($wawancara->tanggal_evaluasi?->format('Y-m-d')
                ?? $wawancara->tanggal_wawancara?->format('Y-m-d'));

        $tanggalPengisian = $wawancara->tanggal_wawancara?->format('d/m/Y') ?? '-';

        $jabatan = $info['jabatan_responden']
            ?? $wawancara->status_responden
            ?? $wawancara->jabatan_narasumber
            ?? '-';

        $jabatanTampil = $jabatan === 'Lainnya'
            ? ($info['jabatan_lainnya'] ?? $wawancara->jabatan_narasumber ?? 'Lainnya')
            : $jabatan;
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
                    <span>Hasil Wawancara TENDIK</span>
                </div>

                <h1 class="mt-1 text-2xl font-bold text-slate-800">Detail Wawancara TENDIK</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Hasil wawancara evaluasi pelatihan tenaga kependidikan.
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
                    Edit Data
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- A. Identitas Petugas Monev --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">A. Identitas Petugas Monev</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Identitas petugas yang melakukan monitoring dan evaluasi.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Petugas Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->nama_petugas_monev ?: $wawancara->nama_pewawancara ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Instansi Petugas</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $info['instansi_petugas'] ?? $wawancara->unit_kerja_petugas ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Lokasi Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $info['lokasi_monev'] ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Pelaksanaan</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $tanggalPelaksanaan ? \Illuminate\Support\Carbon::parse($tanggalPelaksanaan)->format('d/m/Y') : '-' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- B. Identitas Responden --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">B. Identitas Responden</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Identitas responden yang mengisi instrumen.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->nama_responden ?: $wawancara->nama_narasumber ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jabatan</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $jabatanTampil }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Satuan Pendidikan</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $info['satuan_pendidikan'] ?? $wawancara->unit_kerja_responden ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Masa Kerja (tahun)</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ isset($info['masa_kerja']) ? $info['masa_kerja'] . ' tahun' : '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Kegiatan/Pelatihan</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $info['nama_pelatihan'] ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Pengisian</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $tanggalPengisian }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status</p>
                    <p class="mt-1 font-semibold {{ $status === 'Selesai' ? 'text-emerald-700' : 'text-amber-700' }}">
                        {{ $status }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Hasil Wawancara --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">V. Hasil Wawancara</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Jawaban responden berdasarkan pengalaman setelah pelatihan.
                </p>
            </div>

            <div class="space-y-6 p-6">
                @foreach ($pertanyaan as $nomor => $teks)
                    <div>
                        <h3 class="font-semibold text-slate-800">
                            {{ $nomor }}. {{ $teks }}
                        </h3>

                        <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                            @if ($wawancara->{'jawaban_' . $nomor})
                                <p class="whitespace-pre-line break-words text-sm leading-7 text-slate-700">
                                    {{ $wawancara->{'jawaban_' . $nomor} }}
                                </p>
                            @else
                                <p class="text-sm italic text-slate-400">Belum ada jawaban.</p>
                            @endif
                        </div>
                    </div>

                    @if (!$loop->last)
                        <div class="border-t border-slate-100"></div>
                    @endif
                @endforeach
            </div>
        </section>
    </div>
@endsection