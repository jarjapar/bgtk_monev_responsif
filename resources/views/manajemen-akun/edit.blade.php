@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">

    {{-- Header --}}
    <div>
        <a href="{{ route('manajemen-akun.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 transition hover:text-blue-800">
            <span>&larr;</span>
            Kembali ke Manajemen Akun
        </a>

        <div class="mt-4">
            <p class="text-sm font-medium text-blue-600">Administrasi Sistem</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-800">
                Edit Data Anggota Monev
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Perbarui informasi anggota yang sudah terdaftar di sistem.
            </p>
        </div>
    </div>

    {{-- Informasi akun --}}
    <div class="flex items-center gap-4 rounded-2xl border border-blue-100 bg-blue-50 p-5">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-600 text-xl font-bold text-white">
            {{ strtoupper(substr($akun->name, 0, 1)) }}
        </div>

        <div class="min-w-0">
            <h2 class="font-semibold text-slate-800">{{ $akun->name }}</h2>
            <p class="mt-1 text-sm text-slate-600">
                Username: {{ $akun->username }}
            </p>
            <p class="mt-1 text-xs text-slate-500">
                ID Anggota: {{ $akun->id }}
            </p>
        </div>

        <div class="ml-auto shrink-0">
            @if ($akun->is_active)
                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                    Aktif
                </span>
            @else
                <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">
                    Nonaktif
                </span>
            @endif
        </div>
    </div>

    {{-- Pesan validasi --}}
    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-2 font-semibold">Data belum dapat disimpan.</p>
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form edit --}}
    <form action="{{ route('manajemen-akun.update', $akun->id) }}"
          method="POST"
          class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        @csrf
        @method('PUT')

        <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="font-semibold text-slate-800">Informasi Anggota</h2>
            <p class="mt-1 text-sm text-slate-500">
                Ubah kolom yang ingin diperbarui, kemudian simpan perubahan.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

            {{-- Nama --}}
            <div class="md:col-span-2">
                <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $akun->name) }}"
                    required
                    maxlength="255"
                    autocomplete="name"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Masukkan nama lengkap"
                >
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Username --}}
            <div>
                <label for="username" class="mb-2 block text-sm font-medium text-slate-700">
                    Username <span class="text-red-500">*</span>
                </label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    value="{{ old('username', $akun->username) }}"
                    required
                    maxlength="100"
                    autocomplete="username"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Masukkan username"
                >
                <p class="mt-1 text-xs text-slate-400">
                    Gunakan huruf, angka, tanda hubung, atau garis bawah.
                </p>
                @error('username')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIP --}}
            <div>
                <label for="nip" class="mb-2 block text-sm font-medium text-slate-700">
                    NIP <span class="text-red-500">*</span>
                </label>
                <input
                    id="nip"
                    name="nip"
                    type="text"
                    value="{{ old('nip', $akun->nip) }}"
                    required
                    maxlength="30"
                    autocomplete="off"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Masukkan NIP"
                >
                @error('nip')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email otomatis --}}
            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Email Sistem
                </label>
                <input
                    type="text"
                    value="{{ $akun->email }}"
                    readonly
                    class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500"
                >
                <p class="mt-1 text-xs text-slate-400">
                    Email sistem akan diperbarui otomatis mengikuti username.
                </p>
            </div>

        </div>

        {{-- Bagian password --}}
        <div class="border-t border-slate-100 px-6 py-5">
            <h2 class="font-semibold text-slate-800">Ganti Password</h2>
            <p class="mt-1 text-sm text-slate-500">
                Kosongkan kedua kolom jika ingin mempertahankan password saat ini.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 px-6 pb-6 md:grid-cols-2">

            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                    Password Baru
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    minlength="8"
                    autocomplete="new-password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Minimal 8 karakter"
                >
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">
                    Konfirmasi Password Baru
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    minlength="8"
                    autocomplete="new-password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    placeholder="Ulangi password baru"
                >
            </div>
        </div>

        
        {{-- Tombol --}}
        <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 bg-slate-50 px-6 py-5 sm:flex-row">
            <a href="{{ route('manajemen-akun.index') }}"
               class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Batal
            </a>

            <button
                type="submit"
                class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection