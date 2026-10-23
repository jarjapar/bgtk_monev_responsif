<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolahs';

    protected $fillable = [
        'npsn',
        'nama_sekolah',
        'jenjang',
        'kabupaten_kota',
        'kecamatan',
        'alamat',
        'status_monitoring',
        'tahun_monitoring',
    ];

    protected $casts = [
        'tahun_monitoring' => 'integer',
    ];

    /**
     * Relasi ke instrumen BCKS.
     */
    public function bcksPengisians(): HasMany
    {
        return $this->hasMany(BcksPengisian::class, 'sekolah_id');
    }

    /**
     * Relasi ke instrumen BK.
     */
    public function bkSubmissions(): HasMany
    {
        return $this->hasMany(BKSubmission::class, 'sekolah_id');
    }

    /**
     * Relasi ke instrumen TENDIK.
     */
    public function tendiks(): HasMany
    {
        return $this->hasMany(Tendik::class, 'sekolah_id');
    }

    /**
     * Relasi ke instrumen Matematika GEMBIRA.
     */
    public function gembiraPengisians(): HasMany
    {
        return $this->hasMany(GembiraPengisian::class, 'sekolah_id');
    }
    public function pkgsdMbiPengisians(): HasMany
    {
        return $this->hasMany(PkgsdMbiPengisian::class, 'sekolah_id');
    }
    /**
     * Relasi ke data wawancara.
     */
    public function wawancaras(): HasMany
    {
        return $this->hasMany(Wawancara::class, 'sekolah_id');
    }

    /**
     * Relasi ke tindak lanjut.
     */
    public function tindakLanjuts(): HasMany
    {
        return $this->hasMany(TindakLanjut::class, 'sekolah_id');
    }
}
