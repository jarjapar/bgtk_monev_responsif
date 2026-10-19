<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ManajemenAkunController extends Controller
{
    /**
     * Menampilkan daftar akun Petugas Monev.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'petugas_monev');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        if ($request->status === 'aktif') {
            $query->where('is_active', true);
        } elseif ($request->status === 'nonaktif') {
            $query->where('is_active', false);
        }

        $akun = $query->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $totalAkun = User::where('role', 'petugas_monev')->count();
        $akunAktif = User::where('role', 'petugas_monev')
            ->where('is_active', true)
            ->count();
        $akunNonaktif = User::where('role', 'petugas_monev')
            ->where('is_active', false)
            ->count();

        return view('manajemen-akun.index', compact(
            'akun',
            'totalAkun',
            'akunAktif',
            'akunNonaktif'
        ));
    }

    /**
     * Menampilkan formulir tambah akun.
     */
    public function create()
    {
        return view('manajemen-akun.create');
    }

    /**
     * Menyimpan akun Petugas Monev baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 'string', 'max:100', 'alpha_dash',
                'unique:users,username',
            ],
            'nip' => [
                'required', 'string', 'max:30',
                'unique:users,nip',
            ],
            'password' => [
                'required', 'confirmed', Password::min(8),
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'nip' => $validated['nip'],
            'email' => strtolower($validated['username'])
                . '@bgtk-monev.local',
            'password' => $validated['password'],
            'role' => 'petugas_monev',
            'is_active' => true,
        ]);

        return redirect()
            ->route('manajemen-akun.index')
            ->with('success', 'Akun Petugas Monev berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail akun.
     */
    public function show(User $manajemen_akun)
    {
        abort_unless(
            $manajemen_akun->role === 'petugas_monev',
            404
        );

        return view('manajemen-akun.show', [
            'akun' => $manajemen_akun,
        ]);
    }

    /**
     * Menampilkan formulir edit akun.
     */
    public function edit(User $manajemen_akun)
    {
        abort_unless(
            $manajemen_akun->role === 'petugas_monev',
            404
        );

        return view('manajemen-akun.edit', [
            'akun' => $manajemen_akun,
        ]);
    }

    /**
     * Memperbarui data akun.
     */
    public function update(Request $request, User $manajemen_akun)
    {
        abort_unless(
            $manajemen_akun->role === 'petugas_monev',
            404
        );

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 'string', 'max:100', 'alpha_dash',
                Rule::unique('users', 'username')->ignore($manajemen_akun->id),
            ],
            'nip' => [
                'required', 'string', 'max:30',
                Rule::unique('users', 'nip')->ignore($manajemen_akun->id),
            ],
            'password' => [
                'nullable', 'confirmed', Password::min(8),
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'username.alpha_dash' => 'Format username tidak valid.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $manajemen_akun->name = $validated['name'];
        $manajemen_akun->username = $validated['username'];
        $manajemen_akun->nip = $validated['nip'];
        $manajemen_akun->email = strtolower($validated['username'])
            . '@bgtk-monev.local';

        // Password hanya diubah jika kolom diisi.
        if (! empty($validated['password'])) {
            $manajemen_akun->password = $validated['password'];
        }

        $manajemen_akun->save();

        return redirect()
            ->route('manajemen-akun.index')
            ->with('success', 'Data akun berhasil diperbarui.');
    }

    /**
     * Mengaktifkan atau menonaktifkan akun.
     */
    public function destroy(User $manajemen_akun)
    {
        abort_unless(
            $manajemen_akun->role === 'petugas_monev',
            404
        );

        $manajemen_akun->is_active = ! $manajemen_akun->is_active;
        $manajemen_akun->save();

        $status = $manajemen_akun->is_active
            ? 'diaktifkan'
            : 'dinonaktifkan';

        return redirect()
            ->route('manajemen-akun.index')
            ->with('success', "Akun berhasil {$status}.");
    }
}
