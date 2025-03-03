<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelurahan extends Model
{
    //
    use HasFactory;
    protected $table = 'tabel_kelurahan';
    protected $primaryKey = 'id_kelurahan';
    protected $fillable = [
        'id_kecamatan',
        'nama',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }
}
