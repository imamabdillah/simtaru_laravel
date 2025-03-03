<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class API extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tabel_api';
    protected $primaryKey = 'id_api';
    protected $fillable = [
        'nama_pemohon', 'token', 'akses_layer', 'id_user', 'id_opd', 'created_by', 'updated_by', 'deleted_by', 'aktif'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function opd()
    {
        return $this->belongsTo(ReferensiOpd::class, 'id_opd', 'id_opd');
    }
}
