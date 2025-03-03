<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ValueAttribut extends Model
{
    use HasFactory;

    protected $table = 'tabel_value_attribut';
    protected $primaryKey = 'id_data';
    public $timestamps = false;

    protected $fillable = [
        'id_atribut', 'id_collection', 'data_value', 'created', 'edited', 'add_by'
    ];

    public function atribut()
    {
        return $this->belongsTo(AtributLayer::class, 'id_atribut', 'id_atribut');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'id_collection', 'id_collection');
    }
}
