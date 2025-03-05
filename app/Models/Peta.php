<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Peta extends Model
{
    use HasFactory;

    protected $table = 'tabel_layer';
    protected $primaryKey = 'id_layer';
    public $timestamps = false;

    protected $fillable = [
        'nama_layer', 'id_opd', 'sumber', 'status', 'id_grup_layer', 
        'id_jenis_peta', 'link_api', 'deskripsi_layer'
    ];

    // Relasi ke tabel referensi OPD
    public function opd()
    {
        return $this->belongsTo(ReferensiOpd::class, 'id_opd');
    }

    // Relasi ke tabel grup layer
    public function grupLayer()
    {
        return $this->belongsTo(GrupLayer::class, 'id_grup_layer');
    }

    // Relasi ke tabel jenis peta
    public function jenisPeta()
    {
        return $this->belongsTo(JenisPeta::class, 'id_jenis_peta');
    }

    // Relasi ke tabel atribut layer
    public function atribut()
    {
        return $this->hasMany(AtributLayer::class, 'id_layer');
    }

    // Relasi ke tabel collection
    public function collections()
    {
        return $this->hasMany(Collection::class, 'id_layer');
    }

    // Fungsi untuk mengambil data dengan filter
    public static function getFilteredData($filters)
    {
        $query = self::query();

        if (!empty($filters['nama_layer'])) {
            $query->where('nama_layer', 'like', '%' . $filters['nama_layer'] . '%');
        }
        if (!empty($filters['id_opd'])) {
            $query->where('id_opd', $filters['id_opd']);
        }
        if (!empty($filters['sumber'])) {
            $query->where('sumber', $filters['sumber']);
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->with(['opd', 'grupLayer', 'jenisPeta'])->get();
    }


}

