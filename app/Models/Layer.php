<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layer extends Model
{
    //

    use HasFactory;

    protected $table = 'tabel_layer';
    protected $primaryKey = 'id_layer';
    public $timestamps = false;

    protected $fillable = [
        'id_grup_layer',
        'id_jenis_peta',
        'nama_layer',
        'deskripsi_layer',
        'id_opd',
        'sumber',
        'link_api',
        'status',
        'pos_grup_atribut',
        'ditambahkan',
        'diupdate',
        'ditambah_oleh',
        'diubah_oleh',
        'is_delete',
        'dihapus_oleh',
        'order_by',
        'is_perbaikan'
    ];

    public function grupLayer()
    {
        return $this->belongsTo(GrupLayer::class, 'id_grup_layer', 'id_grup_layer');
    }

    public function jenisPeta()
    {
        return $this->belongsTo(JenisPeta::class, 'id_jenis_peta', 'id_jenis_peta');
    }

    public function opd()
    {
        return $this->belongsTo(ReferensiOpd::class, 'id_opd', 'id_opd');
    }

    public function ditambahOleh()
    {
        return $this->belongsTo(User::class, 'ditambah_oleh', 'id_user');
    }

    public function diubahOleh()
    {
        return $this->belongsTo(User::class, 'diubah_oleh', 'id_user');
    }
}
