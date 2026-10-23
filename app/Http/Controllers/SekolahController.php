<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SekolahController extends Controller
{
    /**
     * Menampilkan daftar sekolah.
     */
    public function index()
    {
        $query = Sekolah::query()
            ->withCount([
                'bcksPengisians',
                'bkSubmissions',
                'tendiks',
                'gembiraPengisians',
                'wawancaras',
            ])
            ->with('wawancaras:id,sekolah_id,jenis_wawancara');

        if (request()->filled('jenjang')) {
            $query->where('jenjang', request('jenjang'));
        }

        if (request()->filled('kabupaten_kota')) {
            $query->where('kabupaten_kota', request('kabupaten_kota'));
        }

        if (request()->filled('status_monitoring')) {
            $query->where('status_monitoring', request('status_monitoring'));
        }

        if (request()->filled('cari')) {
            $cari = trim(request('cari'));

            $query->where(function ($q) use ($cari) {
                $q->where('nama_sekolah', 'like', "%{$cari}%")
                    ->orWhere('npsn', 'like', "%{$cari}%");
            });
        }

        $sekolahs = $query->latest()->paginate(10)->withQueryString();

        $totalSekolah = Sekolah::count();

        $sudahDimonitor = Sekolah::where(
            'status_monitoring',
            'Sudah Dimonitor'
        )->count();

        $belumDimonitor = Sekolah::where(
            'status_monitoring',
            'Belum Dimonitor'
        )->count();

        $wilayah = Sekolah::query()
            ->whereNotNull('kabupaten_kota')
            ->where('kabupaten_kota', '<>', '')
            ->distinct('kabupaten_kota')
            ->count('kabupaten_kota');

        $daftarWilayah = Sekolah::query()
            ->whereNotNull('kabupaten_kota')
            ->where('kabupaten_kota', '<>', '')
            ->distinct()
            ->orderBy('kabupaten_kota')
            ->pluck('kabupaten_kota');

        return view('sekolah.index', compact(
            'sekolahs',
            'totalSekolah',
            'sudahDimonitor',
            'belumDimonitor',
            'wilayah',
            'daftarWilayah'
        ));
    }

    /**
     * Menampilkan form tambah sekolah.
     */
    public function create()
    {
        return view('sekolah.create');
    }

    /**
     * Menyimpan data sekolah baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'npsn' => [
                'nullable',
                'string',
                'max:20',
                'unique:sekolahs,npsn',
            ],
            'nama_sekolah' => [
                'required',
                'string',
                'max:255',
            ],
            'jenjang' => [
                'nullable',
                Rule::in(['SD', 'SMP', 'SMA', 'SMK']),
            ],
            'kabupaten_kota' => [
                'nullable',
                'string',
                'max:255',
            ],
            'kecamatan' => [
                'nullable',
                'string',
                'max:255',
            ],
            'alamat' => [
                'nullable',
                'string',
            ],
            'status_monitoring' => [
                'required',
                Rule::in(['Sudah Dimonitor', 'Belum Dimonitor']),
            ],
            'tahun_monitoring' => [
                'nullable',
                'integer',
                'min:2000',
                'max:2100',
            ],
        ]);

        $validated['npsn'] = $validated['npsn'] ?: null;
        $validated['jenjang'] = $validated['jenjang'] ?: null;
        $validated['kabupaten_kota'] =
            $validated['kabupaten_kota'] ?: null;

        Sekolah::create($validated);

        return redirect()
            ->route('sekolah.index')
            ->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail sekolah.
     */
    public function show(Sekolah $sekolah)
    {
        return view('sekolah.show', compact('sekolah'));
    }

    /**
     * Menampilkan form edit sekolah.
     */
    public function edit(Sekolah $sekolah)
    {
        return view('sekolah.edit', compact('sekolah'));
    }

    /**
     * Memperbarui data sekolah.
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        $validated = $request->validate([
            'npsn' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('sekolahs', 'npsn')->ignore($sekolah->id),
            ],
            'nama_sekolah' => [
                'required',
                'string',
                'max:255',
            ],
            'jenjang' => [
                'nullable',
                Rule::in(['SD', 'SMP', 'SMA', 'SMK']),
            ],
            'kabupaten_kota' => [
                'nullable',
                'string',
                'max:255',
            ],
            'kecamatan' => [
                'nullable',
                'string',
                'max:255',
            ],
            'alamat' => [
                'nullable',
                'string',
            ],
            'status_monitoring' => [
                'required',
                Rule::in(['Sudah Dimonitor', 'Belum Dimonitor']),
            ],
            'tahun_monitoring' => [
                'nullable',
                'integer',
                'min:2000',
                'max:2100',
            ],
        ]);

        $validated['npsn'] = $validated['npsn'] ?: null;
        $validated['jenjang'] = $validated['jenjang'] ?: null;
        $validated['kabupaten_kota'] =
            $validated['kabupaten_kota'] ?: null;

        $sekolah->update($validated);

        return redirect()
            ->route('sekolah.index')
            ->with('success', 'Data sekolah berhasil diperbarui.');
    }

    /**
     * Menghapus data sekolah.
     */
    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();

        return redirect()
            ->route('sekolah.index')
            ->with('success', 'Data sekolah berhasil dihapus.');
    }
}
