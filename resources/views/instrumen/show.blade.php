@extends('layouts.app')

@section('title', 'Detail Instrumen')
@section('page-title', 'Detail Instrumen')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-slate-500">
                    Monitoring & Evaluasi
                </p>

                <h1 class="mt-1 text-2xl font-bold text-slate-800">
                    Detail Instrumen
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi lengkap mengenai instrumen pemantauan dan evaluasi.
                </p>
            </div>

            <div class="flex gap-2">

                {{-- Kembali --}}
                <a href="{{ route('instrumen.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    Kembali
                </a>

                {{-- Edit --}}
                {{-- Edit --}}
                <a href="{{ route('instrumen.edit', ['instrumen' => $instrumen->id]) }}"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Edit Instrumen
                </a>

            </div>

        </div>


        {{-- Informasi Utama --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Detail --}}
            <div class="rounded-xl border border-slate-200 bg-white shadow-sm lg:col-span-2">

                <div class="border-b border-slate-200 px-6 py-5">

                    <h2 class="text-lg font-bold text-slate-800">
                        Informasi Instrumen
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Data utama instrumen yang telah tersimpan.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">

                    {{-- Kode Instrumen --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Kode Instrumen
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $instrumen->kode_instrumen }}
                        </p>
                    </div>


                    {{-- Nama Instrumen --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Nama Instrumen
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $instrumen->nama_instrumen }}
                        </p>
                    </div>


                    {{-- Jenis Instrumen --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Jenis Instrumen
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $instrumen->jenis_instrumen }}
                        </p>
                    </div>


                    {{-- Status --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Status
                        </p>

                        <div class="mt-1">

                            @if ($instrumen->status === 'Aktif')

                                <span
                                    class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    Aktif
                                </span>

                            @elseif ($instrumen->status === 'Selesai')

                                <span
                                    class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                    Selesai
                                </span>

                            @else

                                <span
                                    class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                    Draft
                                </span>

                            @endif

                        </div>
                    </div>


                    {{-- Jumlah Pertanyaan --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Jumlah Pertanyaan
                        </p>

                        <p class="mt-1 text-lg font-bold text-slate-800">
                            {{ $instrumen->jumlah_pertanyaan }}
                        </p>
                    </div>


                    {{-- Capaian --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Capaian
                        </p>

                        <p class="mt-1 text-lg font-bold text-blue-600">
                            {{ number_format($instrumen->capaian, 2) }}%
                        </p>
                    </div>


                    {{-- Tanggal Mulai --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Tanggal Mulai
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $instrumen->tanggal_mulai
        ? $instrumen->tanggal_mulai->format('d M Y')
        : '-' }}
                        </p>
                    </div>


                    {{-- Tanggal Selesai --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Tanggal Selesai
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $instrumen->tanggal_selesai
        ? $instrumen->tanggal_selesai->format('d M Y')
        : '-' }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Capaian --}}
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    Capaian Instrumen
                </p>


                {{-- Persentase --}}
                <div class="mt-5 flex items-center justify-center">

                    <div class="flex h-40 w-40 items-center justify-center rounded-full border-[12px] border-blue-100">

                        <div class="text-center">

                            <p class="text-3xl font-bold text-blue-600">
                                {{ number_format($instrumen->capaian, 0) }}%
                            </p>

                            <p class="text-xs text-slate-500">
                                Capaian
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Progress Bar --}}
                <div class="mt-6">

                    <div class="mb-2 flex justify-between text-xs font-medium">

                        <span class="text-slate-500">
                            Progress
                        </span>

                        <span class="text-slate-700">
                            {{ number_format($instrumen->capaian, 0) }}%
                        </span>

                    </div>


                    <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">

                        <div class="h-full rounded-full bg-blue-600 transition-all"
                            style="width: {{ min((float) $instrumen->capaian, 100) }}%">
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Deskripsi --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-bold text-slate-800">
                    Deskripsi
                </h2>

            </div>


            <div class="p-6">

                @if ($instrumen->deskripsi)

                    <p class="whitespace-pre-line text-sm leading-7 text-slate-600">
                        {{ $instrumen->deskripsi }}
                    </p>

                @else

                    <p class="text-sm italic text-slate-400">
                        Tidak ada deskripsi untuk instrumen ini.
                    </p>

                @endif

            </div>

        </div>


        {{-- Metadata --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-5">

                <h2 class="text-lg font-bold text-slate-800">
                    Informasi Sistem
                </h2>

            </div>


            <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">

                {{-- Dibuat --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Dibuat
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ $instrumen->created_at->format('d M Y, H:i') }}
                    </p>

                </div>


                {{-- Terakhir Diperbarui --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Terakhir Diperbarui
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ $instrumen->updated_at->format('d M Y, H:i') }}
                    </p>

                </div>

            </div>

        </div>

    </div>

@endsection