
@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-medium text-blue-600">Administrasi Sistem</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-800">Manajemen Akun</h1>
            <p class="mt-1 text-sm text-slate-500">
                Kelola akun Petugas Monitoring dan Evaluasi.
            </p>
        </div>

        <a href="{{ route('manajemen-akun.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
            <span class="text-lg">+</span>
            Tambah Akun
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Petugas</p>
            <p class="mt-2 text-3xl font-bold text-slate-800">{{ $totalAkun }}</p>
            <p class="mt-1 text-xs text-slate-400">Seluruh akun petugas</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Akun Aktif</p>
            <p class="mt-2 text-3xl font-bold text-emerald-600">{{ $akunAktif }}</p>
            <p class="mt-1 text-xs text-slate-400">Dapat digunakan untuk login</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Akun Nonaktif</p>
            <p class="mt-2 text-3xl font-bold text-rose-600">{{ $akunNonaktif }}</p>
            <p class="mt-1 text-xs text-slate-400">Tidak dapat digunakan untuk login</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 p-5">
            <h2 class="font-semibold text-slate-800">Daftar Petugas Monev</h2>
            <p class="mt-1 text-sm text-slate-500">
                Cari akun berdasarkan nama, username, atau NIP.
            </p>

            <form method="GET" action="{{ route('manajemen-akun.index') }}"
                  class="mt-4 flex flex-col gap-3 sm:flex-row">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama, username, atau NIP..."
                    class="min-w-0 flex-1 rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >

                <select name="status"
                        class="rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 outline-none focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                    <option value="nonaktif" @selected(request('status') === 'nonaktif')>Nonaktif</option>
                </select>

                <button type="submit"
                        class="rounded-xl bg-slate-800 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-700">
                    Cari
                </button>

                <a href="{{ route('manajemen-akun.index') }}"
                   class="rounded-xl border border-slate-300 px-5 py-3 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Reset
                </a>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-4">No.</th>
                        <th class="px-5 py-4">Nama Petugas</th>
                        <th class="px-5 py-4">Username</th>
                        <th class="px-5 py-4">NIP</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($akun as $item)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-5 py-4 text-slate-500">
                                {{ $akun->firstItem() + $loop->index }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="font-semibold text-slate-800">{{ $item->name }}</div>
                                <div class="mt-1 text-xs text-slate-400">{{ $item->email }}</div>
                            </td>

                            <td class="px-5 py-4 text-slate-600">{{ $item->username }}</td>

                            <td class="px-5 py-4 font-mono text-slate-600">{{ $item->nip }}</td>

                            <td class="px-5 py-4">
                                @if ($item->is_active)
                                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('manajemen-akun.show', $item->id) }}"
                                       class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100">
                                        Detail
                                    </a>

                                    <a href="{{ route('manajemen-akun.edit', $item->id) }}"
                                       class="rounded-lg border border-blue-200 px-3 py-2 text-xs font-semibold text-blue-700 hover:bg-blue-50">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('manajemen-akun.destroy', $item->id) }}"
                                          onsubmit="return confirm('Yakin ingin mengubah status akun ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-lg border px-3 py-2 text-xs font-semibold {{ $item->is_active ? 'border-rose-200 text-rose-600 hover:bg-rose-50' : 'border-emerald-200 text-emerald-700 hover:bg-emerald-50' }}">
                                            {{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <div class="font-semibold text-slate-700">Data akun tidak ditemukan</div>
                                <p class="mt-1 text-sm text-slate-500">
                                    Coba ubah kata kunci pencarian atau filter status.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($akun->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $akun->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
