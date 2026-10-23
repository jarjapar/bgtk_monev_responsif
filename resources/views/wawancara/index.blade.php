@extends('layouts.app')

@section('title', 'Lembar Wawancara')
@section('page-title', 'Lembar Wawancara')

@section('content')
    @php
        $kartu = [
            [
                'kode' => 'BCKS',
                'no' => '01',
                'solid' => '#1457f5',
                'soft' => '#eef4ff',
                'border' => '#dbe7ff',
                'text' => '#1d4ed8',
                'aktif' => true,
            ],
            [
                'kode' => 'BK',
                'no' => '02',
                'solid' => '#8b1cf5',
                'soft' => '#f6efff',
                'border' => '#e8d5ff',
                'text' => '#7e22ce',
                'aktif' => false,
            ],
            [
                'kode' => 'TENDIK',
                'no' => '03',
                'solid' => '#059669',
                'soft' => '#ecfdf5',
                'border' => '#c7f0dc',
                'text' => '#047857',
                'aktif' => false,
            ],
            [
                'kode' => 'GEMBIRA',
                'no' => '04',
                'solid' => '#d97706',
                'soft' => '#fffbeb',
                'border' => '#fde68a',
                'text' => '#b45309',
                'aktif' => true,
            ],
        ];

        $routeGembiraSiap = \Illuminate\Support\Facades\Route::has('wawancara.gembira.create');
    @endphp

    <div class="w-full space-y-6 pb-8">

        {{-- HEADER --}}
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Lembar Wawancara
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Kelola lembar wawancara monitoring dan evaluasi.
            </p>
        </div>

        {{-- NOTIFIKASI --}}
        @foreach (['success' => 'emerald', 'info' => 'blue'] as $jenisPesan => $warna)
            @if (session($jenisPesan))
                <div id="alert-{{ $jenisPesan }}" role="alert"
                    class="flex items-center justify-between gap-4 rounded-xl border px-4 py-3 text-sm transition-all duration-300"
                    style="
                                                                                                                        border-color: {{ $warna === 'emerald' ? '#a7f3d0' : '#bfdbfe' }};
                                                                                                                        background: {{ $warna === 'emerald' ? '#ecfdf5' : '#eff6ff' }};
                                                                                                                        color: {{ $warna === 'emerald' ? '#047857' : '#1d4ed8' }};
                                                                                                                    ">
                    <div class="flex items-center gap-2">
                        @if ($jenisPesan === 'success')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01" />
                            </svg>
                        @endif

                        <span>{{ session($jenisPesan) }}</span>
                    </div>

                    <button type="button" onclick="tutupNotifikasi('alert-{{ $jenisPesan }}')"
                        class="shrink-0 text-xl font-semibold opacity-70 hover:opacity-100" aria-label="Tutup notifikasi">
                        &times;
                    </button>
                </div>
            @endif
        @endforeach

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- PILIHAN JENIS WAWANCARA --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($kartu as $k)
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                    <div style="height: 5px; background: {{ $k['solid'] }}"></div>

                    <div class="p-5">
                        <span class="inline-flex rounded-full border px-3 py-1 text-xs font-semibold" style="
                                                                                                background: {{ $k['soft'] }};
                                                                                                border-color: {{ $k['border'] }};
                                                                                                color: {{ $k['text'] }};
                                                                                            ">
                            Instrumen {{ $k['no'] }}
                        </span>

                        <h2 class="mt-4 text-lg font-bold text-slate-900">
                            @if ($k['kode'] === 'GEMBIRA')
                                Wawancara  GEMBIRA
                            @else
                                Wawancara {{ $k['kode'] }}
                            @endif
                        </h2>

                        <p class="mt-2 min-h-10 text-sm leading-6 text-slate-500">
                            @if ($k['kode'] === 'BCKS')
                                Form wawancara BCKS
                            @elseif ($k['kode'] === 'BK')
                                Form wawancara BK
                            @elseif ($k['kode'] === 'TENDIK')
                                Form wawancara TENDIK
                            @else
                                Form wawancara Matematika GEMBIRA
                            @endif
                        </p>
<div class="mt-5">
    @php
        $routeTombol = match ($k['kode']) {
            'BCKS' => 'wawancara.bcks.create',
            'BK' => 'wawancara.bk.create',
            'TENDIK' => 'wawancara.tendik.create',
            'GEMBIRA' => 'wawancara.gembira.create',
        };

        $labelTombol = match ($k['kode']) {
            'BCKS' => '+ Isi Wawancara BCKS',
            'BK' => '+ Isi Wawancara BK',
            'TENDIK' => '+ Isi Wawancara TENDIK',
            'GEMBIRA' => '+ Isi Wawancara GEMBIRA',
        };
    @endphp

    <a href="{{ route($routeTombol) }}"
       class="inline-flex w-full items-center justify-center rounded-xl px-4 text-sm font-semibold text-white transition hover:opacity-90"
       style="height: 44px; background: {{ $k['solid'] }};">
        {{ $labelTombol }}
    </a>
