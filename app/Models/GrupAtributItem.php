<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrupAtributItem extends Model
{
    use HasFactory;

    protected $table = 'tabel_grup_atribut_item';
    protected $primaryKey = 'id_grup_atribut_item';
    public $timestamps = true;

    protected $fillable = [
        'id_grup_atribut', 'id_atribut', 'nama_atribut_layer', 'alias_atribut_layer', 'user_id', 'created_at', 'updated_at'
    ];

    public function grupAtribut()
    {
        return $this->belongsTo(GrupAtribut::class, 'id_grup_atribut', 'id_grup_atribut');
    }

    public function atributLayer()
    {
        return $this->belongsTo(AtributLayer::class, 'id_atribut', 'id_atribut');
    }
}
