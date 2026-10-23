@extends('layouts.app')

@section('title', 'Detail Wawancara BCKS')
@section('page-title', 'Detail Wawancara BCKS')

@section('content')
    @php
        $tanggal = $wawancara->tanggal_evaluasi ?: $wawancara->tanggal_wawancara;

        // Label tampilan status responden (disamakan dengan label pada form create)
        $labelStatusResponden = [
            'BCKS' => 'BCKS',
            'Atasan Langsung / Pengawas Sekolah' => 'Atasan Langsung / Kepala Sekolah',
            'Perwakilan Guru / Tenaga Kependidikan' => 'Guru / Tenaga Kependidikan',
        ];
        $statusResponden = $wawancara->status_responden ?: $wawancara->jabatan_narasumber;
        $statusRespondenLabel = $labelStatusResponden[$statusResponden] ?? $statusResponden;

        $pertanyaanEsai = [
            1 => ['judul' => 'Dampak Implementasi RPTKS', 'isi' => 'Dari seluruh RPTKS (Rancangan Projek Integratif dan Transformatif Kepala Sekolah) yang Anda susun setelah pelatihan, apakah berdampak setelah diimplementasikan di sekolah? Apa kunci keberhasilannya?'],
            2 => ['judul' => 'Kendala dan Strategi Mitigasi', 'isi' => 'Kendala (sistem, anggaran, maupun resistensi SDM) apa yang Anda hadapi saat menerapkan Rancangan Projek tersebut? Bagaimana Anda mengatasinya?'],
            3 => ['judul' => 'Perubahan Kepemimpinan dan Pengambilan Keputusan', 'isi' => 'Bagaimana Anda merasakan perubahan pada cara Anda mengambil keputusan strategis dan mengelola konflik di sekolah setelah mengikuti pelatihan BCKS?'],
            4 => ['judul' => 'Dukungan Lingkungan Sekolah', 'isi' => 'Sejauh mana dukungan dari Kepala Sekolah (saat ini), rekan guru, dan pengawas sekolah membantu Anda mengeksekusi ide-ide baru di sekolah?'],
            5 => ['judul' => 'Keberlanjutan Program Inovasi', 'isi' => 'Bagaimana cara Anda memastikan program inovasi yang telah dimulai tetap berjalan berkelanjutan meskipun terjadi pergantian kepemimpinan atau personil?'],
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
                    <span>Hasil Wawancara BCKS</span>
                </div>

                <h1 class="mt-1 text-2xl font-bold text-slate-800">
                    Detail Wawancara BCKS
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi pelaksanaan dan hasil wawancara BCKS.
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
                <a href="{{ route('wawancara.cetak-bcks', $wawancara->id) }}"
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

        {{-- A. Identitas Peserta BCKS --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">A. Identitas Peserta BCKS</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi mengenai peserta wawancara BCKS.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Peserta BCKS</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->nama_bcks ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Unit Kerja</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->unit_kerja_bcks ?: '-' }}</p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Angkatan Pelatihan BCKS</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->angkatan_pelatihan_bcks ?: '-' }}</p>
                </div>
            </div>
        </section>

        {{-- B. Identitas Responden --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi pihak yang memberikan jawaban wawancara.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->nama_responden ?: $wawancara->nama_narasumber ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Unit Kerja Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->unit_kerja_responden ?: '-' }}</p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $statusRespondenLabel ?: '-' }}</p>
                </div>
            </div>
        </section>

        {{-- C. Identitas Petugas Monev --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">C. Identitas Petugas Monev</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi petugas pelaksana monitoring dan evaluasi.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Petugas Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->nama_petugas_monev ?: $wawancara->nama_pewawancara ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Unit Kerja Petugas</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->unit_kerja_petugas ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Evaluasi</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->format('d-m-Y') : '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status</p>
                    <p
                        class="mt-1 font-semibold {{ ($wawancara->status ?: 'Selesai') === 'Selesai' ? 'text-emerald-700' : 'text-amber-700' }}">
                        {{ $wawancara->status ?: 'Selesai' }}
                    </p>
                </div>
            </div>
        </section>

        {{-- D. Hasil Wawancara BCKS --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">D. Hasil Wawancara BCKS</h2>
                <p class="mt-1 text-sm text-slate-500">Jawaban wawancara dengan responden.</p>
            </div>

            <div class="space-y-6 p-6">
                @foreach ($pertanyaanEsai as $nomor => $item)
                    <div>
                        <h4 class="font-semibold text-slate-800">
                            {{ $nomor }}. {{ $item['judul'] }}
                        </h4>
                        <p class="mt-1 text-sm leading-6 text-slate-500">{{ $item['isi'] }}</p>

                        <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                            @if ($wawancara->{'jawaban_' . $nomor})
                                <p class="whitespace-pre-line text-sm leading-7 text-slate-700">
                                    {{ $wawancara->{'jawaban_' . $nomor} }}</p>
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

        {{-- E. Catatan Tambahan --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">E. Catatan Tambahan</h2>
                <p class="mt-1 text-sm text-slate-500">Ringkasan dan informasi lain yang relevan dengan wawancara.</p>
            </div>

            <div class="space-y-6 p-6">
                <div>
                    <h4 class="font-semibold text-slate-800">Ringkasan Hasil Wawancara</h4>
                    <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                        @if ($wawancara->hasil_wawancara)
                            <p class="whitespace-pre-line text-sm leading-7 text-slate-700">
                                {{ $wawancara->hasil_wawancara }}</p>
                        @else
                            <p class="text-sm italic text-slate-400">Belum ada ringkasan hasil wawancara.</p>
                        @endif
                    </div>
                </div>

                <div class="border-t border-slate-100"></div>

                <div>
                    <h4 class="font-semibold text-slate-800">Catatan Pewawancara</h4>
                    <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                        @if ($wawancara->catatan)
                            <p class="whitespace-pre-line text-sm leading-7 text-slate-700">
                                {{ $wawancara->catatan }}</p>
                        @else
                            <p class="text-sm italic text-slate-400">Tidak ada catatan tambahan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if ($wawancara->tindakLanjut)
            <section class="rounded-2xl border border-blue-200 bg-blue-50 p-6">
                <h2 class="font-bold text-blue-900">Tindak Lanjut Terkait</h2>
                <p class="mt-2 text-sm text-blue-800">{{ $wawancara->tindakLanjut->judul_tindak_lanjut }}</p>
                <p class="mt-1 text-sm text-blue-700">{{ $wawancara->tindakLanjut->status }}</p>
            </section>
        @endif
    </div>
@endsection