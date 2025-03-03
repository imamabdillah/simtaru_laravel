<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AtributLayer extends Model
{
    use HasFactory;

    protected $table = 'tabel_atribut_layer';
    protected $primaryKey = 'id_atribut';
    public $timestamps = false;

    protected $fillable = [
        'id_layer', 'nama_atribut', 'slug', 'tipe_data', 'added', 'edited', 'add_by', 'is_delete'
    ];

    public function layer()
    {
        return $this->belongsTo(Layer::class, 'id_layer', 'id_layer');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'add_by', 'id_user');
    }
}
