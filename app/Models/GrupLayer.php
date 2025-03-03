<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrupLayer extends Model
{
    use HasFactory;
    protected $table = 'tabel_grup_layer';
    protected $primaryKey = 'id_grup_layer';

    protected $fillable = [
        'nama_grup_layer',
        'id_opd',
        'id_user'
    ];

    public function opd()
    {
        return $this->belongsTo(User::class, 'id_opd', 'id_opd');
    }
}

