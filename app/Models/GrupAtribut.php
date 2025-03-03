<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrupAtribut extends Model
{
    use HasFactory;

    protected $table = 'tabel_grup_atribut';
    protected $primaryKey = 'id_grup_atribut';
    public $timestamps = true;

    protected $fillable = [
        'id_layer', 'judul_grup_atribut', 'sub_judul_grup_atribut', 'tipe_grup_atribut', 
        'ukuran_grup_atribut', 'pos_grup_atribut_item', 'id_user'
    ];

    public function layer()
    {
        return $this->belongsTo(Layer::class, 'id_layer', 'id_layer');
    }
}
