@extends('layouts.app')

@section('title', 'Detail Wawancara BK')
@section('page-title', 'Detail Wawancara BK')

@section('content')
    @php
        $informasiTambahan = json_decode($wawancara->hasil_wawancara ?? '', true);

        if (!is_array($informasiTambahan)) {
            $informasiTambahan = [];
        }

        $pertanyaanBk = [
            1 => 'Apa saja hambatan yang Anda hadapi selama mengikuti pelatihan ini?',
            2 => 'Hal baik apa saja yang harus dipertahankan dalam pelaksanaan pelatihan ini?',
            3 => 'Saran apa yang dapat Anda berikan untuk peningkatan dan keberlanjutan program ini?',
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
                    <span>Hasil Wawancara BK</span>
                </div>

                <h1 class="mt-1 text-2xl font-bold text-slate-800">
                    Detail Wawancara BK
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi pelaksanaan dan hasil wawancara Bimbingan dan Konseling.
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

        {{-- Informasi Pelaksanaan --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">Informasi Pelaksanaan</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Tanggal Wawancara</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->tanggal_wawancara
        ? \Carbon\Carbon::parse($wawancara->tanggal_wawancara)->format('d-m-Y')
        : '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Status</p>
                    <p
                        class="mt-1 font-semibold {{ ($wawancara->status ?: 'Selesai') === 'Selesai' ? 'text-emerald-700' : 'text-amber-700' }}">
                        {{ $wawancara->status ?: 'Selesai' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Lokasi Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $informasiTambahan['lokasi_monev'] ?? '-' }}
                    </p>
                </div>

                <!-- <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Kabupaten/Kota</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $informasiTambahan['kab_kota'] ?? '-' }}
                    </p>
                </div> -->
            </div>
        </section>

        {{-- Identitas Responden dan Petugas Monev --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">
                    Identitas Responden dan Petugas Monev
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Nama Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->nama_responden ?: $wawancara->nama_narasumber ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Instansi Responden</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->unit_kerja_responden ?: $wawancara->jabatan_narasumber ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Nama Petugas Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->nama_petugas_monev ?: $wawancara->nama_pewawancara ?: '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase text-slate-400">Instansi Petugas</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $wawancara->unit_kerja_petugas ?: $informasiTambahan['instansi_petugas'] ?? '-' }}
                    </p>
                </div>
            </div>
        </section>

        {{-- Hasil Wawancara --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="font-bold text-slate-800">Hasil Wawancara</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Informasi tambahan responden dan jawaban wawancara.
                </p>
            </div>

            <div class="space-y-6 p-6">
                {{-- Informasi Tambahan --}}
                <div>
                    <h3 class="mb-4 font-semibold text-slate-800">
                        A. Informasi Tambahan Responden
                    </h3>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <p class="text-xs font-semibold uppercase text-slate-400">Jabatan</p>
                            <p class="mt-1 font-semibold text-slate-800">
                                {{ $informasiTambahan['jabatan'] ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase text-slate-400">Satuan Pendidikan</p>
                            <p class="mt-1 font-semibold text-slate-800">
                                {{ $informasiTambahan['satuan_pendidikan'] ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase text-slate-400">Masa Kerja</p>
                            <p class="mt-1 font-semibold text-slate-800">
                                @if (isset($informasiTambahan['masa_kerja']) && $informasiTambahan['masa_kerja'] !== '')
                                    {{ $informasiTambahan['masa_kerja'] }} tahun
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase text-slate-400">Nama Kegiatan</p>
                            <p class="mt-1 font-semibold text-slate-800">
                                {{ $informasiTambahan['nama_kegiatan'] ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase text-slate-400">Tanggal Pengisian</p>
                            <p class="mt-1 font-semibold text-slate-800">
                                @if (!empty($informasiTambahan['tanggal_pengisian']))
                                    {{ \Carbon\Carbon::parse($informasiTambahan['tanggal_pengisian'])->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase text-slate-400">Instansi Petugas</p>
                            <p class="mt-1 font-semibold text-slate-800">
                                {{ $informasiTambahan['instansi_petugas'] ?? $wawancara->unit_kerja_petugas ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100"></div>

                {{-- Jawaban Wawancara --}}
                <div>
                    <h3 class="mb-4 font-semibold text-slate-800">
                        B. Jawaban Wawancara
                    </h3>

                    <div class="space-y-6">
                        @foreach ($pertanyaanBk as $nomor => $pertanyaan)
                            <div>
                                <h4 class="font-semibold text-slate-800">
                                    {{ $nomor }}. {{ $pertanyaan }}
                                </h4>

                                <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-4">
                                    @if ($wawancara->{'jawaban_' . $nomor})
                                        <p class="whitespace-pre-line text-sm leading-7 text-slate-700">
                                            {{ $wawancara->{'jawaban_' . $nomor} }}</p>
                                    @else
                                        <p class="text-sm italic text-slate-400">
                                            Belum ada jawaban.
                                        </p>
                                    @endif
                                </div>
                            </div>

                            @if (!$loop->last)
                                <div class="border-t border-slate-100"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection