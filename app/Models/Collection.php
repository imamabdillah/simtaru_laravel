<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'tabel_collection';
    protected $primaryKey = 'id_collection';
    public $timestamps = false;

    protected $fillable = [
        'id_layer', 'tipe_layer', 'stroke', 'stroke_opacity', 'stroke_width', 'stroke_dash', 'fill', 'fill_opacity',
        'icon_name', 'page_detail', 'koordinat', 'name', 'group', 'created', 'edited', 'add_by'
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
