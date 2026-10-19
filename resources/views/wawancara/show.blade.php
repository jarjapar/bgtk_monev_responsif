@extends('layouts.app')

@section('title', 'Detail Wawancara')
@section('page-title', 'Detail Wawancara')

@section('content')
    @php
        $tanggal = $wawancara->tanggal_evaluasi ?: $wawancara->tanggal_wawancara;

        $pertanyaanEsai = [
            1 => ['judul' => 'Dampak Implementasi RPTKS', 'isi' => 'Dari seluruh RPTKS (Rancangan Projek Integratif dan Transformatif Kepala Sekolah) yang Anda susun setelah pelatihan, apakah berdampak setelah diimplementasikan di sekolah? Apa kunci keberhasilannya?'],
            2 => ['judul' => 'Kendala dan Strategi Mitigasi', 'isi' => 'Kendala (sistem, anggaran, maupun resistensi SDM) apa yang Anda hadapi saat menerapkan Rancangan Projek tersebut? Bagaimana Anda mengatasinya?'],
            3 => ['judul' => 'Perubahan Kepemimpinan dan Pengambilan Keputusan', 'isi' => 'Bagaimana Anda merasakan perubahan pada cara Anda mengambil keputusan strategis dan mengelola konflik di sekolah setelah mengikuti pelatihan BCKS?'],
            4 => ['judul' => 'Dukungan Lingkungan Sekolah', 'isi' => 'Sejauh mana dukungan dari Kepala Sekolah (saat ini), rekan guru, dan pengawas sekolah membantu Anda mengeksekusi ide-ide baru di sekolah?'],
            5 => ['judul' => 'Keberlanjutan Program Inovasi', 'isi' => 'Bagaimana cara Anda memastikan program inovasi yang telah dimulai tetap berjalan berkelanjutan meskipun terjadi pergantian kepemimpinan atau personil?'],
        ];
    @endphp

    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">        
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('wawancara.index') }}" class="transition hover:text-blue-600">
                        Lembara Wawancara
                    </a>
                    <span>/</span>
                    <span>Hasil Wawancara BCKS</span>
                </div>
                <h1 class="mt-1 text-2xl font-bold text-slate-800">Detail Wawancara</h1>
                <p class="mt-1 text-sm text-slate-500">Informasi pelaksanaan dan hasil wawancara.</p>
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

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}</div>
        @endif

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">Informasi Pelaksanaan</h2>
            </div>
            <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Jenis Wawancara</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->jenis_wawancara ?: 'Data lama' }}</p>
                </div>
                <!-- <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Instrumen</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->instrumen->nama_instrumen ?? '-' }}</p>
                    <p class="mt-1 text-sm text-slate-500">{{ $wawancara->instrumen->kode_instrumen ?? '' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Sekolah</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->sekolah->nama_sekolah ?? '-' }}</p>
                    <p class="mt-1 text-sm text-slate-500">NPSN: {{ $wawancara->sekolah->npsn ?? '-' }}</p>
                </div> -->
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Tanggal Evaluasi / Wawancara</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $tanggal ? \Illuminate\Support\Carbon::parse($tanggal)->format('d F Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Status</p>
                    <p
                        class="mt-1 font-semibold {{ $wawancara->status === 'Selesai' ? 'text-emerald-700' : 'text-amber-700' }}">
                        {{ $wawancara->status ?: 'Belum Dilaksanakan' }}</p>
                </div>
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">Identitas BCKS</h2>
            </div>
            <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Nama BCKS</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->nama_bcks ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Unit Kerja BCKS</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->unit_kerja_bcks ?: '-' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold uppercase text-slate-400">Angkatan Pelatihan</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->angkatan_pelatihan_bcks ?: '-' }}</p>
                </div>
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">Identitas Responden dan Petugas Monev</h2>
            </div>
            <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Nama Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->nama_responden ?: $wawancara->nama_narasumber ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Status / Jabatan Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->status_responden ?: $wawancara->jabatan_narasumber ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Unit Kerja Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->unit_kerja_responden ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Nama Petugas Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->nama_petugas_monev ?: $wawancara->nama_pewawancara ?: '-' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold uppercase text-slate-400">Unit Kerja Petugas</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $wawancara->unit_kerja_petugas ?: '-' }}</p>
                </div>
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">Hasil Wawancara</h2>
                <p class="mt-1 text-sm text-slate-500">Lima pertanyaan dan jawaban responden.</p>
            </div>
            <div class="space-y-6 p-6">
                @foreach ($pertanyaanEsai as $nomor => $item)
                    <div>
                        <h3 class="font-semibold text-slate-800">{{ $nomor }}. {{ $item['judul'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $item['isi'] }}</p>
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

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">Ringkasan Hasil Wawancara</h2>
            </div>
            <div class="p-6">
                <p class="whitespace-pre-line text-sm leading-7 text-slate-700">
                    {{ $wawancara->hasil_wawancara ?: 'Belum ada ringkasan hasil wawancara.' }}</p>
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">Catatan Pewawancara</h2>
            </div>
            <div class="p-6">
                <p class="whitespace-pre-line text-sm leading-7 text-slate-700">
                    {{ $wawancara->catatan ?: 'Tidak ada catatan tambahan.' }}</p>
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