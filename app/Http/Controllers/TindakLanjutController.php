<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\TindakLanjut;
use App\Models\Wawancara;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    public function index()
    {
        $tindakLanjuts = TindakLanjut::with([
            'sekolah',
            'wawancara',
        ])
            ->latest()
            ->paginate(10);

        $totalTindakLanjut = TindakLanjut::count();

        $belumDimulai = TindakLanjut::where(
            'status',
            'Belum Dimulai'
        )->count();

        $dalamProses = TindakLanjut::where(
            'status',
            'Dalam Proses'
        )->count();

        $selesai = TindakLanjut::where(
            'status',
            'Selesai'
        )->count();

        return view('tindak-lanjut.index', compact(
            'tindakLanjuts',
            'totalTindakLanjut',
            'belumDimulai',
            'dalamProses',
            'selesai'
        ));
    }

    public function create()
    {
        $sekolahs = Sekolah::orderBy(
            'nama_sekolah'
        )->get();

        $wawancaras = Wawancara::with([
            'sekolah',
        ])
            ->latest('tanggal_wawancara')
            ->get();

        return view('tindak-lanjut.create', compact(
            'sekolahs',
            'wawancaras'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sekolah_id' => [
                'required',
                'exists:sekolahs,id',
            ],
            'wawancara_id' => [
                'nullable',
                'exists:wawancaras,id',
            ],
            'judul_tindak_lanjut' => [
                'required',
                'string',
                'max:255',
            ],
            'uraian_tindak_lanjut' => [
                'required',
                'string',
            ],
            'penanggung_jawab' => [
                'required',
                'string',
                'max:255',
            ],
            'tanggal_mulai' => [
                'nullable',
                'date',
            ],
            'target_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
            'status' => [
                'required',
                'in:Belum Dimulai,Dalam Proses,Selesai',
            ],
            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        TindakLanjut::create($validated);

        return redirect()
            ->route('tindak-lanjut.index')
            ->with(
                'success',
                'Data tindak lanjut berhasil ditambahkan.'
            );
    }

    public function show(TindakLanjut $tindakLanjut)
    {
        $tindakLanjut->load([
            'sekolah',
            'wawancara',
        ]);

        return view(
            'tindak-lanjut.show',
            compact('tindakLanjut')
        );
    }

    public function edit(TindakLanjut $tindakLanjut)
    {
        $sekolahs = Sekolah::orderBy(
            'nama_sekolah'
        )->get();

        $wawancaras = Wawancara::with([
            'sekolah',
        ])
            ->latest('tanggal_wawancara')
            ->get();

        return view(
            'tindak-lanjut.edit',
            compact(
                'tindakLanjut',
                'sekolahs',
                'wawancaras'
            )
        );
    }

    public function update(
        Request $request,
        TindakLanjut $tindakLanjut
    ) {
        $validated = $request->validate([
            'sekolah_id' => [
                'required',
                'exists:sekolahs,id',
            ],
            'wawancara_id' => [
                'nullable',
                'exists:wawancaras,id',
            ],
            'judul_tindak_lanjut' => [
                'required',
                'string',
                'max:255',
            ],
            'uraian_tindak_lanjut' => [
                'required',
                'string',
            ],
            'penanggung_jawab' => [
                'required',
                'string',
                'max:255',
            ],
            'tanggal_mulai' => [
                'nullable',
                'date',
            ],
            'target_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
            'status' => [
                'required',
                'in:Belum Dimulai,Dalam Proses,Selesai',
            ],
            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $tindakLanjut->update($validated);

        return redirect()
            ->route('tindak-lanjut.index')
            ->with(
                'success',
                'Data tindak lanjut berhasil diperbarui.'
            );
    }

    public function destroy(TindakLanjut $tindakLanjut)
    {
        $tindakLanjut->delete();

        return redirect()
            ->route('tindak-lanjut.index')
            ->with(
                'success',
                'Data tindak lanjut berhasil dihapus.'
            );
    }
}