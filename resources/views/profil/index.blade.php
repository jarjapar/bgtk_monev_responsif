@extends('layouts.app')

@section('title', 'Profil Saya')

@section('page-title', 'Profil Saya')

@section('content')
    <div class="mx-auto max-w-5xl space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="mt-1 text-2xl font-bold text-slate-800">
                Profil Saya
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Informasi akun pengguna yang sedang masuk ke sistem BGTK Monev.
            </p>
        </div>

        {{-- Kartu Profil --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

{{-- Banner Profil --}}
<div class="min-h-[180px] bg-gradient-to-r from-blue-700 via-blue-600 to-blue-700 px-8 py-8 sm:px-10 sm:py-9">
    <div class="flex min-h-[116px] flex-col items-start justify-center gap-6 sm:flex-row sm:items-center sm:gap-8">

        {{-- Avatar --}}
        <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl border border-white/40 bg-white/15 text-3xl font-bold text-white">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        {{-- Identitas Pengguna --}}
        <div class="min-w-0 flex-1">
            <h2 class="break-words text-2xl font-bold leading-8 text-white">
                {{ auth()->user()->name }}
            </h2>

            <p class="mt-3 text-sm leading-5 text-blue-100">
                {{ auth()->user()->isAdmin() ? 'Administrator' : 'Petugas Monev' }}
            </p>

            {{-- Status Akun --}}
            <div class="mt-4">
                @if (auth()->user()->is_active)
                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-2 text-xs font-semibold leading-4 text-emerald-800">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                        Akun Aktif
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 rounded-full bg-rose-100 px-4 py-2 text-xs font-semibold leading-4 text-rose-800">
                        <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                        Akun Nonaktif
                    </span>
                @endif
            </div>
        </div>

    </div>
</div>
            {{-- Detail Profil --}}
            <div class="p-6 sm:p-8">

                <h3 class="text-lg font-semibold text-slate-800">
                    Informasi Pengguna
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Berikut adalah informasi akun yang terdaftar pada sistem.
                </p>

                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- Nama --}}
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Nama Lengkap
                        </p>
                        <p class="mt-2 break-words font-semibold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>
                    </div>

                    {{-- Username --}}
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Username
                        </p>
                        <p class="mt-2 break-words font-semibold text-slate-800">
                            {{ auth()->user()->username ?: '-' }}
                        </p>
                    </div>

                    {{-- NIP --}}
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            NIP
                        </p>
                        <p class="mt-2 break-words font-mono font-semibold text-slate-800">
                            {{ auth()->user()->nip ?: '-' }}
                        </p>
                    </div>

                    {{-- Email --}}
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Email
                        </p>
                        <p class="mt-2 break-all font-semibold text-slate-800">
                            {{ auth()->user()->email ?: '-' }}
                        </p>
                    </div>

                    {{-- Role --}}
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Hak Akses
                        </p>
                        <p class="mt-2 font-semibold text-slate-800">
                            {{ auth()->user()->isAdmin() ? 'Administrator' : 'Petugas Monev' }}
                        </p>
                    </div>

                    {{-- ID --}}
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            ID Pengguna
                        </p>
                        <p class="mt-2 font-semibold text-slate-800">
                            {{ auth()->user()->id }}
                        </p>
                    </div>

                </div>

                {{-- Informasi Keamanan --}}
                <div class="mt-6 rounded-xl border border-blue-100 bg-blue-50 p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 11c-1.1 0-2 .9-2 2v2h4v-2c0-1.1-.9-2-2-2z" />
                                <rect width="12" height="10" x="6" y="10" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10V7a4 4 0 018 0v3" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-blue-900">
                                Keamanan Akun
                            </p>
                            <p class="mt-1 text-sm leading-6 text-blue-800">
                                Jangan membagikan password kepada orang lain.
                                Jika memerlukan perubahan data akun, hubungi Administrator sistem.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-end border-t border-slate-100 bg-slate-50 px-6 py-5 sm:px-8">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Kembali ke Dashboard
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
@endsection