<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPeta extends Model
{
    use HasFactory;

    protected $table = 'tabel_jenis_peta';
    protected $primaryKey = 'id_jenis_peta';
    public $timestamps = true;

    protected $fillable = [
        'nama_jenis_peta',
        'id_user',
        'updated_at'
    ];
}
