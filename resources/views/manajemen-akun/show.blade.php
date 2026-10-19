@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-5xl space-y-6">

    {{-- Header --}}
    <div>
        <!-- <a href="{{ route('manajemen-akun.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition hover:text-blue-800">
            &larr; Kembali ke Manajemen Akun
        </a> -->

        <div class="mt-4">
            <p class="text-sm font-medium text-blue-600">Administrasi Sistem</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-800">
                Detail Anggota Monev
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap akun Petugas Monitoring dan Evaluasi.
            </p>
        </div>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Profil anggota --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 px-6 py-8 sm:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl border border-white/30 bg-white/20 text-3xl font-bold text-white">
                    {{ strtoupper(substr($akun->name, 0, 1)) }}
                </div>

                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold text-white">
                        {{ $akun->name }}
                    </h2>
                    <p class="mt-2 text-sm text-blue-100">
                        Petugas Monitoring dan Evaluasi
                    </p>

                    <div class="mt-3">
                        @if ($akun->is_active)
                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">
                                ● Akun Aktif
                            </span>
                        @else
                            <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-800">
                                ● Akun Nonaktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex shrink-0 gap-2">
                    <a href="{{ route('manajemen-akun.edit', $akun->id) }}"
                       class="rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-blue-700 transition hover:bg-blue-50">
                        Edit Anggota
                    </a>
                </div>
            </div>
        </div>

        {{-- Informasi akun --}}
        <div class="p-6 sm:p-8">
            <h3 class="text-lg font-semibold text-slate-800">
                Informasi Anggota
            </h3>
            <p class="mt-1 text-sm text-slate-500">
                Data identitas dan akun yang tersimpan dalam sistem.
            </p>

            <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">

                {{-- ID --}}
                <div class="rounded-xl border border-slate-200 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        ID Anggota
                    </p>
                    <p class="mt-2 break-words font-semibold text-slate-800">
                        {{ $akun->id }}
                    </p>
                </div>

                {{-- Nama --}}
                <div class="rounded-xl border border-slate-200 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Nama Lengkap
                    </p>
                    <p class="mt-2 break-words font-semibold text-slate-800">
                        {{ $akun->name }}
                    </p>
                </div>

                {{-- Username --}}
                <div class="rounded-xl border border-slate-200 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Username
                    </p>
                    <p class="mt-2 break-words font-semibold text-slate-800">
                        {{ $akun->username ?: '-' }}
                    </p>
                </div>

                {{-- NIP --}}
                <div class="rounded-xl border border-slate-200 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        NIP
                    </p>
                    <p class="mt-2 break-words font-mono font-semibold text-slate-800">
                        {{ $akun->nip ?: '-' }}
                    </p>
                </div>

                {{-- Email --}}
                <div class="rounded-xl border border-slate-200 p-4 sm:col-span-2">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Email
                    </p>
                    <p class="mt-2 break-all font-semibold text-slate-800">
                        {{ $akun->email ?: '-' }}
                    </p>
                </div>

                {{-- Role --}}
                <div class="rounded-xl border border-slate-200 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Hak Akses
                    </p>
                    <p class="mt-2 font-semibold text-slate-800">
                        {{ $akun->role === 'petugas_monev' ? 'Petugas Monev' : $akun->role }}
                    </p>
                </div>

                {{-- Status --}}
                <div class="rounded-xl border border-slate-200 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Status Akun
                    </p>
                    <p class="mt-2 font-semibold {{ $akun->is_active ? 'text-emerald-700' : 'text-rose-700' }}">
                        {{ $akun->is_active ? 'Aktif' : 'Nonaktif' }}
                    </p>
                </div>

            </div>

            {{-- Catatan keamanan --}}
            <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4">
                <div class="flex items-start gap-3">
                    <span class="text-lg">ⓘ</span>
                    <div>
                        <p class="text-sm font-semibold text-amber-900">
                            Informasi keamanan
                        </p>
                        <p class="mt-1 text-sm leading-6 text-amber-800">
                            Password tidak ditampilkan demi keamanan akun. Jika anggota lupa password,
                            Admin dapat mengubahnya melalui halaman Edit Anggota.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="flex flex-col-reverse justify-between gap-3 border-t border-slate-100 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:px-8">
            <a href="{{ route('manajemen-akun.index') }}"
               class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Kembali ke Daftar
            </a>

            <a href="{{ route('manajemen-akun.edit', $akun->id) }}"
               class="rounded-xl bg-blue-600 px-5 py-3 text-center text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                Edit Data Anggota
            </a>
        </div>
    </div>
</div>
@endsection