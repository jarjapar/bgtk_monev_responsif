
@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <div>
        <a href="{{ route('manajemen-akun.index') }}"
           class="text-sm font-medium text-blue-600 hover:text-blue-800">
            &larr; Kembali ke Manajemen Akun
        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-800">Tambah Akun Petugas</h1>
        <p class="mt-1 text-sm text-slate-500">
            Lengkapi data berikut untuk membuat akun Petugas Monev baru.
        </p>
    </div>

    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('manajemen-akun.store') }}"
          method="POST"
          class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        @csrf

        <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="font-semibold text-slate-800">Informasi Akun</h2>
            <p class="mt-1 text-sm text-slate-500">
                Akun baru akan dibuat dengan role Petugas Monev.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">
            <div class="md:col-span-2">
                <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                    Nama Petugas <span class="text-red-500">*</span>
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    maxlength="255"
                    autocomplete="name"
                    placeholder="Masukkan nama petugas"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >
            </div>

            <div>
                <label for="username" class="mb-2 block text-sm font-medium text-slate-700">
                    Username <span class="text-red-500">*</span>
                </label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    value="{{ old('username') }}"
                    required
                    maxlength="100"
                    autocomplete="username"
                    placeholder="Contoh: BudiMonev"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >
                <p class="mt-1 text-xs text-slate-400">
                    Gunakan huruf, angka, tanda hubung, atau garis bawah.
                </p>
            </div>

            <div>
                <label for="nip" class="mb-2 block text-sm font-medium text-slate-700">
                    NIP <span class="text-red-500">*</span>
                </label>
                <input
                    id="nip"
                    name="nip"
                    type="text"
                    value="{{ old('nip') }}"
                    required
                    maxlength="30"
                    autocomplete="off"
                    placeholder="Masukkan NIP"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >
                <p class="mt-1 text-xs text-slate-400">
                    NIP disimpan sebagai identitas petugas.
                </p>
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                    Password <span class="text-red-500">*</span>
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    minlength="8"
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">
                    Konfirmasi Password <span class="text-red-500">*</span>
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    minlength="8"
                    autocomplete="new-password"
                    placeholder="Ulangi password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >
            </div>
        </div>

        <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 bg-slate-50 px-6 py-5 sm:flex-row">
            <a href="{{ route('manajemen-akun.index') }}"
               class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Batal
            </a>

            <button type="submit"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                Simpan Akun
            </button>
        </div>
    </form>
</div>
@endsection