</div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- FILTER DAN PENCARIAN --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <form action="{{ route('wawancara.index') }}" method="GET">
                <div class="grid grid-cols-1 items-end gap-4 md:grid-cols-2 xl:grid-cols-4">

                    <div>
                        <label for="jenis_instrumen" class="mb-2 block text-sm font-medium text-slate-700">
                            Jenis Wawancara
                        </label>
                        <select id="jenis_instrumen" name="jenis_instrumen"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            style="height: 44px">
                            <option value="">Semua jenis</option>
                            <option value="BCKS" @selected(request('jenis_instrumen') === 'BCKS')>Wawancara BCKS</option>
                            <option value="BK" @selected(request('jenis_instrumen') === 'BK')>Wawancara BK</option>
                            <option value="TENDIK" @selected(request('jenis_instrumen') === 'TENDIK')>Wawancara TENDIK
                            </option>
                            <option value="GEMBIRA" @selected(request('jenis_instrumen') === 'GEMBIRA')>Wawancara Matematika
                                GEMBIRA</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-sm font-medium text-slate-700">
                            Status
                        </label>
                        <select id="status" name="status"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            style="height: 44px">
                            <option value="">Semua status</option>
                            <option value="Belum Dilaksanakan" @selected(request('status') === 'Belum Dilaksanakan')>Belum
                                Dilaksanakan</option>
                            <option value="Selesai" @selected(request('status') === 'Selesai')>Selesai</option>
                        </select>
                    </div>

                    <div>
                        <label for="search" class="mb-2 block text-sm font-medium text-slate-700">
                            Pencarian
                        </label>
                        <input id="search" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nama, responden, atau sekolah"
                            class="w-full rounded-xl border border-slate-200 px-3 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            style="height: 44px">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="inline-flex flex-1 items-center justify-center rounded-xl px-5 text-sm font-semibold text-white transition hover:opacity-90"
                            style="height: 44px; background: #1457f5">
                            Cari
                        </button>
                        <a href="{{ route('wawancara.index') }}"
                            class="inline-flex flex-1 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-600 transition hover:bg-slate-50"
                            style="height: 44px">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>

        {{-- RIWAYAT WAWANCARA --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Riwayat Wawancara</h2>
                <p class="mt-1 text-sm text-slate-500">
                    Daftar wawancara monitoring dan evaluasi yang telah diisi.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left" style="min-width: 1000px">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr class="text-xs font-bold uppercase tracking-wide text-slate-500">
                            <th class="px-6 py-4">Jenis Wawancara</th>
                            <th class="px-6 py-4">BCKS / Narasumber</th>
                            <th class="px-6 py-4">Responden</th>
                            <th class="px-6 py-4">Tanggal Evaluasi</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($wawancaras as $wawancara)
                            @php
                                $jenisData = strtoupper(trim($wawancara->jenis_wawancara ?? ''));
                                $namaInstrumen = strtoupper($wawancara->instrumen->nama_instrumen ?? '');

                                if ($jenisData === 'BCKS' || str_contains($namaInstrumen, 'BCKS')) {
                                    $labelJenis = 'Wawancara BCKS';
                                    $kodeJenis = 'BCKS';
                                } elseif ($jenisData === 'BK') {
                                    $labelJenis = 'Wawancara BK';
                                    $kodeJenis = 'BK';
                                } elseif ($jenisData === 'TENDIK') {
                                    $labelJenis = 'Wawancara TENDIK';
                                    $kodeJenis = 'TENDIK';
                                } elseif ($jenisData === 'GEMBIRA') {
                                    $labelJenis = 'Wawancara Matematika GEMBIRA';
                                    $kodeJenis = 'GEMBIRA';
                                } else {
                                    $labelJenis = $wawancara->instrumen->nama_instrumen ?? 'Wawancara Lama';
                                    $kodeJenis = 'LAMA';
                                }

                                $warnaLatarJenis = match ($kodeJenis) {
                                    'BCKS' => '#eef4ff',
                                    'BK' => '#f6efff',
                                    'TENDIK' => '#ecfdf5',
                                    'GEMBIRA' => '#fffbeb',
                                    default => '#f1f5f9',
                                };

                                $warnaTeksJenis = match ($kodeJenis) {
                                    'BCKS' => '#1d4ed8',
                                    'BK' => '#7e22ce',
                                    'TENDIK' => '#047857',
                                    'GEMBIRA' => '#b45309',
                                    default => '#475569',
                                };

                                // Kolom BCKS / Narasumber: nama responden di baris atas,
                                // status/jabatan responden di baris bawah.
                                $namaBcks = $wawancara->nama_responden
                                    ?: $wawancara->nama_narasumber
                                    ?: '-';

                                $unitBcks = $wawancara->status_responden
                                    ?: $wawancara->jabatan_narasumber
                                    ?: '-';

                                $namaResponden = $wawancara->nama_responden
                                    ?: $wawancara->nama_narasumber
                                    ?: '-';

                                $unitResponden = $wawancara->unit_kerja_responden
                                    ?: $wawancara->jabatan_narasumber;

                                $tanggal = $wawancara->tanggal_evaluasi
                                    ?: $wawancara->tanggal_wawancara;

                                $statusWawancara = $wawancara->status ?: 'Belum Dilaksanakan';
                                $isSelesai = $statusWawancara === 'Selesai';
                            @endphp

                            <tr class="transition hover:bg-slate-50">

                                {{-- JENIS --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl"
                                            style="background: #f3f0ff; color: #7c3aed">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M8 3h8l4 4v14H4V3z" />
                                                <path d="M8 3v5h8V3" />
                                                <path d="M8 13h8M8 17h5" />
                                            </svg>
                                        </div>

                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">
                                                {{ $labelJenis }}
                                            </p>
                                            <span class="mt-1 inline-flex rounded-full px-2.5 py-1 text-xs font-medium"
                                                style="background: {{ $warnaLatarJenis }}; color: {{ $warnaTeksJenis }};">
                                                {{ $kodeJenis }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                {{-- BCKS / NARASUMBER --}}
                                <td class="px-6 py-5">
                                    <p class="text-sm font-semibold text-slate-900">{{ $namaBcks }}</p>
                                    @if ($unitBcks !== '-')
                                        <p class="mt-1 text-xs text-slate-500">{{ $unitBcks }}</p>
                                    @endif
                                </td>

                                {{-- RESPONDEN --}}
                                <td class="px-6 py-5">
                                    <p class="text-sm font-semibold text-slate-900">{{ $namaResponden }}</p>
                                    @if ($unitResponden)
                                        <p class="mt-1 text-xs text-slate-500">{{ $unitResponden }}</p>
                                    @endif
                                </td>

                                {{-- TANGGAL --}}
                                <td class="whitespace-nowrap px-6 py-5 text-sm text-slate-700">
                                    {{ $tanggal ? \Illuminate\Support\Carbon::parse($tanggal)->format('d/m/Y') : '-' }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center gap-2 whitespace-nowrap rounded-full px-3 py-1.5 text-xs font-semibold"
                                        style="
                                                                                                            background: {{ $isSelesai ? '#d1fae5' : '#fef3c7' }};
                                                                                                            color: {{ $isSelesai ? '#047857' : '#b45309' }};
                                                                                                        ">
                                        <span class="h-1.5 w-1.5 rounded-full" style="background: currentColor"></span>
                                        {{ $statusWawancara }}
                                    </span>
                                </td>


                                {{-- AKSI --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-5">

                                        {{-- DETAIL: IKON MATA --}}
                                        <a href="{{ route('wawancara.show', $wawancara->id) }}" title="Lihat detail"
                                            aria-label="Lihat detail" class="text-slate-500 transition hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>

                                        {{-- EDIT: IKON PENSIL --}}
                                        <a href="{{ route('wawancara.edit', $wawancara->id) }}" title="Edit data"
                                            aria-label="Edit data" class="text-slate-600 transition hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z" />
                                            </svg>
                                        </a>

                                        {{-- HAPUS: IKON TEMPAT SAMPAH --}}
                                        <form action="{{ route('wawancara.destroy', $wawancara->id) }}" method="POST"
                                            class="inline-flex"
                                            onsubmit="return confirm('Yakin ingin menghapus data wawancara ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="Hapus data" aria-label="Hapus data"
                                                class="text-red-500 transition hover:text-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4h8v2" />
                                                    <path d="m19 6-1 14H6L5 6" />
                                                    <path d="M10 11v5M14 11v5" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-2xl">
                                            📋
                                        </div>

                                        <h3 class="mt-4 text-base font-bold text-slate-800">
                                            Belum Ada Data Wawancara
                                        </h3>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Belum ada wawancara yang telah diisi.
                                        </p>

                                    </div>

                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if ($wawancaras->hasPages())
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $wawancaras->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- JAVASCRIPT NOTIFIKASI DAN IKON --}}
    <script>
        function tutupNotifikasi(id) {
            const elemen = document.getElementById(id);

            if (!elemen) return;

            elemen.style.opacity = '0';
            elemen.style.transform = 'translateY(-6px)';

            setTimeout(() => {
                elemen.remove();
            }, 350);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Hilangkan notifikasi setelah 3 detik.
            ['success', 'info'].forEach(function (jenis) {
                const elemen = document.getElementById('alert-' + jenis);

                if (elemen) {
                    setTimeout(function () {
                        tutupNotifikasi('alert-' + jenis);
                    }, 3000);
                }
            });

            // Tampilkan ikon Lucide apabila library tersedia.
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
@endsection