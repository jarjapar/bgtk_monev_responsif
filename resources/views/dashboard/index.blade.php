@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    <div class="space-y-6">

        {{-- =========================
        HEADER
        ========================== --}}
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Dashboard Monev
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Ringkasan monitoring dan evaluasi BGTK Provinsi NTB.
            </p>
        </div>


        {{-- =========================
        SUMMARY CARDS
        ========================== --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Total Sekolah --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Sekolah
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $totalSekolah }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ $sekolahSudahDimonitor }} sudah dimonitor
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01" />
                        </svg>
                    </div>

                </div>
            </div>


            {{-- Total Instrumen --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Instrumen
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $totalInstrumen }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ $instrumenAktif }} instrumen aktif
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                        </svg>
                    </div>

                </div>
            </div>


            {{-- Total Wawancara --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Wawancara
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $totalWawancara }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ $wawancaraSelesai }} sudah selesai
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 10h8M8 14h5M6 20l-3 1 1-3a8 8 0 111.5 1.5L6 20z" />
                        </svg>
                    </div>

                </div>
            </div>


            {{-- Total Tindak Lanjut --}}
            <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Tindak Lanjut
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-800">
                            {{ $totalTindakLanjut }}
                        </p>

                        <p class="mt-2 text-xs text-slate-500">
                            {{ $tindakLanjutSelesai }} sudah selesai
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                </div>
            </div>

        </div>


        {{-- =========================
        CHART UTAMA
        ========================== --}}
        {{-- =========================
        CHART STATUS
        ========================== --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Rata-rata Capaian --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Rata-rata Capaian
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Persentase rata-rata capaian seluruh instrumen.
                    </p>
                </div>

                <div class="relative mx-auto h-64 w-full max-w-xs">
                    <canvas id="capaianChart"></canvas>

                    <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold text-blue-600">
                            {{ number_format($rataCapaian, 2) }}%
                        </span>

                        <span class="mt-1 text-xs text-slate-500">
                            Capaian
                        </span>
                    </div>
                </div>

            </div>


            {{-- Monitoring Sekolah --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Status Monitoring
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Status monitoring sekolah.
                    </p>
                </div>

                <div class="relative mx-auto h-64 w-full max-w-xs">
                    <canvas id="monitoringChart"></canvas>

                    @php
                        $persenMonitoring = $totalSekolah > 0
                            ? ($sekolahSudahDimonitor / $totalSekolah) * 100
                            : 0;
                    @endphp

                    <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold text-emerald-600">
                            {{ number_format($persenMonitoring, 0) }}%
                        </span>

                        <span class="mt-1 text-xs text-slate-500">
                            Sudah Dimonitor
                        </span>
                    </div>
                </div>

            </div>


            {{-- Status Wawancara --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Status Wawancara
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Status pelaksanaan wawancara.
                    </p>
                </div>

                <div class="relative mx-auto h-64 w-full max-w-xs">
                    <canvas id="wawancaraChart"></canvas>

                    @php
                        $persenWawancara = $totalWawancara > 0
                            ? ($wawancaraSelesai / $totalWawancara) * 100
                            : 0;
                    @endphp

                    <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold text-emerald-600">
                            {{ number_format($persenWawancara, 0) }}%
                        </span>

                        <span class="mt-1 text-xs text-slate-500">
                            Selesai
                        </span>
                    </div>
                </div>

            </div>

        </div>


        {{-- =========================
        CHART TINDAK LANJUT
        ========================== --}}
        <div class="mt-6">

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Status Tindak Lanjut
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ringkasan progres tindak lanjut hasil monitoring.
                    </p>
                </div>
                <div class="h-72">
                    <canvas id="tindakLanjutChart"></canvas>
                </div>
            </div>
        </div>

        {{-- =========================
        CHART WAWANCARA & TINDAK LANJUT
        ========================== --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Status Wawancara --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Status Wawancara
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Perbandingan wawancara yang selesai dan belum dilaksanakan.
                    </p>
                </div>

                <div class="relative mx-auto h-64 w-full max-w-xs">
                    <canvas id="wawancaraChart"></canvas>

                    @php
                        $persenWawancara = $totalWawancara > 0
                            ? ($wawancaraSelesai / $totalWawancara) * 100
                            : 0;
                    @endphp

                    <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-bold text-emerald-600">
                            {{ number_format($persenWawancara, 0) }}%
                        </span>

                        <span class="mt-1 text-xs text-slate-500">
                            Selesai
                        </span>
                    </div>
                </div>

            </div>


            {{-- Status Tindak Lanjut --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">

                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Status Tindak Lanjut
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ringkasan progres tindak lanjut hasil monitoring.
                    </p>
                </div>

                <div class="h-64">
                    <canvas id="tindakLanjutChart"></canvas>
                </div>

            </div>

        </div>


        {{-- =========================
        DATA TERBARU
        ========================== --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

            {{-- Instrumen Terbaru --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Instrumen Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Lima instrumen terakhir yang ditambahkan.
                    </p>
                </div>

                @if ($instrumenTerbaru->count() > 0)

                    <div class="divide-y divide-slate-100">

                        @foreach ($instrumenTerbaru as $instrumen)

                            <a href="{{ route('instrumen.show', $instrumen) }}"
                                class="block px-6 py-4 transition hover:bg-slate-50">

                                <div class="flex items-center justify-between gap-4">

                                    <div class="min-w-0">

                                        <p class="truncate font-semibold text-slate-800">
                                            {{ $instrumen->nama_instrumen }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $instrumen->kode_instrumen }}
                                            ·
                                            {{ $instrumen->jenis_instrumen }}
                                        </p>

                                    </div>

                                    <div class="shrink-0 text-right">

                                        <p class="text-sm font-bold text-blue-600">
                                            {{ number_format((float) $instrumen->capaian, 2) }}%
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ $instrumen->status }}
                                        </p>

                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-10 text-center">
                        <p class="text-sm font-medium text-slate-600">
                            Belum ada data instrumen.
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Data instrumen akan muncul di sini setelah ditambahkan.
                        </p>
                    </div>

                @endif

            </div>


            {{-- Tindak Lanjut Terbaru --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">

                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold text-slate-800">
                        Tindak Lanjut Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Lima tindak lanjut terakhir yang ditambahkan.
                    </p>
                </div>

                @if ($tindakLanjutTerbaru->count() > 0)

                    <div class="divide-y divide-slate-100">

                        @foreach ($tindakLanjutTerbaru as $tindakLanjut)

                            <a href="{{ route('tindak-lanjut.show', $tindakLanjut) }}"
                                class="block px-6 py-4 transition hover:bg-slate-50">

                                <div class="flex items-center justify-between gap-4">

                                    <div class="min-w-0">

                                        <p class="truncate font-semibold text-slate-800">
                                            {{ $tindakLanjut->judul_tindak_lanjut }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-slate-500">
                                            {{ $tindakLanjut->sekolah?->nama_sekolah ?? 'Sekolah tidak tersedia' }}
                                        </p>

                                    </div>

                                    <div class="shrink-0">

                                        @if ($tindakLanjut->status === 'Selesai')

                                            <span
                                                class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                Selesai
                                            </span>

                                        @elseif ($tindakLanjut->status === 'Dalam Proses')

                                            <span
                                                class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                Dalam Proses
                                            </span>

                                        @else

                                            <span
                                                class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                                Belum Dimulai
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>

                @else

                    <div class="px-6 py-10 text-center">
                        <p class="text-sm font-medium text-slate-600">
                            Belum ada data tindak lanjut.
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Data tindak lanjut akan muncul di sini setelah ditambahkan.
                        </p>
                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================
    CHART.JS
    ========================== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | DATA DARI DATABASE
            |--------------------------------------------------------------------------
            */

            const rataCapaian = {{ min(max((float) $rataCapaian, 0), 100) }};

            const sekolahSudahDimonitor = {{ $sekolahSudahDimonitor }};
            const sekolahBelumDimonitor = {{ $sekolahBelumDimonitor }};

            const wawancaraSelesai = {{ $wawancaraSelesai }};
            const wawancaraBelum = {{ $wawancaraBelum }};

            const tindakLanjutBelum = {{ $tindakLanjutBelum }};
            const tindakLanjutDalamProses = {{ $tindakLanjutDalamProses }};
            const tindakLanjutSelesai = {{ $tindakLanjutSelesai }};


            /*
            |--------------------------------------------------------------------------
            | KONFIGURASI UMUM DOUGHNUT
            |--------------------------------------------------------------------------
            */

            const doughnutOptions = {
                responsive: true,
                maintainAspectRatio: false,

                cutout: '72%',

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,

                            font: {
                                size: 12
                            }
                        }
                    },

                    tooltip: {
                        padding: 10,

                        bodyFont: {
                            size: 12
                        },

                        titleFont: {
                            size: 12
                        }
                    }
                }
            };


            /*
            |--------------------------------------------------------------------------
            | RATA-RATA CAPAIAN
            |--------------------------------------------------------------------------
            */

            const capaianCanvas = document.getElementById('capaianChart');

            if (capaianCanvas) {

                new Chart(capaianCanvas, {

                    type: 'doughnut',

                    data: {
                        labels: [
                            'Capaian',
                            'Belum Tercapai'
                        ],

                        datasets: [{
                            data: [
                                rataCapaian,
                                100 - rataCapaian
                            ],

                            backgroundColor: [
                                '#2563eb',
                                '#e2e8f0'
                            ],

                            borderWidth: 0,

                            hoverOffset: 4
                        }]
                    },

                    options: doughnutOptions

                });
            }


            /*
            |--------------------------------------------------------------------------
            | MONITORING SEKOLAH
            |--------------------------------------------------------------------------
            */

            const monitoringCanvas = document.getElementById('monitoringChart');

            if (monitoringCanvas) {

                new Chart(monitoringCanvas, {

                    type: 'doughnut',

                    data: {
                        labels: [
                            'Sudah Dimonitor',
                            'Belum Dimonitor'
                        ],

                        datasets: [{
                            data: [
                                sekolahSudahDimonitor,
                                sekolahBelumDimonitor
                            ],

                            backgroundColor: [
                                '#10b981',
                                '#f59e0b'
                            ],

                            borderWidth: 0,

                            hoverOffset: 4
                        }]
                    },

                    options: doughnutOptions

                });
            }


            /*
            |--------------------------------------------------------------------------
            | STATUS WAWANCARA
            |--------------------------------------------------------------------------
            */

            const wawancaraCanvas = document.getElementById('wawancaraChart');

            if (wawancaraCanvas) {

                new Chart(wawancaraCanvas, {

                    type: 'doughnut',

                    data: {
                        labels: [
                            'Selesai',
                            'Belum Dilaksanakan'
                        ],

                        datasets: [{
                            data: [
                                wawancaraSelesai,
                                wawancaraBelum
                            ],

                            backgroundColor: [
                                '#10b981',
                                '#f59e0b'
                            ],

                            borderWidth: 0,

                            hoverOffset: 4
                        }]
                    },

                    options: doughnutOptions

                });
            }


            /*
            |--------------------------------------------------------------------------
            | STATUS TINDAK LANJUT
            |--------------------------------------------------------------------------
            */

            const tindakLanjutCanvas = document.getElementById('tindakLanjutChart');

            if (tindakLanjutCanvas) {

                new Chart(tindakLanjutCanvas, {

                    type: 'bar',

                    data: {
                        labels: [
                            'Belum Dimulai',
                            'Dalam Proses',
                            'Selesai'
                        ],

                        datasets: [{
                            label: 'Jumlah',

                            data: [
                                tindakLanjutBelum,
                                tindakLanjutDalamProses,
                                tindakLanjutSelesai
                            ],

                            backgroundColor: [
                                '#94a3b8',
                                '#3b82f6',
                                '#10b981'
                            ],

                            borderRadius: 8,

                            borderSkipped: false
                        }]
                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {

                            legend: {
                                display: false
                            },

                            tooltip: {
                                padding: 10
                            }

                        },

                        scales: {

                            y: {
                                beginAtZero: true,

                                ticks: {
                                    precision: 0,

                                    stepSize: 1
                                },

                                grid: {
                                    color: '#e2e8f0'
                                }
                            },

                            x: {
                                grid: {
                                    display: false
                                }
                            }

                        }
                    }

                });
            }

        });
    </script>

@endsection