<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KBLI extends Model
{
    use HasFactory;
    
    protected $table = 'db_kbli';
    protected $primaryKey = 'id_kegiatan';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'id_kegiatan', 'kegiatan', 'nilai_kbli'
    ];
}
